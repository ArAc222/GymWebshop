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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-6e5LZk39lFoW6wqJlgX06EOMlHbukN5X9rz2+KZlThHOBR7gGyTM3rDukIuipjGWs9s2/iZI/D5EKJ2KFD6J/6g==" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <script>
    function addToCart(productId, event) {
        // Prevent the default behavior of the anchor tag
        event.preventDefault();

        // Use AJAX to call addToCart.php
        $.get('addToCart.php?productId=' + productId, function(data) {
            // Display a simple pop-up notification
            showNotification('Item added to cart!');
        });
    }

    function showNotification(message) {
        // Display a simple pop-up notification
        alert(message);
    }
</script>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <i class="fas fa-home"></i> Homepage
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="products.php">
                        <i class="fas fa-dumbbell"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">
                        <i class="fas fa-id-card"></i> Contact
                    </a>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fas fa-shopping-cart"></i> Cart
                            </a>
                        </li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Log out
                            </a>
                        </li>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-sign-in-alt"></i> Log in
                            </a>
                        </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

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
                    echo '<a href="#" class="btn btn-primary" onclick="addToCart(' . $row['id'] . ')">Add to cart</a>
                    ';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function addToCart(productId) {
            window.location.href = 'cart.php?productId=' + productId;
        }
    </script>

</body>
</html>
