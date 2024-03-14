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
        <form action="login.php" method="post">

          <input type="text" name="email" placeholder="Enter your email" required> 
          <input type="password" name="password" placeholder="Enter your password" required> 
          <a href="#">Forgot password?</a>
          <input type="submit" class="button" value="Login"> 
        </form>
        <div class="signup">
          <span class="signup">Don't have an account?
          <label for="check">Signup</label>
          </span>
        </div>
      </div>

      <div class="registration form">
        <header>Signup</header>
        <form action="insert_data.php" method="post">
          <input type="text" name="email" placeholder="Enter your email" required>
          <input type="password" name="password" placeholder="Create a password" required>
          <input type="password" name="confirm_password" placeholder="Confirm your password" required>
          <input type="submit" class="button" value="Signup" name="submit">
        </form>
        <div class="signup">
          <span class="signup">Already have an account?
            <label for="check"><a href="login.php">Login</a></label>
          </span>
        </div>
      </div>
    </div>
  </body>
  </html>
