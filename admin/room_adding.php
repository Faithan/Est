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

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
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

            <div class="logout-container">
                <a><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
            </div>


        </section>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">

                    <label for=""><i class="fa-solid fa-gear"></i> Room Adding</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">






                <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                    <div class="head-label">
                        <label><i class="fa-solid fa-plus"></i> ADD ROOM</label>
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
                            <label for="room_type">Amenities:</label>
                            <input type="text" name="amenities" id="amenities" class="input_fields"
                                onkeyup="changeColor(this)" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Good for 22 hours:</label>
                            <input type="number" name="price" id="price" class="input_fields"
                                onkeyup="changeColor(this)" placeholder="₱" required>

                        </div>


                        <div class="input-fields">
                            <label for="room_type">Status:</label>
                            <select name="status" id="status" class="select_fields" onchange="changeColorSelect(this)"
                                required>
                                <option disabled selected value="">Choose an Option</option>
                                <option value="Available">Available</option>
                                <option value="Occupied">Occupied</option>
                                <option value="Coming soon">Coming Soon</option>
                                <option value="Under Management">Under Management</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>

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
                                window.location.href = window.location.href;
                            }
                        });
                    </script>
                <?php endif; ?>





            </div>















        </section>

    </main>



</body>

</html>