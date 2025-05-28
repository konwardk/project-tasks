<?php
@include 'database.php'; // Include database connection

$errors = [];
$success = "";
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

//checks the user_id
if (!$user_id) {
    die("Invalid access. User ID is missing.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['profile_pic'])) {
    $file = $_FILES['profile_pic'];
    $file_types = ['image/jpeg', 'image/png'];
    $max_size = 2 * 1024 * 1024;
    $upload_dir = "uploads/";

    //file validations
    if ($file['error'] !== 0) {
        $errors[] = "File upload error.";
    } 
    //validations for the profile picture type and size
    elseif (!in_array($file['type'], $file_types)) {
        $errors[] = "Only JPG and PNG files allowed.";
    } elseif ($file['size'] > $max_size) {
        $errors[] = "Max file size is 2MB.";
    } else {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid("profile_", true) . '.' . $ext;
        $file_path = $upload_dir . $filename;

        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            $stmt = $conn->prepare("INSERT INTO user_profiles (user_id, file_path) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $file_path);
            if ($stmt->execute()) {
                $success = "Photo uploaded successfully!";
            } else {
                $errors[] = "DB error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $errors[] = "Failed to save uploaded file.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head><title>Upload Photo</title></head>
<body>
    <h2>Upload Profile Picture</h2>

    <?php if (!empty($errors)): ?>
        <div style="color: red;"><ul><?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?></ul></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="color: green;"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Select JPG/PNG (Max 2MB):</label><br>
        <input type="file" name="profile_pic" required><br><br>
        <button type="submit">Upload Photo</button>
    </form>
</body>
</html>