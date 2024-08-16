<?php
include('db_connect.php');
session_start();


$user_id = ''; // Initialize user_id


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_cottage_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
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
    <link rel="stylesheet" href="landing_css/viewReservationCottage.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>View Reservation</title>

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




    <!-- for cancel button -->
    <script>
        function confirmCancel() {
            Swal.fire({
                title: 'Cancel Confirmation',
                text: 'Are you sure you want to cancel this reservation?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Cancel',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelItem();
                }
            });
        }

        function cancelItem() {
            var id = document.querySelector('input[name="reserve_id"]').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cancel_reservationCottage.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'Cancelled Successfully',
                            text: 'The reservation has been cancelled.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'myReservationRoom.php'; // Replace with your desired page after deletion
                        });
                    } else {
                        Swal.fire({
                            title: 'Cancellation Error',
                            text: 'Failed to cancel this reservation.',
                            icon: 'error'
                        });
                    }
                }
            };
            xhr.send('reserve_id=' + id);
        }
    </script>

    <!-- for header -->
    <?php include 'header.php' ?>


    <!-- home page -->

    <section class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <div class="wave-text">
                        <h2>View Reservation</h2>
                        <h2>View Reservation</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <main>

        <div class="image-container">
            <img name="photo" src="<?php echo $manage_data['cottage_photo']; ?>" alt="">
        </div>


        <form action="" method="post" class="reserveForm-contents">
            <input type="hidden" name="reserve_id" id="" value="<?php echo $manage_data['reserve_id']; ?>">

            <label class="bold-text">Reservation Status</label>

            <?php
            // Check if the status is 'cancelled' or 'rejected'
            $status = strtolower($manage_data['reserve_status']);
            $status_class = ($status === 'cancelled' || $status === 'rejected') ? 'status-error' : '';
            ?>

            <input class="fixed-value-input <?php echo $status_class; ?>" name="status"
                value="<?php echo $manage_data['reserve_status']; ?>" readonly>



       

            <p id="note">
                This section displays the status of your reservation, including pending, checked in, extended, checked
                out, rejected, or cancelled.
            </p>


            <label class="bold-text">Customer Details</label>


            <label>Full Name</label>


            <input class="fixed-value-input" name="first_name" onkeyup="changeColor(this)" placeholder="First Name"
                value="<?php echo $manage_data['first_name']; ?>" readonly>

            <input class="fixed-value-input" name="middle_name" onkeyup="changeColor(this)" placeholder="Middle Name"
                value="<?php echo $manage_data['middle_name']; ?>" readonly>


            <input class="fixed-value-input" name="last_name" onkeyup="changeColor(this)" placeholder="Last Name"
                value="<?php echo $manage_data['last_name']; ?>" readonly>


            <label>Address</label>
            <input class="fixed-value-input" name="reserve_address" onkeyup="changeColor(this)"
                placeholder="Ex: Maranding, Lala, Lanao Del Norte" value="<?php echo $manage_data['reserve_address']; ?>"
                readonly>

            <label>Phone Number</label>
            <input class="fixed-value-input" type="number" name="phone_number" onkeyup="changeColor(this)"
                placeholder="Ex: 09123456789" value="<?php echo $manage_data['phone_number']; ?>" readonly>

            <label>Email (optional)</label>
            <input class="fixed-value-input" class="input4" name="email" onkeyup="changeColor(this)"
                placeholder="Ex: Name@gmail.com" value="<?php echo $manage_data['email']; ?>" readonly>

            <label>Arrival Date</label>
            <input class="fixed-value-input" type="date" name="date_of_arrival" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['date_of_arrival']; ?>" readonly>

            <label>Check-in Time </label>

            <input class="fixed-value-input" type="time" name="time_of_arrival" onkeyup="changeColor(this)"
                value="14:00" required readonly>
            <p id="comment"> (fixed)</p>

            <label class="bold-text">Room Details</label>

            <label>Cottage Number</label>
            <input class="fixed-value-input" name="room_number" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_number']; ?>" readonly>

            <label>Room Type</label>
            <input class="fixed-value-input" name="cottage_type" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_type']; ?>" readonly>

    
            <label>Number of Persons:</label>
            <input class="fixed-value-input" name="number_of_person" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['number_of_person']; ?>" readonly>

           

            <label>Price (₱)</label>
            <input class="fixed-value-input" name="price" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['price']; ?>" readonly>

            <p id="comment">(fixed)</p>

            <label>Special Request</label>
            <textarea class="fixed-value-textarea" name="special_request" onkeyup="changeColor(this)"
                readonly></textarea>

            <p id="note">
                <b>Note:</b>
                Once you have submitted your reservation, please await confirmation. During the review of your
                submitted data, we will be in contact with you.
            </p>


            <div class="reservationForm-buttons">
                <?php
                // Assuming $manage_data['status'] contains 'pending' as the value
                $status = $manage_data['reserve_status'];

                // Check if the $status variable is set and is equal to 'pending'
                if (isset($status) && strtolower($status) === 'pending') {
                    // Display the first anchor tag if the status is 'pending'
                    echo '<a class="cancel-btn" name="cancel" onclick="confirmCancel()">Cancel Reservation</a>';
                }
                ?>

                <a href="myReservationCottage.php" class="back-btn">Back</a>
            </div>
        </form>


    </main>





    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>