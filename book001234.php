<!DOCTYPE html>
<html>
<head>
    <style>
        .book-container {
            margin-bottom: 20px;
        }

        .book-image {
            width: 200px;
            height: auto;
        }

        .book-name {
            font-weight: bold;
        }

        .read-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .books {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -5px; 
        }

        .book-card {
            flex: 0 0 20%; 
            padding: 0 5px; 
            box-sizing: border-box;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#searchForm").submit(function(event) {
            event.preventDefault();
            searchBooks();
        });

        $("#searchInput").on("input", function() {
            searchBooks();
        });

        function searchBooks() {
            var searchQuery = $("#searchInput").val();
            var url = "search001.php";

            // Adjust the URL based on search query
            if (searchQuery.trim() !== "") {
                url += "?search=" + encodeURIComponent(searchQuery);
            }

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $("#bookResults").html(response);
                }
            });
        }
    });
</script>


</head>
<body>
    
    <form id="searchForm">
        <center><input type="text" id="searchInput" placeholder="Search by Book Name or Author Name">
        <button type="submit">Search</button></center>
    </form>
    
    <br>
    <br>
    <div id="bookResults">
        <?php
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";
            $database = "project001"; 

            $connection = mysqli_connect($servername, $username, $password, $database);

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch books from the database based on search query
            $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
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

            mysqli_close($connection);
        ?>
    </div>
</body>
</html>
