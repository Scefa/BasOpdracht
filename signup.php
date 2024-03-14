<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>