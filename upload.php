<!DOCTYPE html>
<html>
<head>
    <title>Book Upload</title>
    <style>
        body {
            background: linear-gradient(to right, orange, red);
        }
        
        form {
            display: flex;
            flex-direction: column;
            //align-items: center;
            margin: 50px;
        }

        .form-box {
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 200px;
            margin-right: 200px;

            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .messagecorr{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 200px;
            margin-right: 200px;
            margin-bottom: 10px;
            background-color: rgba(203, 235, 245);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

        }
        .messagecorr p{
            color: green;
        }
        .message{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 200px;
            margin-right: 200px;
            margin-bottom: 10px;
            color: red;
            background-color: rgba(240, 189, 192);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .message p{
            color: red;
        }
        input[type="submit"] {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .full{
            display: flex;
            justify-content: space-between;

        }
        .c1{
            margin-right=
        }

        h1{
            color:white;
            align-items: center;
            margin-left: 200px;
        }
        input[type="submit"]:hover {
            background-color: red;
        }
    </style>
</head>
<body>
<h1>Book Updation Form</h1>
    <?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = "";
    $database = "project001";

    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $bookName = $_POST['book_name'];
        $authorName = $_POST['author_name'];
        $bookid=$_POST['bookid'];
        $bookEdition = $_POST['book_edition'];
        
        $librarianID = $_POST['librarian_id'];
        $summary = $_POST['summary'];

        $image = $_FILES['image']['tmp_name']; 

        $imageData = file_get_contents($image);

	$sql1="select * from registration where libraryid='$librarianID'";
	$result1 = mysqli_query($connection, $sql1);

    $sql2 = "SELECT * FROM books where bookid='$bookid'";
    $result2 = mysqli_query($connection, $sql2);
    
    if (mysqli_num_rows($result1) > 0) {
        if (mysqli_num_rows($result2) > 0) {
            echo "<div class='message'><p>Book ID already exists.</p></div>";
        } else {
            $sql3 = "INSERT INTO books (`bookname`, `bookid`, `authorname`, `edition`, `image`, `librarian_id`, `summary`) VALUES ('$bookName', '$bookid', '$authorName', '$bookEdition', ?, '$librarianID', '$summary')";
            $stmt = mysqli_prepare($connection, $sql3);
            mysqli_stmt_bind_param($stmt, "s", $imageData);
            $result3 = mysqli_stmt_execute($stmt);
            if ($result3) {
                echo "<div class='messagecorr'><p>Book uploaded successfully.</p></div>";
            } else {
                echo "<div class='message'>Book not uploaded.</div>";
            }
        }
    } else {
        echo "<div class='message'><p>Library ID does not exist.</p></div>";
    }
    
    
}

    mysqli_close($connection);
    ?>
    <div class="container">

    <div class="form-box">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="full">
        <div class="c1">
            
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" id="book_name" required><br><br><br>
            
            <label for="author_name">Author Name:</label>
            <input type="text" name="author_name" id="author_name" required><br><br><br>


            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" required><br><br>

            
        </div>
        <div class="c2">
            <label for="book_edition">Book Edition:</label>
            <input type="text" name="book_edition" id="book_edition" required><br><br><br>
            
            <label for="bookid">Book ID:</label>
            <input type="text" name="bookid" id="bookid" required><br><br><br>

            <label for="librarian_id">Librarian ID:</label>
            <input type="text" name="librarian_id" id="librarian_id" required><br><br><br>
        </div>
        </div>
        <label for="summary">Summary:</label><br>
            <textarea name="summary" id="summary" rows="5" cols="100" required></textarea><br><br>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</div>
</body>
</html>
