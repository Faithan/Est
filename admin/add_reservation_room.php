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

                <?php include 'icon-container.php' ?>
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
                                <!-- Room Type Select -->
                                <div class="custom-select-pc">
                                    <?php
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

                                <!-- Bed Type Select -->
                                <div class="custom-select-pc">
                                    <?php
                                    // Query to select distinct bed type names
                                    $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                                    $result = $con->query($sql);

                                    echo "<select name='bed_type' id='bedTypeSelect' onchange='filterByBedType()'>";
                                    echo "<option disabled selected value=''>Select a Bed Type</option>";
                                    echo "<option value='all'>All</option>";  // Add "All" option

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $bedType = ucwords(strtolower($row["bed_type_name"])); // Capitalize and format the bed type
                                            echo "<option value='" . $bedType . "'>" . $bedType . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No bed types found.</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>

                                <!-- Toggle Button -->
                                <button id="toggleViewButton" onclick="toggleView()" class="togglebutton">Switch to Table View</button>
                            </div>
                        </div>

                        <!-- start of room holder -->
                        <div class="rooms-holder" id="roomsHolder">
                            <div id="listView">
                                <?php
                                $roomTypesQuery = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                                $roomTypesResult = mysqli_query($con, $roomTypesQuery);

                                while ($typeRow = mysqli_fetch_assoc($roomTypesResult)) {
                                    $room_type = $typeRow['room_type_name'];
                                    $room_type_id = strtolower(str_replace(' ', '-', $room_type)); // Convert room type to a valid ID

                                    echo "<div class='title-head' id='{$room_type_id}'>";
                                    echo "<label>$room_type</label>";
                                    echo '</div>';

                                    echo '<div class="room-first-container">';

                                    // Fetch rooms of this type
                                    $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$room_type'";
                                    $result = mysqli_query($con, $fetchdata);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $roomNumber = $row['room_number'];
                                        $roomType = $row['room_type'];
                                        $bedType = $row['bed_type'];
                                        $bed_quantity = $row['bed_quantity'];
                                        $roomNumber = $row['room_number'];
                                        $amenities = $row['amenities'];
                                        $price = $row['price'];
                                        $photo = $row['photo'];

                                        // Check the reserve_room_tbl to determine room status
                                        $statusQuery = "SELECT status FROM reserve_room_tbl WHERE room_number = '$roomNumber' AND status IN ('checkedIn', 'extended')";
                                        $statusResult = mysqli_query($con, $statusQuery);

                                        if (mysqli_num_rows($statusResult) > 0) {
                                            // Room is reserved (checkedIn or extended)
                                            $roomStatusToday = 'occupied';
                                        } else {
                                            // Room is available
                                            $roomStatusToday = 'available';
                                        }
                                ?>
                                        <div class="rooms">
                                            <img src="<?php echo $photo ?>" alt="Room Image">
                                            <div class="info-container">
                                                <!-- New section for Room Status -->
                                                <p style="text-align:center; padding:0;"><?php echo ucfirst($roomStatusToday); ?></p> <!-- Displaying status with first letter capitalized -->
                                                <div class="room-details">
                                                    <label for="bold-text">Price: </label>
                                                    <p>₱ <?php echo $price ?></p>
                                                </div>
                                                <div class="room-details" id="good-for">
                                                    <p><em>Good For 22 hours</em></p>
                                                </div>
                                                <div class="room-details">
                                                    <label>Room Type: </label>
                                                    <p><?php echo $roomType ?></p>
                                                </div>
                                                <div class="room-details">
                                                    <label>Bed Type: </label>
                                                    <p><?php echo $bedType ?></p>
                                                </div>
                                                <div class="room-details">
                                                    <label>Room Number: </label>
                                                    <p><?php echo $roomNumber ?></p>
                                                </div>
                                                <div class="room-details">
                                                    <label>No. of Beds: </label>
                                                    <p><?php echo $bed_quantity ?></p>
                                                </div>
                                              



                                            </div>

                                            <div class="button-container">
                                                <?php if ($roomStatusToday === 'available') { ?>
                                                    <a href="add_reservation_room2.php?manage_id=<?php echo $row['id']; ?>" name="book_now">
                                                        <button class="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
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
                                                <?php } else { ?>
                                                    <a href="javascript:void(0);" style="cursor: not-allowed;">
                                                        <button class="button" disabled style="cursor: not-allowed;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                                <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                                    <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                                    <path d="m8 3v4"></path>
                                                                    <path d="m16 3v4"></path>
                                                                    <path d="m4 11h16"></path>
                                                                </g>
                                                            </svg>
                                                            <span class="label">Unavailable</span>
                                                        </button>
                                                    </a> <!-- SweetAlert trigger for occupied -->
                                                <?php } ?>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    echo '</div>'; // Close room-first-container
                                }
                                ?>
                            </div>


                            <!-- Table View -->
                            <div id="tableView" style="display: none;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Room Type</th>
                                            <th>Room Number</th>
                                            <th>Bed Type</th>
                                            <th>No. of Beds</th>
                                            <th>No. of Persons</th>
                                            <th>Room Status (today)</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch distinct room types
                                        $roomTypesQuery = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                                        $roomTypesResult = mysqli_query($con, $roomTypesQuery);

                                        while ($typeRow = mysqli_fetch_assoc($roomTypesResult)) {
                                            $room_type = $typeRow['room_type_name'];

                                            // Fetch room details from room_tbl
                                            $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$room_type'";
                                            $result = mysqli_query($con, $fetchdata);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $roomNumber = $row['room_number'];
                                                $bedType = $row['bed_type'];
                                                $bed_quantity = $row['bed_quantity'];
                                                $roomNumber = $row['room_number'];
                                                $price = $row['price'];

                                                // Check the reserve_room_tbl to determine room status
                                                $statusQuery = "SELECT status FROM reserve_room_tbl WHERE room_number = '$roomNumber' AND status IN ('checkedIn', 'extended')";
                                                $statusResult = mysqli_query($con, $statusQuery);

                                                if (mysqli_num_rows($statusResult) > 0) {
                                                    // Room is reserved (checkedIn or extended)
                                                    $roomStatusToday = 'occupied';
                                                } else {
                                                    // Room is available
                                                    $roomStatusToday = 'available';
                                                }
                                        ?>
                                                <tr>
                                                    <td><?php echo ucwords(strtolower($room_type)); ?></td>
                                                    <td><?php echo $roomNumber; ?></td>
                                                    <td><?php echo ucwords(strtolower($bedType)); ?></td>
                                                    <td><?php echo $roomNumber; ?></td>
                                                    <td><?php echo $bed_quantity; ?></td>
                                               
                                                    <td><?php echo ucwords($roomStatusToday); ?></td> <!-- Room Status (today) -->
                                                    <td>₱ <?php echo $price; ?></td>
                                                    <td>
                                                        <?php if ($roomStatusToday === 'available') { ?>
                                                            <a href="add_reservation_room2.php?manage_id=<?php echo $row['id']; ?>" class="button">Select</a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);" class="button occupied-alert">Select</a> <!-- SweetAlert trigger for occupied -->
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <script>
                                    // Add an event listener for the occupied rooms' action links
                                    document.querySelectorAll('.occupied-alert').forEach(function(element) {
                                        element.addEventListener('click', function() {
                                            // Show the SweetAlert message
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Room Occupied',
                                                text: 'You cannot book this room, this room is occupied. Please wait for the customer to check out first.',
                                            });
                                        });
                                    });
                                </script>


                            </div>
                        </div>
                        <!-- end of room holder -->
                    </div>
                    <!-- end of room container -->

                    <script>
                        function toggleView() {
                            const listView = document.getElementById('listView');
                            const tableView = document.getElementById('tableView');
                            const button = document.getElementById('toggleViewButton');

                            if (listView.style.display === 'none') {
                                listView.style.display = 'block';
                                tableView.style.display = 'none';
                                button.textContent = 'Switch to Table View'; // Change button text
                            } else {
                                listView.style.display = 'none';
                                tableView.style.display = 'block';
                                button.textContent = 'Switch to Original View'; // Change button text
                            }
                        }
                    </script>
                    <style>
                        /* for table */



                        table {
                            border-collapse: collapse;
                            width: 100%;
                            overflow-y: scroll;
                            font-size: 1.2rem;
                            border: 1px solid var(--seventh-color3);
                        }

                        table th {
                            text-align: start;
                            height: 5px;
                            padding: 5px;
                            background-color: var(--eight-color);
                            color: var(--pure-white);
                            top: 0;
                            position: -webkit-sticky;
                            position: sticky;


                        }



                        table td {
                            text-align: center;
                            padding: 5px;
                            border: 1px solid var(--first-color2);

                            background-color: var(--first-color);
                            color: var(--seventh-color);
                            border: 1px solid var(--seventh-color3);

                        }

                        td input {
                            border: none;
                            width: 40px;
                            text-align: center;

                        }

                        table td a {
                            background-color: var(--first-color);
                            text-decoration: none;
                        }


                        /* Style for td elements within odd rows */
                        tbody tr:nth-of-type(odd) td {
                            background-color: var(--tdeven-color);

                        }

                        /* Style for td elements within even rows */
                    </style>



                </div>


        </section>

    </main>



