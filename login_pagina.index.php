<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <div>
            
            <button>
                <img src="#" width="19">
                <span>Sign in with Google</span>
            </button>
            <button>
                <img src="#" width="19">
                <span>Sign in with Apple</span>
            </button>
        </div>
        <h5>Or</h5>
        <div>
            <form>
                <input type="text" placeholder="Phone,email, or username"/>
            </form>
            <button>Next</button>
            <button>Forget password</button>
        </div>
        <p>Don't have an account <a href="./signup_page.php">Sign Up</a></p>
    </div>
</body>
</html>



<?php

require_once "database.php";
