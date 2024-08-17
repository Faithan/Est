<?php
include ('db_connect.php');
session_start();


$user_id = ''; // Initialize user_id

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = $manage_id";
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
    $check_in_time = $_POST['check_in_time'];
    $price = $_POST['price'];
    $cottage_number = $_POST['cottage_number'];
    $cottage_type = $_POST['cottage_type'];
    $number_of_person = $_POST['number_of_person'];
    $special_request = $_POST['special_request'];
    $cottage_photo = $manage_data['cottage_photo'];


    $savedata = "INSERT INTO reserve_cottage_tbl  VALUES (
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
    '$check_in_time',
    '$price',
    '$cottage_number',
    '$cottage_type',
    '$number_of_person',
    '$special_request',
    '$cottage_photo'
    )";

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
    <link rel="stylesheet" href="landing_css/reservationFormCottage.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Cottage Reservation Form</title>

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
            <img name="cottage_photo" src="<?php echo $manage_data['cottage_photo']; ?>" alt="">
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



            <label>Check-in Time:</label>
            <select name="check_in_time" id="check_in_time" onchange="updatePrice()" required>
                <option disabled selected value="">Select Time</option>
                <option value="Day (6:00 AM to 5:00 PM)">Day (6:00 AM to 5:00 PM)</option>
                <option value="Night (6:00 PM to 5:00 AM)">Night (6:00 PM to 5:00 AM)</option>
            </select>

            <label>Price (₱):</label>
            <select name="price" id="price" onchange="updateCheckInTime()" required>
                <option disabled selected value="">Select Price</option>
                <option value="<?php echo $manage_data['day_price']; ?>" data-time="Day">Day
                    ₱<?php echo $manage_data['day_price']; ?></option>
                <option value="<?php echo $manage_data['night_price']; ?>" data-time="Night">Night
                    ₱<?php echo $manage_data['night_price']; ?></option>
            </select>

            <script>
                document.getElementById("check_in_time").addEventListener("change", function () {
                    if (this.value === "") {
                        this.selectedIndex = -1;
                    }
                });

                document.getElementById("price").addEventListener("change", function () {
                    if (this.value === "") {
                        this.selectedIndex = -1;
                    }
                });

                function updatePrice() {
                    var checkInTime = document.getElementById("check_in_time");
                    var price = document.getElementById("price");

                    if (checkInTime.value === "Day (6:00 AM to 5:00 PM)") {
                        price.value = "<?php echo $manage_data['day_price']; ?>";
                    } else if (checkInTime.value === "Night (6:00 PM to 5:00 AM)") {
                        price.value = "<?php echo $manage_data['night_price']; ?>";
                    }
                }

                function updateCheckInTime() {
                    var checkInTime = document.getElementById("check_in_time");
                    var price = document.getElementById("price");

                    if (price.value === "<?php echo $manage_data['day_price']; ?>") {
                        checkInTime.value = "Day (6:00 AM to 5:00 PM)";
                    } else if (price.value === "<?php echo $manage_data['night_price']; ?>") {
                        checkInTime.value = "Night (6:00 PM to 5:00 AM)";
                    }
                }
            </script>

            <!-- <p id="comment"> (fixed) Good for 22 hours, start time 2:00PM - 11:00AM</p> -->



            <label class="bold-text">Room Details</label>

            <label>Cottage Number</label>
            <input class="fixed-value-input" name="cottage_number" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_number']; ?>" readonly>

            <label>Cottage Type</label>
            <input class="fixed-value-input" name="cottage_type" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_type']; ?>" readonly>




            <label>Number of Persons:</label>
            <input class="fixed-value-input" name="number_of_person" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['number_of_person']; ?>" readonly>





            <label>Day Price (₱)</label>
            <input class="fixed-value-input" name="day_price" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['day_price']; ?>" readonly>

            <label>Night Price (₱)</label>
            <input class="fixed-value-input" name="night_price" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['night_price']; ?>" readonly>





            <label>Do you have any special request?</label>
            <textarea name="special_request" onkeyup="changeColor(this)"></textarea>

            <p id="note">
                <b>Note:</b> Please kindly provide all the necessary information required for your reservation.
                Once you have submitted your reservation, please await confirmation. During the review of your
                submitted data, we will be in contact with you.
            </p>


            <div class="reservationForm-buttons">
                <button class="submit-btn" name="submit" type="submit">Submit</button>

                <a href="reservationCottage.php" class="cancel-btn">Cancel</a>
            </div>
        </form>


    </main>





    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>