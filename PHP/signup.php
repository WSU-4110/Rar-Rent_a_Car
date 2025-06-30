<?php
include("../classes/connect.php");
include("../classes/signup.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new Signup();
    $result = $signup->evaluate($_POST);
    
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    header("Location: login.php");
    exit();
    // Validation flags
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAR - Sign Up</title>
    <link rel="stylesheet" href="../CSS/signup.css"> 

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
        <div class="signup-container">
            <h1>Create an Account</h1>
            <form id="signup-form" action="signup.php" method="post" onsubmit="return validateForm()">
                <div class="input-group"   >
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
                    <small id="first_name-error" class="error-message"></small>
                </div>
                <div class="input-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
                    <small id="last_name-error" class="error-message"></small>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <small id="email-error" class="error-message"></small>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                    <small id="password-error" class="error-message"></small>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                    <small id="confirm-password-error" class="error-message"></small>
                </div>
                <button type="submit" class="btn">Sign Up</button>
                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </form>
            <button type="button" class="btn-secondary" onclick="window.location.href='termsandconditions.php';">
                View Terms and Conditions
            </button>
        </div>
    </div>
    </div>
    
    <script>
        // Function to validate the form
        function validateForm() {
            let isValid = true;

            // Get form fields
            const first_name = document.getElementById('first_name');
            const last_name = document.getElementById('last_name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');

            // Get error fields
            const first_nameError = document.getElementById('first_name-error');
            const last_nameError = document.getElementById('last_name-error');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const confirmPasswordError = document.getElementById('confirm-password-error');

            // Clear previous error messages
            first_nameError.textContent = '';
            last_nameError.textContent = '';
            emailError.textContent = '';
            passwordError.textContent = '';
            confirmPasswordError.textContent = '';

            // Validate first name and last name (only letters)
            const nameRegex = /^[A-Za-z]+$/;
            if (!nameRegex.test(first_name.value)) {
                first_nameError.textContent = 'First name must contain only letters.';
                isValid = false;
            }
            if (!nameRegex.test(last_name.value)) {
                last_nameError.textContent = 'Last name must contain only letters.';
                isValid = false;
            }

            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                emailError.textContent = 'Please enter a valid email address.';
                isValid = false;
            }

            // Validate password strength
            const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$/;
            if (!passwordRegex.test(password.value)) {
                passwordError.textContent = 'Password must be at least 8 characters long, include uppercase, lowercase, a number, and a special character.';
                isValid = false;
            }
            // Confirm password match
            if (password.value !== confirmPassword.value) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                isValid = false;
            }

            return isValid; // Prevent form submission if validation fails
        }
    </script>
     <footer>
        <p>&copy; 2025 Rar</p>
        <p><a href="termsandconditions.php">Terms and Conditions</a> | <a href="privacy.php">Privacy</a></p>
    </footer>
</body>
</html>