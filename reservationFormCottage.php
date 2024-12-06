<?php
include('db_connect.php');
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
    $time = $_POST['time'];
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
    '$time',
    '$price',
    '',
    '',
    '$cottage_number',
    '$cottage_type',
    '$number_of_person',
    '$special_request',
    '$cottage_photo',
    '',
    '',
    ''
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



    <style>
        /* Full-screen modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        /* Modal content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Close button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Animation */
        .modal-content {
            animation: zoom 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        /* Responsive - image will resize */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
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
            }).then(function() {
                // Redirect to another page after the SweetAlert is closed
                window.location.href = "myReservationCottage.php"; // Replace with the actual URL you want to redirect to
            });
        </script>
    <?php endif; ?>

    <!-- for header -->
    <?php include 'header.php' ?>


    <!-- home page -->



    <main>

        <div class="image-container">
            <?php
            $photo = str_replace('../', '', $manage_data['cottage_photo']);
            ?>
            <img id="cottage-photo" src="<?php echo $photo; ?>" alt="Cottage Photo" style="cursor: pointer;">
        </div>

        <!-- Modal for full-screen image -->
        <div id="imageModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="modal-img">
        </div>

        <script>
            // Get modal elements
            var modal = document.getElementById("imageModal");
            var modalImg = document.getElementById("modal-img");
            var img = document.getElementById("cottage-photo");
            var closeBtn = document.getElementsByClassName("close")[0];

            // Open modal when image is clicked
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src; // Use the source of the clicked image
            }

            // Close the modal when close button is clicked
            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            // Close the modal when anywhere outside the modal image is clicked
            modal.onclick = function(event) {
                if (event.target === modal) {
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
            // Fetch reserved arrival dates and times for a specific cottage
            $cottage_number = $manage_data['cottage_number'];
            $query = "SELECT date_of_arrival, time FROM reserve_cottage_tbl WHERE cottage_number = ? AND reserve_status IN ('pending','confirmed', 'checkedIn')";
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $cottage_number);
            $stmt->execute();
            $result = $stmt->get_result();
            $reserved_dates_times = [];

            
            while ($row = $result->fetch_assoc()) {
                $reserved_dates_times[$row['date_of_arrival']][] = $row['time'];
            }

            // Pass the reserved dates and times as a JSON object to JavaScript
            $disabled_dates_times = json_encode($reserved_dates_times);
            ?>
            <label>Arrival Date</label>
            <input class="input4" id="date_of_arrival" type="text" name="date_of_arrival" placeholder="Select date"
                required>

            <label>Time:</label>
            <select name="time" id="check_in_time" required>
                <option disabled selected value="">Select Time</option>
                <option value="Day (6:00 AM to 5:00 PM)">Day (6:00 AM to 5:00 PM)</option>
                <option value="Night (6:00 PM to 5:00 AM)">Night (6:00 PM to 5:00 AM)</option>
            </select>

            <label>Price (₱):</label>
            <select name="price" id="price" required>
                <option disabled selected value="">Select Price</option>
                <option value="<?php echo $manage_data['day_price']; ?>" data-time="Day">Day
                    ₱<?php echo $manage_data['day_price']; ?></option>
                <option value="<?php echo $manage_data['night_price']; ?>" data-time="Night">Night
                    ₱<?php echo $manage_data['night_price']; ?></option>
            </select>

            <style>
                .ui-datepicker {
                    font-size: 1.5em;
                    width: 350px;
                }

                .reserved-date {
                    background-color: var(--fifth-color) !important;
                    cursor: pointer;
                }

                .past-date {
                    background-color: #e0e0e0 !important;
                    color: #999 !important;
                    cursor: not-allowed;
                }
            </style>

            <script>
                $(function() {
                    // Get reserved dates and times from PHP
                    var disabledDatesTimes = <?php echo $disabled_dates_times; ?>;

                    // Get today's date
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);

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
                            if (disabledDatesTimes[dateString]) {
                                return [true, 'reserved-date', 'This date is partially reserved. Check time options.'];
                            }

                            return [true, '', ''];
                        },
                        onSelect: function(dateText, inst) {
                            var selectedDate = new Date(dateText);
                            selectedDate.setHours(0, 0, 0, 0);

                            // Check if the selected date is in the past
                            if (selectedDate < today) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'You cannot travel back in time!'
                                });
                                $('#date_of_arrival').val('');
                                return;
                            }

                            // Check for reserved times on the selected date
                            if (disabledDatesTimes[dateText]) {
                                var reservedTimes = disabledDatesTimes[dateText];
                                var isDayReserved = reservedTimes.indexOf('Day (6:00 AM to 5:00 PM)') !== -1;
                                var isNightReserved = reservedTimes.indexOf('Night (6:00 PM to 5:00 AM)') !== -1;

                                // If both Day and Night are reserved, show a message and reset the fields
                                if (isDayReserved && isNightReserved) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Fully Reserved',
                                        text: 'Both day and night are reserved on this date. Please select another date.'
                                    });
                                    $('#date_of_arrival').val('');
                                    return;
                                }

                                // Disable the reserved times
                                $('#check_in_time').find('option').each(function() {
                                    if (reservedTimes.indexOf($(this).val()) !== -1) {
                                        $(this).prop('disabled', true);
                                    } else {
                                        $(this).prop('disabled', false);
                                    }
                                });

                                // Disable corresponding price options based on reserved times
                                $('#price').find('option').each(function() {
                                    if (isDayReserved && $(this).data('time') === 'Day') {
                                        $(this).prop('disabled', true);
                                    }
                                    if (isNightReserved && $(this).data('time') === 'Night') {
                                        $(this).prop('disabled', true);
                                    }
                                });

                                Swal.fire({
                                    icon: 'info',
                                    title: 'Partial Reservation',
                                    text: 'Some times on this date are reserved. Please select an available time.'
                                });
                            } else {
                                // If no time is reserved, enable both options
                                $('#check_in_time').find('option').prop('disabled', false);
                                $('#price').find('option').prop('disabled', false);
                            }

                            // Reset the time and price fields
                            $('#check_in_time').val('');
                            $('#price').val('');
                        }
                    });
                });

                // Handle time selection to update price
                document.getElementById("check_in_time").addEventListener("change", function() {
                    var checkInTime = document.getElementById("check_in_time");
                    var price = document.getElementById("price");

                    if (checkInTime.value === "Day (6:00 AM to 5:00 PM)") {
                        price.value = "<?php echo $manage_data['day_price']; ?>";
                    } else if (checkInTime.value === "Night (6:00 PM to 5:00 AM)") {
                        price.value = "<?php echo $manage_data['night_price']; ?>";
                    }
                });

                // Ensure price selection syncs with time selection
                document.getElementById("price").addEventListener("change", function() {
                    var price = document.getElementById("price");
                    var checkInTime = document.getElementById("check_in_time");

                    if (price.value === "<?php echo $manage_data['day_price']; ?>") {
                        checkInTime.value = "Day (6:00 AM to 5:00 PM)";
                    } else if (price.value === "<?php echo $manage_data['night_price']; ?>") {
                        checkInTime.value = "Night (6:00 PM to 5:00 AM)";
                    }
                });
            </script>





            <!-- <p id="comment"> (fixed) Good for 22 hours, start time 2:00PM - 11:00AM</p> -->



            <label class="bold-text">Cottage Details</label>


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

            <!-- Terms and Conditions checkbox -->
            <label class="checkbox-label">
                <input type="checkbox" id="termsCheckbox" name="termsCheckbox" required>
                I agree to the <a href="termsAndCondition.php" target="_blank" style="color:blue;">Terms and Conditions.</a>
            </label>

            <style>
                .checkbox-label {
                    font-size: 2rem;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                /* Style the checkbox itself */
                input[type="checkbox"] {
                    width: 18px;
                    /* Adjust the size */
                    height: 18px;
                    background-color: #fff;
                    /* Background color */
                    border: 2px solid #333;
                    /* Border around checkbox */
                    border-radius: 4px;
                    /* Rounded corners */
                    cursor: pointer;
                    /* Show a pointer cursor on hover */
                }


                input[type="checkbox"]:checked {
                    background-color: blue;
                    /* Change background color when checked */
                    border-color: #388e3c;
                    /* Change border color */
                }
            </style>

            <p id="note">
                <b>Note:</b> Please kindly provide all the necessary information required for your reservation.
                Once you have submitted your reservation, please await confirmation. During the review of your
                submitted data, we will be in contact with you.
            </p>






            <div class="reservationForm-buttons">
                <button class="submit-btn" name="submit" type="submit" onclick="return checkTermsAndConditions()">Submit</button>

                <a href="reservationCottage.php" class="cancel-btn">Cancel</a>
            </div>
        </form>

        <script>
            function checkTermsAndConditions() {
                var termsCheckbox = document.getElementById("termsCheckbox");
                if (!termsCheckbox.checked) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Terms & Conditions',
                        text: 'Please agree to the Terms and Conditions before submitting the form.'
                    });
                    return false; // Prevent form submission
                }

                return true; // Allow form submission if checked
            }
        </script>



    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>