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
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM korisnici WHERE korisnicko_ime = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $korisnicko_ime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($lozinka, $row['lozinka'])) {
            $message = 'Prijava uspješna!';

            $akcija = 'Prijava';
            $sql = "INSERT INTO log (korisnicko_ime, akcija) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $korisnicko_ime, $akcija);
            $stmt->execute();

            session_start();
            $_SESSION['user_id'] = $row['id'];

            header('Location: homepage.php');
            exit();
        } else {
            $message = 'Pogrešna lozinka.';
        }
    } else {
        $message = 'Korisnik nije pronađen.';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="text-center mt-0">
        <h1>Prijava</h1>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="korisnicko_ime">Korisničko ime</label>
                        <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" required>
                    </div>
                    <div class="form-group">
                        <label for="lozinka">Lozinka</label>
                        <input type="password" class="form-control" id="lozinka" name="lozinka" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Prijavi se</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
