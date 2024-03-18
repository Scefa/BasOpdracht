<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />   
</head>
<body>
<header class="homeheader">
    <a href="main.php" class="button-container">
        <img class="homelogo" src="./img/logobas.png" alt="Logo">
    </a>
    <nav class="homenav">
        <a href="main.php">Home</a>
        <a href="contact.php">Contact</a>
        <a href="aboutus.php">About us</a>
        <?php if(isset($_SESSION['email']) && $_SESSION['email'] !== null): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login_pagina.index.php">Login</a>
        <?php endif; ?>


        <?php
    session_start();

   
    if(isset($_SESSION['email']) && $_SESSION['email'] !== null) {
        echo "Welcome: ".$_SESSION['email'];
    } else {
        echo "You are not logged in.";
    }
?>

    </nav>
    <form class="d-flex" role="search" action="search.php" method="post">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
        <button class="btn btn-outline-success" type="submit" name="search_submit">Search</button>
    </form>
</header>
<div class="homeline"></div>



<div class="user">
    <div class="user-img-wrapper">
        <img src="#" alt="" />
    </div>
    <?php if (isset($_SESSION['email']) && $_SESSION['email'] !== null): ?>
        <a href="#" class="user-link light-text"><?php echo substr($_SESSION['email'], 0, ); ?></a>
    <?php else: ?>
        
    <?php endif; ?>

    <?php
class BookSearch {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
       
        $this->conn = new mysqli($servername, $username, $password, $database);

        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function searchBooks($searchTerm) {
      
      $sql = "SELECT * FROM books WHERE Title LIKE '%" . $this->conn->real_escape_string($searchTerm) . "%' OR Author LIKE '%" . $this->conn->real_escape_string($searchTerm) . "%'";
  
     
      $result = $this->conn->query($sql);
  
      
      $books = [];
      if ($result) {
          while ($row = $result->fetch_assoc()) {
              $books[] = ["title" => $row["Title"], "author" => $row["Author"]];
          }
      }
  
      return $books;
  }
  
  

    public function closeConnection() {
        
        $this->conn->close();
    }
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "bas";


$search = new BookSearch($servername, $username, $password, $database);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $searchTitle = $_POST["bookTitle"];
    $searchAuthor = $_POST["author"];

    
    $books = $search->searchBooks($searchTitle, $searchAuthor);

    
    if (!empty($books)) {
        echo "<h3>Search Results:</h3>";
        echo "<ul>";
        foreach ($books as $book) {
            echo "<li>Title: " . $book["title"] . ", Author: " . $book["author"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No books found matching your search criteria.</p>";
    }
}


$search->closeConnection();
?>

<div class="container mt-5">
    <h2>Borrow Books</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="bookTitle" class="form-label">Book Title</label>
                    <input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Enter book title">
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</div>


    </div>
</div>
</body>
</html>
