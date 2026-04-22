<?php
/**
 * failure.php - PayU Failure Callback Handler
 * 
 * This file handles failed PayU transactions and updates the order status.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'admin/db.php';
require_once 'includes/payu_config.php';
require_once 'admin/notification_helper.php';

// Debug: Log raw response
// file_put_contents('payu_debug.txt', date('Y-m-d H:i:s') . " - FAILURE: " . json_encode($_POST) . "\n", FILE_APPEND);

// Handle failure response
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['txnid'])) {
    
    $txnid = $_POST['txnid'];
    $status = $_POST['status'];
    $error_msg = $_POST['error_Message'] ?? ($_POST['field9'] ?? 'Payment failed at gateway.');
    $amount = $_POST['amount'];
    $payu_id = $_POST['mihpayid'] ?? '';
    
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
        
        // Update Order Status to "Failed"
        $upd = $conn->prepare("UPDATE orders SET payment_status = 'failed', status = 'pending_payment', payu_response = ? WHERE id = ?");
        if (!$upd) {
            die("Error in database update: " . $conn->error);
        }
        $response_json = json_encode($_POST);
        $upd->bind_param("si", $response_json, $order_id);
        $upd->execute();
        
        // Record Payment in payments table if it exists
        $ins_pay = $conn->prepare("INSERT INTO payments (user_id, order_id, payment_id, amount, status, method, error_message) VALUES (?, ?, ?, ?, 'failed', 'PayU', ?)");
        if ($ins_pay) {
            $ins_pay->bind_param("iisds", $user_id, $order_id, $payu_id, $amount, $error_msg);
            $ins_pay->execute();
        }
        
        // Add Admin Notification
        addNotification($conn, 'order', "PayU Payment Failed: $order_number", "order_details.php?id=$order_id");
        
        // Redirect to front-end failure page
        header("Location: payment-failed.php?error=" . urlencode($error_msg));
        exit;
    } else {
        $error_msg = "Order not found for transaction ID: " . $txnid;
    }
} else {
    $error_msg = "Invalid request or transaction ID missing.";
}

// If error occurred, redirect to failure page
header("Location: payment-failed.php?error=" . urlencode($error_msg));
exit;
?>
