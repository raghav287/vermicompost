<?php
require_once 'db.php';

echo "<h2>Checking for payment_status column...</h2>";

// Check if column exists
$check = $conn->query("SHOW COLUMNS FROM orders LIKE 'payment_status'");

if ($check->num_rows == 0) {
    echo "Column missing. Adding it...<br>";
    // Add column
    $sql = "ALTER TABLE orders ADD COLUMN payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending' AFTER payment_method";
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added 'payment_status' column.<br>";
        
        // Backfill data
        echo "Backfilling data...<br>";
        $conn->query("UPDATE orders SET payment_status = 'paid' WHERE status IN ('processing', 'shipped', 'delivered')");
        $conn->query("UPDATE orders SET payment_status = 'pending' WHERE status IN ('pending', 'cancelled')");
        echo "Backfill complete.";
    } else {
        echo "Error adding column: " . $conn->error;
    }
} else {
    echo "Column 'payment_status' already exists.";
}
?>
