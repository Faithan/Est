<?php
include('db_connect.php');
session_start();



$manage_data = ['reserve_id' => '', 'fname' => '', 'mname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'price' => '', 'special_request' => '', 'photo' => ''];


$message = "";
$isSuccess = false;


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

if (isset($_POST['checkedin'])) {

    $reserve_id = $_POST['reserve_id'];

    $rejection_reason = $_POST['rejection_reason'];

    $totalFee = $_POST['total_fee'];

    $payment = $_POST['payment'];
    $balance = $_POST['balance'];



    $update_query = "UPDATE reserve_room_tbl SET status='checkedIn', rejection_reason='$rejection_reason', payment='$payment', balance='$balance', total_fee='$totalFee'  WHERE reserve_id='$reserve_id'";

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


    <title>Confirmed</title>

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

                    <label for=""><i class="fa-solid fa-gear"></i> Confirmed Reservation</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">




                <div class="container">
                    <div class="header-label">
                        <label for="">CONFIRMED</label>
                    </div>


                    <form method="post" action="" class="form-container">

                        <div class="image-container">
                            <div class="image-holder">
                                <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                            </div>
                        </div>


                        <div class="info-container">
                            <div class="header-label2">
                                <label>CUSTOMER AND RESERVATION INFO</label>
                            </div>

                            <div class="line">
                                <div>
                                    <label>Reservation ID</label><br>
                                    <input value="<?php echo $manage_data['reserve_id']; ?>" readonly>
                                </div>
                            </div>


                            <div>
                                <!-- hidden id -->
                                <input type="hidden" name="reserve_id"
                                    value="<?php echo $manage_data['reserve_id']; ?>">

                                <div class="line">
                                    <div>
                                        <label>First Name</label><br>
                                        <input name="first_name" value="<?php echo $manage_data['fname']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Middle Name</label><br>
                                        <input name="middle_name" value="<?php echo $manage_data['mname']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Last Name</label><br>
                                        <input name="last_name" value="<?php echo $manage_data['lname']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Address</label><br>
                                        <input name="address" value="<?php echo $manage_data['address']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="line">
                                    <div>
                                        <label>Phone Number</label><br>
                                        <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>"
                                            readonly>
                                    </div>
                                    <div>
                                        <label>Email</label><br>
                                        <input class="notransform" name="email"
                                            value="<?php echo $manage_data['email']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Room Type</label><br>
                                        <input name="room_type" value="<?php echo $manage_data['room_type']; ?>"
                                            readonly>
                                    </div>
                                    <div>
                                        <label>Bed Type</label><br>
                                        <input type="text" name="bed_type"
                                            value="<?php echo $manage_data['bed_type']; ?>" readonly>
                                    </div>

                                </div>
                                <div class="line">
                                    <div>
                                        <label>No. Bed</label><br>
                                        <input type="number" name="bed_quantity"
                                            value="<?php echo $manage_data['bed_quantity']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Number of Persons</label><br>
                                        <input type="number" name="number_of_person"
                                            value="<?php echo $manage_data['number_of_person']; ?>" readonly>
                                    </div>

                                    <div>
                                        <label>Amenities</label><br>
                                        <input name="amenities" value="<?php echo $manage_data['amenities']; ?>"
                                            readonly>
                                    </div>

                                    <div>
                                        <label>Price (₱) <em id="goodfor">*good for 22 hours*</em></label><br>
                                        <input type="number" name="price" value="<?php echo $manage_data['price']; ?>"
                                            readonly>
                                    </div>


                                </div>


                                <div class="line">
                                    <div>
                                        <label>Room Number</label><br>
                                        <input type="number" class="notransform" name="room_number"
                                            value="<?php echo $manage_data['room_number']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Arrival Date</label><br>
                                        <input type="date" class="notransform" name="date_of_arrival"
                                            value="<?php echo $manage_data['date_of_arrival']; ?>" readonly>
                                    </div>
                                    <div>
                                        <label>Check-in Time</label><br>
                                        <input type="time" name="time_of_arrival"
                                            value="<?php echo $manage_data['time_of_arrival']; ?>" readonly>
                                    </div>

                                    <div>
                                        <label>Check-out Time</label><br>
                                        <input type="time" name="time_out" value="11:00" required readonly>
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
                                            readonly><?php echo $manage_data['special_request']; ?></textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="note">
                                <p>
                                    <b>Note:</b> Once the customer has arrived at the hotel, this form will be marked as
                                    "checked in." Please note that any modifications to the customer's information above
                                    are no
                                    longer allowed.

                                </p>
                            </div>

                            <div class="header-label2">
                                <label>PAYMENT</label>
                            </div>
                            <div class="payment-container">

                                <div class="line">
                                    <div>
                                        <label>Reference Number:</label><br>
                                        <input type="number" value="<?php echo $manage_data['reference_number']; ?>" readonly>
                                    </div>

                                    <div>
                                        <label>Reservation Payment (Paid)</label><br>
                                        <input type="number" class="notransform" name="reservation_fee"
                                            value="<?php echo $manage_data['reservation_fee']; ?>" readonly>
                                    </div>

                                    <div>
                                        <label> Reserved Extra Bed And Person</label><br>
                                        <input type="number" class="notransform" name="extra_bed_and_person" value="<?php echo $manage_data['extra_bed_and_person']; ?>" readonly>
                                    </div>

                                    <div>
                                        <label>New Total Fee (₱)</label><br>
                                        <input type="number" name="total_fee" value="" required readonly>
                                    </div>

                                    <script>
                                        // Function to calculate total fee and deduct from reservation fee
                                        function calculateTotalFee() {
                                            // Get the input values
                                            const extraBedAndPerson = parseInt(document.querySelector('input[name="extra_bed_and_person"]').value);
                                            const price = parseInt(document.querySelector('input[name="price"]').value);
                                            const reservationFee = parseInt(document.querySelector('input[name="reservation_fee"]').value);

                                            // Calculate the additional charges
                                            const extraBedAndPersonCharge = extraBedAndPerson * 600;

                                            // Calculate the total fee
                                            const totalFee = price + extraBedAndPersonCharge;

                                            // Deduct the total fee from the reservation fee
                                            const remainingFee = totalFee - reservationFee;

                                            // Set the value of the "Total Fee" input field
                                            document.querySelector('input[name="total_fee"]').value = remainingFee;
                                        }

                                        // Call calculateTotalFee once when the page loads to calculate and deduct the total fee
                                        calculateTotalFee();

                                        // Listen for input and change events on Extra Bed, Extra Person, Price, and Reservation Fee fields
                                        document.querySelectorAll('input[name="extra_bed_and_person"], input[name="total_fee"], input[name="reservation_fee"]').forEach(input => {
                                            input.addEventListener('input', calculateTotalFee);
                                            input.addEventListener('change', calculateTotalFee);
                                        });
                                    </script>

                                </div>


                                <div class="line">
                                    <div>
                                        <label>Payment (₱)</label><br>
                                        <input type="number" name="payment" value="" min="0" required>
                                    </div>

                                    <script>
                                        // Function to validate the payment against the balance
                                        function validatePayment() {
                                            const paymentInput = document.querySelector('input[name="payment"]');
                                            const balance = parseFloat(document.querySelector('input[name="balance"]').value) || 0;
                                            let payment = parseFloat(paymentInput.value) || 0; // Default to 0 if empty

                                            // Ensure the payment is not less than the balance or greater than the balance
                                            if (payment < balance) {
                                                payment = balance; // Set payment to the balance if it's less
                                                Swal.fire({
                                                    icon: 'warning',
                                                    text: 'Payment cannot be less than or greater than the balance, we automatically input it for you.'
                                                });
                                            } else if (payment > balance) {
                                                payment = balance; // Set payment to the balance if it's greater
                                                Swal.fire({
                                                    icon: 'warning',
                                                    text: 'Payment cannot be less than or greater than the balance, we automatically input it for you.'
                                                });
                                            }

                                            // Update the payment input with the valid value
                                            paymentInput.value = payment;
                                        }

                                        // Listen for changes in the payment field and validate
                                        document.querySelector('input[name="payment"]').addEventListener('input', validatePayment);
                                    </script>


                                    <div>
                                        <label>Balance (₱)</label><br>
                                        <input type="number" name="balance" value="" required readonly>

                                    </div>

                                </div>

                                <div style="display:flex; align-items:center; justify-content:center; margin: 20px 0; gap: 10px; font-size:1.2rem">
                                    <input type="checkbox" id="confirmationCheckbox" required>
                                    <label for="confirmationCheckbox"> I confirm that the balance is paid</label>

                                </div>

                                
                                <script>
                                    // Handle form submission
                                    document.querySelector('form').addEventListener('submit', function(event) {
                                        const checkbox = document.getElementById('confirmationCheckbox');
                                        const balance = parseFloat(document.querySelector('input[name="balance"]').value) || 0;

                                        if (!checkbox.checked) {
                                            event.preventDefault();
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Confirmation Required',
                                                text: 'Please confirm that the balance is paid by checking the box.',
                                            });
                                        } else if (balance !== 0) {
                                            event.preventDefault();
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Balance Not Paid',
                                                text: 'Please ensure the balance is paid before proceeding.',
                                            });
                                        }
                                    });
                                </script>




                                <script>
                                    // Initialize balance to the value of total_fee
                                    function initializeBalance() {
                                        const totalFee = parseInt(document.querySelector('input[name="total_fee"]').value) || 0;
                                        document.querySelector('input[name="balance"]').value = totalFee;
                                    }

                                    // Update balance dynamically based on payment
                                    function updateBalance() {
                                        const totalFee = parseInt(document.querySelector('input[name="total_fee"]').value) || 0;
                                        const payment = parseInt(document.querySelector('input[name="payment"]').value) || 0;

                                        // Calculate balance
                                        const balance = Math.max(totalFee - payment, 0); // Prevent negative balance

                                        // Update balance field
                                        document.querySelector('input[name="balance"]').value = balance;
                                    }

                                    // Initialize balance on page load
                                    initializeBalance();

                                    // Attach event listener to payment input
                                    document.querySelector('input[name="payment"]').addEventListener('input', updateBalance);
                                </script>






                            </div>

                            <br>
                            <div>
                                <div class="line">
                                    <div>
                                        <label style="color: red;">Reason for Cancellation <em id="goodfor">*If
                                                cancelled*</em></label><br>
                                        <textarea name="rejection_reason" id=""></textarea>
                                    </div>
                                </div>
                            </div>




                        </div>





                        <div class="button-holder">
                            <button class="check-btn" type="submit" name="checkedin"><i
                                    class="fa-solid fa-check-to-slot"></i> Checked In</button>

                            <a class="reject-btn" id="reject-btn" name="reject" onclick="confirmReject()"><i
                                    class="fa-solid fa-trash"></i>
                                Cancel Reservation</a>
                        </div>
                    </form>
                </div>






            </div>
            <!-- end of content-container -->















        </section>

    </main>



</body>

</html>



<!-- for checkin -->
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


<!-- for cancel -->
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
        xhr.open('POST', 'cancel.php', true);
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
                            window.location.href = 'roomReservation.php'; // Replace with your desired page after rejection
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