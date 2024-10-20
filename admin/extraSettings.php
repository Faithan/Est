<?php
require('db_connect.php');
session_start();

// Check if manage_id is set and fetch user data
if (isset($_GET['manage_id'])) {
    $manage_id = intval($_GET['manage_id']);
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = ?";
    if ($stmt = $con->prepare($manage_query)) {
        $stmt->bind_param('i', $manage_id);
        $stmt->execute();
        $manage_result = $stmt->get_result();
        if ($manage_result->num_rows > 0) {
            $manage_data = $manage_result->fetch_assoc();
        } else {
            $message = 'User not found.';
        }
        $stmt->close();
    } else {
        $message = 'Failed to prepare SQL statement for fetching user details.';
    }
} else {
    $message = 'User ID not specified.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php include 'assets.php'; ?>

    <title>Extra Settings</title>

    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
</head>

<body>

    <main>

        <?php include 'sidenav.php'; ?>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-gears"></i> Extra Settings</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>

            <!-- dynamic content -->
            <div class="center-container">
                <div class="head-label-container">
                    <label>Editing</label>
                </div>

                <div class="minibox-container">
                    <div class="minibox">
                        <label for=""><i class="fa-solid fa-campground"></i> Cottage Extra Settings</label>
                        <div class="input-container">
                            <div class="input-fields">
                                <label for="cottage_type">Cottage Type:</label>
                                <?php
                                // Query to select distinct cottage type names
                                $sql = "SELECT DISTINCT cottage_type_name FROM cottage_type_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='cottage_type' class='select_fields' id='cottageTypeSelect' onchange='filterCottages()'>";
                                $selectBox .= "<option disabled selected value=''>Select a Cottage Type</option>";

                                if ($result->num_rows > 0) {
                                    while ($typeRow = $result->fetch_assoc()) {
                                        $cottageType = ucwords(strtolower($typeRow["cottage_type_name"]));
                                        $selectBox .= "<option value='" . $cottageType . "'>" . $cottageType . "</option>";
                                    }
                                } else {
                                    $selectBox .= "<option value=''>No cottage types found.</option>";
                                }

                                $selectBox .= "</select>";

                                echo $selectBox;
                                ?>

                            </div>

                            <div class="input-fields">
                                <label for="cottage_status">Cottage Status:</label>

                                <?php
                                // Query to select distinct cottage status names
                                $sql = "SELECT DISTINCT cottage_status_name FROM cottage_status_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='cottage_status' class='select_fields' id='cottageStatusSelect' onchange='filterCottagesByStatus()'>";
                                $selectBox .= "<option disabled selected value=''>Select a Cottage Status</option>";

                                if ($result->num_rows > 0) {
                                    while ($statusRow = $result->fetch_assoc()) {
                                        $cottageStatus = ucwords(strtolower($statusRow["cottage_status_name"]));
                                        $selectBox .= "<option value='" . $cottageStatus . "'>" . $cottageStatus . "</option>";
                                    }
                                } else {
                                    $selectBox .= "<option value=''>No cottage statuses found.</option>";
                                }

                                $selectBox .= "</select>";

                                echo $selectBox;
                                ?>

                            </div>

                        </div>

                        <a href="extraSettingsCottage.php">
                            <i class="fa-solid fa-pen-to-square"></i> OPEN
                        </a>

                    </div>







                    <div class="minibox">
                        <label for=""><i class="fa-solid fa-bed"></i> Room Extra Settings</label>
                        <div class="input-container">
                            <div class="input-fields">
                                <label for="room_type">Room Type:</label>

                                <?php
                                // Query to select distinct room type names
                                $sql = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='room_type' class='select_fields' id='roomTypeSelect' onchange='filterRooms()'>";
                                $selectBox .= "<option disabled selected value=''>Select a Room Type</option>";

                                if ($result->num_rows > 0) {
                                    while ($roomRow = $result->fetch_assoc()) {
                                        $roomType = ucwords(strtolower($roomRow["room_type_name"]));
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
                                // Query to select distinct bed type names
                                $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<select name='bed_type' class='select_fields' id='bedTypeSelect' onchange='filterByBedType()'>";

                                    echo "<option disabled selected value=''>Select a Bed Type</option>";

                                    while ($bedRow = $result->fetch_assoc()) {
                                        $bedType = ucwords(strtolower($bedRow["bed_type_name"]));
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


                            <div class="input-fields">
                                <label for="status">Amenities:</label>
                                <?php
                                // Assuming you've included the necessary database connection file

                                // Query to select distinct status names from the room_status_tbl
                                $sql = "SELECT DISTINCT amenity_name FROM room_amenities_tbl";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<select name='status' class='select_fields' id='statusSelect' onchange='changeColorSelect(this)' required>";

                                    echo "<option disabled selected value=''>Choose an Option</option>";

                                    while ($row = $result->fetch_assoc()) {
                                        $amenities = ucwords(strtolower($row["amenity_name"])); // Capitalize and format the status name
                                        echo "<option value='" . $amenities . "'>" . $amenities . "</option>";
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

                        <a href="extraSettingsRoom.php"><i class="fa-solid fa-pen-to-square"></i> OPEN</a>
                    </div>

                    <?php
                    // Assuming you have already connected to your database via db_connect.php
                    require('db_connect.php');

                    // Fetch the gcash details from the database (assuming id = 1)
                    $gcash_number = "";
                    $gcash_photo = "";

                    $sql = "SELECT gcash_number, gcash_photo FROM gcash_tbl WHERE id = 1";
                    $result = $con->query($sql);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $gcash_number = $row['gcash_number'];
                        $gcash_photo = $row['gcash_photo'];
                    }
                    ?>

                    <div class="minibox">
                        <label for=""><i class="fa-solid fa-money-bill"></i> Gcash Settings</label>
                        <!-- Displaying Gcash photo and number based on the database -->
                        <img id="gcashImage" src="<?php echo !empty($gcash_photo) ?  $gcash_photo : 'default-image.jpg'; ?>" alt="Gcash Photo">
                        <label for="">Gcash Number:</label>
                        <p id="gcashNumber" style="margin-bottom:20px;"><?php echo !empty($gcash_number) ? $gcash_number : 'No Gcash Number Set'; ?></p>


                        <a href="javascript:void(0);" onclick="openGcashModal()"><i class="fa-solid fa-pen-to-square"></i> OPEN</a>
                    </div>

                    <style>
                        .minibox img {
                            max-width: 300px;
                            max-height: 300px;
                            background-color: var(--first-color);
                        }
                    </style>

                    <!-- Modal Structure -->
                    <div id="gcashModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <h2>Gcash Settings</h2>
                            <form id="gcashForm" enctype="multipart/form-data">
                                <div class="input-fields">
                                    <label for="gcash_number">Gcash Number:</label>
                                    <input type="text" id="gcash_number" name="gcash_number" required>
                                </div>
                                <div class="input-fields">
                                    <label for="gcash_photo">Gcash Photo:</label>
                                    <input type="file" id="gcash_photo" name="gcash_photo" accept="image/*" onchange="previewImage(event)" style="border:0; padding:0; text-align:center; background-color: var(--first-color);">
                                    <img id="photo_preview" src="" alt="Image Preview" style="display:none; max-width:200px;">
                                </div>
                                <button type="button" onclick="saveGcashSettings()"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>




<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: var(--first-color);
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }


    .modal-content h2 {
        color: var(--seventh-color);

    }

    .modal-content label {
        font-size: 1.5rem;
    }


    .modal-content input {
        font-size: 1.5rem;
        color: var(--seventh-color);
        margin-bottom: 10px;
        border: 0;
        border-radius: 0;
        border-bottom: 1px solid var(--seventh-color);
        background-color: var(--first-color2);
    }

    .modal-content button {
        margin-top: 20px;
        font-size: 1.5rem;
        padding: 10px 15px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>


<script>
    // Function to open the modal
    function openGcashModal() {
        document.getElementById('gcashModal').style.display = 'block';
        loadGcashData(); // Load existing data if available
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('gcashModal').style.display = 'none';
    }

    // Function to preview the image
    function previewImage(event) {
        const photoPreview = document.getElementById('photo_preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Function to load existing Gcash data
    function loadGcashData() {
        // Make an AJAX call to fetch the existing Gcash data
        fetch('fetch_gcash_data.php')
            .then(response => response.json())
            .then(data => {
                if (data.gcash_number) {
                    document.getElementById('gcash_number').value = data.gcash_number;
                    document.getElementById('photo_preview').src = data.gcash_photo;
                    document.getElementById('photo_preview').style.display = 'block';
                }
            });
    }

    // Function to save Gcash settings
    function saveGcashSettings() {
        const formData = new FormData(document.getElementById('gcashForm'));

        fetch('save_gcash_settings.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: data.message,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6',
                    }).then(() => {
                        closeModal(); // Close the modal after the user clicks OK
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33',
                });
            });
    }
</script>