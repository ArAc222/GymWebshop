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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO user_interactions (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Message sent successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Slanje JSON odgovora
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
