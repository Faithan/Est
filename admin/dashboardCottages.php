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


    <title>Estregan Cottages</title>

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
                    <label for=""><i class="fa-solid fa-gear"></i> Manage Cottages</label>
                </div>

                <?php include 'icon-container.php'?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">

                    <?php include 'manageCottages.php'; ?>
            
      
            </div>

         













        </section>

    </main>



</body>

</html>