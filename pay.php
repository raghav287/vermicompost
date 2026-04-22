<?php
/**
 * pay.php - PayU Payment Processing
 * 
 * This file handles the generation of PayU hash and redirects the user
 * to the PayU payment page.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'admin/db.php';
require_once 'includes/payu_config.php';

// Validate order_id
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Error: Missing Order ID.");
}

$order_id = intval($_GET['order_id']);

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
if (!$stmt) {
    die("Error in database query: " . $conn->error);
}
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    die("Error: Order not found.");
}

// Generate unique transaction ID for this payment attempt
$txnid = 'PAYU_' . time() . '_' . $order['id'];

// Check if payu_txnid column exists, if not, try to add it (Senior dev approach: auto-fix if possible)
$check_col = $conn->query("SHOW COLUMNS FROM `orders` LIKE 'payu_txnid'");
if ($check_col->num_rows == 0) {
    $conn->query("ALTER TABLE `orders` ADD COLUMN `payu_txnid` VARCHAR(100) DEFAULT NULL AFTER `razorpay_payment_id` ");
}
$check_res = $conn->query("SHOW COLUMNS FROM `orders` LIKE 'payu_response'");
if ($check_res->num_rows == 0) {
    $conn->query("ALTER TABLE `orders` ADD COLUMN `payu_response` TEXT DEFAULT NULL AFTER `payu_txnid` ");
}

// Update order with PayU txnid
$upd = $conn->prepare("UPDATE orders SET payu_txnid = ? WHERE id = ?");
if (!$upd) {
    die("Error preparing update: " . $conn->error);
}
$upd->bind_param("si", $txnid, $order_id);
$upd->execute();

// Prepare PayU data
$firstname = "Customer";
if (!empty($order['customer_name'])) {
    $firstname = trim(explode(' ', $order['customer_name'])[0]);
}
if(empty($firstname)) $firstname = 'Customer';

$amount = number_format((float)$order['total_amount'], 2, '.', '');
$productinfo = "Order" . $order['order_number'];

$payu_data = [
    'key'         => PAYU_MERCHANT_KEY,
    'txnid'       => $txnid,
    'amount'      => $amount,
    'productinfo' => $productinfo,
    'firstname'   => $firstname,
    'email'       => trim($order['customer_email']),
    'phone'       => trim($order['customer_phone']),
    'surl'        => PAYU_SUCCESS_URL,
    'furl'        => PAYU_FAILURE_URL,
    'udf1'        => '',
    'udf2'        => '',
    'udf3'        => '',
    'udf4'        => '',
    'udf5'        => ''
];

// Generate Hash
$hash = generatePayUHash($payu_data, PAYU_MERCHANT_SALT);

// PayU Test URL
$payu_url = (PAYU_MODE === 'live') ? PAYU_LIVE_URL : PAYU_TEST_URL;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Redirecting to PayU...</title>
</head>

<body>
    <div style="text-align:center; margin-top:100px; font-family:Arial;">
        <h2>Connecting to Secure Gateway...</h2>
        <p>Please wait, do not refresh this page.</p>
        <p>If not redirected within 5 seconds, <a href="javascript:void(0);"
                onclick="document.getElementById('payuForm').submit();">click here</a>.</p>
    </div>

    <form action="<?php echo $payu_url; ?>" method="post" id="payuForm">
        <input type="hidden" name="key" value="<?php echo PAYU_MERCHANT_KEY; ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
        <input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
        <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
        <input type="hidden" name="email" value="<?php echo $payu_data['email']; ?>" />
        <input type="hidden" name="phone" value="<?php echo $payu_data['phone']; ?>" />
        <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
        <input type="hidden" name="surl" value="<?php echo PAYU_SUCCESS_URL; ?>" />
        <input type="hidden" name="furl" value="<?php echo PAYU_FAILURE_URL; ?>" />
        <input type="hidden" name="udf1" value="" />
        <input type="hidden" name="udf2" value="" />
        <input type="hidden" name="udf3" value="" />
        <input type="hidden" name="udf4" value="" />
        <input type="hidden" name="udf5" value="" />
        <!-- Removing service_provider as it can cause issues in PayU Biz Hosted Checkout -->
    </form>

    <script type="text/javascript">
    window.onload = function() {
        document.getElementById('payuForm').submit();
    };
    </script>
</body>

</html>