<?php
include ('db_connect.php');
session_start();


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = $manage_id";
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


 <!-- mobile version -->

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

    <div class="page-structure">

        <div class="left-background">

        </div>




        <!-- home page -->
        <div class="rooms-base-container">
            <div class="container-header">
                <label for="">Cottage reservation</label>
            </div>




            <!-- start of room container -->
            <div class="rooms-container">

                <div class="category-container">
                    <div class="select-container">


                        <div class=" custom-select-pc">


                            <?php
                            // Assuming you've included the necessary database connection file
                            
                            // Query to select distinct cottage type names
                            $sql = "SELECT DISTINCT cottage_type_name FROM cottage_type_tbl";
                            $result = $con->query($sql);

                            $selectBox = "<select name='cottage_type' id='cottageTypeSelect' onchange='filterCottages()'>";
                            $selectBox .= "<option disabled selected value=''>Select a Cottage Type</option>";

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $cottageType = ucwords(strtolower($row["cottage_type_name"])); // Capitalize and format the room type
                                    $selectBox .= "<option value='" . $cottageType . "'>" . $cottageType . "</option>";
                                }
                            } else {
                                $selectBox .= "<option value=''>No cottage types found.</option>";
                            }

                            $selectBox .= "</select>";

                            echo $selectBox;
                            ?>
                        </div>

                        <!-- cottage type script -->
                        <script>
                            function filterCottages() {
                                const select = document.getElementById('cottageTypeSelect');
                                const selectedCottageType = select.value.toLowerCase().replace(/ /g, '-');

                                // Get the target element and the container
                                const targetElement = document.getElementById(selectedCottageType);
                                const container = document.querySelector('.rooms-container');

                                if (targetElement && container) {
                                    // Calculate the position of the target element relative to the container
                                    const offsetTop = targetElement.offsetTop - container.offsetTop;

                                    // Scroll the container to the target element
                                    container.scrollTo({
                                        top: offsetTop,
                                        behavior: 'smooth'
                                    });
                                }
                            }

                        </script>






                       




                    










                    </div>

                </div>






                <!-- start of room holder -->
                <div class="rooms-holder">
                    <?php
                    $cottageTypesQuery = "SELECT DISTINCT cottage_type_name FROM cottage_type_tbl";
                    $cottageTypesResult = mysqli_query($con, $cottageTypesQuery);
                    $cottageTypeCount = 1;

                    while ($typeRow = mysqli_fetch_assoc($cottageTypesResult)) {
                        $cottage_type = $typeRow['cottage_type_name'];
                        $cottage_type_id = strtolower(str_replace(' ', '-', $cottage_type)); // Convert room type to a valid ID
                    
                        echo "<div class='title-head' id='{$cottage_type_id}'>";
                        echo "<label>$cottage_type</label>";
                        echo '</div>';

                        echo '<div class="room-first-container">';

                        $fetchdata = "SELECT * FROM cottage_tbl WHERE cottage_type = '$cottage_type'";
                        $result = mysqli_query($con, $fetchdata);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['cottage_id'];
                            $cottageNumber = $row['cottage_number'];
                            $cottageType = $row['cottage_type'];
                            $day_price= $row['day_price'];
                            $night_price= $row['night_price'];
                            $status = $row['cottage_status'];
                            $noPersons = $row['number_of_person'];
                            $photo = $row['cottage_photo'];
                            ?>

                            <div class="rooms">

                                <img src="<?php echo str_replace('../', '', $photo); ?>" alt="">

                                <div class="info-container">
                                    <div class="room-details"><label for="bold-text">Day Price : </label>
                                        <p for="bold-text">₱ <?php echo $day_price ?></p>
                                    </div>
                                    <div class="room-details"><label for="bold-text">Night Price : </label>
                                        <p for="bold-text">₱ <?php echo $night_price ?></p>
                                    </div>
                                    <div class="room-details" id="good-for">
                                        <p><em>Good For 10 hours</em></p>
                                    </div>
                                    <div class="room-details"><label for="">Cottage Type: </label>
                                        <p><?php echo $cottageType ?></p>
                                    </div>
                                   
                                 
                                    <div class="room-details"><label for="">Number of persons: </label>
                                        <p> <?php echo $noPersons ?></p>
                                    </div>
                                  
                                  
                                </div>

                                <div class="button-container">
                                    <?php
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                        $href = "reservationFormCottage.php?manage_id=" . $id;
                                        $button_text = "Book Now";
                                    } else {
                                        $href = "";
                                        $button_text = "Login to Book";
                                    }
                                    ?>
                                    <a href="<?php echo $href; ?>" name="book_now">
                                        <button class="button" <?php if (empty($href))
                                            echo 'disabled'; ?>>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24"
                                                fill="none" class="svg-icon">
                                                <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                    <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                    <path d="m8 3v4"></path>
                                                    <path d="m16 3v4"></path>
                                                    <path d="m4 11h16"></path>
                                                </g>
                                            </svg>
                                            <span class="label"><?php echo $button_text; ?></span>
                                        </button>
                                    </a>
                                </div>
                            </div>



                            <?php
                        }

                        echo '</div>'; // Close room-first-container
                        $cottageTypeCount++;
                    }

                    ?>
                </div>
                <!-- end of room holder -->

            </div>
            <!-- end of room container -->



        </div>














        <div class="right-background">

        </div>
    </div>
























































































   

  

 
    <!-- end of mobile version -->






    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>