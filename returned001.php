<!DOCTYPE html>
<html>
<head>
  <title>Returned Form</title>
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
  <h1>Returned Form</h1>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $librarianidu = $_POST['librarian_id'];
    $membershipidu = $_POST['membership_id'];
    $bookName = $_POST['bookname'];
    $authorName = $_POST['authorname'];
    $edition = $_POST['edition'];
    $bookidu = $_POST['bookid'];

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

   $sql0001="select libraryid from registration where libraryid='$librarianidu'";
   $result0001=$conn->query($sql0001);
   if ($result0001->num_rows > 0)
   {

    $sql = "SELECT * FROM lended WHERE bookid='$bookidu'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $bookname = $row['bookname'];
      $authorname = $row['authorname'];
      $edition = $row['edition'];
      $image = $row['image'];
      $librarianid = $row['librarian_id'];
      $summary = $row['summary'];
      $bookid001=$row['bookid'];
      $membershipid001=$row['member_id'];
      $sql1 = "SELECT * FROM lended WHERE bookid='$bookidu' and member_id='$membershipidu' and librarian_id='$librarianidu'";
      $result1 = $conn->query($sql1);
      if($result1->num_rows > 0)
      {
       $stmt = $conn->prepare("INSERT INTO books (bookname, bookid, authorname, edition, image, librarian_id, summary) VALUES (?, ?, ?, ?, ?, ?, ?)");
       $stmt->bind_param("sssssss", $bookname, $bookid001, $authorname, $edition, $image, $librarianid, $summary);
       $result2 = $stmt->execute();

       if ($result2) 
       {
         $sql3 = "DELETE FROM lended WHERE bookid='$bookid001'";
         $result3 = $conn->query($sql3);
         if ($result3) 
         {
           $sql4 = "INSERT INTO returned (bookname, bookid, authorname, librarianid, edition, membershipid) VALUES ('$bookname', '$bookid001', '$authorname', '$librarianid', '$edition', '$membershipid001')";
           $result4 = $conn->query($sql4);
           if ($result4)
           {
             echo "<div class='messagecorr'><p>Returned successfully</p></div>";       
           } 
           else 
           {
            echo "<div class='message'><p>Not returned</p></div>";
           }
         } 
         else 
         {
           echo "<div class='message'><p>Lended not deleted</p></div>";
         }
      } 
      else
      {
          echo "<div class='message'><p>Book not inserted</p></div>";
      }
     }
     else 
     {
        echo "<div class='message'><p>Membership ID is not exits</p></div>";
       
     }
    }
    else
    {
         echo "<div class='message'><p>Book does not exist</p></div>";
    }
   }
   else
   {
    echo "library id is not exits";
   }
    $conn->close();
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
