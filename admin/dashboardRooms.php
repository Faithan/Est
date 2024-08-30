<?php
require('db_connect.php');
session_start();



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <title>Estregan Rooms</title>

    <script src="javascripts/switch.js"></script>


    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

     <?php include 'sidenav.php'
      ?>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                <label for=""><i class="fa-solid fa-gear"></i> Manage Rooms</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                  


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">

                    <?php include 'manageRooms.php'; ?>
            
      
            </div>

         













        </section>

    </main>



</body>

</html>