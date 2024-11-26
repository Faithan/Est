<?php
include('db_connect.php');
session_start();



$manage_data = ['reserve_id' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'price' => '', 'special_request' => '', 'reservation_type' => '', 'photo' => ''];

$message = "";
$isSuccess = false;


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

if (isset($_POST['confirm'])) {
    $reserve_id = $_POST['reserve_id'];
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time_of_arrival = $_POST['time_of_arrival'];
    $checkOutTime = $_POST['time_out'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $special_request = $_POST['special_request'];
    $reservation_fee = $_POST['reservation_fee'];
    $extraBedAndPerson = $_POST['extra_bed_and_person'];

    $totalFee = $_POST['total_fee'];

    $update_query = "UPDATE reserve_room_tbl SET status='confirmed', fname='$fname', mname='$mname', lname='$lname', address='$address', phone_number='$phone_number', email='$email', date_of_arrival='$date_of_arrival', time_of_arrival='$time_of_arrival', time_out='$checkOutTime',
    room_number='$room_number', room_type='$room_type', bed_type='$bed_type', bed_quantity='$bed_quantity',
    number_of_person='$number_of_person', amenities='$amenities' , price='$price', 
    special_request='$special_request', reservation_fee='$reservation_fee' , extra_bed_and_person='$extraBedAndPerson' , 
    total_fee='$totalFee'  WHERE reserve_id='$reserve_id'";

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
        'reservation_type' => '',
        'photo' => ''
    ];


    $query = (mysqli_query($con, $update_query));

    if ($query) {
        $message = "Changes Saved Successfully!";
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


    <title>Pendings</title>

    <script src="javascripts/totalFee.js" defer></script>
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

                    <div class="item"><a href="dashboardRoomReservation.php"><i class="fa-regular fa-circle-left"></i> Return</a>
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

                    <label for=""><i class="fa-solid fa-gear"></i> Pending Reservation</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">





                <div class="container">
                    <div class="header-label">
                        <label for="">PENDING</label>
                    </div>


                    <form method="post" action="" class="form-container">

                        <div class="info-container">


                            <div class="image-container">

                                <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">

                            </div>

                            <div class="header-label2">
                                <label>CUSTOMER AND RESERVATION INFO</label>
                            </div>


                            <div class="line">
                                <div>
                                    <label>Reservation ID</label><br>
                                    <input value="<?php echo $manage_data['reserve_id']; ?>" readonly>
                                </div>
                            </div>



                            <div class="line">
                                <div>
                                    <label>First Name</label><br>
                                    <input name="first_name" value="<?php echo $manage_data['fname']; ?>">
                                </div>
                                <div>
                                    <label>Middle Name</label><br>
                                    <input name="middle_name" value="<?php echo $manage_data['mname']; ?>">
                                </div>
                                <div>
                                    <label>Last Name</label><br>
                                    <input name="last_name" value="<?php echo $manage_data['lname']; ?>">
                                </div>
                                <div>
                                    <label>Address</label><br>
                                    <input name="address" value="<?php echo $manage_data['address']; ?>">
                                </div>
                            </div>
                            <div class="line">
                                <div>
                                    <label>Phone Number</label><br>
                                    <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>">
                                </div>
                                <div>
                                    <label>Email</label><br>
                                    <input class="notransform" name="email"
                                        value="<?php echo $manage_data['email']; ?>">
                                </div>
                                <div>
                                    <label>Room Type</label><br>
                                    <input name="room_type" value="<?php echo $manage_data['room_type']; ?>">
                                </div>
                                <div>
                                    <label>Bed Type</label><br>
                                    <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>">
                                </div>

                            </div>
                            <div class="line">
                                <div>
                                    <label>No. Bed</label><br>
                                    <input type="number" name="bed_quantity"
                                        value="<?php echo $manage_data['bed_quantity']; ?>">
                                </div>
                                <div>
                                    <label>Number of Persons</label><br>
                                    <input type="number" name="number_of_person"
                                        value="<?php echo $manage_data['number_of_person']; ?>">
                                </div>

                                <div>
                                    <label>Amenities</label><br>
                                    <input name="amenities" value="<?php echo $manage_data['amenities']; ?>">
                                </div>

                                <div>
                                    <label>Price (₱) <em id="goodfor">*good for 22 hours*</em></label><br>
                                    <input type="number" name="price" value="<?php echo $manage_data['price']; ?>">
                                </div>


                            </div>


                            <div class="line">
                                <div>
                                    <label>Room Number</label><br>
                                    <input type="number" class="notransform" name="room_number"
                                        value="<?php echo $manage_data['room_number']; ?>">
                                </div>
                                <div>
                                    <label>Arrival Date</label><br>
                                    <input type="date" class="notransform" name="date_of_arrival"
                                        value="<?php echo $manage_data['date_of_arrival']; ?>">
                                </div>
                                <div>
                                    <label>Check-in Time</label><br>
                                    <input type="time" name="time_of_arrival"
                                        value="<?php echo $manage_data['time_of_arrival']; ?>">
                                </div>

                                <div>
                                    <label>Check-out Time</label><br>
                                    <input type="time" name="time_out" value="11:00" required>
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
                                    <textarea name="special_request"
                                        id=""><?php echo $manage_data['special_request']; ?></textarea>
                                </div>
                            </div>


                            <div class="note">
                                <p>
                                    <b>Note:</b> Please note that the input fields are intentionally left open for any
                                    necessary modifications or changes to customer and reservation information. We
                                    understand that there may be updates or adjustments to be provided by the customer
                                    during the confirmation of their reservation. Also, the customer is welcome to request additional beds or
                                    accommodate more people. We strive to ensure a seamless and comfortable experience for our guests throughout their stay. Rest assured, we are committed to
                                    accommodating any necessary revisions to ensure a seamless and satisfactory
                                    experience.

                                </p>
                            </div>


                            <div class="line">
                                <div>
                                    <label>Extra Bed And Person (+₱600)<em id="goodfor">*If Applicable*</em></label><br>
                                    <input type="number" class="notransform" name="extra_bed_and_person" value="0">
                                </div>



                                <div>
                                    <label>Total Fee (₱)</label><br>
                                    <input type="number" name="total_fee" value="" readonly>
                                </div>

                            </div>


                            <script>
                                function calculateTotalFee() {
                                    // Get the input values
                                    const extraBedAndPerson = parseInt(document.querySelector('input[name="extra_bed_and_person"]').value);

                                    const price = parseInt(document.querySelector('input[name="price"]').value);

                                    // Calculate the additional charges
                                    const extraBedAndPersonCharge = extraBedAndPerson * 600;


                                    // Calculate the total fee
                                    const totalFee = price + extraBedAndPersonCharge;

                                    // Set the value of the "Total Fee" input field
                                    document.querySelector('input[name="total_fee"]').value = totalFee;
                                }

                                // Call calculateTotalFee once when the page loads to display the initial total fee
                                calculateTotalFee();

                                // Listen for input and change events on Extra Bed, Extra Person, and Price fields
                                document.querySelectorAll('input[name="extra_bed_and_person"], input[name="rate_per_hour"]').forEach(input => {
                                    input.addEventListener('input', calculateTotalFee);
                                    input.addEventListener('change', calculateTotalFee);
                                });
                            </script>



                            <div class="header-label2">
                                <label>RESERVATION ADVANCE PAYMENT</label>
                            </div>

                            <div class="payment-container">

                                <div class="line">

                                    <div>
                                        <label>Reference Number:</label><br>
                                        <input type="number" name="reservation_fee" value="<?php echo $manage_data['reference_number']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Reservation Fee</label><br>
                                        <input type="number" name="reservation_fee" required>
                                    </div>

                                </div>

                                <div class="invisible-id">
                                    <div>
                                        <label>id</label><br>
                                        <input type="number" name="reserve_id"
                                            value="<?php echo $manage_data['reserve_id']; ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- reason for rejection -->
                            <br>
                            <div>
                                <div class="line">
                                    <div>
                                        <label style="color: red;">Reason for Rejection <em id="goodfor">*If
                                                rejected*</em></label><br>
                                        <textarea name="rejection_reason" id=""></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>






                        <div class="button-holder">
                            <button class="check-btn" type="submit" name="confirm"><i
                                    class="fa-solid fa-check-to-slot"></i>
                                Confirm</button>
                            <a class="reject-btn" id="reject-btn" name="reject" onclick="confirmReject()"><i
                                    class="fa-solid fa-trash"></i>
                                Reject</a>
                        </div>
                    </form>
                </div>







            </div>
            <!-- end of center content -->




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


<!-- for reject -->
<script>
    function confirmReject() {
        Swal.fire({
            title: 'Reject Confirmation',
            text: 'Are you sure you want to reject this reservation?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                var rejection_reason = document.querySelector('textarea[name="rejection_reason"]').value;
                rejectItem(rejection_reason);
            }
        });
    }

    function rejectItem(rejection_reason) {
        var reserve_id = document.querySelector('input[name="reserve_id"]').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'room_reject.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    if (xhr.responseText === 'success') {
                        Swal.fire({
                            title: 'Rejected Successfully',
                            text: 'Reservation rejected successfully.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'dashboardRoomReservation.php'; // Replace with your desired page after rejection
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to reject this reservation.',
                            icon: 'error'
                        });
                    }
                }
            }
        };
        xhr.send('reserve_id=' + reserve_id + '&rejection_reason=' + rejection_reason);
    }
</script>