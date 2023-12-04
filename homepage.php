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

$sql = "SELECT * FROM products LIMIT $results_per_page";
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
        <h1>Gym WebShop</h1>
    </header>

    <div class="container mt-5">
        <div class="card-deck">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    
                    $imagePath = "http://localhost/pictures/{$row['image']}";
                    
                    echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
                    echo '<a href="#" class="btn btn-primary" onclick="addToCart(' . $row['id'] . ', event)">Add to cart</a>';
                    echo '</div></div>';
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid mt-5" style="background: none;">
        <img src="http://localhost/pictures/gym.jpg" class="img-fluid w-100" alt="Motivational Image">
    </div>

    <div class="container text-center text-white mt-3">
        <h2 class="display-4">Get Fit and Stay Healthy!</h2>
        <p class="lead">Transform your body with our premium gym equipment. Start your fitness journey today.</p>
        <p class="lead">Believe in yourself and all that you are. Know that there is something inside you that is greater than any obstacle.</p>
        <p class="lead">The only bad workout is the one that didn’t happen. Don’t wish for it, work for it.</p>
        <p class="lead">Your body can stand almost anything. It’s your mind that you have to convince.</p>
        <p class="lead">The only place where success comes before work is in the dictionary. Work hard, stay consistent, and be patient.</p>
    </div>

    <footer class="mt-0 text-center footer">
        <p>&copy; 2023 Gym WebShop. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>
