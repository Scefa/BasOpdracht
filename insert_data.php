<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

class Database {
    private $host = "localhost";
    private $dbname = "bas";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully"; 
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
    }

    public function loginUser($email, $password) {
        $query = $this->conn->prepare("SELECT * FROM students WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                echo "You have successfully logged in as " . $_SESSION['username'];
                header('Location: main.php');
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "There is no account with that email address.";
        }
    }

    public function registerUser($email, $password) {
        $query = $this->conn->prepare("SELECT * FROM students WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "An account with that email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO students (email, password) VALUES (:email, :password)");
            $query->bindParam(":email", $email);
            $query->bindParam(":password", $hashedPassword);

            if ($query->execute()) {
                header('Location: login.php');
                exit();
            } else {
                echo "An error occurred!";
            }
        }
    }
}

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $database->loginUser($email, $password);
    }

    if (isset($_POST['submit'])) {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $database->registerUser($email, $password);
    }
}

?>
