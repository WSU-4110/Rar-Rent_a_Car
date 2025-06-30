<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAR - DayOrWeek</title>
    <link rel="stylesheet" href="../CSS/dayorweek.css">
</head>
<body>
<div class="navbar">
    <!--<a href="#hero-image"><img src="Rcarlogo.png" height = 60 width = 30/></a>-->
        <!--<a href="#hero-image"><img src="Rcarlogo.png" alt="Logo" height = 60/></a>-->
        <!--<a href="#hero-image"><img src="Rcarlogo.png" alt="Logo" height="60" style="margin-right: 20px;" /></a>-->
        <a href="../index.php"><img src="Rcarlogo.png" alt="Logo" height="60" style="margin-right: 20px;" /></a>
        
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
        <div class="content">
            <h1>Choose Your Rental Option</h1>
            <div class="button-containerr">
                <!-- Day Button -->
                <a href="browse-cars.php" class="rent-button day-button">
                    Rent for a Day
                </a>
                <!-- Week Button -->
                <a href="browse-carsweek.php" class="rent-button week-button">
                    Rent for a Week
                    <p class="payment-info">Make a 3-month payment plan!</p>
                </a>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy; 2025 Rar</p>
        <p><a href="termsandconditions.php">Terms and Conditions</a> | <a href="privacy.php">Privacy</a></p>
    </footer>
</body>
</html>
