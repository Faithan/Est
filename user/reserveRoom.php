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




                <?php

                // Define a function to display rooms based on room type
                function displayRooms($con, $roomType, $slideNum, $slideClass)
                {
                    // Construct SQL query to fetch rooms of a specific type from the database
                    $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$roomType'";
                    $result = mysqli_query($con, $fetchdata);

                    // Output the HTML structure for displaying rooms
                    echo '
    <div class="content-center">
        <div class="container">
            <div class="slide-wrapper' . $slideNum . '">
                <button id="prev-slide" class="' . $slideClass . '"></button>
                <div class="list-container">';

                    // Loop through the fetched room data
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Store room details in variables
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

                        // Include file to display room details
                        include 'roomDetails.php';
                    }

                    // Output the rest of the HTML structure for room display
                    echo '
                </div>
                <button id="next-slide" class="' . $slideClass . '"></button>
            </div>
            <div class="slider-scrollbar' . $slideNum . '">
                <div class="scrollbar-track' . $slideNum . '">
                    <div class="scrollbar-thumb' . $slideNum . '"></div>
                </div>
            </div>
        </div>
    </div>';
                }

                ?>

                <div class="content-sub-header" id="standard">
                    <label>STANDARD ROOMS</label>
                </div> <!-- for content sub header -->

                <?php displayRooms($con, 'Standard', 1, 'slide-button1'); // Display Standard Rooms ?>

                <div class="content-sub-header" id="superior">
                    <label>SUPERIOR ROOMS</label>
                </div>

                <?php displayRooms($con, 'Superior', 2, 'slide-button2'); // Display Superior Rooms ?>

                <div class="content-sub-header" id="family">
                    <label>FAMILY ROOMS</label>
                </div>

                <?php displayRooms($con, 'Family', 3, 'slide-button3'); // Display Family Rooms ?>

                <div class="content-sub-header" id="barkadahan">
                    <label>BARKADAHAN ROOMS</label>
                </div>

                <?php displayRooms($con, 'Barkadahan', 4, 'slide-button4'); // Display Barkadahan Rooms ?>

                <div class="content-sub-header" id="exclusive">
                    <label>EXCLUSIVE SUITES</label>
                </div>

                <?php displayRooms($con, 'Exclusive Suite', 5, 'slide-button5'); // Display Exclusive Suites ?>

            </div> <!-- for real sub container -->
        </div>
    </div> <!-- for real container -->

</body>

</html>