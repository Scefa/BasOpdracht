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
        }
    }

   
    public function login($email_or_username, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE (Username = :email_or_username OR Email = :email_or_username)");
            $stmt->bindParam(':email_or_username', $email_or_username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['PASSWORD'])) {
                $_SESSION['username'] = $user['Username'];
                header('Location: index.php');
                exit();
            } else {
                echo "Invalid email/username or password.";
                sleep(2);
                header('Location: chirplogin.php');
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Example usage:
$db = new Database();
$email_or_username = $_POST['email_or_username'];
$password = $_POST['password'];
$db->login($email_or_username, $password);
?>