</body>

</html>





<!-- Bed Type Script -->
<script>
    function filterByBedType() {
        const bedTypeSelect = document.getElementById('bedTypeSelect');
        const selectedBedType = bedTypeSelect.value.toLowerCase();

        // Get all rooms and title-head elements
        const rooms = document.querySelectorAll('.rooms');
        const titleHeads = document.querySelectorAll('.title-head');
        let hasMatchingRoom = false;
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
            titleHead.style.display = visibleRoomTypes.has(roomTypeId) ? 'block' : 'none';
        });

        // Handle no matching rooms message
        let messageContainer = document.getElementById('noRoomsMessage');
        if (!messageContainer) {
            messageContainer = document.createElement('div');
            messageContainer.id = 'noRoomsMessage';
            messageContainer.classList.add('no-rooms-message');
            document.querySelector('.rooms-container').appendChild(messageContainer);
        }

        messageContainer.style.display = hasMatchingRoom || selectedBedType === 'all' ? 'none' : 'block';
        messageContainer.textContent = hasMatchingRoom ? '' : "There's no room for that type of bed.";
    }
</script>

<!-- Room Type Script -->
<script>
    function filterRooms() {
        const select = document.getElementById('roomTypeSelect');
        const selectedRoomType = select.value.toLowerCase().replace(/ /g, '-');

        // Scroll to the selected room type
        const targetElement = document.getElementById(selectedRoomType);
        const container = document.querySelector('.rooms-container');

        if (targetElement && container) {
            const offsetTop = targetElement.offsetTop - container.offsetTop;
            container.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    }
</script>