<?php

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
            $domain = explode('@', $email);
            if (isset($domain[1]) && $domain[1] === 'student.zadkine.nl') {
                if (isset($result['password_hashed'])) { // Controleren op een gehasht wachtwoord
                    if (password_verify($password, $result['password_hashed'])) {
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['username'] = $result['username'];
                        header('Location: main.php');
                        exit();
                    } else {
                        return "Incorrect email or password.";
                    }
                } else {
                    return "Password field not found in database.";
                }
            } else {
                return "Only users with email addresses ending in '@student.zadkine.nl' can login.";
            }
        } else {
            return "Incorrect email or password."; 
        }
       
    }
    
}

$database = new Database();

if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; 
    $loginResult = $database->loginUser($email, $password);
    if ($loginResult === true) {
      header('Location: main.php');
       exit();
    } else {
        $errorMessage = $loginResult;
    }
}

