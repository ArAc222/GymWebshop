<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

if (!isset($_SESSION['user_id'])) {
    echo 0;
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) as count FROM cart_items WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$count = 0;
if ($row = $result->fetch_assoc()) {
    $count = $row['count'];
}

$stmt->close();
$conn->close();

echo $count;
?>
