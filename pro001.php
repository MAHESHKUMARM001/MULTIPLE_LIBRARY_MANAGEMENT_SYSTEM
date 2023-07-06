<html>
<head>
<style>
 td {
  border: 1px solid black;
  
  width:110px;
  height:50px;
}
th{
  border: 1px solid black;
  
  width:110px;
  height:50px;
  color:orangered;
}

 body {
            background: linear-gradient(to right, orange, red);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
header {
       margin: 0;
      background: linear-gradient(to left, red, orange);
      color: white;
      text-align: left;
      border-radius: 30px;
      font-size: 13px;
      width: 100%;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
header .tags .tag1 nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    header .tags .tag1 nav ul li {
      margin-right: 20px;
    }

    header .tags .tag1 nav ul li a {
      color: white;
      text-decoration: none;
      transition: color 0.1s ease;
    }

    header .tags .tag1 nav ul li a:hover {
      color: black;
      border: 0.5px solid white;
      border-radius: 30px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }
    header .tags .tag1 nav ul li a.active {
      color: black;
      border: 0.5px solid white;
      border-radius: 30px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }


    .content {
      display: none;
      padding: 20px;
    }


    #profile {
      display: block;
    }

   
    footer {
      background: linear-gradient(to right, red, orange);
      padding: 5px;
      color: white;
      text-align: center;
      font-size: 13px;
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
    }

 .full{
            border: 2px solid white;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: 150px;
            margin-right: 150px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }
  .container{
           padding:50px;
  }
  h1{
     color:orangered;
  }
  
  .formlinks a{
    color:orangered;
    text-decoration:none;
  }
  .formlinks a:hover{
      color: black;
      border: 0.5px solid white;
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
   }
   .con001 p{
       color:black;
       font-size:20px;
       padding:50px;
    }
    .full001{
            border: 2px solid white;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: 400px;
            margin-right: 400px;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }
    .full001 .con001 p b a{
          color:orangered;
          text-decoration:none;
    }
    .full001 .con001 p b a:hover{
        color: black;
      border: 0.5px solid white;
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }
    .heading{
      margin-top:30px;
       color:white;
          font-size:30px;
          margin-left:150px;
     }
</style>
</head>
<body>
<p class='heading'><b>Profile Page</b></p>
<?php
session_start();
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$conn = mysqli_connect('localhost', 'root', '', 'project001');

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM registration WHERE username = '$username'";

$result = mysqli_query($conn, $sql);

$row= mysqli_fetch_assoc($result);
$user001=$row['username'];
echo "<div class='full'><div class='container'>";
if($row['user']==="Normal User")
{
 echo "<header>";
 echo "<div class='tags'>";
 echo  "<div class='tag1'>";
 echo   "<nav>";
 echo     "<ul>";
 echo        "<li><a href='#profile' class='active'>Profile</a></li>";
 echo        "<li><a href='#membership'>Membership</a></li>";
 echo        "<li><a href='#lend'>Lended Books</a></li>";
 echo        "<li><a href='#return'>Returned Books</a></li>";
 echo      "</ul>";
 echo    "</nav>";
 echo    "</div>";
 echo  "</header>";




echo "<div id='profile' class='content'>";
 echo "<b><lable>NAME       :</lable></b>";
 echo $row['name'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Designation:</label></b>";
 echo $row['user'];
 echo "<br>";
 echo "<br>";
 echo "<b><lable>EMAIL      :</lable></b>";
 echo $row['mailid'];
 echo "<br>";
 echo "<br>";
 echo "<b><lable>USER NAME :</lable></b>";
 echo $row['username'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Address:</label></b>";
 echo $row['address'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Phone No:</label></b>";
 echo $row['phoneno'];
 echo "<br>";
 echo "<br>";
 echo "<div class='formlinks'>";
 echo "Logout <a href='logout.php'><b>click here</b></a><br><br>";
 echo "</div>";
 echo "</div>";

echo "<div id='membership' class='content'>";
 $sql4="select * from membership where username='$user001'";
 $result4=mysqli_query($conn,$sql4);

 echo "<h1>Membership data</h1>";
 echo "<table >";
 echo "<tr><th>Library ID</th><th>Membership ID</th><th>User name</th></tr>";

// Fetch and display data
 while ($row4 = mysqli_fetch_assoc($result4)) {
    echo "<tr>";
    echo "<td>" . $row4['library_id'] . "</td>";
    echo "<td>" . $row4['membershipid'] . "</td>";
    echo "<td>" . $row4['username'] . "</td>";  
    echo "</tr>";
 }
 echo "</table>";
echo "</div>";

echo "<div id='lend' class='content'>";
 echo "<h1>Lended data</h2>";
 $sql5="select librarian_id, member_id, bookname, authorname, edition, bookid from lended where member_id in (select membershipid from membership where username='$user001')";
 $result5=mysqli_query($conn,$sql5);
 echo "<table>";
 echo "<tr><th>Library ID</th><th>Membership ID</th><th>Book Name</th><th>Author Name</th><th>Edition</th><th>BookId</th></tr>";

 while ($row5 = mysqli_fetch_assoc($result5)) {
    echo "<tr>";
    echo "<td>" . $row5['librarian_id'] . "</td>";
    echo "<td>" . $row5['member_id'] . "</td>";
    echo "<td>" . $row5['bookname'] . "</td>";
    echo "<td>" . $row5['authorname'] . "</td>";
    echo "<td>" . $row5['edition'] . "</td>";
    echo "<td>" . $row5['bookid'] . "</td>";
    echo "</tr>";
 }
 echo "</table>";
echo "</div>";

echo "<div id='return' class='content'>";
 echo "<h1>Returned data</h1>";
 $sql6="select bookname, bookid, authorname, librarianid, edition, membershipid from returned where membershipid in (select membershipid from membership where username='$user001')";
 $result6=mysqli_query($conn,$sql6);

 echo "<table>";
 echo "<tr><th>Library ID</th><th>Membership ID</th><th>Book Name</th><th>Author Name</th><th>Edition</th><th>BookId</th></tr>";

 while ($row6 = mysqli_fetch_assoc($result6)) {
    echo "<tr>";
    echo "<td>" . $row6['librarianid'] . "</td>";
    echo "<td>" . $row6['membershipid'] . "</td>";
    echo "<td>" . $row6['bookname'] . "</td>";
    echo "<td>" . $row6['authorname'] . "</td>";
    echo "<td>" . $row6['edition'] . "</td>";
    echo "<td>" . $row6['bookid'] . "</td>";
    echo "</tr>";
 }
 echo "</table>";
 echo "<br>";
 echo "<br>";
echo "</div>";
}
else
{
echo "<header>";
 echo "<div class='tags'>";
 echo  "<div class='tag1'>";
 echo   "<nav>";
 echo     "<ul>";
 echo        "<li><a href='#profile' class='active'>Profile</a></li>";
 echo        "<li><a href='#books'>Book Upload</a></li>";
 echo        "<li><a href='#membership'>Membership</a></li>";
 echo        "<li><a href='#lend'>Lended Books</a></li>";
 echo        "<li><a href='#return'>Returned Books</a></li>";
 echo      "</ul>";
 echo    "</nav>";
 echo    "</div>";
 echo  "</header>";

echo "<div id='profile' class='content'>";
 echo "<b><lable>NAME       :</lable></b>";
 echo $row['name'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Designation:</label></b>";
 echo $row['user'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Librarian ID:</label></b>";
 echo $row['libraryid'];
 echo "<br>";
 echo "<br>";
 echo "<b><lable>EMAIL      :</lable></b>";
 echo $row['mailid'];
 echo "<br>";
 echo "<br>";
 echo "<b><lable>USER NAME :</lable></b>";
 echo $row['username'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Address:</label></b>";
 echo $row['address'];
 echo "<br>";
 echo "<br>";
 echo "<b><label>Phone No:</label></b>";
 echo $row['phoneno'];
 echo "<br>";
 $libid=$row['libraryid'];
 echo "<br>";
 echo "<br>";
 echo "<div class='formlinks'>";
 echo "Logout <a href='logout.php'><b>click here</b></a><br><br>";
 echo "</div>";
echo "</div>";

echo "<div id='membership' class='content'>";
 $sql1="select library_id, membershipid from membership where library_id='$libid'";
 $result1=mysqli_query($conn, $sql1);
 
 echo "<h1>Membership data</h1>";
 echo "<div class='formlinks'>";
 echo "Membership form link <a href='membership.php' target='_blank'><b>click here</b></a><br><br>";
 echo "Membership delete form link <a href='membershipdelete.php' target='_blank'><b>click here</b></a><br><br>";
 echo "</div>";
 echo "<table >";
 echo "<tr><th>Library ID</th><th>Membership ID</th></tr>";

// Fetch and display data
 while ($row1 = mysqli_fetch_assoc($result1)) {
    echo "<tr>";
    echo "<td>" . $row1['library_id'] . "</td>";
    echo "<td>" . $row1['membershipid'] . "</td>";
    echo "</tr>";
 }

 echo "</table>";
echo "</div>";

echo "<div id='books' class='content'>";
 echo "<h1>Your uploaded Books</h2>";
 echo "<div class='formlinks'>";
 echo "Book Uploaded Form link <a href='upload.php' target='_blank'><b>click here</b></a><br><br>"; 
 echo "</div>";
 $sql7="select bookname, bookid, authorname, edition, librarian_id from books where librarian_id='$libid'";
 $result7=mysqli_query($conn,$sql7);
 echo "<table>";
 echo "<tr><th>Book name</th><th>Book ID</th><th>Author Name</th><th>Edition</th><th>Librarian_id</th></tr>";

 while ($row7 = mysqli_fetch_assoc($result7)) {
    echo "<tr>";
    echo "<td>" . $row7['bookname'] . "</td>";
    echo "<td>" . $row7['bookid'] . "</td>";
    echo "<td>" . $row7['authorname'] . "</td>";
    echo "<td>" . $row7['edition'] . "</td>";
    echo "<td>" . $row7['librarian_id'] . "</td>";
    echo "</tr>";
 }

 echo "</table>";
echo "</div>";

echo "<div id='lend' class='content'>";
 echo "<h1>Lended data</h2>";
 echo "<div class='formlinks'>";
 echo "Lended form link <a href='lendedform.php' target='_blank'><b>click here</b></a><br><br>";
 echo "</div>";
 $sql2="select librarian_id, member_id, bookname, authorname, edition, bookid from lended where librarian_id='$libid'";
 $result2=mysqli_query($conn,$sql2);
 echo "<table>";
 echo "<tr><th>Library ID</th><th>Membership ID</th><th>Book Name</th><th>Author Name</th><th>Edition</th><th>BookId</th></tr>";

 while ($row2 = mysqli_fetch_assoc($result2)) {
    echo "<tr>";
    echo "<td>" . $row2['librarian_id'] . "</td>";
    echo "<td>" . $row2['member_id'] . "</td>";
    echo "<td>" . $row2['bookname'] . "</td>";
    echo "<td>" . $row2['authorname'] . "</td>";
    echo "<td>" . $row2['edition'] . "</td>";
    echo "<td>" . $row2['bookid'] . "</td>";
    echo "</tr>";
 }
 echo "</table>";
echo "</div>";

echo "<div id='return' class='content'>";
 echo "<h1>Returned data</h1>";
 echo "<div class='formlinks'>";
 echo "Returned form link <a href='returned001.php' target='_blank'><b>click here</b></a><br><br>"; 
 echo "</div>";
 $sql3="select bookname, bookid, authorname, librarianid, edition, membershipid from returned where librarianid='$libid'";
 $result3=mysqli_query($conn,$sql3);

 echo "<table>";
 echo "<tr><th>Library ID</th><th>Membership ID</th><th>Book Name</th><th>Author Name</th><th>Edition</th><th>BookId</th></tr>";

 while ($row3 = mysqli_fetch_assoc($result3)) {
    echo "<tr>";
    echo "<td>" . $row3['librarianid'] . "</td>";
    echo "<td>" . $row3['membershipid'] . "</td>";
    echo "<td>" . $row3['bookname'] . "</td>";
    echo "<td>" . $row3['authorname'] . "</td>";
    echo "<td>" . $row3['edition'] . "</td>";
    echo "<td>" . $row3['bookid'] . "</td>";
    echo "</tr>";
 }

 echo "</table>";
 echo "<br>";
 echo "<br>";
echo "</div>";
}
echo "</div>";
echo "</div>";
mysqli_close($conn);
}
else{
die("<div class='full001'><div class='con001'><p><b>Please login <a href='login.php'>Click Here</a></b></p></div></div>");
}
?>
<script>
    // JavaScript code to handle tab switching
    const tabs = document.querySelectorAll("header nav ul li a");
    const contents = document.querySelectorAll(".content");

    tabs.forEach((tab) => {
      tab.addEventListener("click", (e) => {
        e.preventDefault();
        const target = tab.getAttribute("href").substring(1);
        contents.forEach((content) => {
          content.style.display = "none";
        });
        document.getElementById(target).style.display = "block";

        // Remove active class from all tabs
        tabs.forEach((tab) => {
          tab.classList.remove("active");
        });

        // Add active class to the clicked tab
        tab.classList.add("active");
      });
    });
    
  </script>

</body>
</html>