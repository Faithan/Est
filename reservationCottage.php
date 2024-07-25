<?php
include ('db_connect.php');
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
   

    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>
    <!-- <script src="landing_js/selectCategory.js" defer></script> -->
    <!-- <script src="landing_js/reserveRoom.js" defer></script> -->
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php 
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/reservationCottage.css?v=<?php echo time(); ?>">
    
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Cottage Reservation</title>

</head>


<body>

    <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <section class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <div class="wave-text">
                        <h2>Cottage Reservation</h2>
                        <h2>Cottage Reservation</h2>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="category-main-container">

        <h2>Categories✨</h2>

        <div class="category-bar-container">
            <div class="custom-select">
                <select onchange="scrollToDiv()">
                    <option disabled selected value="">Select a Cottage Type</option>
                    <option value="standard">Standard</option>
                    <option value="superior">Superior</option>
                    <option value="family">Family</option>
                    <option value="barkadahan">Barkadahan</option>
                    <option value="exclusive">Exclusive</option>
                </select>
            </div>

        



      
        </div>

        <div class="search-bar-container">
            <div>
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="search-input">
                </div>
            </div>
        </div>
    </section>















    <main class="rooms-main-container">
        <div class="wrapper-main">

            <!-- for standard room-->
            <div class="content-sub-header" id="standard">
                <label>Standard Cottages</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = 'Standard'";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cottage_id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $noPersons = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $photo = $row['cottage_photo'];
                    
                    ?>

                    <?php
                    include 'cottageDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->






             <!-- for superior cottages-->
             <div class="content-sub-header" id="superior">
                <label>Superior Cottages</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = 'Superior'";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cottage_id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $noPersons = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $photo = $row['cottage_photo'];
                    
                    ?>

                    <?php
                    include 'cottageDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->



            <!-- for Family cottages-->
            <div class="content-sub-header" id="family">
                <label>Family Cottages</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = 'Family'";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cottage_id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $noPersons = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $photo = $row['cottage_photo'];
                    
                    ?>

                    <?php
                    include 'cottageDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->




          
            <!-- for barkadahan cottages-->
            <div class="content-sub-header" id="barkadahan">
                <label>Barkadahan Cottages</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = 'Barkadahan'";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cottage_id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $noPersons = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $photo = $row['cottage_photo'];
                    
                    ?>

                    <?php
                    include 'cottageDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->


              <!-- for exclusive cottages-->
              <div class="content-sub-header" id="exclusive">
                <label>Exclusive Cottages</label>
            </div> <!-- for content sub header -->

            <div class="content-center">
                <?php $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = 'Exclusive'";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cottage_id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $noPersons = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $photo = $row['cottage_photo'];
                    
                    ?>

                    <?php
                    include 'cottageDetails.php'
                        ?>

                <?php } ?>
            </div> <!-- for content center -->







        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>