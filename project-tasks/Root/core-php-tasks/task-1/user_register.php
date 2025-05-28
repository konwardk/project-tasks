<?php
@include 'database.php'; // Include database connection
$name = "";
$email = "";
$age = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);

    if (empty($name)) $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (!is_numeric($age)) $errors[] = "Age must be numeric.";

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $email, $age);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            header("Location: upload_photo.php?user_id=$user_id");
            exit;
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Handling & Validation</title>
</head>
<body>
    <h2>Registration Form</h2>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="color: green;">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"></label><br><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"></label><br><br>
        <label>Age: <input type="text" name="age" value="<?= htmlspecialchars($age) ?>"></label><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>