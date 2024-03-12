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

    public function login($email, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM students WHERE Email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['Email']; // Storing email instead of username
                header('Location: index.php');
                exit();
            } else {
                echo "Invalid email or password.";
                sleep(2);
                header('Location: login+pagina.index.php');
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Example usage:
$db = new Database();
$email = $_POST['email'];
$password = $_POST['password'];
$db->login($email, $password);
?>
