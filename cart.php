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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h2>Your Cart</h2>

        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>';
                if ($row['quantity'] > 1) {
                    echo '<button class="btn btn-sm btn-danger" onclick="updateQuantity(' . $row['id'] . ', \'remove\')">-</button>';
                }
                echo ' ' . $row['quantity'] . ' ';
                echo '<button class="btn btn-sm btn-success" onclick="updateQuantity(' . $row['id'] . ', \'add\')">+</button>';
                echo '</td>';
                echo '<td>$' . number_format($row['quantity'] * $row['price'], 2) . '</td>';
                echo '<td><a href="#" onclick="updateQuantity(' . $row['id'] . ', \'removeAll\')">Remove All</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';

            $totalPriceSql = "SELECT SUM(cart_items.quantity * products.price) AS total_price 
                              FROM cart_items 
                              JOIN products ON cart_items.product_id = products.id 
                              WHERE cart_items.user_id = $user_id";

            $totalPriceResult = $conn->query($totalPriceSql);

            if ($totalPriceResult->num_rows > 0) {
                $totalPriceRow = $totalPriceResult->fetch_assoc();
                $totalPrice = $totalPriceRow['total_price'];

                echo '<div class="mt-3">Total Price: $' . number_format($totalPrice, 2) . '</div>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }

        $conn->close();
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
    function updateQuantity(itemId, action) {
        console.log('Button clicked!', itemId, action);

        var confirmed = true;

        if (action === 'removeAll') {
            confirmed = confirm("Do you want to remove all items of this product?");
        } else if (action === 'remove') {
            confirmed = confirm("Do you want to remove this item?");
        }

        if (confirmed) {
            var url = 'updateQuantity.php';
            var data = 'itemId=' + itemId + '&action=' + action;

            console.log('Fetch Data:', data);

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data,
            })
            .then(response => response.text())
            .then(response => {
                console.log('Response:', response);
                location.reload();
            })
            .catch(error => {
                console.error('Error updating quantity:', error);
            });
        }
    }
    </script>
</body>

</html>
