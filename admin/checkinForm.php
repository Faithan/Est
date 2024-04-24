<?php
include ('db_connect.php');
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location:../login.php');
    exit();
}



$manage_data = ['reserve_id' => '', 'fname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'photo' => '', 'hours_of_stay' => '', 'total_price' => '' , 'payment' => '' , 'cash_change' => '', 'time_in' => '', 'time_out' => '' , 'reservation_fee' => ''];


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
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time_of_arrival = $_POST['time_of_arrival'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $rate_per_hour = $_POST['rate_per_hour'];
    $special_request = $_POST['special_request'];
    $hours_of_stay = $_POST['hours_of_stay'];
    $total_price = $_POST['total_price'];
    $payment = $_POST['payment'];
    $cash_change = $_POST['cash_change'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];
    $update_query = "UPDATE reserve_room_tbl SET status='checkedIn', fname='$fname', lname='$lname', address='$address', phone_number='$phone_number', email='$email', date_of_arrival='$date_of_arrival', time_of_arrival='$time_of_arrival', room_type='$room_type', bed_type='$bed_type', bed_quantity='$bed_quantity',  number_of_person='$number_of_person', amenities='$amenities' , rate_per_hour='$rate_per_hour', special_request='$special_request', hours_of_stay='$hours_of_stay', total_price='$total_price', payment='$payment', cash_change='$cash_change', time_in='$time_in', time_out='$time_out' WHERE reserve_id='$reserve_id'";
    
    $query = (mysqli_query($con, $update_query));

    if ($query) {
        $message = "Changes Saved Successfully!";
        $isSuccess = true;
        $manage_data = ['reserve_id' => '', 'fname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'bed_type' => '', 'bed_quantity' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'photo' => '', 'hours_of_stay' => '', 'total_price' => '' , 'payment' => '' , 'cash_change' => '', 'time_in' => '', 'time_out' => '' , 'reservation_fee' => ''];

       
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

    <script src="../sweetalert/sweetalert.js"></script>
    <script src="javascripts/logout.js" defer></script>

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="checkinForm.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Check In</title>
</head>

<body>

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
                    document.querySelector('.form-container').reset();
                }
            });
            
        </script>
    <?php endif; ?>



    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
            <li><a href="#">Home</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <li class="dropdown">
                    <a href="rooms.php" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="rooms.php">Rooms</a>
                <li class="dropdown">
                    <a href="add_room.php" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="add_room.php">Add Rooms</a>

            </ul>
            <a class="logout-btn" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
        </nav>
    </div>

    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">RESERVATION</label>
            </div>


            <form method="post" action="" class="form-container">

                <div class="info-container">
                    <div class="header-label2">
                        <label>RESERVATION INFO</label>
                    </div>
                    <div>
                        <div class="line">
                            <div>
                                <label>First Name</label><br>
                                <input name="first_name" value="<?php echo $manage_data['fname']; ?>">
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
                                <input class="notransform" name="email" value="<?php echo $manage_data['email']; ?>">
                            </div>
                            <div>
                                <label>Date of Arrival</label><br>
                                <input type="date" class="notransform" name="date_of_arrival"
                                    value="<?php echo $manage_data['date_of_arrival']; ?>">
                            </div>
                        </div>
                        
                        <div class="line">
                            <div>
                                <label>Time of Arrival</label><br>
                                <input type="time" name="time_of_arrival"
                                    value="<?php echo $manage_data['time_of_arrival']; ?>">
                            </div>
                            <div>
                                <label>Room Type</label><br>
                                <input name="room_type" value="<?php echo $manage_data['room_type']; ?>" readonly>
                            </div>
                            <div>
                                <label>Bed Type</label><br>
                                <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>" >
                            </div>
                        </div>


                        <div class="line">
                            <div>
                                <label>Bed Quantity</label><br>
                                <input type="number" name="bed_quantity" value="<?php echo $manage_data['bed_quantity']; ?>" >
                            </div>
                            <div>
                                <label>Number of Persons</label><br>
                                <input type="number" name="number_of_person"
                                    value="<?php echo $manage_data['number_of_person']; ?>">
                            </div>
                            <div>
                                <label>Amenities</label><br>
                                <input name="amenities" value="<?php echo $manage_data['amenities']; ?>" >
                            </div>
                        </div>

                        <div class="line">
                            <div>
                                <label>Rate Per Hour</label><br>
                                <input type="number" name="rate_per_hour"
                                    value="<?php echo $manage_data['rate_per_hour']; ?>" >
                            </div>
                            <div>
                                <label>Special Request</label><br>
                                <input type="text" name="special_request"
                                    value="<?php echo $manage_data['special_request']; ?>" >
                            </div>
                        </div>


                    </div>


                    <div class="header-label3">
                        <label>PAYMENT</label>
                    </div>
                    <div class="payment-container">

                        <div class="line">
                            <div>
                                <label>Rate Per Hour</label><br>
                                <input type="number" id="input1" name="rate_per_hour"
                                    value="<?php echo $manage_data['rate_per_hour']; ?>" readonly>
                            </div>
                            <div>
                                <label>Hours of Stay</label><br>
                                <input type="number" name="hours_of_stay" id="input2" oninput="multiply()"
                                    placeholder="Enter Number" required>
                            </div>
                            <div>
                                <label>Total Price</label><br>
                                <input type="number" name="total_price" id="result" placeholder="Result" readonly>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Reservation Payment</label><br>
                                <input type="number" name="reservation_fee" id="input4" value="<?php echo $manage_data['reservation_fee']; ?>">
                            </div>
                            <div>
                                <label>Payment</label><br>
                                <input type="number" name="payment" id="input3" oninput="subtract()"
                                    placeholder="Enter Payment" required>
                            </div>
                            <div>
                                <label>Change</label><br>
                                <input type="number" name="cash_change" id="change" placeholder="Your Change" readonly>
                            </div>
                        </div>

                        <div class="line">
                            <div>
                                <label>Time In</label><br>
                                <input type="time" name="time_in" required>
                            </div>

                            <div>
                                <label>Time Out</label><br>
                                <input type="time" name="time_out"  required>
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

                </div>



                <div class="image-container">
                    <div class="image-holder">
                        <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                    </div>
                </div>

                <div class="button-container">
                    <div class="button-holder">
                        <button class="check-btn" type="submit" name="checkedin"><i
                                class="fa-solid fa-check-to-slot"></i> Checked In</button>
                        <a href="reservation.php" class="back-btn"><i class="fa-solid fa-rotate-left"></i> Back</a>
                        <div>

                        </div>
            </form>
        </div>

        <script src="javascripts/calculation.js"></script>
        <script src="javascripts/subtract.js"></script>
        
</body>

</html>