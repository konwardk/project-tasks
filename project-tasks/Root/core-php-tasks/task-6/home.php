<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['email']) ?>!</h2>
<p>This is a protected page.</p>
<a href="logout.php">Logout</a>
</body>
</html>
