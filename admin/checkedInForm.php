<?php
include ('db_connect.php');
session_start();


$manage_data = ['reserve_id' => '', 'fname' => '', 'lname' => '', 'address' => '', 'phone_number' => '', 'email' => '', 'date_of_arrival' => '', 'time_of_arrival' => '', 'room_type' => '', 'number_of_person' => '', 'amenities' => '', 'rate_per_hour' => '', 'special_request' => '', 'photo' => ''];



if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}



if (isset($_POST['checkOut'])) {
    $reserve_id = $_POST['reserve_id'];
    $update_query = "UPDATE reserve_room_tbl SET status='checkedOut' WHERE reserve_id='$reserve_id'";
    if (mysqli_query($con, $update_query)) {
        echo "<script> alert('checked In Successfully')</script>";
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($con);
    }
}



?>

<?php 
if (isset($_POST['extended'])) {
    $reserve_id = $_POST['reserve_id'];
    $number_of_person = $_POST['number_of_person'];
    $hours_ext = $_POST['hours_ext'];
    $payment_ext = $_POST['payment_ext'];
    $cash_change_ext = $_POST['cash_change_ext'];
    $time_out = $_POST['time_out'];
    $update_query = "UPDATE reserve_room_tbl SET  status = 'extended', number_of_person='$number_of_person', hours_ext='$hours_ext', payment_ext='$payment_ext', cash_change_ext='$cash_change_ext', time_out='$time_out'  WHERE reserve_id='$reserve_id'";
    
    if (mysqli_query($con, $update_query)) {
        echo "<script> alert('checked In Successfully')</script>";
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($con);
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="checkedInForm.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Checked In</title>
</head>

<body>

    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
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
                                <input name="first_name" value="<?php echo $manage_data['fname']; ?>" readonly>
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
                                <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>" readonly>
                            </div>
                            <div>
                                <label>Email</label><br>
                                <input class="notransform" name="email" value="<?php echo $manage_data['email']; ?>" readonly>
                            </div>
                            <div>
                                <label>Date of Arrival</label><br>
                                <input type="date" class="notransform" name="date_of_arrival"
                                    value="<?php echo $manage_data['date_of_arrival']; ?>" readonly>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Time of Arrival</label><br>
                                <input type="time" name="time_of_arrival"
                                    value="<?php echo $manage_data['time_of_arrival']; ?>" readonly>
                            </div>
                            <div>
                                <label>Room Type</label><br>
                                <input name="room_type" value="<?php echo $manage_data['room_type']; ?>" readonly>
                            </div>
                            <div>
                                <label>Bed Type</label><br>
                                <input type="text" name="bed_type" value="<?php echo $manage_data['bed_type']; ?>" readonly>
                            </div>
                        </div>


                        <div class="line">
                            <div>
                                <label>Bed Quantity</label><br>
                                <input type="number" name="bed_quantity" value="<?php echo $manage_data['bed_quantity']; ?>" readonly>
                            </div>
                            <div>
                                <label>Number of Persons</label><br>
                                <input type="number" name="number_of_person"
                                    value="<?php echo $manage_data['number_of_person']; ?>" >
                            </div>
                            <div>
                                <label>Amenities</label><br>
                                <input name="amenities" value="<?php echo $manage_data['amenities']; ?>" readonly>
                            </div>
                        </div>

                        <div class="line">
                            <div>
                                <label>Rate Per Hour</label><br>
                                <input type="number" name="rate_per_hour"
                                    value="<?php echo $manage_data['rate_per_hour']; ?>" readonly>
                            </div>
                            <div>
                                <label>Special Request</label><br>
                                <input type="text" name="special_request"
                                    value="<?php echo $manage_data['special_request']; ?>" readonly>
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
                                <input type="number" name="hours_of_stay" value="<?php echo $manage_data['hours_of_stay']; ?>" readonly>
                            </div>
                            <div>
                                <label>Total Price</label><br>
                                <input type="number" name="total_price" value="<?php echo $manage_data['total_price']; ?>" readonly>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Reservation Payment</label><br>
                                <input type="number" name="reservation_fee" value="<?php echo $manage_data['reservation_fee']; ?>" readonly>
                            </div>
                            <div>
                                <label>Payment</label><br>
                                <input type="number" name="payment" value="<?php echo $manage_data['payment']; ?>" readonly>
                            </div>
                            <div>
                                <label>Change</label><br>
                                <input type="number" name="cash_change" value="<?php echo $manage_data['cash_change']; ?>" readonly>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Extended Hours</label><br>
                                <input type="number" name="hours_ext" id="input2" placeholder="Optional" >
                            </div>
                            <div>
                                <label>Extended Payment</label><br>
                                <input type="number" name="payment_ext" id="input3" placeholder="Enter Payment" oninput= "extendedPayment()">
                            </div>
                            <div>
                                <label>Extended Change</label><br>
                                <input type="number" name="cash_change_ext" id="input4" readonly>
                            </div>
                        </div>


                        <div class="line">
                            <div>
                                <label>Time In</label><br>
                                <input type="time" name="time_in"  value="<?php echo $manage_data['time_in']; ?>" readonly>
                            </div>

                            <div>
                                <label>Time Out</label><br>
                                <input type="time" name="time_out"  value="<?php echo $manage_data['time_out']; ?>" required>
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
                    <button class="extend-btn" type="submit" name="extended"><i
                                class="fa-solid fa-check-to-slot"></i> Extend</button>
                        <button class="check-btn" type="submit" name="checkOut"><i
                                class="fa-solid fa-check-to-slot"></i> Check Out</button>
                        <a href="reservation.php" class="back-btn"><i class="fa-solid fa-rotate-left"></i> Back</a>
                        <div>

                        </div>
            </form>
        </div>

        <script src="javascripts/extendedHours.js"></script>
        

</body>

</html>