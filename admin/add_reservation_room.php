<?php
include('db_connect.php');
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


    <title>Walk-in Room Reservation</title>

    <script src="javascripts/add_room.js" defer></script>
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/walkInReservation.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

        <section class="side-nav">
            <div class="menu-container">
                <div class="logo-container">
                    <img src="../system_images/suntree.png" alt="">
                    <label for="">Estregan Beach Resort</label>
                </div>

                <div class="menu">

                    <div class="item"><a href="dashboardRoomReservation.php"><i class="fa-regular fa-circle-left"></i>
                            Return</a>
                    </div>



                </div>


            </div>

            <?php 
            include 'logoutbtn.php'
            ?>


        </section>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">

                    <label for=""><i class="fa-solid fa-gear"></i> Walk-in Room Reservation</label>
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




                <!-- home page -->
                <div class="rooms-base-container">
                    <div class="container-header">
                        <label for="">Select Room</label>
                    </div>

                    <!-- start of room container -->
                    <div class="rooms-container">

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

                                <!-- room type script -->
                                <script>
                                    function filterRooms() {
                                        const select = document.getElementById('roomTypeSelect');
                                        const selectedRoomType = select.value.toLowerCase().replace(/ /g, '-');

                                        // Get the target element and the container
                                        const targetElement = document.getElementById(selectedRoomType);
                                        const container = document.querySelector('.rooms-container');

                                        if (targetElement && container) {
                                            // Calculate the position of the target element relative to the container
                                            const offsetTop = targetElement.offsetTop - container.offsetTop;

                                            // Scroll the container to the target element
                                            container.scrollTo({
                                                top: offsetTop,
                                                behavior: 'smooth'
                                            });
                                        }
                                    }

                                </script>






                                <div class="custom-select-pc">
                                    <?php
                                    // Assuming you've included the necessary database connection file
                                    
                                    // Query to select distinct bed type names
                                    $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo "<select name='bed_type' id='bedTypeSelect' onchange='filterByBedType()'>";

                                        echo "<option disabled selected value=''>Select a Bed Type</option>";
                                        echo "<option value='all'>All</option>";  // Add "All" option
                                    
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




                                <!-- bed type script -->
                                <script>
                                    function filterByBedType() {
                                        const bedTypeSelect = document.getElementById('bedTypeSelect');
                                        const selectedBedType = bedTypeSelect.value.toLowerCase();

                                        // Get all rooms and title-head elements
                                        const rooms = document.querySelectorAll('.rooms');
                                        const titleHeads = document.querySelectorAll('.title-head');
                                        let hasMatchingRoom = false;

                                        // Track room types that have visible rooms
                                        const visibleRoomTypes = new Set();

                                        rooms.forEach(room => {
                                            // Find the bed type within each room
                                            const bedType = room.querySelector('.room-details:nth-child(4) p').textContent.toLowerCase();

                                            // Show or hide the room based on the selected bed type
                                            if (selectedBedType === 'all' || bedType === selectedBedType || selectedBedType === '') {
                                                room.style.display = 'block'; // Show matching rooms
                                                hasMatchingRoom = true;
                                                visibleRoomTypes.add(room.closest('.room-first-container').previousElementSibling.id); // Add to visible room types
                                            } else {
                                                room.style.display = 'none'; // Hide non-matching rooms
                                            }
                                        });

                                        // Show or hide title-heads based on visible room types
                                        titleHeads.forEach(titleHead => {
                                            const roomTypeId = titleHead.id;
                                            if (visibleRoomTypes.has(roomTypeId)) {
                                                titleHead.style.display = 'block';
                                            } else {
                                                titleHead.style.display = 'none';
                                            }
                                        });

                                        // Get or create the message container
                                        let messageContainer = document.getElementById('noRoomsMessage');
                                        if (!messageContainer) {
                                            messageContainer = document.createElement('div');
                                            messageContainer.id = 'noRoomsMessage';
                                            messageContainer.classList.add('no-rooms-message');
                                            // Append to rooms-container or rooms-holder, depending on where you want the message
                                            document.querySelector('.rooms-container').appendChild(messageContainer);
                                        }

                                        // Show the message if no matching rooms are found
                                        if (!hasMatchingRoom && selectedBedType !== 'all') {
                                            messageContainer.textContent = "There's no room for that type of bed.";
                                            messageContainer.style.display = 'block';
                                        } else {
                                            messageContainer.style.display = 'none'; // Hide the message if there are matching rooms or "All" is selected
                                        }
                                    }
                                </script>

                            </div>

                        </div>






                        <!-- start of room holder -->
                        <div class="rooms-holder">
                            <?php
                            $roomTypesQuery = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                            $roomTypesResult = mysqli_query($con, $roomTypesQuery);
                            $roomTypeCount = 1;

                            while ($typeRow = mysqli_fetch_assoc($roomTypesResult)) {
                                $room_type = $typeRow['room_type_name'];
                                $room_type_id = strtolower(str_replace(' ', '-', $room_type)); // Convert room type to a valid ID
                            
                                echo "<div class='title-head' id='{$room_type_id}'>";
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

                                            <div class="room-details"><label for="">No. of Beds: </label>
                                                <p> <?php echo $bed_quantity ?></p>
                                            </div>
                                            <div class="room-details"><label for="">No. of Persons: </label>
                                                <p><?php echo $noPersons ?></p>
                                            </div>
                                        </div>

                                        <div class="button-container">
                                            <?php

                                            ?>
                                            <a href="add_reservation_room2.php?manage_id=<?php echo $id; ?>" name="book_now">
                                                <button class="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                                        height="24" fill="none" class="svg-icon">
                                                        <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                            <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                            <path d="m8 3v4"></path>
                                                            <path d="m16 3v4"></path>
                                                            <path d="m4 11h16"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="label">Select</span>
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





        </section>

    </main>



</body>

</html>