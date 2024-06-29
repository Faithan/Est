<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important additional css -->
    <script src="sweetalert/sweetalert.js"></script>

    <link href="fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="fontawesome/css/brands.css" rel="stylesheet" />
    <link href="fontawesome/css/solid.css" rel="stylesheet" />


    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>

    <!-- important css -->
    <link rel="stylesheet" type="text/css" href="landing_css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="landing_css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="landing_css/main.css?v=<?php echo time(); ?>">
    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/signup.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Sign up</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php' ?>


    <div class="alignment-container">

    <!-- login page -->

    <main class="main-login">

        <form method="post" action="" class="login-container">

           
            <div class="logo-container">
                <img class="picture2" src="system_images/Picture4.png" alt="">
                <hr>

            </div>

            <div>
                <h2>Create an account✨</h2>
                <p>Welcome! Please enter your details.</p>
            </div>

            <label for="">Name</label>

            <div class="input-container">
                <span class="input-icon3">&#128100;</span>
                <input type="text" placeholder="Enter your name">
            </div>

            <label for="">Email</label>

            <div class="input-container">
                <span class="input-icon">&#9993;</span>
                <input type="email" placeholder="Enter your email">
            </div>

           
            <label for="">Password</label>
            <div class="input-container">
                <span class="input-icon2">&#128274;</span>
                <input type="password" placeholder="Enter your password">
            </div>

            <?php
            if (isset($error_message)) {
                echo "<p class='error-msg' style='color:red;'>$error_message</p>";
            }
            ?>

           <button name="login" class="btn-grad">Sign up</button>

           <div class="signup-btn">
            <p>Already have an account?</p>
            <a href="newlogin.php">Log in</a>
           </div>

        </form>
    </main>

    </div>

    <!-- footer -->
    <?php
     include 'footer.php' 
    ?>




</body>



</html>