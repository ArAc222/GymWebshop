<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymwebshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'addToCart') {
    $user_id = (int)$_POST['userId'];
    $product_id = (int)$_POST['productId'];
    $quantity = (int)$_POST['quantity'];

    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)
            ON DUPLICATE KEY UPDATE quantity = quantity + $quantity";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }
} elseif ($action == 'getCartCount') {
    $user_id = (int)$_GET['userId'];

    $sql = "SELECT SUM(quantity) AS count FROM cart WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $count = $result->fetch_assoc()['count'];
        echo json_encode(['status' => 'success', 'count' => $count]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No items in cart']);
    }
} elseif ($action == 'getCartItems') {
    $user_id = (int)$_GET['userId'];

    $sql = "SELECT p.id, p.name, p.description, p.price, c.quantity, p.image FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $items = [];
        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        echo json_encode(['status' => 'success', 'items' => $items]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No items in cart']);
    }
} elseif ($action == 'removeFromCart') {
    $user_id = (int)$_POST['userId'];
    $product_id = (int)$_POST['productId'];

    $sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Product removed from cart']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }
}

$conn->close();
?>
