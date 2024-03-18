<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchTerm"])) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bas";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the search term
    $searchTerm = $conn->real_escape_string($_POST["searchTerm"]);

    // Prepare SQL query
    $sql = "SELECT * FROM books WHERE Title LIKE '%$searchTerm%' OR Author LIKE '%$searchTerm%'";

    // Execute the query
    $result = $conn->query($sql);

    // Display search results
    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Title: " . $row["Title"] . ", Author: " . $row["Author"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No books found matching your search criteria.</p>";
    }

    // Close connection
    $conn->close();
}
?>
