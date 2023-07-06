<html>
<head>
  <style> 
  body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container{
            border: 2px solid white;
            border-radius: 10px;
            padding: 50px;
            margin-top: 20px;
            margin-left: 250px;
            margin-right: 250px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .messagecorr{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 250px;
            margin-right: 250px;
            
            background-color: rgba(203, 235, 245);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

        }
        .messagecorr p{
            margin-left: 10px;
            color: green;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .message{
            border: 2px solid white;
            border-radius: 10px;
            padding: 0px 0px;
            margin-left: 250px;
            margin-right: 250px;
           
            color: red;
            background-color: rgba(240, 189, 192);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .message p{

           margin-left: 10px;
            color: red;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        input[type="submit"] {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        h1{
            color:white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            align-items: center;
            margin-left: 250px;
            margin-top: 100px
        }
        a{
            cursor: pointer;
            text-decoration: none;
        }
        input[type="submit"]:hover {
            background-color: red;
        }    
    </style>
</head>
<body>
<h1>MEMBERSHIP DELETE FORM</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project001";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the librarian ID and membership ID from the form
    $librarianId = $_POST['librarian_id'];
    $membershipId = $_POST['membership_id'];

    $sql = "DELETE FROM membership WHERE library_id = ? AND membershipid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $librarianId, $membershipId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<div class='messagecorr'>Membership ID $membershipId has been deleted.</div>";
    } else {
        echo "<div class='message'><p>Failed to delete Membership ID $membershipId.</p></div>";
    }
    $stmt->close();
    $conn->close();
}
?>
<div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="librarian_id">Librarian ID:</label>
    <input type="text" name="librarian_id" id="librarian_id" required><br><br>
    <label for="membership_id">Membership ID:</label>
    <input type="text" name="membership_id" id="membership_id" required><br><br>
    <input type="submit" value="Delete Membership">
</form>
</div>
</body>
</html