<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop";

// Spajanje na bazu podataka
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';  // Inicijalizacija poruke

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dobivanje podataka iz obrasca
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Priprema SQL upita
    $sql = "INSERT INTO korisnici (korisnicko_ime, lozinka, email) VALUES (?, ?, ?)";

    // Izvršavanje SQL upita s parametrima
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $korisnicko_ime, $lozinka, $email);

    // Izvršavanje upita
    if ($stmt->execute()) {
        $message = 'Registracija uspješna!';
        
        // Redirect to login page after successful registration
        header('Location: login.php');
        exit();
    } else {
        $message = 'Registracija nije uspjela.';
    }

    // Zatvaranje izjave
    $stmt->close();
}

// Zatvaranje veze s bazom podataka
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="text-center mt-0">
        <h1>Registracija</h1>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="korisnicko_ime">Korisničko ime</label>
                        <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" required>
                    </div>
                    <div class="form-group">
                        <label for="lozinka">Lozinka</label>
                        <input type="password" class="form-control" id="lozinka" name="lozinka" required>
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
