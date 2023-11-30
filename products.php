<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym WebShop - Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-6e5LZk39lFoW6wqJlgX06EOMlHbukN5X9rz2+KZlThHOBR7gGyTM3rDukIuipjGWs9s2/iZI/D5EKJ2KFD6J/6g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="homepage.php">
            <i class="fas fa-home"></i> Homepage
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fas fa-dumbbell"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">
                        <i class="fas fa-id-card"></i> Contact
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <header class="text-center mt-0">
        <h1>Find everything for you!</h1>
    </header>


    <div class="container mt-5">
        <div class="card-deck">
            <?php
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

            if ($result->num_rows > 0) {
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
                    echo '<a href="#" class="btn btn-primary" onclick="addToCart(' . $row['id'] . ')">Add to cart</a>';
                    echo '</div></div>';
                    $count++;
                }
            } else {
                echo "0 results";
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

</body>
</html>
