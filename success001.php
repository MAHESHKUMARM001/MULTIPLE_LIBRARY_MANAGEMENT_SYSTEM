<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <style>
        body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .messagecorr {
            border: 2px solid white;
            border-radius: 10px;
            padding: 50px;
            align-items: center;
            margin-top: 200px;
            margin-left: 250px;
            margin-right: 250px;
            background-color: rgba(203, 235, 245);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .messagecorr center p b {
            color: green;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 50px;
        }
        .messagecorr p {
            font-size: 20px;
        }
        a {
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="messagecorr">
        <?php
        // Check if session variables are set
        if (
            isset($_SESSION["name"]) &&
            isset($_SESSION["mail"]) &&
            isset($_SESSION["username"]) &&
            isset($_SESSION["password"]) &&
            isset($_SESSION["address"]) &&
            isset($_SESSION["phone"]) &&
            isset($_SESSION["user"])
        ) {
            // Retrieve form data from session variables
            $name = $_SESSION["name"];
            $mail = $_SESSION["mail"];
            $username = $_SESSION["username"];
            $password = $_SESSION["password"];
            $address = $_SESSION["address"];
            $phone = $_SESSION["phone"];
            $user = $_SESSION["user"];
            $libraryname = isset($_SESSION["libraryname"]) ? $_SESSION["libraryname"] : "";

            // Unset session variables
            unset($_SESSION["name"]);
            unset($_SESSION["mail"]);
            unset($_SESSION["username"]);
            unset($_SESSION["password"]);
            unset($_SESSION["address"]);
            unset($_SESSION["phone"]);
            unset($_SESSION["user"]);
            unset($_SESSION["libraryname"]);

            // Insert the registration data into the database
            $con = mysqli_connect("localhost", "root", "", "project001");
            if ($con) {
                if ($user === 'Librarian') {
                    // Generate the library ID
                    $libraryId = generateLibraryId();

                    $sql = "INSERT INTO registration (`name`, `mailid`, `username`, `password`, `address`, `phoneno`, `user`, `libraryname`, `libraryid`) VALUES ('$name', '$mail', '$username', '$password', '$address', '$phone', '$user', '$libraryname', '$libraryId')";
                    $result = mysqli_query($con, $sql);

                    // Print the library ID
                    if ($result) {
                        echo "<center><p><b>Thank you for your registration!</b></p></center>";
                        echo "<center><p><b>Your library ID is: $libraryId</b></p></center>";
                        echo "<center><b>Please login <a href='login.php'>click here</a> for unlock more features</b></center>";
                    } else {
                        echo "<center><p><b>Oops! Something went wrong.</b></p></center>";
                    }
                } else {
                    $sql = "INSERT INTO registration (`name`, `mailid`, `username`, `password`, `address`, `phoneno`, `user`) VALUES ('$name', '$mail', '$username', '$password', '$address', '$phone', '$user')";
                    $result = mysqli_query($con, $sql);

                    // Print a "thank you" message
                    if ($result) {
                        echo "<center><p><b>Thank you for your registration!</b></p></center>";
                        echo "<center><b>Please login <a href='login.php'>click here</a> for unlock more features</b></center>";
                    } else {
                        echo "<center><p><b>Oops! Something went wrong.</b></p></center>";
                    }
                }

                mysqli_close($con);
            } else {
                echo "<center><p><b>Oops! Something went wrong. Unable to connect to the database.</b></p></center>";
            }
        } else {
            die("<center><p><b>Oops! Something went wrong. Unable to connect to the database.</b></p></center>");
        }

        // Function to generate the library ID
        function generateLibraryId()
        {
            $timestamp = time();
            $randomNumber = mt_rand(1000, 9999);
            $libraryId = 'LIB_' . $timestamp . $randomNumber;
            return $libraryId;
        }
        ?>
    </div>
</body>
</html>
