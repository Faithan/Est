<?php
include('db_connect.php');
session_start();


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = $manage_id";
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
    $time = $_POST['time'];
    $price = $_POST['price'];
    $cottage_number = $_POST['cottage_number'];
    $cottage_type = $_POST['cottage_type'];
    $number_of_person = $_POST['number_of_person'];
    $special_request = $_POST['special_request'];
    $cottage_photo = $manage_data['cottage_photo'];


    $savedata = "INSERT INTO reserve_cottage_tbl  VALUES (
    '',
    'n/a', 
    'pending',
    'walk-in',
    '$fname',
    '$mname',
    '$lname',
    '$address',
    '$phone_number',
    '$email',
    '$date_of_arrival',
    '$time',
    '$price',
    '$cottage_number',
    '$cottage_type',
    '$number_of_person',
    '$special_request',
    '$cottage_photo',
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

    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <title>Walk-in Room Reservation</title>

    <script src="javascripts/add_room.js" defer></script>
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/walkInReservation.css?v=<?php echo time(); ?>">
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

                    <div class="item"><a href="add_reservation_cottage.php"><i class="fa-regular fa-circle-left"></i>
                            Return</a>
                    </div>



                </div>


            </div>

            <?php
            include 'logoutbtn.php'
                ?>


        </section>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">

                    <label for=""><i class="fa-solid fa-gear"></i> Walk-in Room Reservation</label>
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


























                <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                    <div class="head-label">
                        <label> ADD RESERVATION</label>
                    </div>


                    <div class="input-fields-container">

                        <div class="adding-photo-container">

                            <img name="cottage_photo"
                                src="<?php echo htmlspecialchars($manage_data['cottage_photo']); ?>" alt="">

                        </div>

                        <div class="input-fields">
                            <label for="room_type">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="input_fields" required>
                        </div>



                        <div class="input-fields">
                            <label for="room_type">Middle Name:</label>
                            <input type="text" name="middle_name" id="middle_name" class="input_fields" required>
                        </div>


                        <div class="input-fields">
                            <label for="room_type">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Adress:</label>
                            <input type="text" name="address" id="address" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Phone Number:</label>
                            <input type="number" name="phone_number" id="phone_number" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Email (optional):</label>
                            <input type="text" name="email" id="email" class="input_fields">
                        </div>

                        <?php
                        // Fetch reserved arrival dates and times for a specific cottage
                        $cottage_number = $manage_data['cottage_number'];
                        $query = "SELECT date_of_arrival, time FROM reserve_cottage_tbl WHERE cottage_number = ? AND reserve_status IN ('confirmed', 'checkedIn')";
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
                        <div class="input-fields">
                            <label>Arrival Date</label>
                            <input class="input4" id="date_of_arrival" type="text" name="date_of_arrival"
                                placeholder="Select date" required>
                        </div>

                        <div class="input-fields">
                            <label>Time:</label>
                            <select name="time" id="check_in_time" required>
                                <option disabled selected value="">Select Time</option>
                                <option value="Day (6:00 AM to 5:00 PM)">Day (6:00 AM to 5:00 PM)</option>
                                <option value="Night (6:00 PM to 5:00 AM)">Night (6:00 PM to 5:00 AM)</option>
                            </select>
                        </div>

                        <div class="input-fields">
                            <label>Price (₱):</label>
                            <select name="price" id="price" required>
                                <option disabled selected value="">Select Price</option>
                                <option value="<?php echo $manage_data['day_price']; ?>" data-time="Day">Day
                                    ₱<?php echo $manage_data['day_price']; ?></option>
                                <option value="<?php echo $manage_data['night_price']; ?>" data-time="Night">Night
                                    ₱<?php echo $manage_data['night_price']; ?></option>
                            </select>
                        </div>

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
                            $(function () {
                                // Get reserved dates and times from PHP
                                var disabledDatesTimes = <?php echo $disabled_dates_times; ?>;

                                // Get today's date
                                var today = new Date();
                                today.setHours(0, 0, 0, 0);

                                // Initialize the datepicker
                                $('#date_of_arrival').datepicker({
                                    dateFormat: 'yy-mm-dd',
                                    beforeShowDay: function (date) {
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
                                    onSelect: function (dateText, inst) {
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
                                            $('#check_in_time').find('option').each(function () {
                                                if (reservedTimes.indexOf($(this).val()) !== -1) {
                                                    $(this).prop('disabled', true);
                                                } else {
                                                    $(this).prop('disabled', false);
                                                }
                                            });

                                            // Disable corresponding price options based on reserved times
                                            $('#price').find('option').each(function () {
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
                            document.getElementById("check_in_time").addEventListener("change", function () {
                                var checkInTime = document.getElementById("check_in_time");
                                var price = document.getElementById("price");

                                if (checkInTime.value === "Day (6:00 AM to 5:00 PM)") {
                                    price.value = "<?php echo $manage_data['day_price']; ?>";
                                } else if (checkInTime.value === "Night (6:00 PM to 5:00 AM)") {
                                    price.value = "<?php echo $manage_data['night_price']; ?>";
                                }
                            });

                            // Ensure price selection syncs with time selection
                            document.getElementById("price").addEventListener("change", function () {
                                var price = document.getElementById("price");
                                var checkInTime = document.getElementById("check_in_time");

                                if (price.value === "<?php echo $manage_data['day_price']; ?>") {
                                    checkInTime.value = "Day (6:00 AM to 5:00 PM)";
                                } else if (price.value === "<?php echo $manage_data['night_price']; ?>") {
                                    checkInTime.value = "Night (6:00 PM to 5:00 AM)";
                                }
                            });
                        </script>








                        <div class="input-fields">
                            <label for="">Cottage Number:</label>
                            <input type="text" name="cottage_number" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['cottage_number']); ?>" readonly>
                        </div>


                        <div class="input-fields">
                            <label for="">Cottage Type:</label>
                            <input type="text" name="cottage_type" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['cottage_type']); ?>" readonly>
                        </div>




                        <div class="input-fields">
                            <label for="">Number of Persons:</label>
                            <input type="number" id="number_of_person" name="number_of_person"
                                class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['number_of_person']); ?>" readonly>
                        </div>

                        <div class="input-fields">
                            <label>Do you have any special request?</label>
                            <textarea name="special_request"></textarea>
                        </div>



                    </div>


                    <div class="button-container2">
                        <button type="submit" name="submit" class="button1"><i class="fa-solid fa-calendar-check"></i>
                            Book</button>
                    </div>



                </form>






                <?php if (!empty($message)): ?>
                    <script>
                        Swal.fire({
                            title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                            text: '<?php echo $message; ?>',
                            icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'dashboardCottageReservation.php'; // Change this to your desired page
                            }
                        });
                    </script>
                <?php endif; ?>






            </div>















        </section>

    </main>



</body>

</html>