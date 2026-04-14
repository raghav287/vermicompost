<?php
require_once 'db.php';
echo "<h2>Payments Table Schema</h2>";
$result = $conn->query("DESCRIBE payments");
if ($result) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['Field'] . "</td><td>" . $row['Type'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $conn->error;
    // Create it if missing
    $sql = "CREATE TABLE IF NOT EXISTS payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT DEFAULT 0,
        order_id INT NOT NULL,
        payment_id VARCHAR(255),
        amount DECIMAL(10,2),
        status VARCHAR(50),
        method VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        error_message TEXT
    )";
    if ($conn->query($sql) === TRUE) {
        echo "<br>Created payments table.";
    }
}
?>
