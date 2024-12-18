<?php
include('db_connect.php');
session_start();

$manage_data = [
    'reserve_id' => '',
    'reserve_status' => '',
    'first_name' => '',
    'middle_name' => '',
    'last_name' => '',
    'reserve_address' => '',
    'phone_number' => '',
    'email' => '',
    'date_of_arrival' => '',
    'time' => '',
    'cottage_number' => '',
    'cottage_type' => '',
    'number_of_person' => '',
    'price' => '',
    'special_request' => '',
    'reserve_type' => '',
    'cottage_photo' => '',
    'cottage_reserve_fee' => ''
];

$message = "";
$isSuccess = false;

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_cottage_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

if (isset($_POST['confirm'])) {
    $reserve_id = $_POST['reserve_id'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];
    $balance = $_POST['balance'];

    $cottage_reserve_fee = $_POST['cottage_reserve_fee'];
    $rejection_reason = $_POST['rejection_reason'] ?? '';

    // Update query to match your data structure
    $update_query = "UPDATE reserve_cottage_tbl 
                     SET reserve_status='checkedIn', 
                        payment='$payment',
                        balance='$balance',
                        rejection_reason='$rejection_reason'
                     WHERE reserve_id='$reserve_id'";

    $manage_data = [
        'reserve_id' => '',
        'reserve_status' => '',
        'first_name' => '',
        'middle_name' => '',
        'last_name' => '',
        'reserve_address' => '',
        'phone_number' => '',
        'email' => '',
        'date_of_arrival' => '',
        'time' => '',
        'cottage_number' => '',
        'cottage_type' => '',
        'number_of_person' => '',
        'price' => '',
        'special_request' => '',
        'reserve_type' => '',
        'cottage_photo' => '',
        'cottage_reserve_fee' => ''
    ];


    $query = mysqli_query($con, $update_query);

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

                    <div class="item"><a href="dashboardCottageReservation.php"><i
                                class="fa-regular fa-circle-left"></i> Return</a>
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
                    <label for=""><i class="fa-solid fa-gear"></i> Confirmed Cottage Reservation</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">





                <div class="container">
                    <div class="header-label">
                        <label for="">Confirmed</label>
                    </div>


                    <form method="post" action="" class="form-container">

                        <div class="info-container">


                            <div class="image-container">



                                <img name="photo" src="<?php echo $manage_data['cottage_photo']; ?>" alt="">

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
                                    <input name="first_name" value="<?php echo $manage_data['first_name']; ?>">
                                </div>
                                <div>
                                    <label>Middle Name</label><br>
                                    <input name="middle_name" value="<?php echo $manage_data['middle_name']; ?>">
                                </div>
                                <div>
                                    <label>Last Name</label><br>
                                    <input name="last_name" value="<?php echo $manage_data['last_name']; ?>">
                                </div>
                                <div>
                                    <label>Address</label><br>
                                    <input name="reserve_address"
                                        value="<?php echo $manage_data['reserve_address']; ?>">
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
                                    <label>Date of Arrival</label><br>
                                    <input type="date" name="date_of_arrival"
                                        value="<?php echo $manage_data['date_of_arrival']; ?>">
                                </div>
                                <div>
                                    <label>Time</label><br>
                                    <input type="text" name="time" value="<?php echo $manage_data['time']; ?>">
                                </div>

                            </div>
                            <div class="line">
                                <div>
                                    <label>Price (₱)</label><br>
                                    <input type="number" name="price" value="<?php echo $manage_data['price']; ?>">
                                </div>
                                <div>
                                    <label>Cottage Number</label><br>
                                    <input type="number" name="cottage_number"
                                        value="<?php echo $manage_data['cottage_number']; ?>">
                                </div>

                                <div>
                                    <label>Cottage Type</label><br>
                                    <input name="cottage_type" value="<?php echo $manage_data['cottage_type']; ?>">
                                </div>

                                <div>
                                    <label>Number of Person</label><br>
                                    <input name="number_of_person"
                                        value="<?php echo $manage_data['number_of_person']; ?>">
                                </div>


                            </div>



                            <div class="line">
                                <div>
                                    <label>Type of Reservation</label><br>
                                    <input type="text" class="notransform" name="reserve_type"
                                        value="<?php echo $manage_data['reserve_type']; ?>" disabled>
                                </div>
                            </div>



                            <div class="line">
                                <div>
                                    <label>Special Request</label><br>
                                    <textarea name="special_request"
                                        id=""><?php echo $manage_data['special_request']; ?><?php echo $manage_data["special_request"] ?></textarea>
                                </div>
                            </div>

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
                                        <label>Reservation Fee (Paid)</label><br>
                                        <input type="number" name="cottage_reserve_fee"
                                            value="<?php echo $manage_data["cottage_reserve_fee"] ?>" required>
                                    </div>

                                </div>


                                <div class="line">
                                    <div>
                                        <label>Payment (₱)</label><br>
                                        <input type="number" name="payment" value="" min="0" required>
                                    </div>

                                    <div>
                                        <label>Balance (₱)</label><br>
                                        <input type="number" name="balance" value="" required readonly>
                                    </div>
                                </div>

                                <script>
                                    const paymentInput = document.querySelector('input[name="payment"]');
                                    const balanceInput = document.querySelector('input[name="balance"]');

                                    function validatePayment() {
                                        const payment = parseFloat(paymentInput.value) || 0;
                                        const balance = parseFloat(balanceInput.value) || 0;

                                        if (payment > balance) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Invalid Payment',
                                                text: 'Payment cannot exceed the balance.',
                                            });
                                            paymentInput.value = balance;
                                        } else if (payment < balance) {
                                            Swal.fire({
                                                icon: 'warning',
                                                text: 'Payment cannot be less than the balance, we automatically input it for you.',
                                            });
                                            paymentInput.value = balance;
                                        }
                                    }

                                    paymentInput.addEventListener('input', validatePayment);
                                </script>



                                <div style="display:flex; align-items:center; justify-content:center; margin: 20px 0; gap: 10px; font-size:1.2rem">
                                    <input type="checkbox" id="confirmationCheckbox">
                                    <label for="confirmationCheckbox"> I confirm that the balance is paid</label>

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



                                <script>
                                    // Initialize balance based on price and reservation fee
                                    function initializeBalance() {
                                        const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
                                        const cottageReserveFee = parseFloat(document.querySelector('input[name="cottage_reserve_fee"]').value) || 0;

                                        // Calculate balance as price - reservation fee
                                        const balance = Math.max(price - cottageReserveFee, 0); // Prevent negative balance

                                        // Set the balance value
                                        document.querySelector('input[name="balance"]').value = balance;
                                    }

                                    // Update balance dynamically based on payment
                                    function updateBalance() {
                                        const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
                                        const cottageReserveFee = parseFloat(document.querySelector('input[name="cottage_reserve_fee"]').value) || 0;
                                        const payment = parseFloat(document.querySelector('input[name="payment"]').value) || 0;

                                        // Calculate balance as price - reservation fee - payment
                                        const balance = Math.max(price - cottageReserveFee - payment, 0); // Prevent negative balance

                                        // Update balance field
                                        document.querySelector('input[name="balance"]').value = balance;
                                    }

                                    // Initialize balance on page load
                                    initializeBalance();

                                    // Attach event listener to payment input
                                    document.querySelector('input[name="payment"]').addEventListener('input', updateBalance);
                                </script>


                                <div class="invisible-id">
                                    <div>
                                        <label>id</label><br>
                                        <input type="number" name="reserve_id"
                                            value="<?php echo $manage_data['reserve_id']; ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="note">
                                <p>
                                    <b>Note:</b> Please note that the input fields are intentionally left open for any
                                    necessary modifications or changes to customer and reservation information. We
                                    understand that there may be updates or adjustments to be provided by the customer
                                    during the confirmation of their reservation. Rest assured, we are committed to
                                    accommodating any necessary revisions to ensure a seamless and satisfactory
                                    experience.

                                </p>
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



                        <script>
                            // Handle form submission
                            document.querySelector('form').addEventListener('submit', function(event) {
                                const checkbox = document.getElementById('confirmationCheckbox');
                                const balance = parseFloat(document.querySelector('input[name="balance"]').value) || 0;

                                // Prevent form submission if checkbox is not checked or if balance is not 0
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


                        <div class="button-holder">
                            <button class="check-btn" type="submit" name="confirm"><i
                                    class="fa-solid fa-check-to-slot"></i>
                                Check In</button>
                            <a class="reject-btn" id="reject-btn" name="reject" onclick="confirmReject()"><i
                                    class="fa-solid fa-trash"></i>
                                Cancel</a>
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
                window.location.href = 'dashboardCottageReservation.php'; // Change this to your desired page
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
        xhr.open('POST', 'cottage_reject.php', true);
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
                            window.location.href = 'dashboardCottageReservation.php'; // Replace with your desired page after rejection
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