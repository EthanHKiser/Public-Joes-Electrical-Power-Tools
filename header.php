<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1" /> -->
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />

    <title>Joe's Electrical Power Tools</title>
    <link rel="shortcut icon" href="jlogo.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Sono:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="joes.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
      <nav class="navbar">
          <div class="brand">
          <?php
                if (isset($_SESSION["useruid"])) {
                    echo '<a href="profile.php" style="color: white;">Welcome ' . $_SESSION["useruid"] . '!</a>';
                }
                elseif (isset($_SESSION["adminsuid"])) {
                    echo "Welcome " . $_SESSION["adminsuid"] . "!";
                }
                else {
                    echo "Welcome to Joe's!";
                }

                ?>
          </div>
          <a href="#" class="toggle-button">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
          </a>
          <div class="navbar-links">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="fix.php">Repair</a></li>
                <li><a href="parts.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <?php
                if (isset($_SESSION["useruid"])) {
                    echo '<li><a href="includes/logout.inc.php">Logout</a></li>';
                    echo '<li><a href="cart.php"><span class="material-symbols-outlined">shopping_cart</span></a></li>';
                }
                elseif (isset($_SESSION["adminsid"])) {
                    echo "<li><a href='adminedit.php'>Edit</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
                }
                
                else {
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                    echo "<li><a href='signin.php'>Login</a></li>";
                }
                ?>
              </ul>
          </div>
      </nav>

      <script src="joes.js"></script>  