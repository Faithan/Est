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


    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>
    <!-- <script src="landing_js/selectCategory2.js" defer></script> -->
    <!-- <script src="landing_js/reserveRoom.js" defer></script> -->
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/reservationRoom.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Room Reservation</title>

</head>

<body>

    <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- for header -->
    <?php include 'header.php' ?>




    <div class="page-structure">

        <div class="left-background">

        </div>




        <!-- home page -->
        <div class="rooms-base-container">
            <div class="container-header">
                <label for=""> room reservation</label>
            </div>

            <div class="category-container">
                <div class="select-container">

                   

                    <div class=" custom-select-pc">



                        <?php
                        // Assuming you've included the necessary database connection file
                        
                        // Query to select distinct room type names
                        $sql = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                        $result = $con->query($sql);

                        $selectBox = "<select name='room_type' id='roomTypeSelect' onchange='filterRooms()'>";
                        $selectBox .= "<option disabled selected value=''>Select a Room Type</option>";

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $roomType = ucwords(strtolower($row["room_type_name"])); // Capitalize and format the room type
                                $selectBox .= "<option value='" . $roomType . "'>" . $roomType . "</option>";
                            }
                        } else {
                            $selectBox .= "<option value=''>No room types found.</option>";
                        }

                        $selectBox .= "</select>";

                        echo $selectBox;
                        ?>
                    </div>



                    <div class="custom-select-pc">
                        <?php
                        // Assuming you've included the necessary database connection file
                        
                        // Query to select distinct bed type names
                        $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<select name='bed_type' id='bedTypeSelect'>";
                            echo "<option disabled selected value=''>Select a Bed Type</option>";

                            while ($row = $result->fetch_assoc()) {
                                $bedType = ucwords(strtolower($row["bed_type_name"])); // Capitalize and format the bed type
                                echo "<option value='" . $bedType . "'>" . $bedType . "</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<select name='bed_type' id='bedTypeSelect'>";
                            echo "<option disabled selected value=''>Select a Bed Type</option>";
                            echo "<option value=''>No bed types found.</option>";
                            echo "</select>";
                        }
                        ?>

                    </div>

                </div>

                <div class="search-bar-container">
                    <div>
                        <div class="group">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path
                                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                    </path>
                                </g>
                            </svg>
                            <input placeholder="Search" type="search" class="search-input">
                        </div>
                    </div>
                </div>
            </div>



            <!-- start of room container -->
            <div class="rooms-container">


                <!-- start of room holder -->
                <div class="rooms-holder">
                    <?php
                    $roomTypesQuery = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                    $roomTypesResult = mysqli_query($con, $roomTypesQuery);
                    $roomTypeCount = 1;

                    while ($typeRow = mysqli_fetch_assoc($roomTypesResult)) {
                        $room_type = $typeRow['room_type_name'];
                        $room_type_id = 'roomType' . $roomTypeCount; // Creating a unique ID for each room type
                        echo "<div class='title-head' id='$room_type_id'>";
                        echo "<label>$room_type</label>";
                        echo '</div>';

                        echo '<div class="room-first-container">';

                        $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$room_type'";
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

                            <div class="rooms">

                                <img src="<?php echo $photo ?>" alt="">

                                <div class="info-container">
                                    <div class="room-details"><label for="bold-text">Price : </label>
                                        <p for="bold-text">₱ <?php echo $price ?></p>
                                    </div>
                                    <div class="room-details" id="good-for">
                                        <p><em>Good For 22hours</em></p>
                                    </div>
                                    <div class="room-details"><label for="">Room Type: </label>
                                        <p><?php echo $roomType ?></p>
                                    </div>
                                    <div class="room-details"><label for="">Bed Type: </label>
                                        <p><?php echo $bedType ?></p>
                                    </div>
                                    <div class="room-details"><label for="">Room Number: </label>
                                        <p> <?php echo $roomNumber ?></p>
                                    </div>
                                    <div class="room-details"><label for="">No. of Beds: </label>
                                        <p> <?php echo $bed_quantity ?></p>
                                    </div>
                                    <div class="room-details"><label for="">No. of Persons: </label>
                                        <p><?php echo $noPersons ?></p>
                                    </div>
                                </div>

                                <div class="button-container">
                                    <?php
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                        $href = "reservationForm.php?manage_id=" . $id;
                                        $button_text = "Book Now";
                                    } else {
                                        $href = "";
                                        $button_text = "Login to Book";
                                    }
                                    ?>
                                    <a href="<?php echo $href; ?>" name="book_now">
                                        <button class="button" <?php if (empty($href))
                                            echo 'disabled'; ?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24"
                                                fill="none" class="svg-icon">
                                                <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                    <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                    <path d="m8 3v4"></path>
                                                    <path d="m16 3v4"></path>
                                                    <path d="m4 11h16"></path>
                                                </g>
                                            </svg>
                                            <span class="label"><?php echo $button_text; ?></span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }

                        echo '</div>'; // Close room-first-container
                        $roomTypeCount++;
                    }

                    ?>
                </div>
                <!-- end of room holder -->

            </div>
            <!-- end of room container -->
        </div>














        <div class="right-background">

        </div>
    </div>























































































    <!-- mobile version -->



    <section class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <div class="wave-text">
                        <h2>Room Reservation</h2>
                        <h2>Room Reservation</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-main-container">

        <h2>Categories✨</h2>

        <div class="category-bar-container">
            <div class="custom-select">
                <?php
                // Assuming you've included the necessary database connection file
                
                // Query to select distinct room type names
                $sql = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    echo "<select name='room_type' id='roomTypeSelect' onchange='scrollToDiv()'>";
                    echo "<option disabled selected value=''>Select a Room Type</option>";

                    while ($row = $result->fetch_assoc()) {
                        $roomType = ucwords(strtolower($row["room_type_name"])); // Capitalize and format the room type
                        echo "<option value='" . $roomType . "'>" . $roomType . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<select name='room_type' id='roomTypeSelect' onchange='scrollToDiv()'>";
                    echo "<option disabled selected value=''>Select a Room Type</option>";
                    echo "<option value=''>No room types found.</option>";
                    echo "</select>";
                }
                ?>
            </div>

            <div class="custom-select">
                <?php
                // Assuming you've included the necessary database connection file
                
                // Query to select distinct bed type names
                $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    echo "<select name='bed_type' id='bedTypeSelect'>";
                    echo "<option value=''>Select a Bed Type</option>";

                    while ($row = $result->fetch_assoc()) {
                        $bedType = ucwords(strtolower($row["bed_type_name"])); // Capitalize and format the bed type
                        echo "<option value='" . $bedType . "'>" . $bedType . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "<select name='bed_type' id='bedTypeSelect'>";
                    echo "<option disabled selected value=''>Select a Bed Type</option>";
                    echo "<option value=''>No bed types found.</option>";
                    echo "</select>";
                }
                ?>

            </div>




        </div>

        <div class="search-bar-container">
            <div>
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="search-input">
                </div>
            </div>
        </div>
    </section>



    <main class="rooms-main-container">
        <div class="wrapper-main">

            <?php
            // Function to fetch and display rooms for a specific room type
            function displayRoomType($con, $roomType, $headerLabel)
            {
                $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$roomType'";
                $result = mysqli_query($con, $fetchdata);

                echo '<div class="content-sub-header" id="' . strtolower($roomType) . '">
                    <label>' . $headerLabel . '</label>
                 </div>'; // Header for the room type
            
                echo '<div class="content-center">';
                echo '<div class="list-container">';

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $roomNumber = $row['room_number'];
                    $bedType = $row['bed_type'];
                    $bed_quantity = $row['bed_quantity'];
                    $noPersons = $row['no_persons'];
                    $amenities = $row['amenities'];
                    $price = $row['price'];
                    $status = $row['status'];
                    $photo = $row['photo'];

                    include 'roomDetails.php'; // Include room details template
                }

                echo '</div>'; // Close list-container
                echo '</div>'; // Close content-center
            }

            // Display rooms for different room types
            displayRoomType($con, 'Standard', 'Standard Rooms');
            displayRoomType($con, 'Superior', 'Superior Rooms');
            displayRoomType($con, 'Family', 'Family Rooms');
            displayRoomType($con, 'Barkadahan', 'Barkadahan Rooms');
            displayRoomType($con, 'Exclusive Suite', 'Exclusive Suite');
            ?>

        </div> <!-- Close wrapper-main -->
    </main>

    <!-- end of mobile version -->






    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>