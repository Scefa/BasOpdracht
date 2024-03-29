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
        <a href="aboutus.php">About us</a>
        <a href="contact.php">Contact</a>
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

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Borrow Books</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <form id="searchForm">
                <div class="mb-3">
                    <label for="searchTerm" class="form-label">Search</label>
                    <input type="text" class="form-control" id="searchTerm" name="searchTerm" placeholder="Enter book title or author">
                </div>
            </form>
        </div>
    </div>
    <div id="searchResults"></div>
</div>

<script>
    // Function to perform live search
    function liveSearch() {
        var searchTerm = document.getElementById('searchTerm').value;

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('searchResults').innerHTML = xhr.responseText;
            }
        }

        xhr.send('searchTerm=' + searchTerm);
    }

    // Event listener for input changes
    document.getElementById('searchTerm').addEventListener('input', liveSearch);
</script>

</body>
</html>



    </div>
</div>
</body>
</html>
