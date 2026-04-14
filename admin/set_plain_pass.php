<?php
require_once 'db.php';

echo "<h2>Setting Plain Text Password</h2>";

$pass = "admin123";

// Update all admins to use plain text password
$sql = "UPDATE admins SET password='$pass'";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color:green'>Success!</h3>";
    echo "<p>All admin passwords have been updated to plain text: <strong>$pass</strong></p>";
    echo "<p>You can now login with this password.</p>";
} else {
    echo "Error updating record: " . $conn->error;
}
?>
