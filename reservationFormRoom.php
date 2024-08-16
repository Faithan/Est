<?php
include ('db_connect.php');
session_start();


$user_id = ''; // Initialize user_id

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
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
    $savedata = "INSERT INTO reserve_room_tbl  VALUES (
    '',
    '$user_id', 
    'pending',
    'online',
    '$fname',
    '$mname',
    '$lname',
    '$address',
    '$phone_number',
    '$email',
    '$date_of_arrival',
    '$time_of_arrival',
    '$room_number',
    '$room_type',
    '$bed_type',
    '$bed_quantity',
    '$number_of_person',
    '$amenities',
    '$rate_per_hour',
    '$special_request',
    '$room_photo',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '')";

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
  


    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->

    <script src="landing_js/mobileMenu.js" defer></script>
    <script src="landing_js/inputColor.js" defer></script>


    <!-- important additional css -->
    <?php 
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/reservationForm.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Reservation Form</title>

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

    <!-- for header -->
    <?php include 'header.php' ?>


    <!-- home page -->

    <section class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <div class="wave-text">
                        <h2>Reservation Form</h2>
                        <h2>Reservation Form</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <main>

        <div class="image-container">
            <img name="photo" src="<?php echo str_replace('../', '', $manage_data['photo']); ?>" alt="">
        </div>


        <form action="" method="post" class="reserveForm-contents">

            <label>Full Name</label>


            <input class="input2" name="first_name" onkeyup="changeColor(this)" placeholder="First Name" required>

            <input class="input2" name="middle_name" onkeyup="changeColor(this)" placeholder="Middle Name" required>


            <input class="input2" name="last_name" onkeyup="changeColor(this)" placeholder="Last Name" required>


            <label>Address</label>
            <input name="address" onkeyup="changeColor(this)" placeholder="Ex: Maranding, Lala, Lanao Del Norte"
                required>

            <label>Phone Number</label>
            <input type="number" name="phone_number" onkeyup="changeColor(this)" placeholder="Ex: 09123456789" required>

            <label>Email (optional)</label>
            <input class="input4" name="email" onkeyup="changeColor(this)" placeholder="Ex: Name@gmail.com">

            <label>Arrival Date</label>
            <input class="input4" type="date" name="date_of_arrival" onkeyup="changeColor(this)" required>

            <label>Check-in Time </label>

            <input class="fixed-value-input" type="time" name="time_of_arrival" onkeyup="changeColor(this)"
                value="14:00" required readonly>
            <p id="comment"> (fixed) Good for 22 hours, start time 2:00PM - 11:00AM</p>

            <label class="bold-text">Room Details</label>

            <label>Room Number</label>
            <input class="fixed-value-input" name="room_number" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['room_number']; ?>" readonly>

            <label>Room Type</label>
            <input class="fixed-value-input" name="room_type" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['room_type']; ?>" readonly>

            <label>Bed Type</label>
            <input class="fixed-value-input" name="bed_type" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['bed_type']; ?>" readonly>

            <label>Numbers of Bed</label>
            <input class="fixed-value-input" name="bed_quantity" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['bed_quantity']; ?>" readonly>

            <label>Number of Persons:</label>
            <input class="fixed-value-input" name="number_of_person" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['no_persons']; ?>" readonly>

            <label>Amenities</label>
            <input class="fixed-value-input" name="amenities" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['amenities']; ?>" readonly>

            <label>Price (₱)</label>
            <input class="fixed-value-input" name="rate_per_hour" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['price']; ?>" readonly>

            <p id="comment"> (fixed) Good for 22 hours</p>

            <label>Do you have any special request?</label>
            <textarea name="special_request" onkeyup="changeColor(this)"></textarea>

            <p id="note">
                <b>Note:</b> Please kindly provide all the necessary information required for your reservation.
                Once you have submitted your reservation, please await confirmation. During the review of your
                submitted data, we will be in contact with you.
            </p>


            <div class="reservationForm-buttons">
                <button class="submit-btn" name="submit" type="submit">Submit</button>

                <a href="reservationRoom.php" class="cancel-btn">Cancel</a>
            </div>
        </form>


    </main>





    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>