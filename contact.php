<?php
$servername = "localhost"; 
$username = "root";  
$password = "";  
$dbname = "oakame_db";  

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) { echo "Message saved successfully!"; } 
    else { echo "Error: " . $conn->error; }
}
$conn->close();
?>
