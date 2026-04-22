<?php
/**
 * success.php - PayU Success Callback Handler
 * 
 * This file verifies the PayU hash and updates the order status to "Paid".
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'admin/db.php';
require_once 'includes/payu_config.php';
require_once 'admin/notification_helper.php';

// Verify PayU response
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hash'])) {
    
    // Check if the hash matches
    if (verifyPayUHash($_POST, PAYU_MERCHANT_SALT)) {
        
        $txnid = $_POST['txnid'];
        $status = $_POST['status'];
        $amount = $_POST['amount'];
        $payu_id = $_POST['mihpayid']; // PayU's unique payment ID
        
        // Fetch order based on txnid
        $stmt = $conn->prepare("SELECT * FROM orders WHERE payu_txnid = ?");
        if (!$stmt) {
            die("Error in database query: " . $conn->error);
        }
        $stmt->bind_param("s", $txnid);
        $stmt->execute();
        $order = $stmt->get_result()->fetch_assoc();
        
        if ($order) {
            $order_id = $order['id'];
            $order_number = $order['order_number'];
            $user_id = $order['user_id'];
            
            // Security: Check if amount matches
            if (number_format($order['total_amount'], 2, '.', '') == number_format($amount, 2, '.', '')) {
                
                // Update Order Status to "Paid"
                $upd = $conn->prepare("UPDATE orders SET payment_status = 'paid', status = 'processing', payu_response = ? WHERE id = ?");
                if (!$upd) {
                    die("Error in database update: " . $conn->error);
                }
                $response_json = json_encode($_POST);
                $upd->bind_param("si", $response_json, $order_id);
                $upd->execute();
                
                // Record Payment in payments table if it exists
                $ins_pay = $conn->prepare("INSERT INTO payments (user_id, order_id, payment_id, amount, status, method) VALUES (?, ?, ?, ?, 'success', 'PayU')");
                $ins_pay->bind_param("iisd", $user_id, $order_id, $payu_id, $amount);
                $ins_pay->execute();
                
                // Clear Cart
                if ($user_id) {
                    $conn->query("DELETE FROM carts WHERE user_id = $user_id");
                } elseif (isset($_SESSION['cart_session_id'])) {
                    $c_sess = $_SESSION['cart_session_id'];
                    $conn->query("DELETE FROM carts WHERE session_id = '$c_sess'");
                }
                
                // Add Admin Notification
                addNotification($conn, 'order', "PayU Payment Success: $order_number", "order_details.php?id=$order_id");
                
                // Send Email Confirmation
                require_once 'includes/send_email_helper.php';
                sendOrderConfirmation($conn, $order_id);
                
                // Redirect to front-end success page
                header("Location: payment-success.php?order_number=" . $order_number);
                exit;
                
            } else {
                $error_msg = "Amount mismatch. Security violation.";
            }
        } else {
            $error_msg = "Order not found for transaction ID: " . $txnid;
        }
    } else {
        $error_msg = "Hash verification failed. Potential tampering.";
    }
} else {
    $error_msg = "Invalid request method or missing parameters.";
}

// If error occurred, redirect to failure page
header("Location: payment-failed.php?error=" . urlencode($error_msg));
exit;
?>
