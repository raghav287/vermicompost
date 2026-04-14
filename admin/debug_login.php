<?php
require_once 'db.php';

echo "<h2>Admin Login Debugger</h2>";

// 1. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<p>Database connection successful.</p>";

// 2. Check if admins table exists and has users
$sql = "SELECT * FROM admins";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<p>Found " . $result->num_rows . " admin(s).</p>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Email: " . $row["email"] . "<br>";
        
        // Reset password for this user
        $new_pass = "admin123";
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $update_sql = "UPDATE admins SET password='$hashed_pass' WHERE id=" . $row["id"];
        
        if ($conn->query($update_sql) === TRUE) {
            echo "<strong style='color:green;'>Password for " . $row["email"] . " reset to: <code>$new_pass</code></strong><br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
    }
} else {
    echo "<p>No admin users found. Creating a default one...</p>";
    $email = "admin@example.com";
    $pass = "admin123";
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $insert_sql = "INSERT INTO admins (email, password) VALUES ('$email', '$hashed_pass')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "<strong style='color:green;'>Created new admin: $email / $pass</strong>";
    } else {
        echo "Error creating admin: " . $conn->error;
    }
}
?>
