<?php
include ('db_connect.php');
session_start();



// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/profile.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Profile</title>

</head>

<body>

  

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <main class="profile-main">
        <div class="profile-icon">
            
        </div>
    </main>
  






    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>