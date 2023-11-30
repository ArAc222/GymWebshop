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

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    // Check if the product is already in the cart
    $sql = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_SESSION['user_id'], $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product is already in the cart, you can handle this case as needed
        // For example, you can update the quantity or display a message
        echo "Product is already in the cart.";
    } else {
        // Product is not in the cart, add it
        $sql = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['user_id'], $productId);
        $stmt->execute();

        echo "Product added to the cart!";
    }

    $stmt->close();
}

$conn->close();
?>
