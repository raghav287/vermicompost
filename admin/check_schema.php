<?php
require_once 'db.php';
echo "<h2>Orders Table Schema</h2>";
$result = $conn->query("DESCRIBE orders");
if ($result) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['Field'] . "</td><td>" . $row['Type'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $conn->error;
}
?>
