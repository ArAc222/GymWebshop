<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart items for the logged-in user
$sql = "SELECT products.*, cart_items.quantity FROM products
        INNER JOIN cart_items ON products.id = cart_items.product_id
        WHERE cart_items.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>

    <!-- Display cart items -->
    <div>
        <h2>Your Cart</h2>
        <?php if (!empty($cartItems)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item) : ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td>$<?= $item['price'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Add more content as needed -->

</body>
</html>
