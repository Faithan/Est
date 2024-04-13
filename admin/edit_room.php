<?php
include ('db_connect.php');
session_start();



if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}


if (isset($_POST['addroom'])) {
    $roomType = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $noPersons = $_POST['no_persons'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $photo = $_FILES['photo'];

    $filename = $_FILES['photo']['name'];
    $filetempname = $_FILES['photo']['tmp_name'];
    $filsize = $_FILES['photo']['size'];
    $fileerror = $_FILES['photo']['error'];
    $filetype = $_FILES['photo']['type'];

    $fileext = explode('.', $filename);
    $filetrueext = strtolower(end($fileext));
    $array = ['jpg', 'png', 'jpeg'];


    if (in_array($filetrueext, $array)) {
        if ($fileerror === 0) {
            if ($filsize < 10000000) {
                $filenewname = $filename;
                $filedestination = '../images/' . $filenewname;
                if ($filename) {
                    move_uploaded_file($filetempname, $filedestination);
                }



                $savedata = "INSERT INTO room_tbl  VALUES ('','$roomType','$bed_type','$bed_quantity','$noPersons','$amenities','$price','$status','../images/$filenewname')";

                if (mysqli_query($con, $savedata)) {
                    echo "<script> alert('Room Added Successfully')</script>";
                } else {
                    echo "Error:" . $sql . "<br>" . mysqli_error($con);
                }
            } else {
                echo '<script> alert("your file is too big!") </script>';
            }
        }
    } else {
        echo '<script> alert("cant upload this type of file!") </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="edit_room.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

    <title>Edit Room</title>



    <script src="javascripts/inputColor.js" defer></script>

</head>

<body>

    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
        </nav>
    </div>


    <div class="form-holder">


        <div>
            <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                <div class="head-label">
                    <label class="header_text">EDIT ROOM</label><br>
                </div>

                <div class="line-a">

                    <div class="input_field_holder">

                        <label for="room_type">Room Type:</label><br>
                        <select name="room_type" id="room_type" class="select_fields" onchange="changeColorSelect(this)"
                            required>
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
                        <select name="bed_type" id="bed_type" class="select_fields" onchange="changeColorSelect(this)"
                            required>
                            <option disabled value="">Choose an Option</option>
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
                            onkeyup="changeColor(this)" value="<?php echo $manage_data['no_persons']; ?>" required><br>

                        <label>Amenities:</label><br>
                        <input type="text" name="amenities" id="amenities" class="input_fields"
                            onkeyup="changeColor(this)" value="<?php echo $manage_data['amenities']; ?>" required><br>

                        <label>Rate per Hours:</label><br>
                        <input type="number" name="price" id="price" class="input_fields" onkeyup="changeColor(this)"
                            value="<?php echo $manage_data['price']; ?>" required><br>

                        <label>Status:</label><br>
                        <select name="status" id="status" class="select_fields" onchange="changeColorSelect(this)"
                            required>
                            <option disabled value="">Choose an Option</option>
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
                    </div>
                </div>

                <div class="line-b">
                    <div class="center-label">
                        <label for="room_type">Photo:</label><br>
                    </div>

                    <div class="center-label-image">
                        <div class="image-holder" id="photo_preview"></div>

                        <div class="image-holder" >
                            <img class ="" value="<?php echo $manage_data['photo']; ?>">
                        </div>
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

        </div>
    </div>

    <script src="javascripts/add_room.js"></script>

</body>

</html>