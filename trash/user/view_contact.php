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
    <link rel="stylesheet" href="css/view_contact.css?v=<?php echo time(); ?>">

</head>

<body>

     <!-- for nav -->
     <?php
    include 'header.php'
        ?>



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