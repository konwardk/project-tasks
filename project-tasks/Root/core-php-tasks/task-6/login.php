<?php
@include 'database.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("SELECT id, email, password FROM admins WHERE email = ? FOR UPDATE");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $userEmail, $hashed_password);
            $stmt->fetch();

            if (password_verify($pass, $hashed_password)) {
                $conn->commit();
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $userEmail;
                header("Location: home.php");
                exit;
            } else {
                $error = "Invalid credentials.";
            }
        } else {
            $error = "Invalid credentials.";
        }

        $stmt->close();
        $conn->rollback();

    } catch (Exception $e) {
        $conn->rollback();
        $error = "An error occurred: " . $e->getMessage();
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <!-- htmlspecialchars($email)  -->
    <div class="">
        <h2>User Login</h2>
        <form method="POST" action="">
        <label>Email: </label>
            <input type="email" name="email" required><br><br>
        <label>Password: </label>
            <input type="password" name="password" required><br><br>
        <button type="submit">Submit</button>
    </form>
    </div>
</body>
</html>