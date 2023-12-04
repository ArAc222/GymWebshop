<link rel="stylesheet" href="/css/navbarStyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="homepage.php">
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
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-id-card"></i> Contact
                </a>
            </li>

            <?php
        if (isset($_SESSION['user_id'])) {
            echo '<li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fas fa-shopping-cart"></i> <span id="cartCount">Cart</span>
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
                
            echo '<li class="nav-item">
                    <a class="nav-link" href="register.php">
                        <u>New User? Register here!</u>
                    </a>
                </li>';
        }
        ?>
    </ul>
</div>
</nav>
