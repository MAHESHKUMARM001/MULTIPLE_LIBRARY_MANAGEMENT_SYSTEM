<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "project001";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch search query from GET request
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the SQL statement with search query
$sql = "SELECT * FROM books WHERE bookname LIKE '%$searchQuery%' OR authorname LIKE '%$searchQuery%'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='books'>";
    while ($row = mysqli_fetch_assoc($result)) {
        $bookName = $row['bookname'];
        $authorName = $row['authorname'];
        $bookEdition = $row['edition'];
        $bookId = $row['bookid'];
        $librarianID = $row['librarian_id'];
        $imageData = $row['image'];
        $summary = $row['summary'];

        echo "<div class='book-card'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($imageData) . "' class='book-image'><br>";
        echo "<div class='book-container'>";
        echo "<span class='book-name'>Book Name: $bookName</span><br>";
        echo "Author Name: $authorName<br>";
        echo "Book Edition: $bookEdition<br>";
        echo "Book ID: $bookId<br>";
        echo "Librarian ID: $librarianID<br>";
        echo "<button class='read-button' onclick=\"window.open('summary0.php?bookid=" . urlencode($bookId) . "&librarian_id=$librarianID', '_blank')\">Read</button>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No books found.";
}

// Close the connection
mysqli_close($connection);
?>
