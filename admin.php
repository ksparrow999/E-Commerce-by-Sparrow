<?php
session_start();

// Admin Login Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oakame_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Delete Message
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_messages WHERE id=$id");
    header("Location: admin.php");
}

// Fetch Messages
$result = $conn->query("SELECT * FROM contact_messages ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Contact Messages</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <h2>Admin Panel - Contact Messages</h2>
    <a href="logout.php" class="logout-btn">Logout</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= $row['submitted_at'] ?></td>
            <td><a href="admin.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this message?');">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
