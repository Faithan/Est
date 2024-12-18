<?php
include('db_connect.php');
session_start();

$message = "";
$isSuccess = false;

if (isset($_POST['addcottage'])) {

    $cottageNumber = $_POST['cottage_number'];
    $cottageType = $_POST['cottage_type'];
    $noPersons = $_POST['number_of_person'];
    $dayPrice = $_POST['day_price'];
    $nightPrice = $_POST['night_price'];

    // Set the status automatically to "available"
    $cottageStatus = 'Available'; 

    $photo = $_FILES['cottage_photo'];

    $filename = $_FILES['cottage_photo']['name'];
    $filetempname = $_FILES['cottage_photo']['tmp_name'];
    $filsize = $_FILES['cottage_photo']['size'];
    $fileerror = $_FILES['cottage_photo']['error'];
    $filetype = $_FILES['cottage_photo']['type'];

    $fileext = explode('.', $filename);
    $filetrueext = strtolower(end($fileext));
    $array = ['jpg', 'png', 'jpeg'];

    // Check if the cottage number already exists in the database
    $checkQuery = "SELECT * FROM cottage_tbl WHERE cottage_number = ?";
    $stmt = $con->prepare($checkQuery);
    $stmt->bind_param("s", $cottageNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Cottage number already exists
        $message = "The Cottage Number is already taken. Please choose a different one.";
        $isSuccess = false;
    } else {
        // Proceed with file upload and insert if the cottage number is unique
        if (in_array($filetrueext, $array)) {
            if ($fileerror === 0) {
                if ($filsize < 10000000) {
                    $filenewname = $filename;
                    $filedestination = '../images/' . $filenewname;
                    if ($filename) {
                        move_uploaded_file($filetempname, $filedestination);
                    }

                    // Insert the data into the database
                    $savedata = "INSERT INTO cottage_tbl (cottage_status, cottage_number, cottage_type, number_of_person, day_price, night_price, cottage_photo) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $con->prepare($savedata);
                    $stmt->bind_param("ssssiss", $cottageStatus, $cottageNumber, $cottageType, $noPersons, $dayPrice, $nightPrice, $filedestination);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        $message = "Cottage added successfully!";
                        $isSuccess = true;
                    } else {
                        $message = "Failed to save cottage!";
                        $isSuccess = false;
                    }
                } else {
                    $message = "File size is too large. Please upload a smaller image.";
                    $isSuccess = false;
                }
            } else {
                $message = "There was an error uploading the file.";
                $isSuccess = false;
            }
        } else {
            $message = "Invalid file type. Only jpg, png, jpeg are allowed.";
            $isSuccess = false;
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
    <?php include 'assets.php' ?>

    <title>Cottage Adding</title>

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
                    <div class="item"><a href="dashboardCottages.php"><i class="fa-regular fa-circle-left"></i> Return</a></div>
                </div>
            </div>
            <?php include 'logoutbtn.php' ?>
        </section>

        <section class="middle-container">
            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-gear"></i> Cottage Adding</label>
                </div>
                <?php include 'icon-container.php' ?>
            </div>

            <!-- dynamic content -->
            <div class="center-container">
                <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                    <div class="head-label">
                        <label> ADD COTTAGE</label>
                    </div>

                    <div class="input-fields-container">
                        <div class="input-fields">
                            <label for="cottage_number">Cottage Number:</label>
                            <input type="number" name="cottage_number" id="cottage_number" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="cottage_type">Cottage Type:</label>
                            <?php
                            // Assuming you've included the necessary database connection file
                            // Query to select distinct cottage type names
                            $sql = "SELECT DISTINCT cottage_type_name FROM cottage_type_tbl";
                            $result = $con->query($sql);

                            $selectBox = "<select name='cottage_type' class='select_fields' id='cottageTypeSelect' onchange='filterCottages()'>";
                            $selectBox .= "<option disabled selected value=''>Select a Cottage Type</option>";

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $cottageType = ucwords(strtolower($row["cottage_type_name"])); // Capitalize and format the cottage type
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
                            <label for="number_of_person">Number of Persons:</label>
                            <input type="number" name="number_of_person" id="number_of_person" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="day_price">Day Price:</label>
                            <input type="number" name="day_price" id="day_price" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="night_price">Night Price:</label>
                            <input type="number" name="night_price" id="night_price" class="input_fields" required>
                        </div>

                        <!-- Removed the cottage status input as it's set to 'available' by default -->
                    </div>

                    <div class="adding-photo-container">
                        <div class="center-label">
                            <label for="">Photo:</label><br>
                        </div>

                        <div class="center-label-image">
                            <div class="image-holder" id="photo_preview"></div>
                        </div>

                        <div class="center-label">
                            <input type="file" id="photo_input" name="cottage_photo" accept="image/*" required><br>
                        </div>

                        <div class="center-label">
                            <button type="submit" name="addcottage" class="button1"><i class="fa-solid fa-download"></i> Save</button>
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
                                // Redirect to the dashboardCottages.php page after success or failure
                                window.location.href = 'dashboardCottages.php';
                            }
                        });
                    </script>
                <?php endif; ?>

            </div>
        </section>
    </main>

</body>

</html>
