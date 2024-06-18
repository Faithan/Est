<?php
include ('db_connect.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:../login.php');
    exit();
}

$message = "";
$isSuccess = false;


$manage_data = ['room_type' => '', 'no_persons' => '', 'amenities' => '', 'price' => '', 'photo' => ''];


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}



//when form is submitted
if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time_of_arrival = $_POST['time_of_arrival'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $rate_per_hour = $_POST['rate_per_hour'];
    $special_request = $_POST['special_request'];
    $room_photo = $manage_data['photo'];
    $savedata = "INSERT INTO reserve_room_tbl  VALUES ('','pending','$fname','$mname','$lname','$address ',' $phone_number',' $email','$date_of_arrival',' $time_of_arrival','$room_number','$room_type', '$bed_type','$bed_quantity', '$number_of_person', '$amenities', ' $rate_per_hour', '$special_request', '$room_photo','','','','','','','','','','' )";

    $query = (mysqli_query($con, $savedata));


    if ($query) { // Replace this condition with your actual success condition
        $message = "Reservation Sent Successfully! please wait for confirmation";
        $isSuccess = true;
    } else {
        $message = "Form Submission Failed!";
        $isSuccess = false;
    }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="css/reserveRoom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/reserveForm.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">
    
    <title>Room Reservation</title>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <script src="../sweetalert/sweetalert.js"></script>
    <script src="javascripts/logout.js" defer></script>
    <script src="reserveRoom.js" defer></script>
    <script src="scroll.js" defer></script>
    <script src="javascripts/inputColor.js" defer></script>
</head>

<body>



    <!-- sweetalert -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>'
            });
        </script>
    <?php endif; ?>

    <!-- for nav -->
    <div class="navbar-container">
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>

                <li class="dropdown">
                    <a href="reserveRoom.php" class="reservation">Reservation <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="reserveRoom.php">Rooms</a>
                    </div>
                </li>
                <li><a href="#">My Reservation</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="#">Settings</a></li>

            </ul>
            <a class="logout-btn" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
        </nav>
    </div>

    <div class="real-container">

        <div class="background-design1"></div>

        <div class="background-design2"></div>

        <div class="for-footer"> @Estregan_Beach_Resort_2024 </div>


        <div class="reserveForm-display" id="reserveForm-display">

            <div class="reserveForm-container">

                <div class="reserveForm-container1">

                    <div class="image-container">
                        <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                    </div>

                </div>


                <form action="" method="post" class="reserveForm-container2">

                    <label class="bold-text">Reservation Form</label><br>


                    <label>Full Name</label><br>


                    <input class="input2" name="first_name" onkeyup="changeColor(this)" placeholder="First Name"
                        required>

                    <input class="input2" name="middle_name" onkeyup="changeColor(this)" placeholder="Middle Name"
                        required>


                    <input class="input2" name="last_name" onkeyup="changeColor(this)" placeholder="Last Name"
                        required><br>


                    <label>Address</label><br>
                    <input name="address" onkeyup="changeColor(this)" placeholder="Ex: Maranding, Lala, Lanao Del Norte"
                        required><br>

                    <label>Phone Number</label><br>
                    <input type="number" name="phone_number" onkeyup="changeColor(this)" placeholder="Ex: 09123456789"
                        required><br>

                    <label>Email</label><br>
                    <input class="input4" name="email" onkeyup="changeColor(this)" placeholder="Ex: Name@gmail.com"
                        required><br>

                    <label>Arrival Date</label><br>
                    <input class="input4" type="date" name="date_of_arrival" onkeyup="changeColor(this)" required><br>

                    <label>Check-in Time </label><br>

                    <input type="time" name="time_of_arrival" onkeyup="changeColor(this)" value="14:00" required
                        readonly>
                    <p id="comment"> (fixed) Good for 22 hours, start time 2:00PM - 11:00AM</p><br>

                    <label class="bold-text">Room Details</label><br>

                    <label>Room Number</label><br>
                    <input class="input3" name="room_number" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['room_number']; ?>" readonly><br>

                    <label>Room Type</label><br>
                    <input class="input3" name="room_type" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['room_type']; ?>" readonly><br>

                    <label>Bed Type</label><br>
                    <input class="input3" name="bed_type" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['bed_type']; ?>" readonly><br>

                    <label>Numbers of Bed</label><br>
                    <input class="input3" name="bed_quantity" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['bed_quantity']; ?>" readonly><br>

                    <label>Number of Persons:</label><br>
                    <input class="input3" name="number_of_person" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['no_persons']; ?>" readonly><br>

                    <label>Amenities</label><br>
                    <input class="input3" name="amenities" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['amenities']; ?>" readonly><br>

                    <label>Price (₱)</label><br>
                    <input class="input3" name="rate_per_hour" onkeyup="changeColor(this)"
                        value="<?php echo $manage_data['price']; ?>" readonly><br>

                        <p id="comment"> (fixed) Good for 22 hours</p><br>

                    <label>Do you have any special request?</label><br>
                    <textarea name="special_request" onkeyup="changeColor(this)"></textarea><br>

                    <p id="note">
                        <b>Note:</b> Please kindly provide all the necessary information required for your reservation.
                        Once you have submitted your reservation, please await confirmation. During the review of your
                        submitted data, we will be in contact with you.
                    </p>


                    <div class="button-container2">
                        <button class="submit-btn" name="submit" type="submit">Submit</button>

                        <a href="reserveRoom.php" class="cancel-btn">Cancel</a>
                    </div>
                </form>



            </div>

        </div>

    </div>






</body>

</html>