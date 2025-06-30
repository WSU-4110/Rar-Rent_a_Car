<?php
session_start();

include("../classes/connect.php");
include("../classes/login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $result = $login->evaluate($_POST);

    if ($result === true) {
        $_SESSION['email'] = $_POST['email'];
        $username = urlencode($_SESSION['Rar_username']);
        header("Location: ../index.php");
        exit();
    } else {
        // Display error messages
        $_SESSION['login_error'] = implode("<br>", $result);
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAR - Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <div class="navbar">
    <!--<a href="#hero-image"><img src="Rcarlogo.png" height = 60 width = 30/></a>-->
        <!--<a href="#hero-image"><img src="Rcarlogo.png" alt="Logo" height = 60/></a>-->
        <!--<a href="#hero-image"><img src="Rcarlogo.png" alt="Logo" height="60" style="margin-right: 20px;" /></a>-->
        <a href="../index.php"><img src="../PHP/Rcarlogo.png" alt="Logo" height="60" style="margin-right: 20px;" /></a>
        
        <div class="menu">
            <a href="../index.php">Home</a>
            <a href="../index.php#three-column-section">About Us</a>
            <a href="../index.php#browse-cars">Browse Cars</a>
            <a href="../index.php#my-payment-section">View Payment</a>
            <a href="help.php">Help</a>
            <a href="../index.php#meet-the-hosts">Meet the Hosts</a>
            <a href="../index.php#contact">Contact Us</a>
        </div>
        <div class="auth-buttons">
            <button onclick="window.location.href='signup.php'">Sign Up</button>
            <button onclick="window.location.href='login.php'">Log In</button>
        </div>
    </div>

    <div id="hero-image" class="hero-image">
    <div class="hero-content">
        <div class="login-container">
            <h1>Login to Rar </h1>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo "<p style='color:red;'>" . $_SESSION['login_error'] . "</p>";
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
                <p class="signup-link">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
            <button type="button" class="btn-secondary" onclick="window.location.href='termsandconditions.php';">
                View Terms and Conditions
            </button>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2025 Rar</p>
        <p><a href="termsandconditions.php">Terms and Conditions</a> | <a href="privacy.php">Privacy</a></p>
    </footer>
</body>
</html>
