<?php
include('db_connect.php');
session_start();




if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

$message = "";
$isSuccess = false;



if (isset($_POST['checkOut'])) {
    $reserve_id = $_POST['reserve_id'];
    $update_query = "UPDATE reserve_room_tbl SET status='checkedOut' WHERE reserve_id='$reserve_id'";

    $query = (mysqli_query($con, $update_query));

    if ($query) {
        $message = "Checked out Successfully!";
        $isSuccess = true;
    } else {
        $message = "Failed!";
        $isSuccess = false;
    }
}


if (isset($_POST['extended'])) {

    $reserve_id = $_POST['reserve_id'];
    $extendedTime = $_POST['extended_time'];
    $extendedPrice = $_POST['extended_price'];
    $additionalPayment = $_POST['additional_payment'];
    $time_out = $_POST['time_out'];

    $update_query = "UPDATE reserve_room_tbl SET  status = 'extended', extend_time='$extendedTime',
     extend_price='$extendedPrice', additional_payment='$additionalPayment',
      time_out='$time_out'  WHERE reserve_id='$reserve_id'";


    $manage_data = [
        'reserve_id' => '',
        'fname' => '',
        'mname' => '',
        'lname' => '',
        'address' => '',
        'phone_number' => '',
        'email' => '',
        'date_of_arrival' => '',
        'time_of_arrival' => '',
        'room_number' => '',
        'room_type' => '',
        'bed_type' => '',
        'bed_quantity' => '',
        'number_of_person' => '',
        'amenities' => '',
        'price' => '',
        'special_request' => '',
        'reservation_fee' => '',
        'reservation_type' => '',
        'photo' => '',
        'extra_bed' => '',
        'extra_person' => '',
        'total_fee' => '',
        'time_out' => ''
    ];


    $query = (mysqli_query($con, $update_query));

    if ($query) {
        $message = "Extended Successfully!";
        $isSuccess = true;
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


    <title>Checked In</title>

    <script src="javascripts/add_room.js" defer></script>
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/allReservationRoomAndCottage.css?v=<?php echo time(); ?>">
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

                    <div class="item"><a href="dashboardRoomReservation.php"><i class="fa-regular fa-circle-left"></i>
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

                    <label for=""><i class="fa-solid fa-gear"></i> Checked-In Reservation</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">




                <div class="container">
                    <div class="header-label">
                        <label for="">CHECKED IN</label>
                    </div>


                    <form method="post" action="" class="form-container">

                        <div class="info-container">


                            <div class="image-container">
                                <div class="image-holder">
                                    <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                                </div>
                            </div>

                            <div class="header-label2">
                                <label>CUSTOMER AND RESERVATION INFO</label>
                            </div>

                            <div class="line">
                                <div>
                                    <label>Reservation ID</label><br>
                                    <input value="<?php echo $manage_data['reserve_id']; ?>">
                                </div>
                            </div>




                            <div class="line">
                                <div>
                                    <label>First Name</label><br>
                                    <input name="first_name" value="<?php echo $manage_data['fname']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Middle Name</label><br>
                                    <input name="middle_name" value="<?php echo $manage_data['mname']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Last Name</label><br>
                                    <input name="last_name" value="<?php echo $manage_data['lname']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Address</label><br>
                                    <input name="address" value="<?php echo $manage_data['address']; ?>" disabled>
                                </div>
                            </div>
                            <div class="line">
                                <div>
                                    <label>Phone Number</label><br>
                                    <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>"
                                        disabled>
                                </div>
                                <div>
                                    <label>Email</label><br>
                                    <input class="notransform" name="email" value="<?php echo $manage_data['email']; ?>"
                                        disabled>
                                </div>
                                <div>
                                    <label>Room Type</label><br>
                                    <input name="room_type" value="<?php echo $manage_data['room_type']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Bed Type</label><br>
                                    <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>"
                                        disabled>
                                </div>

                            </div>
                            <div class="line">
                                <div>
                                    <label>No. Bed</label><br>
                                    <input type="number" name="bed_quantity"
                                        value="<?php echo $manage_data['bed_quantity']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Number of Persons</label><br>
                                    <input type="number" name="number_of_person"
                                        value="<?php echo $manage_data['number_of_person']; ?>" disabled>
                                </div>

                                <div>
                                    <label>Amenities</label><br>
                                    <input name="amenities" value="<?php echo $manage_data['amenities']; ?>" disabled>
                                </div>

                                <div>
                                    <label>Price (₱) <em id="goodfor">*good for 22 hours*</em></label><br>
                                    <input type="number" name="price" value="<?php echo $manage_data['price']; ?>"
                                        disabled>
                                </div>


                            </div>


                            <div class="line">
                                <div>
                                    <label>Room Number</label><br>
                                    <input type="number" class="notransform" name="room_number"
                                        value="<?php echo $manage_data['room_number']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Arrival Date</label><br>
                                    <input type="date" class="notransform" name="date_of_arrival"
                                        value="<?php echo $manage_data['date_of_arrival']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Check-in Time</label><br>
                                    <input type="time" name="time_of_arrival"
                                        value="<?php echo $manage_data['time_of_arrival']; ?>" disabled>
                                </div>

                                <div>
                                    <label>Check-out Time</label><br>
                                    <input type="time" name="time_out" value="<?php echo $manage_data['time_out']; ?>">
                                </div>

                            </div>

                            <div class="line">
                                <div>
                                    <label>Type of Reservation</label><br>
                                    <input type="text" class="notransform" name="reservation_type"
                                        value="<?php echo $manage_data['reservation_type']; ?>" disabled>
                                </div>
                            </div>

                            <div class="line">
                                <div>
                                    <label>Special Request</label><br>
                                    <textarea name="special_request" id=""
                                        disabled><?php echo $manage_data['special_request']; ?></textarea>
                                </div>
                            </div>




                            <div class="line">
                                <div>
                                    <label>Reference Number:</label><br>
                                    <input type="number" value="<?php echo $manage_data['reference_number']; ?>" readonly>
                                </div>

                                <div>
                                    <label>Reservation Payment (Paid)</label><br>
                                    <input type="number" class="notransform" name="reservation_fee"
                                        value="<?php echo $manage_data['reservation_fee']; ?>" disabled>
                                </div>

                                <div>
                                    <label> Reserved Extra Bed And Person <em id="goodfor">*record only*</em></label><br>
                                    <input type="number" class="notransform" name="extra_bed_and_person" value="<?php echo $manage_data['extra_bed_and_person']; ?>" readonly>
                                </div>
                                <div>
                                    <label>Total Fee(₱) <em id="goodfor">*Paid*</em></label><br>
                                    <input type="number" name="total_fee"
                                        value="<?php echo $manage_data['total_fee']; ?>" disabled>
                                </div>



                            </div>

                            <div class="line">
                                <div>
                                    <label>Payment (₱) <em id="goodfor">*record only*</em></label><br>
                                    <input type="number" name="payment" value="<?php echo $manage_data['payment']; ?>" required readonly>
                                </div>

                                <div>
                                    <label>Balance (₱) <em id="goodfor">*Paid*</em></label><br>
                                    <input type="number" name="balance" value="<?php echo $manage_data['balance']; ?>" required readonly>

                                </div>
                            </div>



                            <div class="note">
                                <p>
                                    <b>Note:</b> Once the customer is checked in, they have the option to extend their
                                    stay by
                                    paying an additional fee. Please use the input fields below to record the
                                    transaction for
                                    their extended stay. We appreciate your cooperation and look forward to providing an
                                    exceptional experience throughout their extended stay.
                                </p>
                            </div>


                            <div class="line">
                                <div class="header-label2">
                                    <label>EXTEND SECTION</label>
                                </div>
                            </div>

                            <div class="payment-container">



                                <div class="line">

                                    <div>
                                        <label>Extended Time (hrs) <em id="goodfor">*if applicable*</em></label><br>
                                        <input type="number" class="notransform" name="extended_time" min="0" value="0">
                                    </div>

                                    <div>
                                        <label>Price per Hour (₱) <em id="goodfor">*by management*</em></label><br>
                                        <input type="number" class="notransform" name="extended_price" min="0" value="0">
                                    </div>

                                    <div>
                                        <label>Additional Payment (₱) <em id="goodfor">*if applicable*</em></label><br>
                                        <input type="number" class="notransform" name="additional_payment" value="0">
                                    </div>

                                </div>

                                <div style="display:flex; align-items:center; justify-content:center; margin: 20px 0; gap: 10px; font-size:1.2rem">
                                    <input type="checkbox" id="confirmationCheckbox" required>
                                    <label for="confirmationCheckbox"> I confirm that the additional payment is paid</label>

                                </div>
                                <script>
                                    // Handle form submission
                                    document.querySelector('form').addEventListener('submit', function(event) {
                                        const checkbox = document.getElementById('confirmationCheckbox');

                                        // Prevent form submission if checkbox is not checked
                                        if (!checkbox.checked) {
                                            event.preventDefault();
                                            alert('Please confirm that the balance is paid by checking the box.');
                                        }
                                    });
                                </script>

                                <div class="note">
                                    <p>
                                        <b>Tips:</b> If there is an error in the calculation, please refresh the page and
                                        try
                                        again. We apologize for any inconvenience caused and appreciate your patience.


                                    </p>
                                </div>


                                <script>
                                    // Function to debounce the input
                                    function debounce(func, wait) {
                                        let timeout;
                                        return function executedFunction(...args) {
                                            const later = () => {
                                                clearTimeout(timeout);
                                                func(...args);
                                            };
                                            clearTimeout(timeout);
                                            timeout = setTimeout(later, wait);
                                        };
                                    }

                                    // Function to calculate additional payment based on extended time and price per hour
                                    function calculateAdditionalPayment() {
                                        // Get the input values
                                        const extendedTime = parseInt(document.querySelector('input[name="extended_time"]').value);
                                        const extendedPrice = parseInt(document.querySelector('input[name="extended_price"]').value);

                                        // Calculate the additional payment
                                        const additionalPayment = extendedTime * extendedPrice;

                                        // Set the value of the "Additional Payment" input field
                                        document.querySelector('input[name="additional_payment"]').value = additionalPayment;
                                    }

                                    // Function to update check-out time based on extended time
                                    function updateCheckOutTime() {
                                        // Get the input values
                                        const extendedTime = parseInt(document.querySelector('input[name="extended_time"]').value);
                                        const timeOutInput = document.querySelector('input[name="time_out"]');

                                        // Get the current time out value
                                        let currentTimeOut = timeOutInput.value;

                                        // Calculate the new check-out time
                                        let timeOutHours = parseInt(currentTimeOut.split(":")[0]);
                                        let timeOutMinutes = parseInt(currentTimeOut.split(":")[1]);
                                        let newTimeOutHours = timeOutHours + extendedTime;

                                        // Adjust hours and minutes
                                        if (newTimeOutHours >= 24) {
                                            newTimeOutHours -= 24;
                                        }

                                        // Format new check-out time
                                        let newTimeOutFormatted = (newTimeOutHours < 10 ? "0" : "") + newTimeOutHours + ":" + (timeOutMinutes < 10 ? "0" : "") + timeOutMinutes;

                                        // Update the check-out time input field
                                        timeOutInput.value = newTimeOutFormatted;
                                    }

                                    // Debounce the functions for calculating additional payment and updating check-out time
                                    const debouncedCalculateAdditionalPayment = debounce(calculateAdditionalPayment, 300);
                                    const debouncedUpdateCheckOutTime = debounce(updateCheckOutTime, 300);

                                    // Listen for input events on Extended Time field with debounce
                                    document.querySelector('input[name="extended_time"]').addEventListener('input', () => {
                                        debouncedCalculateAdditionalPayment();
                                        debouncedUpdateCheckOutTime();
                                    });

                                    // Listen for input events on Extended Price field with debounce
                                    document.querySelector('input[name="extended_price"]').addEventListener('input', () => {
                                        debouncedCalculateAdditionalPayment();
                                    });
                                </script>


                            </div>



                            <div class="invisible-id">
                                <div>
                                    <label>id</label><br>
                                    <input type="number" name="reserve_id"
                                        value="<?php echo $manage_data['reserve_id']; ?>">
                                </div>
                            </div>
                        </div>


                </div>






                <div class="button-holder">
                    <!-- Extend Button -->
                    <button class="check-btn" type="submit" name="extended" id="extendBtn"><i class="fa-solid fa-check-to-slot"></i> Extend</button>

                    <script>
                        // Function to check the additional payment
                        document.getElementById('extendBtn').addEventListener('click', function(event) {
                            // Get the value of additional payment
                            const additionalPayment = parseFloat(document.querySelector('input[name="additional_payment"]').value) || 0;

                            // If additional payment is 0, show SweetAlert message and prevent form submission
                            if (additionalPayment === 0) {
                                event.preventDefault(); // Prevent form submission
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'No Additional Payment',
                                    text: 'Please enter an additional payment to extend the stay.',
                                });
                            }
                        });
                    </script>


                    <button class="reject-btn" type="submit" name="checkOut"><i class="fa-solid fa-check-to-slot"></i>
                        Check Out</button>

                </div>

                </form>
            </div>






            </div>
            <!-- end of content-container -->















        </section>

    </main>



</body>

</html>



<!-- for confirm -->
<?php if (!empty($message)): ?>
    <script>
        Swal.fire({
            title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
            text: '<?php echo $message; ?>',
            icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
            showConfirmButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'dashboardRoomReservation.php';
            }
        });
    </script>
<?php endif; ?>