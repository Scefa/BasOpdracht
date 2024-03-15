<?php
require "database.php";
session_start();

class LoginHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loginUser($email, $password) {
        $get_user = $this->conn->prepare("SELECT * FROM bas.students WHERE email = :email");
        $get_user->bindParam(":email", $email);
        $get_user->execute();
        $user = $get_user->fetch();

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        

        if (password_verify($user['password'], $password_hash)) {
            $_SESSION['email'] = $email;
           header('Location: main.php');
            exit();
        } else {
            echo ($user['password']);
            echo "Invalid email or password.";
            sleep(2);
            header('Location: login_pagina.index.php');
            exit();
        }
        
    }
}

 

//Usage:
 //$loginHandler = new LoginHandler($conn);
 //$email = $_POST['email_or_username'];
 //$password = $_POST['password'];
 //$loginHandler->loginUser($email, $password);
?>
