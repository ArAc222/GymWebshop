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

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $action = 'Login';
            $sql = "INSERT INTO log (username, action, time_and_date) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $action);
            $stmt->execute();

            session_start();
            $_SESSION['user_id'] = $row['id'];

            // Return JSON response for successful login
            echo json_encode(['redirect' => 'homepage.php']);
            exit();
        } else {
            // Return JSON response for incorrect password
            echo json_encode(['error' => 'Pogrešna password.']);
            exit();
        }
    } else {
        // Return JSON response for user not found
        echo json_encode(['error' => 'Korisnik nije pronađen.']);
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
