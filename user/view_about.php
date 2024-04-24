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
    <link rel="stylesheet" href="view_about.css?v=<?php echo time(); ?>">

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
    <div class="content">
        <div class="container2">
            <div class="header-text"><label for="">ABOUT ESTREGAN</label></div>
            <hr>
            <p>Estregan Beach Resort provides the best quality of services applying top quality guest house
                and conference facilities, in order to fulfill the best way in the relevant needs of every guest.
                Provide our guests a unique experience, through which they connect with the best in our company,
                and to offer top quality service to our entire guest and provided comfort abundance. Join us, and
                experience the vacation of your dreams at Estregan Beach Resort.</p>
            <div class="image-holder"><img src="../system_images/estregan.png" alt="Estregan Beach"></div>
            <h4>LOCATION ADDRESS</h4>
            <h5>Address: Estregan beach resort, 9215 Pikalawag SND, Lanao Del Norte.<h5>
                    <h5>Phone: 0977-804-3668<h5>
                            <h5>Email: info@estreganbeachresort.com<h5>
        </div>
    </div>
    </div>



    <!-- logout  -->

</body>

</html>