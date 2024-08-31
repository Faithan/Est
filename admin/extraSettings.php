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

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>
                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
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

                        </div>

                        <a href="extraSettingsRoom.php"><i class="fa-solid fa-pen-to-square"></i> OPEN</a>
                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>