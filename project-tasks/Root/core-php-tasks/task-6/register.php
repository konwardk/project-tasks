<?php
@include 'database.php';
// session_start();

if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$email = "admin@gmail.com";
$plain_password = "admin123";
$hashed = password_hash($plain_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $hashed);
if ($stmt->execute()) {
    echo "User registered!";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
