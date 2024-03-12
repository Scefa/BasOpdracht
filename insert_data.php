<?php
session_start();

class Database
{
    private $host = "localhost";
    private $dbname = "chirpify";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage());
        }
    }

    public function loginUser($email, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM students WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                echo "You have successfully logged in as " . $_SESSION['username'];
                header('Location: main.php'); // Redirect to main.php after successful login
                exit(); // Ensure script execution stops after redirection
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "There is no account with that email address.";
        }
    }

    public function registerUser($email, $username, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM students WHERE email = :email OR username = :username");
        $query->bindParam(":email", $email);
        $query->bindParam(":username", $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "An account with that email or username already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO students (email, username, password) VALUES (:email, :username, :password)");
            $query->bindParam(":email", $email);
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $hashedPassword);

            if ($query->execute()) {
                header('Location: login.php'); // Redirect to login.php after successful registration
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
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $database->registerUser($email, $username, $password);
    }
}
?>
