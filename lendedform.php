<!DOCTYPE html>
<html>
<head>
  <title>Lended Form</title>
  <style>
    body {
            background: linear-gradient(to right, orange, red);
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    .messagecorr{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 300px;
            margin-right: 300px;
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
            margin-left: 300px;
            margin-right: 300px;
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
    input[type="submit"]:hover {
            background-color: red;
        }
    .container{
            border: 2px solid white;
            border-radius: 10px;
            padding: 50px;
            margin-left: 300px;
            margin-right: 300px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    h1{
            color:white;
            align-items: center;
            margin-left: 300px;
            margin-top: 50px;
    }

  </style>
</head>
<body>
  <h1>Lended Form</h1>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $librarianId = $_POST['librarian_id'];
    $membershipId = $_POST['membership_id'];
    $bookName = $_POST['bookname'];
    $authorName = $_POST['authorname'];
    $edition = $_POST['edition'];
    $bookid001 = $_POST['bookid'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project001";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
   $sql0001="select libraryid from registration where libraryid='$librarianId'";
   $result0001=$conn->query($sql0001);
   if ($result0001->num_rows > 0)
   {
    $conn1=mysqli_connect($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM membership WHERE library_id = '$librarianId' and membershipid= '$membershipId'";
    $result=$conn->query($sql);
    if (($result->num_rows) > 0)
    {
     $conn1000=mysqli_connect("localhost","root","","project001");
     $sql1 = "SELECT * FROM books WHERE bookid='$bookid001' and librarian_id='$librarianId'";
     $result1000=mysqli_query($conn1000,$sql1);
     $row1000=mysqli_fetch_assoc($result1000);
     if ($row1000>0)
     {
      $bookname=$row1000['bookname'];
      $authorname=$row1000['authorname'];
      $bookid=$row1000['bookid'];
      $edition=$row1000['edition'];
      $summary = $row1000['summary'];
      $image = $row1000['image'];
      $librarianid=$row1000['librarian_id'];
       
      $sql2="INSERT INTO lended(`librarian_id`, `member_id`, `bookname`, `authorname`, `edition`, `bookid`, `image`, `summary`) VALUES ('$librarianid','$membershipId','$bookname','$authorname','$edition','$bookid',?,'$summary')";
      $stmt = mysqli_prepare($conn1, $sql2);
      mysqli_stmt_bind_param($stmt, "s", $image);
      $result2 = mysqli_stmt_execute($stmt);
      if($result2)
      {
       $sql3="DELETE FROM `books` WHERE bookid='$bookid001' and librarian_id='$librarianId'";
       $result3=mysqli_query($conn1,$sql3);
       if($result3)
       {
         echo "<div class='messagecorr'><p>Book lended successfully.</p></div>";
       }
       else
       {
         echo "book not lended";
       }
      }
      else
      {
       echo "<div class='message'><p>not inserted on the lended table</p></div>";
      }
     }
     else
     {
      echo "<div class='message'><p>Book id is invalid</p></div>";
     }
    }
    else
    {
     echo "<div class='message'><p>Membership id is invalid</p></div>";
    }
   }
   else
   {
     echo "<div class='message'><p>library id is not exits</p></div>";
   }
   }
  ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="container">
  <div class="full">
  <div class="ids">
    <label for="bookname">Book Name:</label>
    <input type="text" id="bookname" name="bookname" required><br><br>

    <label for="authorname">Author Name:</label>
    <input type="text" id="authorname" name="authorname" required><br><br>

    <label for="edition">Edition:</label>
    <input type="text" id="edition" name="edition" required><br><br>

    
    <input type="submit" value="Submit">
  </div>
  <div class="details">
    <label for="librarian_id">Librarian ID:</label>
    <input type="text" id="librarian_id" name="librarian_id" required><br><br>

    <label for="membership_id">Membership ID:</label>
    <input type="text" id="membership_id" name="membership_id" required><br><br>

    <label for="bookid">Book ID:</label>
    <input type="text" id="bookid" name="bookid" required><br><br>
</div>
</div>

    
  </div>
  </form>

</body>
</html>
