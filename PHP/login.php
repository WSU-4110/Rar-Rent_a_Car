<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HonkAndSmile - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login to HonkAndSmile </h1>
        <form action="process-login.php" method="post">
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
</body>
</html>
