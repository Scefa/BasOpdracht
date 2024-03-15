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
            
            if (isset($result['password'])) {
                if (password_verify($password, $result['password'])) {
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    header('Location: main.php');
                    exit();
                } else {
                    return "Incorrect password.";
                }
            } else {
                return "Password field not found in database.";
            }
        } else {
            return "There is no account with that email address.";
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
?>
