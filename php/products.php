<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymwebshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action == 'getProducts') {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 20;
    $offset = ($page - 1) * $itemsPerPage;

    $sql = "SELECT * FROM products LIMIT $itemsPerPage OFFSET $offset";
    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    $sql = "SELECT COUNT(*) as count FROM products";
    $result = $conn->query($sql);
    $totalItems = $result->fetch_assoc()['count'];
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo json_encode(['status' => 'success', 'products' => $products, 'totalPages' => $totalPages]);
} elseif ($action == 'deleteProduct') {
    $productId = isset($_GET['productId']) ? (int)$_GET['productId'] : 0;

    $sql = "DELETE FROM products WHERE id = $productId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting product: ' . $conn->error]);
    }
}

$conn->close();
?>
