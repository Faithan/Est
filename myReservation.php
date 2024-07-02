<?php
include ('db_connect.php');
session_start();


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}


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
    <!-- <script src="landing_js/selectCategory.js" defer></script> -->
    <!-- <script src="landing_js/reserveRoom.js" defer></script> -->
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php 
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/myReservation.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Room Reservation</title>

</head>

<body>

    <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <section class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <div class="wave-text">
                        <h2>My Reservation</h2>
                        <h2>My Reservation</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <main class="rooms-main-container">
        <div class="wrapper-main">

            <!-- for standard room-->
            <div class="content-sub-header" id="standard">
                <label>My Reserved Rooms</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM reserve_room_tbl WHERE user_id = $user_id";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $reserve_id = $row['reserve_id'];
                    $roomNumber = $row['room_number'];
                    $roomType = $row['room_type'];  
                    $bedType = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $number_of_person = $row['number_of_person'];
                    $amenities = $row['amenities'];
                    $price = $row['price'];
                    $status = $row['status'];
                    $photo = $row['photo'];
                    ?>

                    <?php
                    include 'reserveRoomDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->






        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>