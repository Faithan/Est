<?php
include ('db_connect.php');
session_start();


$manage_data = [
    'reserve_id' => '',
    'fname' => '',
    'lname' => '',
    'address' => '',
    'phone_number' => '',
    'email' => '',
    'date_of_arrival' => '',
    'time_of_arrival' => '',
    'room_type' => '',
    'number_of_person' => '',
    'amenities' => '',
    'price' => '',
    'special_request' => '',
    'reservation_type' => '',
    'photo' => ''
];


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_room_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
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

    <script src="javascripts/logout.js" defer></script>


    <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="css/extended.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Checked Out</title>
</head>

<body>


    <?php
    include 'header.php'
        ?>


    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">CHECKED OUT</label>
            </div>


            <form method="post" action="" class="form-container">

                <div class="info-container">
                    <div class="header-label2">
                        <label>RESERVATION INFO</label>
                    </div>
                    <div>
                        <div>
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
                                    <input type="number" name="price"
                                        value="<?php echo $manage_data['price']; ?>" disabled>
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
                                    <input type="time" name="time_out" value="<?php echo $manage_data['time_out']; ?>"
                                        disabled>
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


                        </div>

                        <div class="line">

                            <div>
                                <label>Reservation Payment (Paid)</label><br>
                                <input type="number" class="notransform" name="reservation_fee"
                                    value="<?php echo $manage_data['reservation_fee']; ?>" disabled>
                            </div>

                            <div>
                                <label>Extra Bed (+₱600) <em id="goodfor">*records only*</em></label><br>
                                <input type="number" class="notransform" name="extra_bed"
                                    value="<?php echo $manage_data['extra_bed']; ?>" disabled>
                            </div>

                            <div>
                                <label>Extra Person (+₱600) <em id="goodfor">*records only*</em></label><br>
                                <input type="number" name="extra_person"
                                    value="<?php echo $manage_data['extra_person']; ?>" disabled>
                            </div>

                            <div>
                                <label>New Total Fee (₱) <em id="goodfor">*Paid*</em></label><br>
                                <input type="number" name="total_fee" value="<?php echo $manage_data['total_fee']; ?>"
                                    disabled>
                            </div>

                        </div>

                        <div class="line">

                            <div>
                                <label>Extended Time (hrs) <em id="goodfor">*records only*</em></label><br>
                                <input type="number" class="notransform" name="extended_time"
                                    value="<?php echo $manage_data['extend_time']; ?>" disabled>
                            </div>

                            <div>
                                <label>Price per Hour (₱) <em id="goodfor">*records only*</em></label><br>
                                <input type="number" class="notransform" name="extended_price"
                                    value="<?php echo $manage_data['extend_price']; ?>" disabled>
                            </div>

                            <div>
                                <label>Additional Payment (₱) <em id="goodfor">*records only*</em></label><br>
                                <input type="number" class="notransform" name="additional_payment"
                                    value="<?php echo $manage_data['additional_payment']; ?>" disabled>
                            </div>
                        </div>

                        <div class="note">
                            <p>
                                <b>Note:</b> This form is for recorded data only.
                            </p>
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
                        <a href="roomReservation.php" class="back-btn"><i
                                class="fa-solid fa-arrow-right-from-bracket"></i>
                            Back</a>
                    </div>

                </div>
            </form>
        </div>

        <script src="javascripts/extendedHours.js"></script>

</body>

</html>