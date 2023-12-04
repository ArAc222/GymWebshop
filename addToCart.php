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

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $username = '';
    if ($user_id) {
        $userSql = "SELECT username FROM users WHERE id = $user_id";
        $userResult = $conn->query($userSql);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $username = $userRow['username'];
        }
    }

    $checkSql = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $productId";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {

        $updateSql = "UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $productId";
        $conn->query($updateSql);
    } else {

        $insertSql = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES ($user_id, $productId, 1)";
        $conn->query($insertSql);
    }

    $action = 'Added product to cart';
    $logSql = "INSERT INTO log (username, action, time_and_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($logSql);
    $stmt->bind_param('ss', $username, $action);
    $stmt->execute();
    $stmt->close();

    echo "Item added to the cart!";
} else {
    echo "Invalid request!";
}

$conn->close();
?>
