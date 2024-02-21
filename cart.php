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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['itemId'];
    $action = $_POST['action'];

    if ($action === 'add') {
        $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE id = $itemId";
    } elseif ($action === 'remove') {
        $sql = "UPDATE cart_items SET quantity = GREATEST(1, quantity - 1) WHERE id = $itemId";
    } elseif ($action === 'removeAll') {
        $sql = "DELETE FROM cart_items WHERE id = $itemId";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Update successful";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }

    exit;
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$sql = "SELECT cart_items.id, products.name, cart_items.quantity, products.price 
        FROM cart_items 
        JOIN products ON cart_items.product_id = products.id 
        WHERE cart_items.user_id = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cartItems = array();
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($cartItems);
?>
