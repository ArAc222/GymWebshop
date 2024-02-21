<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";
$results_per_page = 5;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array(); // Initialize an associative array for the JSON response

$sql = "SELECT * FROM products LIMIT $results_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image']
        );
    }

    $response['status'] = 'success';
    $response['products'] = $products;
} else {
    $response['status'] = 'error';
    $response['message'] = 'No products found.';
}

$conn->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
