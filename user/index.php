<?php
include ('../db_connect.php');
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location:../login.php');
    exit();
  }



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    
</head>
<body>

    <!-- for nav -->
    <div>
    <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li class="dropdown">
                    <a href="reserveRoom.php" class="reservation">Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="reserveRoom.php">Rooms</a>
                <li><a>Contact</a></li>

            </ul>
            <a class="logout-btn" href="../logout.php">Log out</a>
        </nav>
    </div>



    <!-- for body -->
    <div class="content">
        <div class="for-background">
        </div>
        <div class="leftcontent">
            <label>RESERVE FOR COTTAGES</label>
            <p>A place to Stay, A place to Enjoy, A place to Relax.
                We openly welcome you to stay a moment, for the sea is just beyond the door.
            </p>
            <button>Reserve Now</button>
        </div>

        <div class="rightcontent">
            <img src="../system_images/Picture4.png" class="logo2">
        </div>
    </div>


    <script src="index.js">
    </script>
</body>

</html>