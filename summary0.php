<?php
$con = mysqli_connect("localhost:3306", "root", "", "project001");

// Retrieve the book name and librarian ID from the query parameters
$bookid = $_GET['bookid'];
$librarianID = $_GET['librarian_id'];

// Prepare and execute the SQL query to fetch the book summary and library name
$sql = "SELECT b.bookname, b.authorname, b.bookid, b.edition,b.image, b.summary, r.libraryname
        FROM books b
        JOIN registration r ON b.librarian_id = r.libraryid
        WHERE b.bookid = '$bookid' AND b.librarian_id = '$librarianID'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$bookname=$row['bookname'];
$authorname=$row['authorname'];
$bookid=$row['bookid'];
$edition=$row['edition'];
$summary = $row['summary'];
$libraryName = $row['libraryname'];
$imageData = $row['image'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Summary - <?php echo $bookName; ?></title>
  <style>
       body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
        }
        .h{
            color:white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            align-items: center;
            margin-left: 200px;
            margin-bottom:50px;
        }
       .summary1{
            border: 2px solid white;
            border-radius: 10px;           
            margin-top: 20px;
            padding: 50px;
            margin-left: 200px;
            margin-right: 200px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      }
      .image{
        margin-left: 290px;
        margin-right: 300px;
        padding-bottom: 30px;
      }
      .summarycont{
        color: orangered;
        font-size: 30px;
      }
  </style>
</head>
<body>
<h1 class="h">Book Summary - <?php echo $bookname; ?></h1>
  <div class="container">
  <div class="summary1">
    <div class="image">
    <?php echo "<img src='data:image/jpeg;base64," . base64_encode($imageData) . "' class='book-image' width=250px height=300px><br>"; ?>
    </div>
    <b>Book Name    : <?php echo $bookname; ?></b>
    <p>Author Name  : <?php echo $authorname; ?></p>
    <p>Book ID      : <?php echo $bookid; ?></p>
    <p>Book Edition : <?php echo $edition; ?></p>
    <p>Library      : <?php echo $libraryName; ?></p>
    <p>Library ID   : <?php echo $librarianID; ?></p>
     <b><p class="summarycont"><u>Summary </u></p></b>
      <p><?php echo $summary; ?></p>
    </div>
  </div>
</body>
</html>
