<?php
include('db_connect.php');
session_start();





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


    <title>Walk-in Room Reservation</title>

    <script src="javascripts/add_room.js" defer></script>
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/walkInReservation.css?v=<?php echo time(); ?>">
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
                                class="fa-regular fa-circle-left"></i>
                            Return</a>
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

                    <label for=""><i class="fa-solid fa-gear"></i> Walk-in Room Reservation</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                   

                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">




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
                                    $day_price = $row['day_price'];
                                    $night_price = $row['night_price'];
                                    $status = $row['cottage_status'];
                                    $noPersons = $row['number_of_person'];
                                    $photo = $row['cottage_photo'];
                                    ?>

                                    <div class="rooms">

                                        <img src="<?php echo $photo ?>" alt="">

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

                                            ?>
                                            <a href="add_reservation_cottage2.php?manage_id=<?php echo $id; ?>" name="book_now">
                                                <button class="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"
                                                        height="24" fill="none" class="svg-icon">
                                                        <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                                            <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                                            <path d="m8 3v4"></path>
                                                            <path d="m16 3v4"></path>
                                                            <path d="m4 11h16"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="label">Select</span>
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



            </div>





        </section>

    </main>



</body>

</html>