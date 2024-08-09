<?php
include ('db_connect.php');
session_start();




if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

    <link rel="stylesheet" type="text/css" href="css/reserveRoom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">
    <title>Room Reservation</title>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <script src="../sweetalert/sweetalert.js"></script>
    <script src="javascripts/logout.js" defer></script>
    <script src="javascripts/reserveRoom.js" defer></script>
    <script src="javascripts/scroll.js" defer></script>
    <script src="javascripts/inputColor.js" defer></script>
</head>

<body>
    <!-- for nav -->
    <?php
    include 'header.php'
        ?>


    <div class="real-container">

        <div class="background-design1"></div>

        <div class="background-design2"></div>

        <div class="for-footer"></div>






        <div class="display-container" id="display-container">
            <div class="real-sub-container">


                <div class="content-for-head">
                    <label class="header-text">MAKE A RERSERVATION</label>
                </div> <!-- for content for head -->


                <div class="category-bar-container">
                    <select id="category-bar" onchange="scrollToCategory(this.value)">
                        <option disabled selected value="">Select a Room Type</option>
                        <option value="standard">Standard</option>
                        <option value="superior">Superior</option>
                        <option value="family">Family</option>
                        <option value="barkadahan">Barkadahan</option>
                        <option value="exclusive">Exclusive Suites</option>
                    </select>
                </div>




                <!-- for standard room                            -->

                <div class="content-sub-header" id="standard">
                    <label>STANDARD ROOMS</label>
                </div> <!-- for content sub header -->



                <div class="content-center">
                    <div class="container">
                        <div class="slide-wrapper1">
                            <button id="prev-slide" class="slide-button1"></button>

                            <div class="list-container">
                                <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Standard'";
                                $result = mysqli_query($con, $fetchdata);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $roomNumber = $row['room_number'];
                                    $roomType = $row['room_type'];
                                    $bedType = $row['bed_type'];
                                    $bed_quantity = $row['bed_quantity'];
                                    $noPersons = $row['no_persons'];
                                    $amenities = $row['amenities'];
                                    $price = $row['price'];
                                    $status = $row['status'];
                                    $photo = $row['photo'];
                                    ?>

                                    <?php
                                    include 'roomDetails.php'
                                        ?>

                                <?php } ?>

                            </div>
                            <button id="next-slide" class="slide-button1"></button>
                        </div>

                        <div class="slider-scrollbar1">
                            <div class="scrollbar-track1">
                                <div class="scrollbar-thumb1"></div>
                            </div>
                        </div>
                    </div>

                </div> <!-- for content center -->



























                <!-- for superior room   -->
                <div class="content-sub-header" id="superior">
                    <label>SUPERIOR ROOMS</label>
                </div> <!-- for content sub header -->



                <div class="content-center">
                    <div class="container">
                        <div class="slide-wrapper2">
                            <button id="prev-slide" class="slide-button2"></button>

                            <div class="list-container">
                                <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Superior'";
                                $result = mysqli_query($con, $fetchdata);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $roomNumber = $row['room_number'];
                                    $roomType = $row['room_type'];
                                    $bedType = $row['bed_type'];
                                    $bed_quantity = $row['bed_quantity'];
                                    $noPersons = $row['no_persons'];
                                    $amenities = $row['amenities'];
                                    $price = $row['price'];
                                    $status = $row['status'];
                                    $photo = $row['photo'];
                                    ?>
                                    <?php
                                    include 'roomDetails.php'
                                        ?>
                                <?php } ?>

                            </div>
                            <button id="next-slide" class="slide-button2"></button>
                        </div>

                        <div class="slider-scrollbar2">
                            <div class="scrollbar-track2">
                                <div class="scrollbar-thumb2"></div>
                            </div>
                        </div>
                    </div>

                </div> <!-- for content center -->






























                <!-- for family room   -->
                <div class="content-sub-header" id="family">
                    <label>FAMILY ROOMS</label>
                </div> <!-- for content sub header -->



                <div class="content-center">
                    <div class="container">
                        <div class="slide-wrapper3">
                            <button id="prev-slide" class="slide-button3"></button>

                            <div class="list-container">
                                <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Family'";
                                $result = mysqli_query($con, $fetchdata);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $roomNumber = $row['room_number'];
                                    $roomType = $row['room_type'];
                                    $bedType = $row['bed_type'];
                                    $bed_quantity = $row['bed_quantity'];
                                    $noPersons = $row['no_persons'];
                                    $amenities = $row['amenities'];
                                    $price = $row['price'];
                                    $status = $row['status'];
                                    $photo = $row['photo'];
                                    ?>
                                    <?php
                                    include 'roomDetails.php'
                                        ?>
                                <?php } ?>

                            </div>
                            <button id="next-slide" class="slide-button3"></button>
                        </div>

                        <div class="slider-scrollbar3">
                            <div class="scrollbar-track3">
                                <div class="scrollbar-thumb3"></div>
                            </div>
                        </div>
                    </div>

                </div> <!-- for content center -->
























                <!-- for barkadahan room   -->
                <div class="content-sub-header" id="barkadahan">
                    <label>BARKADAHAN ROOMS</label>
                </div> <!-- for content sub header -->



                <div class="content-center">
                    <div class="container">
                        <div class="slide-wrapper4">
                            <button id="prev-slide" class="slide-button4"></button>

                            <div class="list-container">
                                <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Barkadahan'";
                                $result = mysqli_query($con, $fetchdata);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $roomNumber = $row['room_number'];
                                    $roomType = $row['room_type'];
                                    $bedType = $row['bed_type'];
                                    $bed_quantity = $row['bed_quantity'];
                                    $noPersons = $row['no_persons'];
                                    $amenities = $row['amenities'];
                                    $price = $row['price'];
                                    $status = $row['status'];
                                    $photo = $row['photo'];
                                    ?>

                                    <?php
                                    include 'roomDetails.php'
                                        ?>

                                <?php } ?>

                            </div>
                            <button id="next-slide" class="slide-button4"></button>
                        </div>

                        <div class="slider-scrollbar4">
                            <div class="scrollbar-track4">
                                <div class="scrollbar-thumb4"></div>
                            </div>
                        </div>
                    </div>

                </div> <!-- for content center -->













                <!-- for Exclusive suite room   -->
                <div class="content-sub-header" id="exclusive">
                    <label>EXCLUSIVE SUITES</label>
                </div> <!-- for content sub header -->



                <div class="content-center">
                    <div class="container">
                        <div class="slide-wrapper5">
                            <button id="prev-slide" class="slide-button5"></button>

                            <div class="list-container">
                                <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Exclusive Suite'";
                                $result = mysqli_query($con, $fetchdata);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $roomNumber = $row['room_number'];
                                    $roomType = $row['room_type'];
                                    $bedType = $row['bed_type'];
                                    $bed_quantity = $row['bed_quantity'];
                                    $noPersons = $row['no_persons'];
                                    $amenities = $row['amenities'];
                                    $price = $row['price'];
                                    $status = $row['status'];
                                    $photo = $row['photo'];
                                    ?>

                                    <?php
                                    include 'roomDetails.php'
                                        ?>

                                <?php } ?>

                            </div>
                            <button id="next-slide" class="slide-button5"></button>
                        </div>

                        <div class="slider-scrollbar5">
                            <div class="scrollbar-track5">
                                <div class="scrollbar-thumb5"></div>
                            </div>
                        </div>
                    </div>

                </div> <!-- for content center -->



            </div> <!-- for real sub container -->
        </div>
    </div> <!-- for real container -->




</body>

</html>