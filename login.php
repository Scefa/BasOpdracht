<?php
session_start();

class Database {
    private $host = "localhost"; 
    private $username = "root"; 
    private $password = ""; 
    private $database = "bas"; 
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit(); 
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE Email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['Email']; 
                header('Location: main.php');
                exit();
            } else {
                echo "Invalid email or password.";
                sleep(2);
                header('Location: login_pagina.index.php');
                exit();
            }
        } catch(PDOException $e) {
            
            file_put_contents('pdo_errors.log', "[" . date('Y-m-d H:i:s') . "] Error: " . $e->getMessage() . "\n", FILE_APPEND);
            echo "An error occurred. Please try again later."; 
            exit();
        }
    }
    
}


$db = new Database();
$email = $_POST['email'];
$password = $_POST['password'];
$db->login($email, $password);
?>
