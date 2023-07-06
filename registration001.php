<?php
session_start();

if (isset($_POST["submit"])) {
    // Retrieve form data
    $name = $_POST["name"];
    $username = $_POST["username"];
    $mail = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    if (!isset($_POST["libraryname"])) {
        $libraryname = "";
    } else {
        $libraryname = $_POST["libraryname"];
    }

    // Assign form data to session variables
    $_SESSION["name"] = $name;
    $_SESSION["username"] = $username;
    $_SESSION["mail"] = $mail;
    $_SESSION["password"] = $password;
    $_SESSION["address"] = $address;
    $_SESSION["phone"] = $phone;
    $_SESSION["user"] = $user;
    $_SESSION["libraryname"] = $libraryname;

    $con = mysqli_connect("localhost", "root", "", "project001");
    $sql = "SELECT * FROM registration WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)) {
        $error_message = "Username already exists";
    } else {
        header("Location: success001.php"); // Redirect to success page
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
         body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        form {
            display: flex;
            flex-direction: column;
          
        }

        .form-box {
            border: 2px solid white;
            border-radius: 10px;
            
            margin-top: 20px;
            margin-left: 150px;
            margin-right: 150px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .messagecorr{
            border: 2px solid white;
            border-radius: 10px;
            padding: 20px;
            margin-left: 150px;
            margin-right: 150px;
            
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
            margin-left: 150px;
            margin-right: 150px;
           
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
        .container{
                display: flex;
                justify-content: space-between;

                padding-top: 40px;
                padding-bottom: 40px;

                
            }
        h1{
            color:white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            align-items: center;
            margin-left: 150px;
        }
        div b{
            font-size: 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: orangered;
           // margin-right: 150px;
        }
        input[type="submit"]:hover {
            background-color: red;
        }
        .c1
        {
          border-radius: 5px;
          padding-left: 80px;
          padding-right:40px;
        }
        .c2{
          border-radius: 5px;
          padding-right: 80px;
          padding-left: 160px;
        }

        a{

            cursor: pointer;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <h1>Registration Form</h1>
    <?php if(isset($error_message)): ?>
        <div class='message'>
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-box">
            <div class="container">
                <div class="c1">
                    <label>NAME:</label><br>
                    <input type="text" name="name" required class="name"><br>
                    <label>Address:</label><br>
                    <textarea name="address" rows="3" cols="25" required></textarea><br>
                    <label>Phone No:</label><br>
                    <input type="tel" name="phone" required><br>
                    Enter Your Designation<br>
                    <label>
                        <input type="radio" name="user" value="Normal User" onclick="javascript:yesnoCheck();" id="noCheck" required>
                        Normal User
                    </label><br>
                    <label>
                        <input type="radio" name="user" value="Librarian" onclick="javascript:yesnoCheck();" id="yesCheck" required>
                        Librarian
                    </label><br>
                    <div id="ifYes" style="display:none">
                        <label>Library Name:</label><br>
                        <input type="text" name="libraryname"><br>
                    </div>
                    <br>
                    <input type="submit" name="submit" value="Register"><br>
                    <br>
                    <div class="al">
                        <b>Already Have a Account</b>
                        <a href="login.php">click here</a>
                    </div>
                    <script>
                        function yesnoCheck() {
                            if (document.getElementById('yesCheck').checked) {
                                document.getElementById('ifYes').style.display = 'block';
                            } else {
                                document.getElementById('ifYes').style.display = 'none';
                            }
                        }
                    </script>
                </div>
                <div class="c2">
                    <label>E-MAIL:</label><br>
                    <input type="email" name="email" required><br>
                    <br>
                    <label>Username:</label><br>
                    <input type="text" name="username" required><br>
                    <br>
                    <label>Password:</label><br>
                    <input type="password" name="password" required><br>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
