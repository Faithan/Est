<?php
include('db_connect.php');
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









    <style>
        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 90%;
        }

        .modal-content img {
            width: 100%;
            height: auto;
        }

        .modal-content {
            -webkit-animation: zoom 0.6s;
            animation: zoom 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* Close button */
        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #999;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

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
            <img id="roomImage" src="<?php echo str_replace('../', '', $manage_data['photo']); ?>" alt="Room Photo" style="cursor: pointer;">
        </div>


        <!-- The Modal for full-screen image -->
        <div id="imageModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="fullImage">
        </div>


        <script>
            // Get the modal
            var modal = document.getElementById("imageModal");

            // Get the image and the modal content
            var img = document.getElementById("roomImage");
            var modalImg = document.getElementById("fullImage");
            var closeModal = document.getElementsByClassName("close")[0];

            // When the user clicks the image, open the modal and display the full image
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            }

            // When the user clicks on (x), close the modal
            closeModal.onclick = function() {
                modal.style.display = "none";
            }

            // Close the modal if clicked outside the image
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

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




            <?php
            $room_number = $manage_data['room_number'];
            $query = "SELECT date_of_arrival FROM reserve_room_tbl WHERE room_number = ? AND status IN ('confirmed', 'checkedIn', 'extended')";
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $room_number);
            $stmt->execute();
            $result = $stmt->get_result();
            $reserved_dates = [];

            while ($row = $result->fetch_assoc()) {
                $reserved_dates[] = $row['date_of_arrival'];
            }

            // Pass the reserved dates as a JSON object to JavaScript
            $disabled_dates = json_encode($reserved_dates);

            ?>
            <label>Arrival Date</label>
            <input class="input4" id="date_of_arrival" type="text" name="date_of_arrival" placeholder="Select date" required>


            <!-- Custom CSS for larger datepicker -->
            <style>
                /* Increase the size of the datepicker */
                .ui-datepicker {
                    font-size: 1.5em;
                    /* Make the calendar larger */
                    width: 350px;
                    /* Increase calendar width */
                }


                /* Custom styles for reserved dates */
                .reserved-date {
                    background-color: var(--fifth-color) !important;
                    /* Red background for reserved dates */
                    cursor: pointer;
                    /* Still allows clicking */
                }

                /* Custom styles for past dates */
                .past-date {
                    background-color: #e0e0e0 !important;
                    /* Gray background for past dates */
                    color: #999 !important;
                    /* Light gray text */
                    cursor: not-allowed;
                    /* Show not-allowed cursor */
                }
            </style>

            <script>
                $(function() {
                    // Get reserved dates from PHP
                    var disabledDates = <?php echo $disabled_dates; ?>;

                    // Get today's date
                    var today = new Date();
                    today.setHours(0, 0, 0, 0); // Set the time to 00:00:00 for accurate comparison

                    // Initialize the datepicker
                    $('#date_of_arrival').datepicker({
                        dateFormat: 'yy-mm-dd',
                        beforeShowDay: function(date) {
                            var dateString = $.datepicker.formatDate('yy-mm-dd', date);

                            // Disable past dates
                            if (date < today) {
                                return [false, 'past-date', 'You cannot travel back in time'];
                            }

                            // Highlight reserved dates
                            if (disabledDates.indexOf(dateString) !== -1) {
                                return [true, 'reserved-date', 'This room is reserved on this date'];
                            }

                            return [true, '', ''];
                        },
                        onSelect: function(dateText, inst) {
                            var selectedDate = new Date(dateText);
                            selectedDate.setHours(0, 0, 0, 0); // Set time to 00:00:00 for comparison

                            // Check if the selected date is in the past
                            if (selectedDate < today) {
                                // Show SweetAlert for past dates
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'You cannot travel back in time!'
                                });
                                // Clear the input field
                                $('#date_of_arrival').val('');
                                return;
                            }

                            // Check if the selected date is a reserved date
                            if (disabledDates.indexOf(dateText) !== -1) {
                                // Show SweetAlert for reserved dates
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'This date is already reserved for someone else!'
                                });
                                // Clear the input field
                                $('#date_of_arrival').val('');
                            }
                        }
                    });
                });
            </script>




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