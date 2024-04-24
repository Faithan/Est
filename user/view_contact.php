<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />
    
    <script src="../sweetalert/sweetalert.js"></script>
    <script src="javascripts/logout.js" defer></script>
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="view_contact.css?v=<?php echo time(); ?>">

</head>

<body>

    <!-- for nav -->
    <div class="navbar-container">
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a onclick="confirm('You have to log in first!')">Home</a></li>
                <li><a href="view_about.php">About</a></li>
                <li class="dropdown">
                    <a href="view_rooms.php" class="reservation">Reservation <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a onclick="confirm('You have to log in first!')">Cottages</a>
                        <a href="view_rooms.php">Rooms</a>
                    </div>
                <li><a href="view_contact.php">Contact</a></li>

            </ul>
            <a class="logout-btn" href="../login.php"><i class="fa-solid fa-right-to-bracket"></i>Sign in</a>
        </nav>
    </div>



    <!-- for body -->
    <div class="container">
        <div class="contact-box">
            <div class="left"></div>
            <div class="right">
                <h2>Contact Us</h2>
                <input type="text" class="field" placeholder="Your Name">
                <input type="text" class="field" placeholder="Your Email">
                <input type="text" class="field" placeholder="Phone">
                <textarea placeholder="Message" class="field"></textarea>
                <button class="btn">Send</button>
            </div>
        </div>
    </div>




    <!-- logout  -->

</body>

</html>