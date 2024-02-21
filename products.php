<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";
$results_per_page = 25;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start_limit = ($page - 1) * $results_per_page;

$sql = "SELECT * FROM products LIMIT $start_limit, $results_per_page";
$result = $conn->query($sql);

$productData = array();
while ($row = $result->fetch_assoc()) {
    $productData[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($productData);
?>
