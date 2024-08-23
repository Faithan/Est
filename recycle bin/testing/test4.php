<?php
include ('../db_connect.php');
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test4.css?v=<?php echo time(); ?>">
    <script src="test3.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="reserveForm">
        <div class="reserveForm-Container">
            
        </div>
    </div>
    <div class="content-center">
        <div class="container">
            <div class="slide-wrapper1">
                <div class="list-container">
                    <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Standard'";
                    $result = mysqli_query($con, $fetchdata);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $roomType = $row['room_type'];
                        $noPersons = $row['no_persons'];
                        $amenities = $row['amenities'];
                        $price = $row['price'];
                        $status = $row['status'];
                        $photo = $row['photo'];
                        ?>
                        <div class="items">
                            <img src="<?php echo $photo ?>" alt="" class="item-container">
                            <div class="container-of-labels">
                                <div class="label-container">
                                    <label>
                                        <b>Room Type:</b>
                                        <?php echo $roomType ?>
                                    </label>
                                </div>
                                <div class="label-container">
                                    <label>
                                        <b>Number of Persons:</b>
                                        <?php echo $noPersons ?>
                                    </label>
                                </div>
                                <div class="label-container">
                                    <label>
                                        <b>Amenities:</b>
                                        <?php echo $amenities ?>
                                    </label>
                                </div>
                                <div class="label-container">
                                    <label>
                                        <b>Rate per Hours:</b>
                                        <?php echo $price ?>
                                    </label>
                                </div>
                                <div class="label-container">
                                    <label>
                                        <b>Status:</b>
                                        <?php echo $status ?>
                                    </label>
                                </div>
                            </div>

                            <div class="button-container">
                                <button class="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24"
                                        fill="none" class="svg-icon">
                                        <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                            <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                            <path d="m8 3v4"></path>
                                            <path d="m16 3v4"></path>
                                            <path d="m4 11h16"></path>
                                        </g>
                                    </svg>
                                    <span class="lable">Book Now</span>
                                </button>
                            </div>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div> <!-- for content center -->

</body>

</html>