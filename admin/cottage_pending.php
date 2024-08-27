<?php
include('db_connect.php');
session_start();

$manage_data = [
    'reserve_id' => '',
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
    'cottage_photo' => ''
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
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $reserve_address = $_POST['reserve_address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time = $_POST['time'];
    $cottage_number = $_POST['cottage_number'];
    $cottage_type = $_POST['cottage_type'];
    $number_of_person = $_POST['number_of_person'];
    $price = $_POST['price'];
    $special_request = $_POST['special_request'];
    $cottage_reserve_fee = $_POST['cottage_reserve_fee'];
    $rejection_reason = $_POST['rejection_reason'] ?? '';

    // Update query to match your data structure
    $update_query = "UPDATE reserve_cottage_tbl 
                     SET reserve_status='confirmed', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', 
                         reserve_address='$reserve_address', phone_number='$phone_number', email='$email', 
                         date_of_arrival='$date_of_arrival', time='$time', 
                         cottage_number='$cottage_number', cottage_type='$cottage_type', 
                         number_of_person='$number_of_person', price='$price', 
                         special_request='$special_request', cottage_reserve_fee='$cottage_reserve_fee', 
                         rejection_reason='$rejection_reason'
                     WHERE reserve_id='$reserve_id'";

    $manage_data = [
        'reserve_id' => '',
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
        'cottage_photo' => ''
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


    <title>Pendings</title>

    <script src="javascripts/totalFee.js" defer></script>


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

                    <label for=""><i class="fa-solid fa-gear"></i> Pending Cottage Reservation</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">





                <div class="container">
                    <div class="header-label">
                        <label for=""><?php echo $manage_data['reserve_status'] ?></label>
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
                                        id=""><?php echo $manage_data['special_request']; ?></textarea>
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



                            <div class="header-label2">
                                <label>RESERVATION ADVANCE PAYMENT</label>
                            </div>

                            <div class="payment-container">

                                <div class="line">
                                    <div>
                                        <label>Reservation Fee</label><br>
                                        <input type="number" name="cottage_reserve_fee" required>
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
                document.querySelector('.form-container').reset();
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
        xhr.onreadystatechange = function () {
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