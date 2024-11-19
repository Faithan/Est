<?php
include('db_connect.php');
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
    <!-- <script src="landing_js/selectCategory.js" defer></script> -->
    <!-- <script src="landing_js/reserveRoom.js" defer></script> -->
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/myReservationRoom.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>My Room Reservation</title>

</head>

<body>

    <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- for header -->
    <?php include 'header.php' ?>




    <main class="rooms-main-container">
        <div class="wrapper-main">

            <?php
            $fetchdata = "SELECT * FROM reserve_room_tbl WHERE user_id = $user_id";
            $result = mysqli_query($con, $fetchdata);
            $reservation_count = mysqli_num_rows($result);

            if ($reservation_count == 0) {
                // Display if user has no reservations
            ?>
                <div class="no-reservation-message">
                    <div class="house-icon"><i class="fa-solid fa-house-circle-exclamation"></i></div>
                    <label>There are no reservations yet. Browse rooms and cottages to reserve.</label>
                    <div class="browse-btns"><a href="#"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
                        <a href="reservationRoom.php"><i class="fas fa-bed"></i> Rooms</a>
                    </div>
                </div>
            <?php } else { ?>





                <div class="content-center">
                    <?php
                    $fetchdata = "SELECT * FROM reserve_room_tbl WHERE user_id = $user_id AND status != 'checkedOut' AND status != 'cancelled' ORDER BY reserve_Id DESC";
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

                        // Your HTML and display code for each reservation item
                    ?>

                        <div class="items">

                            <img src="<?php echo str_replace('../', '', $photo); ?>" alt="">

                            <p style="text-align:center; font-weight:bold; text-transform:capitalize;"><?php echo $status ?></p>
                            <div class="container-of-labels">

                                <div class="label-container">
                                    <div class="title-text-bold"><label>Price (Good for 22hrs):</label></div>
                                    <div class="detail-bold">
                                        <p>₱<?php echo $price ?></p>
                                    </div>
                                </div>


                                <div class="label-container">
                                    <div class="title-text"><label><b>Room Type:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $roomType ?></p>
                                    </div>
                                </div>


                                <div class="label-container">
                                    <div class="title-text"><label><b>Bed Type:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $bedType ?></p>
                                    </div>
                                </div>


                                <div class="label-container">
                                    <div class="title-text"><label><b>Room Number:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $roomNumber ?></p>
                                    </div>
                                </div>





                                <div class="label-container">
                                    <div class="title-text"><label><b>No. of Beds:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $bed_quantity ?></p>
                                    </div>
                                </div>

                                <div class="label-container">
                                    <div class="title-text"><label><b>Number of Persons:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $number_of_person ?></p>
                                    </div>
                                </div>

                                <div class="label-container">
                                    <div class="title-text"><label><b>Amenities:</b></label></div>
                                    <div class="detail">
                                        <p><?php echo $amenities ?></p>
                                    </div>
                                </div>



                            </div>

                            <div class="button-container">
                                <a href="viewReservationRoom.php?manage_id=<?php echo $reserve_id; ?>"><i
                                        class="fa-regular fa-eye"></i> OPEN</a>
                            </div>
                        </div>
                    <?php } ?>
                </div> <!-- for content center -->
            <?php } ?>
        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>