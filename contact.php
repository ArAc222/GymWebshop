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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO user_interactions (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Message sent successfully!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym WebShop - Contact</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
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

        function showNotification(message) {
            alert(message);
        }

        $(document).ready(function () {
            updateCartCount();
        });
    </script>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <header class="text-center mt-0">
        <h1>Gym WebShop - Contact &#9742;</h1>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p>If you have any questions or concerns, feel free to reach out to us:</p>
                <ul>
                    <li>Email: luka263284@gmail.com</li>
                    <li>Phone: +385958126334</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Get in Touch</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-0 text-center footer">
        <p>&copy; 2023 Gym WebShop. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
