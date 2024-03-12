<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="main.php" method="post">
        <input type="text" name="login_email" placeholder="Enter your email">
        <input type="password" name="login_password" placeholder="Enter your password">
        <a href="#">Forgot password?</a>
        <input type="submit" class="button" value="Login">
      </form>
      <div class="signup">
        <label for="check">Don't have an account? Signup</label>
      </div>
    </div>

    <div class="registration form">
      <header>Signup</header>
      <form action="login_pagina.index.php" method="post">
        <input type="text" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Create a password" required>
        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        <input type="submit" class="button" value="Signup" name="submit">
      </form>
      <div class="signup">
        <label for="check">Already have an account? <a href="login_pagina.index.php">Login</a></label>
      </div>
    </div>
  </div>
</body>
</html>
