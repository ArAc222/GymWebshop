<?php
session_start();
include 'config.php';
session_unset();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $akcija = 'Logout';
    $sql = "INSERT INTO log (korisnik_id, akcija) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $akcija);
    $stmt->execute();
}

session_destroy();

header("Location: login.php");
exit();
?>
