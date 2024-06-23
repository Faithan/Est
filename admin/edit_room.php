<?php
include ('db_connect.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:../login.php');
    exit();
}


$manage_data = ['id' => '', 'room_number' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'no_persons' => '', 'amenities' => '', 'status' => '', 'price' => '', 'photo' => ''];

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}



$message = "";
$isSuccess = false;


if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $roomNumber = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $noPersons = $_POST['no_persons'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $photo = $_FILES['photo'];

    $filename = $_FILES['photo']['name'];
    $filetempname = $_FILES['photo']['tmp_name'];
    $filesize = $_FILES['photo']['size'];
    $fileerror = $_FILES['photo']['error'];
    $filetype = $_FILES['photo']['type'];

    $fileext = explode('.', $filename);
    $filetrueext = strtolower(end($fileext));
    $allowedExtensions = ['jpg', 'png', 'jpeg'];

    if (in_array($filetrueext, $allowedExtensions)) {
        if ($fileerror === 0) {
            if ($filesize < 10000000) {
                $filenewname = $filename;
                $filedestination = '../images/' . $filenewname;
                if ($filename) {
                    move_uploaded_file($filetempname, $filedestination);
                }

                $update_query = "UPDATE room_tbl SET room_number='$roomNumber', room_type='$room_type', bed_type='$bed_type', bed_quantity='$bed_quantity', no_persons='$noPersons', amenities='$amenities',price='$price', status='$status', photo='../images/$filenewname'  WHERE id='$id'";

                $query = (mysqli_query($con, $update_query));

                if ($query) {
                    $message = "Changes Saved Successfully!";
                    $isSuccess = true;

                } else {

                    $message = "Failed!";
                    $isSuccess = false;

                }
            } else {
                $message = "Failed!";
                $isSuccess = false;
            }
        }
    } else {
        $message = "Failed!";
        $isSuccess = false;
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


    <script src="javascripts/deleteRoom.js" defer></script>
    <script src="javascripts/logout.js" defer></script>


    <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="css/edit_room.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/fullscreen.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

    <title>Edit Room</title>

    <script src="javascripts/fullscreen.js" defer></script>
    <script src="javascripts/edit_room.js" defer></script>
    <script src="javascripts/inputColor.js" defer></script>

</head>

<body>

    <?php
    include 'header.php'
        ?>



    <div class="form-holder">


        <div>
            <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                <div class="head-label">
                    <label class="header_text">EDIT ROOM</label><br>
                </div>

                <div class="line-a">
                    <div class="input_field_holder">
                        <div>

                            <label>Room Number:</label><br>
                            <input type="number" name="room_number" id="room_number" class="input_fields"
                                onkeyup="changeColor(this)" value="<?php echo $manage_data['room_number']; ?>"
                                required><br>

                            <label for="room_type">Room Type:</label><br>
                            <select name="room_type" id="room_type" class="select_fields"
                                onchange="changeColorSelect(this)" required>
                                <option disabled selected value="">Choose an Option</option>
                                <option value="Standard" <?php if ($manage_data['room_type'] == 'Standard')
                                    echo 'selected'; ?>>Standard</option>
                                <option value="Superior" <?php if ($manage_data['room_type'] == 'Superior')
                                    echo 'selected'; ?>>Superior</option>
                                <option value="Family" <?php if ($manage_data['room_type'] == 'Family')
                                    echo 'selected'; ?>>
                                    Family</option>
                                <option value="Barkadahan" <?php if ($manage_data['room_type'] == 'Barkadahan')
                                    echo 'selected'; ?>>Barkadahan</option>
                                <option value="Exclusive Suite" <?php if ($manage_data['room_type'] == 'Exclusive Suite')
                                    echo 'selected'; ?>>Exclusive Suite</option>
                            </select>
                            <br>

                            <label for="bed_type">Bed Type:</label><br>
                            <select name="bed_type" id="bed_type" class="select_fields"
                                onchange="changeColorSelect(this)" required>
                                <option disabled selected value="">Choose an Option</option>
                                <option value="Single bed" <?php if ($manage_data['bed_type'] == 'Single bed')
                                    echo 'selected'; ?>>Single Bed</option>
                                <option value="Double bed" <?php if ($manage_data['bed_type'] == 'Double bed')
                                    echo 'selected'; ?>>Double Bed</option>
                                <option value="Queen bed" <?php if ($manage_data['bed_type'] == 'Queen bed')
                                    echo 'selected'; ?>>Queen Bed</option>
                                <option value="King bed" <?php if ($manage_data['bed_type'] == 'King bed')
                                    echo 'selected'; ?>>King Bed</option>
                                <option value="California king bed" <?php if ($manage_data['bed_type'] == 'California king bed')
                                    echo 'selected'; ?>>California King Bed</option>
                                <option value="Sofa bed" <?php if ($manage_data['bed_type'] == 'Sofa bed')
                                    echo 'selected'; ?>>Sofa Bed</option>
                                <option value="Murphy bed" <?php if ($manage_data['bed_type'] == 'Murphy bed')
                                    echo 'selected'; ?>>Murphy Bed</option>
                                <option value="Bunk bed" <?php if ($manage_data['bed_type'] == 'Bunk bed')
                                    echo 'selected'; ?>>Bunk Bed</option>
                            </select>
                            <br>

                            <label>Number of Bed:</label><br>
                            <input type="number" name="bed_quantity" id="bed_quantity" class="input_fields"
                                onkeyup="changeColor(this)" value="<?php echo $manage_data['bed_quantity']; ?>"
                                required><br>

                            <label>Number of Persons:</label><br>
                            <input type="number" name="no_persons" id="no_persons" class="input_fields"
                                onkeyup="changeColor(this)" value="<?php echo $manage_data['no_persons']; ?>"
                                required><br>

                            <label>Amenities:</label><br>
                            <input type="text" name="amenities" id="amenities" class="input_fields"
                                onkeyup="changeColor(this)" value="<?php echo $manage_data['amenities']; ?>"
                                required><br>

                            <label>Price (Good for 22hrs):</label><br>
                            <input type="number" name="price" id="price" class="input_fields"
                                onkeyup="changeColor(this)" value="<?php echo $manage_data['price']; ?>" required><br>

                            <label>Status:</label><br>
                            <select name="status" id="status" class="select_fields" onchange="changeColorSelect(this)"
                                required>
                                <option disabled selected value="">Choose an Option</option>
                                <option value="Available" <?php if ($manage_data['status'] == 'Available')
                                    echo 'selected'; ?>>Available</option>
                                <option value="Coming soon" <?php if ($manage_data['status'] == 'Coming soon')
                                    echo 'selected'; ?>>Coming Soon</option>
                                <option value="Under Management" <?php if ($manage_data['status'] == 'Under Management')
                                    echo 'selected'; ?>>Under Management</option>
                                <option value="Unavailable" <?php if ($manage_data['status'] == 'Unavailable')
                                    echo 'selected'; ?>>Unavailable</option>
                            </select>
                            <br>

                            <div class="invisible-id">
                                <div>
                                    <label>id</label><br>
                                    <input type="number" name="id" value="<?php echo $manage_data['id']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="return-holder">
                        <a class="return-btn" href="rooms.php"><i
                                class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i> Return</a>
                    </div>
                </div>

                <div class="line-b">
                    <div class="center-label">
                        <label> Previous Photo:</label><br>
                    </div>
                    <div class="center-label-image">
                        <div class="image-holder2">
                            <img class="prev-image" onclick="openFullScreen()"
                                src="<?php echo $manage_data['photo']; ?>">
                        </div>
                    </div>
                    <div class="center-label">
                        <label> Upload New Photo:</label><br>
                    </div>
                    <div class="center-label-image">
                        <div class="image-holder" id="photo_preview"></div>
                    </div>
                    <div class="center-label">
                        <input type="file" id="photo_input" name="photo" accept="image/*"><br>
                    </div>

                    <div class="center-label">
                        <button type="submit" name="save" class="button1"><i class="fa-solid fa-download"></i>
                            Save Changes</button>
                    </div>
                    <div class="center-label">
                        <button type="button" name="delete" class="button2" onclick="confirmDelete()"><i
                                class="fa-solid fa-trash"></i>
                            Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- for fullscreen -->
    <div id="fullscreen-overlay">
        <span class="close" onclick="closeFullScreen()">&times;</span>
        <img id="fullscreen-image" src="" alt="">
    </div>


    <!-- for save changes -->
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



    <!-- for delete button -->
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem();
                }
            });
        }

        function deleteItem() {
            var id = document.querySelector('input[name="id"]').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_room.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'Deleted Successfully',
                            text: 'The item has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'edit_room.php'; // Replace with your desired page after deletion
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Error',
                            text: 'Failed to delete the item.',
                            icon: 'error'
                        });
                    }
                }
            };
            xhr.send('id=' + id);
        }
    </script>




</body>

</html>