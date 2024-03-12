<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="social-buttons">
            <button class="google-btn">
                <img src="./img/google logo.png" width="19" alt="Google Logo">
                <span>Sign in with Google</span>
            </button>
            <button class="apple-btn">
                <img src="./img/apple.png" width="19" alt="Apple Logo">
                <span>Sign in with Apple</span>
            </button>
        </div>
        <h5>Or</h5>
        <div class="login-form">
            <form>
                <input type="text" class="input-field" placeholder="Phone, email, or username"/>
            </form>
            <button class="next-btn">Next</button>
            <button class="forgot-btn">Forget password</button>
        </div>
        <p>Don't have an account <a href="./signup_page.php" class="signup-link">Sign Up</a></p>
    </div>
</body>
</html>
