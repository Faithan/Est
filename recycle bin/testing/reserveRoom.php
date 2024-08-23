<?php
include ('../db_connect.php');
session_start();


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="reserveRoom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <title>Room Reservation</title>
    <script src="reserveRoom.js" defer></script>
    <script src="scroll.js" defer></script>
    <script src="inputColor.js" defer></script>
</head>

<body>
    <div class="nav-container">
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>About</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li><a>Contact</a></li>

            </ul>
            <button>Sign up</button>
        </nav>
        <div>

            <div class="real-container">

                <div class="background-design1"></div>

                <div class="background-design2"></div>

                <div class="for-footer"> @Estregan_Beach_Resort_2024 </div>


          



                <div class="display-container" id="display-container">
                    <div class="real-sub-container">


                        <div class="content-for-head">
                            <label class="header-text">MAKE A RERSERVATION</label>
                        </div> <!-- for content for head -->


                        <div class="category-bar-container">
                            <select id="category-bar" onchange="scrollToCategory(this.value)">
                                <option disabled selected value="">Select a Room Type</option>
                                <option value="standard">Standard</option>
                                <option value="superior">Superior</option>
                                <option value="family">Family</option>
                                <option value="barkadahan">Barkadahan</option>
                                <option value="exclusive">Exclusive Suites</option>
                            </select>
                        </div>




                        <!-- for standard room                            -->

                        <div class="content-sub-header" id="standard">
                            <label>STANDARD ROOMS</label>
                        </div> <!-- for content sub header -->



                        <div class="content-center">
                            <div class="container">
                                <div class="slide-wrapper1">
                                    <button id="prev-slide" class="slide-button1"></button>

                                    <div class="list-container">
                                        <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Standard'";
                                        $result = mysqli_query($con, $fetchdata);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
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
                                               
                                                <a href="reserveForm.php?manage_id=<?php echo $id; ?>" name="book_now" ><button class="button" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                            <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                                <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                                <path d="m8 3v4"></path>
                                                                <path d="m16 3v4"></path>
                                                                <path d="m4 11h16"></path>
                                                            </g>
                                                        </svg>
                                                        <span class="lable" >Book Now</span>
                                                    </button></a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <button id="next-slide" class="slide-button1"></button>
                                </div>

                                <div class="slider-scrollbar1">
                                    <div class="scrollbar-track1">
                                        <div class="scrollbar-thumb1"></div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- for content center -->



























                        <!-- for superior room   -->
                        <div class="content-sub-header" id="superior">
                            <label>SUPERIOR ROOMS</label>
                        </div> <!-- for content sub header -->



                        <div class="content-center">
                            <div class="container">
                                <div class="slide-wrapper2">
                                    <button id="prev-slide" class="slide-button2"></button>

                                    <div class="list-container">
                                        <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Superior'";
                                        $result = mysqli_query($con, $fetchdata);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
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
                                               
                                               <a href="reserveForm.php?manage_id=<?php echo $id; ?>" name="book_now" ><button class="button" >
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                           viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                           <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                               <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                               <path d="m8 3v4"></path>
                                                               <path d="m16 3v4"></path>
                                                               <path d="m4 11h16"></path>
                                                           </g>
                                                       </svg>
                                                       <span class="lable" >Book Now</span>
                                                   </button></a>
                                               </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <button id="next-slide" class="slide-button2"></button>
                                </div>

                                <div class="slider-scrollbar2">
                                    <div class="scrollbar-track2">
                                        <div class="scrollbar-thumb2"></div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- for content center -->






























                        <!-- for family room   -->
                        <div class="content-sub-header" id="family">
                            <label>FAMILY ROOMS</label>
                        </div> <!-- for content sub header -->



                        <div class="content-center">
                            <div class="container">
                                <div class="slide-wrapper3">
                                    <button id="prev-slide" class="slide-button3"></button>

                                    <div class="list-container">
                                        <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Family'";
                                        $result = mysqli_query($con, $fetchdata);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
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
                                                <a href="reserveForm.php?manage_id=<?php echo $id; ?>" name="book_now" ><button class="button" type="submit" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                            <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                                <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                                <path d="m8 3v4"></path>
                                                                <path d="m16 3v4"></path>
                                                                <path d="m4 11h16"></path>
                                                            </g>
                                                        </svg>
                                                        <span class="lable" >Book Now</span>
                                                    </button></a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <button id="next-slide" class="slide-button3"></button>
                                </div>

                                <div class="slider-scrollbar3">
                                    <div class="scrollbar-track3">
                                        <div class="scrollbar-thumb3"></div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- for content center -->
















                        <!-- for barkadahan room   -->
                        <div class="content-sub-header" id="barkadahan">
                            <label>BARKADAHAN ROOMS</label>
                        </div> <!-- for content sub header -->



                        <div class="content-center">
                            <div class="container">
                                <div class="slide-wrapper4">
                                    <button id="prev-slide" class="slide-button4"></button>

                                    <div class="list-container">
                                        <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Barkadahan'";
                                        $result = mysqli_query($con, $fetchdata);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
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
                                                <a href="reserveForm.php?manage_id=<?php echo $id; ?>" name="book_now" ><button class="button" type="submit" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                            <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                                <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                                <path d="m8 3v4"></path>
                                                                <path d="m16 3v4"></path>
                                                                <path d="m4 11h16"></path>
                                                            </g>
                                                        </svg>
                                                        <span class="lable" >Book Now</span>
                                                    </button></a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <button id="next-slide" class="slide-button4"></button>
                                </div>

                                <div class="slider-scrollbar4">
                                    <div class="scrollbar-track4">
                                        <div class="scrollbar-thumb4"></div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- for content center -->













                        <!-- for Exclusive suite room   -->
                        <div class="content-sub-header" id="exclusive">
                            <label>EXCLUSIVE SUITES</label>
                        </div> <!-- for content sub header -->



                        <div class="content-center">
                            <div class="container">
                                <div class="slide-wrapper5">
                                    <button id="prev-slide" class="slide-button5"></button>

                                    <div class="list-container">
                                        <?php $fetchdata = "SELECT * FROM room_tbl WHERE room_type = 'Exclusive Suite'";
                                        $result = mysqli_query($con, $fetchdata);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
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
                                                <a href="reserveForm.php?manage_id=<?php echo $id; ?>" name="book_now" ><button class="button" type="submit" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            viewBox="0 0 24 24" height="24" fill="none" class="svg-icon">
                                                            <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                                <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                                <path d="m8 3v4"></path>
                                                                <path d="m16 3v4"></path>
                                                                <path d="m4 11h16"></path>
                                                            </g>
                                                        </svg>
                                                        <span class="lable" >Book Now</span>
                                                    </button></a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <button id="next-slide" class="slide-button5"></button>
                                </div>

                                <div class="slider-scrollbar5">
                                    <div class="scrollbar-track5">
                                        <div class="scrollbar-thumb5"></div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- for content center -->



                    </div> <!-- for real sub container -->
                </div>
            </div> <!-- for real container -->

</body>

</html>