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



if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_cottage_tbl WHERE reserve_id = $manage_id";
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
                    <label for=""><i class="fa-solid fa-gear"></i> Checked-Out Cottage
                        Reservation</label>
                </div>

                <?php include 'icon-container.php' ?>
            </div>











            <!-- dynamic content -->

            <div class="center-container">





                <div class="container">
                    <div class="header-label">
                        <label for="">Checked-Out</label>
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
                                    <input name="first_name" value="<?php echo $manage_data['first_name']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Middle Name</label><br>
                                    <input name="middle_name" value="<?php echo $manage_data['middle_name']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Last Name</label><br>
                                    <input name="last_name" value="<?php echo $manage_data['last_name']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Address</label><br>
                                    <input name="reserve_address"
                                        value="<?php echo $manage_data['reserve_address']; ?>" disabled>
                                </div>
                            </div>
                            <div class="line">
                                <div>
                                    <label>Phone Number</label><br>
                                    <input name="phone_number" value="<?php echo $manage_data['phone_number']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Email</label><br>
                                    <input class="notransform" name="email"
                                        value="<?php echo $manage_data['email']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Date of Arrival</label><br>
                                    <input type="date" name="date_of_arrival"
                                        value="<?php echo $manage_data['date_of_arrival']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Time</label><br>
                                    <input type="text" name="time" value="<?php echo $manage_data['time']; ?>" disabled>
                                </div>

                            </div>
                            <div class="line">
                                <div>
                                    <label>Price (₱)</label><br>
                                    <input type="number" name="price" value="<?php echo $manage_data['price']; ?>" disabled>
                                </div>
                                <div>
                                    <label>Cottage Number</label><br>
                                    <input type="number" name="cottage_number"
                                        value="<?php echo $manage_data['cottage_number']; ?>" disabled>
                                </div>

                                <div>
                                    <label>Cottage Type</label><br>
                                    <input name="cottage_type" value="<?php echo $manage_data['cottage_type']; ?>" disabled>
                                </div>

                                <div>
                                    <label>Number of Person</label><br>
                                    <input name="number_of_person"
                                        value="<?php echo $manage_data['number_of_person']; ?>" disabled>
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
                                        id="" disabled><?php echo $manage_data["special_request"] ?></textarea>
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
                                        <input type="number" name="cottage_reserve_fee" value="<?php echo $manage_data["cottage_reserve_fee"] ?>" disabled>
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


                            <div class="note">
                                <p>
                                    <b>Note:</b> This form is for recorded data only.

                                </p>
                            </div>





                            <!-- reason for rejection -->
                            <br>


                        </div>







                    </form>
                </div>







            </div>
            <!-- end of center content -->




        </section>

    </main>



</body>

</html>