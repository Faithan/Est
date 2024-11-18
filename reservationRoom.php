<?php
include('db_connect.php');
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


    <!-- mobile version -->



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
                        <br>
                        <div><em style="color:var(--seventh-color);">*for Scrolling only*</em></div>
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
                            echo "</select> ";
                        }
                        ?>
                         <br>
                        <div><em style="color:var(--seventh-color);">*for Filtering only*</em></div>
                       
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
                        $room_type_id = strtolower(str_replace(' ', '-', $room_type)); // Convert room type to a valid ID

                        echo "<div class='title-head' id='{$room_type_id}'>";
                        echo "<label>$room_type</label>";
                        echo '</div>';

                        echo '<div class="room-first-container">';

                        $fetchdata = "SELECT * FROM room_tbl WHERE room_type = '$room_type' AND status='available'";
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

                                <img src="<?php echo str_replace('../', '', $photo); ?>" alt="Room Image" onclick="openModal(this)">




                                <!-- Fullscreen image modal -->
                                <div id="imageModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="fullImage">
                                    <div id="caption"></div>
                                </div>

                                <style>
                                    /* The Modal (background) */
                                    .modal {
                                        display: none;
                                        /* Hidden by default */
                                        position: fixed;
                                        /* Stay in place */
                                        z-index: 9999;
                                        /* Sit on top */
                                        padding-top: 200px;
                                        /* Location of the box */
                                        left: 0;
                                        top: 0;
                                        width: 100%;
                                        /* Full width */
                                        height: 100%;
                                        /* Full height */
                                        overflow: auto;
                                        /* Enable scroll if needed */
                                        background-color: rgba(0, 0, 0, 0.9);
                                        /* Black w/ opacity */
                                    }

                                    /* Modal Content (image) */
                                    .modal-content {
                                        margin: auto;
                                        display: block;
                                        max-width: 100%;
                                        max-height: 90vh;
                                        /* Limit height to avoid stretching */
                                        object-fit: contain;
                                        /* Maintain aspect ratio */
                                        transition: transform 0.3s ease;
                                        /* Smooth transition for zooming */
                                        cursor: zoom-in;
                                        /* Zoom-in cursor */
                                    }

                                    /* Zoomed-in state */
                                    .modal-content.zoomed {
                                        transform: scale(3);
                                        /* Zoom the image */
                                        cursor: zoom-out;
                                        /* Change cursor when zoomed */
                                    }

                                    /* Caption of Modal Image */
                                    #caption {
                                        margin: auto;
                                        display: block;
                                        width: 80%;
                                        max-width: 700px;
                                        text-align: center;
                                        color: #ccc;
                                        padding: 10px 0;
                                        height: 150px;
                                    }

                                    /* The Close Button */
                                    .close {
                                        position: absolute;
                                        top: 15px;
                                        right: 35px;
                                        color: #f1f1f1;
                                        font-size: 40px;
                                        font-weight: bold;
                                        transition: 0.3s;
                                    }

                                    .close:hover,
                                    .close:focus {
                                        color: #bbb;
                                        text-decoration: none;
                                        cursor: pointer;
                                    }
                                </style>


                                <script>
                                    // Get the modal
                                    var modal = document.getElementById("imageModal");

                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                    var modalImg = document.getElementById("fullImage");
                                    var captionText = document.getElementById("caption");

                                    function openModal(img) {
                                        modal.style.display = "block";
                                        modalImg.src = img.src;
                                        captionText.innerHTML = img.alt;
                                    }

                                    // Toggle zoom on click
                                    modalImg.onclick = function() {
                                        if (modalImg.classList.contains("zoomed")) {
                                            modalImg.classList.remove("zoomed"); // Zoom out
                                        } else {
                                            modalImg.classList.add("zoomed"); // Zoom in
                                        }
                                    }

                                    // Get the <span> element that closes the modal
                                    var span = document.getElementsByClassName("close")[0];

                                    // When the user clicks on <span> (x), close the modal
                                    span.onclick = function() {
                                        modal.style.display = "none";
                                        modalImg.classList.remove("zoomed"); // Reset zoom when closing
                                    }
                                </script>















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
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                        $href = "reservationFormRoom.php?manage_id=" . $id;
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

    <!-- end of mobile version -->

    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>