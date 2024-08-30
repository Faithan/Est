<?php
require 'db_connect.php';
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


    <title>Dashboard</title>

    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

        <?php
        include 'sidenav.php'
            ?>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-table-cells-large"></i> Dashboard</label>
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
                <div class="second-container">
                    <div class="smallbox-container">
                        <!-- Total Revenue -->
                        <div class="sbox">
                            <label for="">Total Revenue <i class="fa-solid fa-coins"></i></label>
                            <?php
                            // Query to sum up the price for 'checkedOut' room reservations
                            $room_revenue_query = "SELECT SUM(price) as total_room_revenue FROM reserve_room_tbl WHERE status = 'checkedOut'";
                            $room_revenue_result = mysqli_query($con, $room_revenue_query);

                            // Query to sum up the price for 'checkedOut' cottage reservations
                            $cottage_revenue_query = "SELECT SUM(price) as total_cottage_revenue FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut'";
                            $cottage_revenue_result = mysqli_query($con, $cottage_revenue_query);

                            // Initialize total revenue
                            $total_revenue = 0;

                            // Calculate total room revenue
                            if ($room_revenue_result) {
                                $row = mysqli_fetch_assoc($room_revenue_result);
                                $total_room_revenue = $row['total_room_revenue'];
                                $total_room_revenue = $total_room_revenue ? $total_room_revenue : 0; // Handle NULL values
                            } else {
                                $total_room_revenue = 0; // Default value if query fails
                            }

                            // Calculate total cottage revenue
                            if ($cottage_revenue_result) {
                                $row = mysqli_fetch_assoc($cottage_revenue_result);
                                $total_cottage_revenue = $row['total_cottage_revenue'];
                                $total_cottage_revenue = $total_cottage_revenue ? $total_cottage_revenue : 0; // Handle NULL values
                            } else {
                                $total_cottage_revenue = 0; // Default value if query fails
                            }

                            // Calculate combined total revenue
                            $total_revenue = $total_room_revenue + $total_cottage_revenue;
                            ?>
                            <p><?php echo number_format($total_revenue, 2); ?></p>
                        </div>



                        <div class="sbox">
                            <label for="">Total Cottage Revenue <i class="fa-solid fa-coins"></i></label>
                            <?php
                            // Query to sum up the price for 'checkedOut' reservations in cottages
                            $cottage_revenue_query = "SELECT SUM(price) as total_revenue FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut'";
                            $cottage_revenue_result = mysqli_query($con, $cottage_revenue_query);

                            if ($cottage_revenue_result) {
                                $row = mysqli_fetch_assoc($cottage_revenue_result);
                                $total_cottage_revenue = $row['total_revenue'];
                                $total_cottage_revenue = $total_cottage_revenue ? $total_cottage_revenue : 0; // Handle NULL values
                            } else {
                                $total_cottage_revenue = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo number_format($total_cottage_revenue, 2); ?></p>
                        </div>










                        <div class="sbox">
                            <label for="">Total Room Revenue <i class="fa-solid fa-coins"></i></label>
                            <?php
                            // Query to sum up the price for 'checkedOut' reservations
                            $revenue_query = "SELECT SUM(price) as total_revenue FROM reserve_room_tbl WHERE status = 'checkedOut'";
                            $revenue_result = mysqli_query($con, $revenue_query);

                            if ($revenue_result) {
                                $row = mysqli_fetch_assoc($revenue_result);
                                $total_revenue = $row['total_revenue'];
                                $total_revenue = $total_revenue ? $total_revenue : 0; // Handle NULL values
                            } else {
                                $total_revenue = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo number_format($total_revenue, 2); ?></p>
                        </div>






                        <!-- Total Reservation (Cottages and Rooms) -->
                        <div class="sbox">
                            <label for="">Total Reservation<em>(Cottages and Rooms)</em></label>
                            <?php
                            // Query to count the total number of room reservations
                            $room_reservation_query = "SELECT COUNT(*) as total_room_reservations FROM reserve_room_tbl";
                            $room_reservation_result = mysqli_query($con, $room_reservation_query);

                            // Query to count the total number of cottage reservations
                            $cottage_reservation_query = "SELECT COUNT(*) as total_cottage_reservations FROM reserve_cottage_tbl";
                            $cottage_reservation_result = mysqli_query($con, $cottage_reservation_query);

                            // Initialize total reservations
                            $total_reservations = 0;

                            // Calculate total room reservations
                            if ($room_reservation_result) {
                                $row = mysqli_fetch_assoc($room_reservation_result);
                                $total_room_reservations = $row['total_room_reservations'];
                                $total_room_reservations = $total_room_reservations ? $total_room_reservations : 0; // Handle NULL values
                            } else {
                                $total_room_reservations = 0; // Default value if query fails
                            }

                            // Calculate total cottage reservations
                            if ($cottage_reservation_result) {
                                $row = mysqli_fetch_assoc($cottage_reservation_result);
                                $total_cottage_reservations = $row['total_cottage_reservations'];
                                $total_cottage_reservations = $total_cottage_reservations ? $total_cottage_reservations : 0; // Handle NULL values
                            } else {
                                $total_cottage_reservations = 0; // Default value if query fails
                            }

                            // Calculate combined total reservations
                            $total_reservations = $total_room_reservations + $total_cottage_reservations;
                            ?>
                            <p><?php echo $total_reservations; ?></p>
                        </div>


                        <div class="sbox" onclick="window.location.href='dashboardUserSettings.php';"
                            style="cursor: pointer;">
                            <label for="">Total User <i class="fa-solid fa-users"></i></label>
                            <?php
                            // Query to count the total number of users
                            $total_user_query = "SELECT COUNT(*) as total_users FROM user_tbl";
                            $total_user_result = mysqli_query($con, $total_user_query);

                            if ($total_user_result) {
                                $row = mysqli_fetch_assoc($total_user_result);
                                $total_users = $row['total_users'];
                            } else {
                                $total_users = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo $total_users; ?></p>
                        </div>


                        <div class="sbox" onclick="window.location.href='dashboardCottageReservation.php';"
                            style="cursor: pointer;">
                            <label for="">Today's Cottage Reservation <i class="fa-solid fa-umbrella-beach"></i></label>
                            <?php
                            // Query to count the number of cottage reservations with today's arrival date
                            $todays_cottage_reservation_query = "SELECT COUNT(*) as todays_cottage_reservations FROM reserve_cottage_tbl WHERE DATE(date_of_arrival) = CURDATE()";
                            $todays_cottage_reservation_result = mysqli_query($con, $todays_cottage_reservation_query);

                            if ($todays_cottage_reservation_result) {
                                $row = mysqli_fetch_assoc($todays_cottage_reservation_result);
                                $todays_cottage_reservations = $row['todays_cottage_reservations'];
                            } else {
                                $todays_cottage_reservations = 0; // Default value if query fails
                            }
                            ?>



                            <p><?php echo $todays_cottage_reservations; ?></p>
                            <?php if ($todays_cottage_reservations > 0): ?>
                                <span class="red-dot"></span> <!-- Red dot notification -->
                            <?php endif; ?>
                        </div>





                        <!-- Total Cottage Reservation -->
                        <div class="sbox" onclick="window.location.href='dashboardCottageReservation.php';"
                            style="cursor: pointer;">
                            <label for="">Total Cottage Reservation <i class="fa-solid fa-umbrella-beach"></i></label>
                            <?php
                            // Query to count the total number of cottage reservations
                            $cottage_reservation_query = "SELECT COUNT(*) as total_cottage_reservations FROM reserve_cottage_tbl";
                            $cottage_reservation_result = mysqli_query($con, $cottage_reservation_query);

                            if ($cottage_reservation_result) {
                                $row = mysqli_fetch_assoc($cottage_reservation_result);
                                $total_cottage_reservations = $row['total_cottage_reservations'];
                                $total_cottage_reservations = $total_cottage_reservations ? $total_cottage_reservations : 0; // Handle NULL values
                            } else {
                                $total_cottage_reservations = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo $total_cottage_reservations; ?></p>
                        </div>


                        <div class="sbox" onclick="window.location.href='dashboardRoomReservation.php';"
                            style="cursor: pointer;">
                            <label for="">Today's Room Reservation <i class="fa-solid fa-bed"></i></label>
                            <?php
                            // Query to count the number of room reservations with today's arrival date
                            $todays_room_reservation_query = "SELECT COUNT(*) as todays_room_reservations FROM reserve_room_tbl WHERE DATE(date_of_arrival) = CURDATE()";
                            $todays_room_reservation_result = mysqli_query($con, $todays_room_reservation_query);

                            if ($todays_room_reservation_result) {
                                $row = mysqli_fetch_assoc($todays_room_reservation_result);
                                $todays_room_reservations = $row['todays_room_reservations'];
                            } else {
                                $todays_room_reservations = 0; // Default value if query fails
                            }
                            ?>



                            <p><?php echo $todays_room_reservations; ?></p>
                            <?php if ($todays_room_reservations > 0): ?>
                                <span class="red-dot"></span> <!-- Red dot notification -->
                            <?php endif; ?>
                        </div>






                        <!-- Total Room Reservation -->
                        <div class="sbox" onclick="window.location.href='dashboardRoomReservation.php';"
                            style="cursor: pointer;">
                            <label for="">Total Room Reservation <i class="fa-solid fa-bed"></i></label>
                            <?php
                            // Query to count the total number of room reservations
                            $room_reservation_query = "SELECT COUNT(*) as total_room_reservations FROM reserve_room_tbl";
                            $room_reservation_result = mysqli_query($con, $room_reservation_query);

                            if ($room_reservation_result) {
                                $row = mysqli_fetch_assoc($room_reservation_result);
                                $total_room_reservations = $row['total_room_reservations'];
                                $total_room_reservations = $total_room_reservations ? $total_room_reservations : 0; // Handle NULL values
                            } else {
                                $total_room_reservations = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo $total_room_reservations; ?></p>
                        </div>







                        <div class="sbox" onclick="window.location.href='dashboardUserSettings.php';"
                            style="cursor: pointer;">
                            <label for="">New User<em>(Today)</em></label>
                            <?php
                            // Query to count the number of new users registered today
                            $new_user_query = "SELECT COUNT(*) as new_users FROM user_tbl WHERE DATE(date_created) = CURDATE()";
                            $new_user_result = mysqli_query($con, $new_user_query);

                            if ($new_user_result) {
                                $row = mysqli_fetch_assoc($new_user_result);
                                $new_users = $row['new_users'];
                            } else {
                                $new_users = 0; // Default value if query fails
                            }
                            ?>



                            <p><?php echo $new_users; ?></p>
                            <?php if ($new_users > 0): ?>
                                <span class="red-dot"></span> <!-- Red dot notification -->
                            <?php endif; ?>
                        </div>











                    </div>
                    <!-- end smallbox container -->







                    <div class="bigbox-container">
                        <?php
                        // Query to get reservation count for rooms grouped by date_of_arrival
                        $queryRooms = "SELECT date_of_arrival, COUNT(*) as reservation_count 
                   FROM reserve_room_tbl 
                   GROUP BY date_of_arrival 
                   ORDER BY date_of_arrival";
                        $resultRooms = $con->query($queryRooms);

                        $datesRooms = [];
                        $reservationCountsRooms = [];
                        if ($resultRooms->num_rows > 0) {
                            while ($row = $resultRooms->fetch_assoc()) {
                                $datesRooms[] = $row['date_of_arrival'];
                                $reservationCountsRooms[] = $row['reservation_count'];
                            }
                        }

                        // Query to get reservation count for cottages grouped by date_of_arrival
                        $queryCottages = "SELECT date_of_arrival, COUNT(*) as reservation_count 
                      FROM reserve_cottage_tbl 
                      GROUP BY date_of_arrival 
                      ORDER BY date_of_arrival";
                        $resultCottages = $con->query($queryCottages);

                        $datesCottages = [];
                        $reservationCountsCottages = [];
                        if ($resultCottages->num_rows > 0) {
                            while ($row = $resultCottages->fetch_assoc()) {
                                $datesCottages[] = $row['date_of_arrival'];
                                $reservationCountsCottages[] = $row['reservation_count'];
                            }
                        }
                        ?>

                        <canvas id="roomReservationChart"></canvas>
                        <canvas id="cottageReservationChart"></canvas>

                        <script>
                            // Data passed from PHP for Room Reservations
                            const datesRooms = <?php echo json_encode($datesRooms); ?>;
                            const reservationCountsRooms = <?php echo json_encode($reservationCountsRooms); ?>;

                            // Data passed from PHP for Cottage Reservations
                            const datesCottages = <?php echo json_encode($datesCottages); ?>;
                            const reservationCountsCottages = <?php echo json_encode($reservationCountsCottages); ?>;

                            // Define an array of colors for the lines
                            const colors = [
                                'rgba(255, 99, 132, 0.6)', // Red
                                'rgba(54, 162, 235, 0.6)', // Blue
                                'rgba(255, 206, 86, 0.6)', // Yellow
                                'rgba(75, 192, 192, 0.6)', // Green
                                'rgba(153, 102, 255, 0.6)', // Purple
                                'rgba(255, 159, 64, 0.6)'  // Orange
                            ];

                            // Utility function to get CSS variable
                            function getCSSVariable(name) {
                                return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
                            }

                            // Create Room Reservations line chart
                            const ctxRooms = document.getElementById('roomReservationChart').getContext('2d');
                            const roomReservationChart = new Chart(ctxRooms, {
                                type: 'line',
                                data: {
                                    labels: datesRooms,
                                    datasets: [{
                                        label: 'Number of Reservations',
                                        data: reservationCountsRooms,
                                        borderColor: colors[0], // Red
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Light red
                                        fill: true,
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Room Reservations',
                                            font: {
                                                size: 18
                                            },
                                            color: getCSSVariable('--graph-title-color')
                                        },
                                        legend: {
                                            labels: {
                                                color: getCSSVariable('--legend-text-color')
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: getCSSVariable('--tooltip-bg-color'),
                                            titleColor: getCSSVariable('--tooltip-title-color'),
                                            bodyColor: getCSSVariable('--tooltip-body-color')
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Date of Arrival',
                                                color: getCSSVariable('--axis-title-color')
                                            },
                                            ticks: {
                                                color: getCSSVariable('--axis-ticks-color')
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Reservations',
                                                color: getCSSVariable('--axis-title-color')
                                            },
                                            ticks: {
                                                color: getCSSVariable('--axis-ticks-color')
                                            }
                                        }
                                    }
                                }
                            });

                            // Create Cottage Reservations line chart
                            const ctxCottages = document.getElementById('cottageReservationChart').getContext('2d');
                            const cottageReservationChart = new Chart(ctxCottages, {
                                type: 'line',
                                data: {
                                    labels: datesCottages,
                                    datasets: [{
                                        label: 'Number of Reservations',
                                        data: reservationCountsCottages,
                                        borderColor: colors[1], // Blue
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Light blue
                                        fill: true,
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Cottage Reservations',
                                            font: {
                                                size: 18
                                            },
                                            color: getCSSVariable('--graph-title-color')
                                        },
                                        legend: {
                                            labels: {
                                                color: getCSSVariable('--legend-text-color')
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: getCSSVariable('--tooltip-bg-color'),
                                            titleColor: getCSSVariable('--tooltip-title-color'),
                                            bodyColor: getCSSVariable('--tooltip-body-color')
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Date of Arrival',
                                                color: getCSSVariable('--axis-title-color')
                                            },
                                            ticks: {
                                                color: getCSSVariable('--axis-ticks-color')
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Reservations',
                                                color: getCSSVariable('--axis-title-color')
                                            },
                                            ticks: {
                                                color: getCSSVariable('--axis-ticks-color')
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    <!-- end of bigbox container -->






                </div>
            </div>






        </section>

    </main>



</body>

</html>