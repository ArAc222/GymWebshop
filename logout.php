<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $username = '';
    $stmt_username = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt_username->bind_param('i', $user_id);
    $stmt_username->execute();
    $stmt_username->bind_result($username);
    $stmt_username->fetch();
    $stmt_username->close();

    $action = 'Logout';
    $sql = "INSERT INTO log (username, action, time_and_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $action);
    $stmt->execute();
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>
