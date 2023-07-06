<?php
session_start();
/*// Check if user is already logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header('Location: profilec.php');
    exit;
}
*/
if(isset($_POST['login'])){
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $conn = mysqli_connect('localhost', 'root', '', 'project001');

    // Check connection
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement
    $sql = "SELECT * FROM registration WHERE username = '$username'";

    // Execute SQL statement
    $result = mysqli_query($conn, $sql);

    // Check if username exists
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        //$_SESSION['user']=$user;
        // Verify password
        if($user['password']==$password){
            // Set session variable
           
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            // Redirect to profile page
            header('Location: h1.php');
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid username";
    }
    // Close database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <style>
      body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container{
            border: 2px solid white;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: 400px;
            margin-right: 400px;
            padding: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .message{
            border: 2px solid white;
            border-radius: 10px;
            padding: 0px 0px;
            margin-left: 400px;
            margin-right: 400px;
            padding: 20px;
            color: red;
            background-color: rgba(240, 189, 192);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        input[type="submit"] {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }       

        input[type="submit"]:hover {
            background-color: red;
        }

        .message p{
           margin-left: 10px;
            color: red;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1{
           margin-top: 50px;
           margin-left: 400px;
           color: white;
           }
        a{

            cursor: pointer;
            text-decoration: none;
        }
        div b{
            font-size: 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: orangered;
        }
        
    </style>
</head>
<body>
	<h1>Login Form</h1>
    
	<?php 
    if(!empty($error))
    {
        echo "<div class='message'>"; // Fix typo here
        echo $error;
        echo "</div>"; 
    }
?>


        <div class="container">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label>Username:</label>
		<input type="text" name="username"><br><br>
		<label>Password:</label>
		<input type="password" name="password"><br><br>
		<input type="submit" name="login" value="Login">
	</form><br>
       <br>
        <b> I don't have any account </b><a href="registration001.php">Click here</a>
        </div>
    </body>
</html>
