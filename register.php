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

$response = array(); // Inicijalizacija asocijativnog polja za JSON odgovor

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $checkSql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('ss', $username, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $response['status'] = 'error';
        $response['message'] = 'Username or email already exists.';
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $email);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Registration successful!';

            $action = 'Register';
            $logSql = "INSERT INTO log (username, action, time_and_date) VALUES (?, ?, NOW())";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param('ss', $username, $action);
            $logStmt->execute();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Registration failed.';
        }

        $stmt->close();
    }

    $checkStmt->close();
}

$conn->close();

// Slanje JSON odgovora
header('Content-Type: application/json');
echo json_encode($response);
?>
