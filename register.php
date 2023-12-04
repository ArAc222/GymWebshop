<?php
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
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $checkSql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('ss', $username, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $message = 'Username or email already exists.';
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $email);

        if ($stmt->execute()) {
            $message = 'Registration successful!';

            $action = 'Register';
            $logSql = "INSERT INTO log (username, action, time_and_date) VALUES (?, ?, NOW())";
            $logStmt = $conn->prepare($logSql);
            $logStmt->bind_param('ss', $username, $action);
            $logStmt->execute();

            header('Location: login.php');
            exit();
        } else {
            $message = 'Registration failed.';
        }

        $stmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="/css/logandregister.css">
</head>
<body>
    <header class="text-center mt-0">
        <h1>Registration</h1>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="username">Korisničko ime</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Lozinka</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email adresa</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registriraj se</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
