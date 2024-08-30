<?php
include ('../db_connect.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
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
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <script src="../sweetalert/sweetalert.js"></script>
    <script src="javascripts/logout.js" defer></script>

    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    
    <link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/about.css?v=<?php echo time(); ?>">

</head>

<body>

      <!-- for nav -->
      <?php
    include 'header.php'
        ?>



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
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Log Out',
                text: 'Are you sure you want to log out?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Log Out',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform log out action here
                    window.location.href = '../logout.php';
                    Swal.fire('Logged Out', 'You have been logged out successfully!', 'success');
                }
            });
        });
    </script>
    <script src="index.js">
    </script>
</body>

</html>