<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project001";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert form data into the database
$sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
     $re="Thank you for contacting us!";
} else {
     $re="Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
    <body>
        <head>
            <style>
            body {
            background: linear-gradient(to right, orange, red);
            }

            .printfull{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 200px;
            margin-top: 250px;
            margin-right: 200px;
            padding: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);   
            }

            .printfull .print p{
                color: "green";
            }
            h1{
                color:green;
            }

            </style>
        </head>
        <div class="printfull">
            <div class="print">
                <center><h1><?php echo $re; ?></h1></center>
            </div>
        </div>
    </body>
</html>