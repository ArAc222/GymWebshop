<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemId = $_POST['itemId'];
$action = $_POST['action'];

if ($action === 'add') {
    $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE id = $itemId";
} elseif ($action === 'remove') {
    $sql = "UPDATE cart_items SET quantity = GREATEST(1, quantity - 1) WHERE id = $itemId";
} elseif ($action === 'removeAll') {
    $sql = "DELETE FROM cart_items WHERE id = $itemId";
}

$stmt = $conn->prepare($sql);
$stmt->execute();

$stmt->close();
$conn->close();
echo "Update successful.";
?>
