<?php
/**
 * update_db.php - Update Database for PayU Integration
 * 
 * Run this file once to add the necessary columns to the 'orders' table.
 */

require_once 'admin/db.php';

$sql = "ALTER TABLE `orders` 
        ADD COLUMN `payu_txnid` VARCHAR(100) DEFAULT NULL AFTER `razorpay_payment_id`,
        ADD COLUMN `payu_response` TEXT DEFAULT NULL AFTER `payu_txnid`;";

if ($conn->query($sql)) {
    echo "Database updated successfully. Columns 'payu_txnid' and 'payu_response' added to 'orders' table.";
} else {
    echo "Error updating database: " . $conn->error;
    // Check if columns already exist
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "<br>Note: Columns may already exist.";
    }
}
?>
