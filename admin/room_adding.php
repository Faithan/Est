<?php
include('db_connect.php');
session_start();

$message = "";
$isSuccess = false;
if (isset($_POST['addroom'])) {
    $roomNumber = $_POST['room_number'];
    $roomType = $_POST['room_type'];
    $bedType = $_POST['bed_type'];
    $bedQuantity = $_POST['bed_quantity'];
    $noPersons = $_POST['no_persons'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Handle file upload
    $photo = $_FILES['photo'];
    $allowedExts = ['jpg', 'png', 'jpeg'];
    $fileExt = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
    $uploadDir = '../images/';

    // Generate a unique file name to prevent overwriting
    $uniqueFileName = uniqid('', true) . '.' . $fileExt;
    $fileDestination = $uploadDir . $uniqueFileName;

    // Check if the room number already exists
    $checkRoomQuery = "SELECT * FROM room_tbl WHERE room_number = '$roomNumber'";
    $checkResult = mysqli_query($con, $checkRoomQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $message = "Room number already exists! Please choose a different number.";
        $isSuccess = false;
    } else {
        // Proceed with file upload and room data insertion
        if (in_array($fileExt, $allowedExts) && $photo['error'] === 0 && $photo['size'] < 10000000) {
            if (move_uploaded_file($photo['tmp_name'], $fileDestination)) {
                // Insert data into database
                $saveData = "INSERT INTO room_tbl (room_number, room_type, bed_type, bed_quantity, no_persons, amenities, price, status, photo) 
                            VALUES ('$roomNumber', '$roomType', '$bedType', '$bedQuantity', '$noPersons', '$amenities', '$price', '$status', '$fileDestination')";

                if (mysqli_query($con, $saveData)) {
                    $message = "Saved Successfully!";
                    $isSuccess = true;
                } else {
                    $message = "Failed to save data!";
                }
            } else {
                $message = "Failed to move uploaded file!";
            }
        } else {
            $message = "Failed to upload file!";
        }
    }
}
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


    <title>Room Adding</title>

    <script src="javascripts/add_room.js" defer></script>
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/room_adding.css?v=<?php echo time(); ?>">
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

                    <div class="item"><a href="dashboardRooms.php"><i class="fa-regular fa-circle-left"></i> Return</a>
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

                    <label for=""><i class="fa-solid fa-gear"></i> Room Adding</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">






                <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                    <div class="head-label">
                        <label> ADD ROOM</label>
                    </div>


                    <div class="input-fields-container">



                        <div class="input-fields">
                            <label for="room_type">Room Number:</label>
                            <input type="number" name="room_number" id="room_number" class="input_fields"
                                onkeyup="changeColor(this)" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Room Type:</label>

                            <?php
                            // Assuming you've included the necessary database connection file

                            // Query to select distinct room type names
                            $sql = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                            $result = $con->query($sql);

                            $selectBox = "<select name='room_type' class='select_fields' id='roomTypeSelect' onchange='filterRooms()'>";
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

                        <div class="input-fields">
                            <label for="bed_type">Bed Type:</label>
                            <?php
                            // Assuming you've included the necessary database connection file

                            // Query to select distinct bed type names
                            $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<select name='bed_type' class='select_fields' id='bedTypeSelect' onchange='filterByBedType()'>";

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

                        <div class="input-fields">
                            <label for="room_type">Number of Bed:</label>
                            <input type="number" name="bed_quantity" id="bed_quantity" class="input_fields"
                                onkeyup="changeColor(this)" required>
                        </div>


                        <div class="input-fields">
                            <label for="room_type">Number of Persons:</label>
                            <input type="number" name="no_persons" id="no_persons" class="input_fields"
                                onkeyup="changeColor(this)" required>
                        </div>



                        <div class="input-fields">
                            <label for="amenities">Amenities:</label>
                            <div class="custom-select">
                                <div id="amenitiesSelectBox" class="select-box" onclick="toggleDropdown()">
                                    <span id="selectedAmenities">Select Amenities</span>
                                    <i class="fa fa-caret-down"></i>
                                </div>
                                <div id="amenitiesDropdown" class="dropdown-content">
                                    <?php
                                    // Fetch amenities from the database
                                    $sql = "SELECT amenity_name FROM room_amenities_tbl";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $amenityName = ucwords(strtolower($row["amenity_name"])); // Capitalize and format the amenity name
                                            echo "<label><input type='checkbox' value='$amenityName' onchange='updateSelectedAmenities()'> $amenityName</label><br>";
                                        }
                                    } else {
                                        echo "<label>No amenities found.</label>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <input type="hidden" name="amenities" id="selectedAmenitiesInput">
                        </div>


                        <script>
                            function toggleDropdown() {
                                const dropdown = document.getElementById("amenitiesDropdown");
                                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                            }

                            function updateSelectedAmenities() {
                                const checkboxes = document.querySelectorAll('#amenitiesDropdown input[type="checkbox"]');
                                let selected = [];

                                checkboxes.forEach((checkbox) => {
                                    if (checkbox.checked) {
                                        selected.push(checkbox.value);
                                    }
                                });

                                // Update the displayed selected amenities
                                const selectedText = selected.length > 0 ? selected.join(', ') : 'Select Amenities';
                                document.getElementById("selectedAmenities").textContent = selectedText;

                                // Update the hidden input value for form submission
                                document.getElementById("selectedAmenitiesInput").value = selected.join(', ');
                            }

                            // Close dropdown when clicking outside of it
                            window.onclick = function(event) {
                                const dropdown = document.getElementById("amenitiesDropdown");
                                const selectBox = document.getElementById("amenitiesSelectBox");

                                // Check if the click was outside the dropdown and the select box
                                if (!event.target.matches('.select-box') && !selectBox.contains(event.target)) {
                                    if (dropdown.style.display === "block") {
                                        dropdown.style.display = "none";
                                    }
                                }
                            };
                        </script>

                        <style>
                            .custom-select {
                                position: relative;
                                display: inline-block;
                                width: 100%;
                            }

                            .select-box {
                                border: 1px solid #ccc;
                                padding: 10px;
                                cursor: pointer;
                                background-color: var(--first-color2);
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                font-size: 1.4rem;
                                border-radius: 5px;
                                color: var(--seventh-color);
                            }

                            .select-box span {
                                flex-grow: 1;

                            }

                            .dropdown-content {
                                display: none;
                                position: absolute;

                                border: 1px solid #ccc;
                                width: 100%;
                                z-index: 1;
                                max-height: 200px;
                                overflow-y: auto;
                                background-color: var(--first-color);
                                color: var(--seventh-color);
                            }

                            .dropdown-content label {
                                display: block;
                                padding: 10px;
                                cursor: pointer;
                                font-size: 1.2rem;
                            }

                            .dropdown-content label:hover {
                                background-color: var(--seventh-color3);
                            }

                            .dropdown-content input {
                                margin-right: 10px;
                            }
                        </style>





                        <div class="input-fields">
                            <label for="room_type">Good for 23 hours:</label>
                            <input type="number" name="price" id="price" class="input_fields"
                                onkeyup="changeColor(this)" placeholder="₱" required>

                        </div>


                        <div class="input-fields">
                            <label for="status">Status:</label>
                            <?php
                            // Assuming you've included the necessary database connection file

                            // Query to select distinct status names from the room_status_tbl
                            $sql = "SELECT DISTINCT room_status_name FROM room_status_tbl";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<select name='status' class='select_fields' id='statusSelect' onchange='changeColorSelect(this)' required>";

                                echo "<option disabled selected value=''>Choose an Option</option>";

                                while ($row = $result->fetch_assoc()) {
                                    $status = ucwords(strtolower($row["room_status_name"])); // Capitalize and format the status name
                                    echo "<option value='" . $status . "'>" . $status . "</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "<select name='status' id='statusSelect' class='select_fields' required>";
                                echo "<option disabled selected value=''>Choose an Option</option>";
                                echo "<option value=''>No options found.</option>";
                                echo "</select>";
                            }
                            ?>
                        </div>





                    </div>







                    <div class="adding-photo-container">
                        <div class="center-label">
                            <label for="room_type">Photo:</label><br>
                        </div>

                        <div class="center-label-image">
                            <div class="image-holder" id="photo_preview"></div>
                        </div>

                        <div class="center-label">
                            <input type="file" id="photo_input" name="photo" accept="image/*" required><br>
                        </div>

                        <div class="center-label">
                            <button type="submit" name="addroom" class="button1"><i class="fa-solid fa-download"></i>
                                Save</button>
                        </div>
                    </div>
                </form>





                <!-- for save -->
                <?php if (!empty($message)): ?>
                    <script>
                        Swal.fire({
                            title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                            text: '<?php echo $message; ?>',
                            icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'dashboardRooms.php';
                            }
                        });
                    </script>
                <?php endif; ?>





            </div>















        </section>

    </main>



</body>

</html>