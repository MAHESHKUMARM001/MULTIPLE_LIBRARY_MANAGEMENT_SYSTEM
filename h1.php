<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Core Books</title>
  <style>
    body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    header {
       margin: 0;
      background: linear-gradient(to left, red, orange);
      color: white;
      text-align: left;
      
      font-size: 13px;
      width: 100%;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .logo {
      display: flex;
      align-items: center;
    }

    header .logo img {
      max-width: 200px;
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
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }
    header .tags .tag1 nav ul li a.active {
      color: black;
      border: 0.5px solid white;
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }


    .content {
      display: none;
      padding: 20px;
    }


    #home {
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

    .r1 p{
          font-size: 40px;
           flex-wrap: wrap;
    }
    .r2{
        font-size: 20px;
        flex-wrap: wrap;                
    }
    .r{
       
        flex-basis: 50%;
    }
    .c{
        flex-basis: 50%;
     margin-left: 200px;
        
    }
    .c1a{
      margin-left: 100px;
      margin-top: 50px;
    }

   .t {
  display: flex;
  justify-content: space-between;
  margin-top: 30px;
}


    .contact001{
      display: flex;
      justify-content: space-between;
    }
    .fullcontact{
      border: 2px solid white;
      border-radius: 10px;
      padding: 50px;
      margin-left: 200px;
      margin-right: 200px;
      margin-bottom: 10px;
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
    header .tags .linkingtabs a{
      dispaly: flex;
      color: white;
      text-decoration: none;
      padding: 5px;
    }
    header .tags{
      display:flex;
    }
    header .tags .linkingtabs a:hover {
      color: black;
      border: 0.5px solid white;
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      
      background-color: #ade9eb;
    }
    header .tags .linkingtabs a.active {
      color: black;
      border: 0.5px solid white;
      border-radius: 10px;
      background-color: rgb(149, 226, 236);
      padding: 8px;
      background-color: #ade9eb;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="fulllogo.jpg" alt="Logo" width="110px" height="40px">
    </div>
    <div class="tags">
    <div class="tag1">
    <nav>
      <ul>
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#booklist">Book List</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>
    </nav>
    </div>
    <div class="linkingtabs">
        <a href="pro001.php" target="_blank">profile</a>

    </div>
  </header>


  <div id="home" class="content">
    <div class="t">
      <div class="r">
          <div class="r1">
              <p><b>A Library is a Hospital for the Mind</b></p>
          </div>
          <div class="r2">
              <p align="justify">A library is a collection of sources of information and similar resource, made accessible to a defined community for reference 
                  or borrowing. It provides physical or digital access to material and may be physical building or room, or a virtual space, or both.
              </p>
          </div>
      </div>
      <div class="c">
          <img src="1.png" class="c1" width="500px" height="350px">
      </div>
    </div>
  </div>

  <div id="about" class="content">
    <div class="t">
      <div class="r">
          <div class="r1">
              <p><b>About</b></p>
          </div>
          <div class="r2">
              <p align="justify">Welcome to our Library Management System. We strive to provide a comprehensive and efficient library management solution for both librarians and library users. Our system offers various features such as catalog management, user authentication, borrowing and returning books, and more. We are committed to enhancing the library experience and promoting knowledge sharing within our community.
              </p>
          </div>
      </div>
      <div class="c">
          <img src="ab.png" class="c1a" width="250px" height="300px">
      </div>
    </div>
  </div>

  <div id="booklist" class="content">
    <h2>Book List</h2>
    <p>Explore our collection of books.</p>
    <div id="bookListContent">
      <?php include 'book001234.php'; ?>
    </div>
  </div>

  <div id="contact" class="content">
    
         <img src="c001.gif" width="200px" height="75px">
    <form action="submit_contact.php" method="POST">
    <div class="fullcontact">
    <div class="contact001">
      <div class="con01">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" required><br><br>

      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="message">Message:</label><br>
      <textarea id="message" name="message" required rows="5" cols="50"></textarea><br><br>
      </div>
      <div class="con02">
        <img src="Contact-1" width="400px" height="250px">
      </div>
    </div>
    <input type="submit" value="Submit">
    </div>
  </form>
  </div>

  <footer>
    <p>&copy; 2023 Library. All rights reserved.</p>
  </footer>

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
