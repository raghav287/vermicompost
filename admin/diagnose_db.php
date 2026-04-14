<?php
require_once 'db.php';

echo "<h2>Database Diagnostic</h2>";

// 1. Check Table Schema
echo "<h3>Table: admins</h3>";
$result = $conn->query("DESCRIBE admins");
if ($result) {
    echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "</tr>";
        
        // Check for password length issue
        if ($row['Field'] == 'password') {
            if (strpos($row['Type'], 'varchar') !== false) {
                preg_match('/\d+/', $row['Type'], $matches);
                if (isset($matches[0]) && $matches[0] < 60) {
                    echo "<tr><td colspan='4' style='color:red; font-weight:bold;'>WARNING: Password column is too short for hashes! Should be at least 60. Current: " . $matches[0] . "</td></tr>";
                    
                    // Attempt auto-fix
                    $conn->query("ALTER TABLE admins MODIFY password VARCHAR(255) NOT NULL");
                    echo "<tr><td colspan='4' style='color:green; font-weight:bold;'>ATTEMPTED FIX: Expanded password column to VARCHAR(255). Please reset password again using debug_login.php</td></tr>";
                }
            }
        }
    }
    echo "</table>";
} else {
    echo "Error describing table: " . $conn->error;
}

// 2. Check Users
echo "<h3>Current Users</h3>";
$users = $conn->query("SELECT id, email, password FROM admins");
while($u = $users->fetch_assoc()) {
    echo "ID: " . $u['id'] . "<br>";
    echo "Email: " . $u['email'] . "<br>";
    echo "Password Hash Length: " . strlen($u['password']) . "<br>";
    echo "Hash: " . $u['password'] . "<br>";
    
    // Test generic password
    $test_pass = "admin123";
    if (password_verify($test_pass, $u['password'])) {
        echo "<strong style='color:green'>MATCHES 'admin123'</strong><br>";
    } else {
        echo "<strong style='color:red'>DOES NOT MATCH 'admin123'</strong><br>";
    }
    echo "<hr>";
}
?>
