<?php
session_start();

$admin_username = "admin";
$admin_password = "password123"; // Change this to a secure password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] == $admin_username && $_POST['password'] == $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <h2>Admin Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

</body>
</html>
