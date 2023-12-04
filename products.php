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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym WebShop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        function addToCart(productId, event) {
            event.preventDefault();

            var isConfirmed = confirm("Do you want to add this item to your cart?");

            if (isConfirmed) {
                var xhr = new XMLHttpRequest();

                xhr.open('GET', 'addToCart.php?productId=' + productId, true);

                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var data = xhr.responseText;
                        showNotification(data);

                        updateCartCount();
                    } else {
                        console.error('Request failed with status', xhr.status);
                    }
                };

                xhr.send();
            } else {
                console.log("User canceled adding to cart");
            }
        }

        function showNotification(message) {
            alert(message);
        }

        function updateCartCount() {
            var xhr = new XMLHttpRequest();

            xhr.open('GET', 'getCartCount.php', true);

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var count = xhr.responseText;

                    $('#cartCount').text('Cart(' + count + ')');
                } else {
                    console.error('Request failed with status', xhr.status);
                }
            };

            xhr.send();
        }

        $(document).ready(function () {
            updateCartCount();
        });

    </script>

</head>
<body>

    <?php include 'navbar.php'; ?>

    <header class="text-center mt-0">
        <h1>Find everything for you!</h1>
    </header>

    <div class="container mt-5">
        <div class="card-deck">
            <?php
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                if ($count % 5 == 0) {
                    echo '</div><div class="card-deck">';
                }
                echo '<div class="card">';
                
                $imagePath = "http://localhost/pictures/{$row['image']}";
                
                echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . $row['name'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
                echo '<a href="#" class="btn btn-primary" onclick="addToCart(' . $row['id'] . ', event)">Add to cart</a>';;
                echo '</div></div>';
                $count++;
            }

            $sql = "SELECT COUNT(*) AS total FROM products";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row['total'] / $results_per_page);

            $conn->close();
            ?>
        </div>
    </div>

    <div class="pagination-container text-center mt-3">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<li class="page-item';
                if ($i == $page) {
                    echo ' active';
                }
                echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <footer class="mt-0 text-center footer">
        <p>&copy; 2023 Gym WebShop. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>
</html>
