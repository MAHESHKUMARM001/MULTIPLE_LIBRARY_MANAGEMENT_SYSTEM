<!DOCTYPE html>
<html>
<head>
    <title>Membership Form</title>
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
<h1>Membership Form</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project001";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $librarianId = $_POST['librarian_id'];
    $membershipId = $_POST['membership_id'];
    $username = $_POST['username'];

    // Check if library_id and username exist in registration table
    $sql = "SELECT * FROM registration WHERE libraryid = '$librarianId'";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM registration WHERE username = '$username'";
    $result1 = $conn->query($sql1);
   
    $sql2 = "SELECT * FROM membership WHERE membershipid = '$membershipId'";
    $result2 = $conn->query($sql2);
    

   if($result->num_rows > 0)
   {
   	    
    	if($result1->num_rows > 0)
        {
    		
    		if($result2->num_rows > 0)
            {
    			echo "<div class='message'><p>Membership already exits</p></div>";
    		}
    		else
            {
    			
                $con=mysqli_connect("localhost","root","","project001");
                $sql3 = "INSERT INTO membership (library_id, username, membershipid) VALUES ('$librarianId', '$username', '$membershipId')";
                $result3=mysqli_query($con,$sql3);
                if($result3) 
                {
                    echo "<div class='messagecorr'><p>Membership form submitted successfully.</p></div>";
                } 
                else 
                {
                    echo "<div class='message'><p>Membership form not submitted</p></div>";
                }
    		}
	    }
        else
        {
             echo "<div class='message'><p>Username is not exits</p></div>";
        }
   }
   else{
       echo "<div class='message'><p>library id not exits</p></div>";
   }
}
?>


    <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="librarian_id">Librarian ID:</label>
        <input type="text" id="librarian_id" name="librarian_id" required><br><br>

        <label for="membership_id">Membership ID:</label>
        <input type="text" id="membership_id" name="membership_id" required><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <input type="submit" name="submit" value="Submit"><br>
    </form>
    </div>
</body>
</html>
