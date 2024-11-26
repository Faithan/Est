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

                <?php include 'icon-container.php' ?>
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
                            <label for="">Pending Cottage Reservation <i class="fa-solid fa-campground"></i></label>
                            <?php
                            // Query to count the number of pending cottage reservations
                            $pending_cottage_reservation_query = "SELECT COUNT(*) as pending_cottage_reservations FROM reserve_cottage_tbl WHERE reserve_status = 'pending'";
                            $pending_cottage_reservation_result = mysqli_query($con, $pending_cottage_reservation_query);

                            if ($pending_cottage_reservation_result) {
                                $row = mysqli_fetch_assoc($pending_cottage_reservation_result);
                                $pending_cottage_reservations = $row['pending_cottage_reservations'];
                            } else {
                                $pending_cottage_reservations = 0; // Default value if query fails
                            }
                            ?>

                            <p><?php echo $pending_cottage_reservations; ?></p>
                            <?php if ($pending_cottage_reservations > 0): ?>
                                <span class="red-dot"></span> <!-- Red dot notification -->
                            <?php endif; ?>
                        </div>






                        <!-- Total Cottage Reservation -->
                        <div class="sbox" onclick="window.location.href='dashboardCottageReservation.php';"
                            style="cursor: pointer;">
                            <label for="">Total Cottage Reservation <i class="fa-solid fa-campground"></i></label>
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
                            <label for="">Pending Room Reservation <i class="fa-solid fa-bed"></i></label>
                            <?php
                            // Query to count the number of pending room reservations
                            $pending_room_reservation_query = "SELECT COUNT(*) as pending_room_reservations FROM reserve_room_tbl WHERE status = 'pending'";
                            $pending_room_reservation_result = mysqli_query($con, $pending_room_reservation_query);

                            if ($pending_room_reservation_result) {
                                $row = mysqli_fetch_assoc($pending_room_reservation_result);
                                $pending_room_reservations = $row['pending_room_reservations'];
                            } else {
                                $pending_room_reservations = 0; // Default value if query fails
                            }
                            ?>

                            <p><?php echo $pending_room_reservations; ?></p>
                            <?php if ($pending_room_reservations > 0): ?>
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
                                'rgba(255, 159, 64, 0.6)' // Orange
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



                <div class="reports-base-container">

                    <div class="reports-container">
                        <h1>Short Cottage Reservation Summary</h1>
                        <div class="base-income-container">
                            <?php
                            // Calculate income for cottages based on daily, monthly, and yearly intervals
                            $cottageDailyIncome = $cottageMonthlyIncome = $cottageYearlyIncome = 0;

                            // Query to get daily, monthly, and yearly income for cottages with "checkedOut" status
                            $cottageIncomeQuery = "SELECT price, DATE(date_of_arrival) AS arrival_date 
               FROM reserve_cottage_tbl 
               WHERE reserve_status = 'checkedOut'";
                            $cottageIncomeResult = $con->query($cottageIncomeQuery);

                            if ($cottageIncomeResult->num_rows > 0) {
                                while ($row = $cottageIncomeResult->fetch_assoc()) {
                                    $price = $row['price'];
                                    $arrivalDate = new DateTime($row['arrival_date']);
                                    $today = new DateTime();

                                    // Add to daily income if the arrival date is today
                                    if ($arrivalDate->format('Y-m-d') == $today->format('Y-m-d')) {
                                        $cottageDailyIncome += $price;
                                    }

                                    // Add to monthly income if the arrival date is within the current month
                                    if ($arrivalDate->format('Y-m') == $today->format('Y-m')) {
                                        $cottageMonthlyIncome += $price;
                                    }

                                    // Add to yearly income if the arrival date is within the current year
                                    if ($arrivalDate->format('Y') == $today->format('Y')) {
                                        $cottageYearlyIncome += $price;
                                    }
                                }
                            }
                            ?>
                            <div class="income-container">
                                <h2>Daily Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($cottageDailyIncome, 2); ?></p>

                            </div>
                            <div class="income-container">
                                <h2>Monthly Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($cottageMonthlyIncome, 2); ?></p>

                            </div>
                            <div class="income-container">
                                <h2>Yearly Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($cottageYearlyIncome, 2); ?></p>
                            </div>

                            <div class="income-container">
                                <h2>Total Income <i class="fa-solid fa-coins"></i></h2>
                                <?php
                                // Query to calculate the total income from checked-out cottage reservations
                                $totalIncomeCottagesQuery = "SELECT SUM(price) AS total_income FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut'";
                                $totalIncomeCottagesResult = $con->query($totalIncomeCottagesQuery);

                                if ($totalIncomeCottagesResult) {
                                    $incomeData = $totalIncomeCottagesResult->fetch_assoc();
                                    $totalIncome = $incomeData['total_income'] ?? 0;
                                    echo "<p>PHP " . number_format($totalIncome, 2) . "</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>
                            <div class="income-container">
                                <h2>Daily Checkouts <i class="fa-solid fa-campground"></i></h2>
                                <?php
                                // Query to count daily checked-out cottage reservations
                                $dailyCheckedOutCottagesQuery = "SELECT COUNT(*) AS daily_checked_out 
                 FROM reserve_cottage_tbl 
                 WHERE reserve_status = 'checkedOut' 
                 AND DATE(date_of_arrival) = CURDATE()";
                                $dailyCheckedOutCottagesResult = $con->query($dailyCheckedOutCottagesQuery);

                                if ($dailyCheckedOutCottagesResult) {
                                    $dailyCheckedOut = $dailyCheckedOutCottagesResult->fetch_assoc();
                                    echo "<p> {$dailyCheckedOut['daily_checked_out']}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>

                            <div class="income-container">
                                <h2>Monthly Checkouts <i class="fa-solid fa-campground"></i></h2>
                                <?php
                                // Query to count the number of checked-out cottages for the current month
                                $monthlyCheckedOutCottagesQuery = "SELECT COUNT(*) AS monthly_checked_out FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut' AND MONTH(date_of_arrival) = MONTH(CURDATE()) AND YEAR(date_of_arrival) = YEAR(CURDATE())";
                                $monthlyCheckedOutCottagesResult = $con->query($monthlyCheckedOutCottagesQuery);

                                if ($monthlyCheckedOutCottagesResult) {
                                    $monthlyData = $monthlyCheckedOutCottagesResult->fetch_assoc();
                                    $monthlyCheckedOut = $monthlyData['monthly_checked_out'] ?? 0;
                                    echo "<p> {$monthlyCheckedOut}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>

                            <div class="income-container">
                                <h2>Yearly Checkouts <i class="fa-solid fa-campground"></i></h2>
                                <?php
                                // Query to count the number of checked-out cottages for the current year
                                $yearlyCheckedOutCottagesQuery = "SELECT COUNT(*) AS yearly_checked_out FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut' AND YEAR(date_of_arrival) = YEAR(CURDATE())";
                                $yearlyCheckedOutCottagesResult = $con->query($yearlyCheckedOutCottagesQuery);

                                if ($yearlyCheckedOutCottagesResult) {
                                    $yearlyData = $yearlyCheckedOutCottagesResult->fetch_assoc();
                                    $yearlyCheckedOut = $yearlyData['yearly_checked_out'] ?? 0;
                                    echo "<p> {$yearlyCheckedOut}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>


                            <div class="income-container">
                                <h2>Total Checkouts <i class="fa-solid fa-campground"></i></h2>
                                <?php
                                // Query to count checked-out cottage reservations
                                $totalCheckedOutCottagesQuery = "SELECT COUNT(*) AS total_checked_out FROM reserve_cottage_tbl WHERE reserve_status = 'checkedOut'";
                                $totalCheckedOutCottagesResult = $con->query($totalCheckedOutCottagesQuery);

                                if ($totalCheckedOutCottagesResult) {
                                    $checkedOutCottage = $totalCheckedOutCottagesResult->fetch_assoc();
                                    echo "<p>{$checkedOutCottage['total_checked_out']}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>


                        </div>
                        <?php
                        // Query to fetch checked-out cottage reservations
                        $cottageQuery = "SELECT * 
 FROM reserve_cottage_tbl 
 WHERE reserve_status = 'checkedOut'";
                        $cottageResult = $con->query($cottageQuery);

                        if ($cottageResult->num_rows > 0) {
                            while ($row = $cottageResult->fetch_assoc()) {
                                echo "
<div class='report-card'>
<p><strong>Reservation id:</strong> {$row['reserve_id']}</p>
<p><strong>Guest:</strong> {$row['first_name']} {$row['last_name']}</p>
<p><strong>Checked-in Date:</strong> {$row['date_of_arrival']}</p>
<p style='color:green;'><strong>Status:</strong> Checked Out</p>
<p><strong>Income:</strong> PHP " . number_format($row['price'], 2) . "</p>
</div>";
                            }
                        } else {
                            echo "<p>No checked-out cottage reservations.</p>";
                        }
                        ?>
                    </div>

                    <div class="reports-container">
                        <h1>Short Room Reservation Summary</h1>
                        <div class="base-income-container">
                            <?php
                            // Calculate income for rooms based on daily, monthly, and yearly intervals
                            $roomDailyIncome = $roomMonthlyIncome = $roomYearlyIncome = 0;

                            // Query to get daily, monthly, and yearly income for rooms with "checkedOut" status
                            $roomIncomeQuery = "SELECT price, extend_price, DATE(date_of_arrival) AS arrival_date 
            FROM reserve_room_tbl 
            WHERE status = 'checkedOut'";
                            $roomIncomeResult = $con->query($roomIncomeQuery);

                            if ($roomIncomeResult->num_rows > 0) {
                                while ($row = $roomIncomeResult->fetch_assoc()) {
                                    $price = $row['price'] + ($row['extend_price'] ?? 0);
                                    $arrivalDate = new DateTime($row['arrival_date']);
                                    $today = new DateTime();

                                    // Add to daily income if the arrival date is today
                                    if ($arrivalDate->format('Y-m-d') == $today->format('Y-m-d')) {
                                        $roomDailyIncome += $price;
                                    }

                                    // Add to monthly income if the arrival date is within the current month
                                    if ($arrivalDate->format('Y-m') == $today->format('Y-m')) {
                                        $roomMonthlyIncome += $price;
                                    }

                                    // Add to yearly income if the arrival date is within the current year
                                    if ($arrivalDate->format('Y') == $today->format('Y')) {
                                        $roomYearlyIncome += $price;
                                    }
                                }
                            }
                            ?>
                            <div class="income-container">
                                <h2>Daily Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($roomDailyIncome, 2); ?> </p>

                            </div>
                            <div class="income-container">
                                <h2>Monthly Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($roomMonthlyIncome, 2); ?></p>
                            </div>
                            <div class="income-container">
                                <h2>Yearly Income <i class="fa-solid fa-coins"></i></h2>
                                <p>PHP <?php echo number_format($roomYearlyIncome, 2); ?></p>
                            </div>
                            <div class="income-container">
                                <h2>Total Income <i class="fa-solid fa-coins"></i></h2>
                                <?php
                                // Query to calculate the total income from checked-out room reservations, including extended prices
                                $totalIncomeRoomsQuery = "SELECT SUM(price + IFNULL(extend_price, 0)) AS total_income FROM reserve_room_tbl WHERE status = 'checkedOut'";
                                $totalIncomeRoomsResult = $con->query($totalIncomeRoomsQuery);

                                if ($totalIncomeRoomsResult) {
                                    $incomeData = $totalIncomeRoomsResult->fetch_assoc();
                                    $totalIncome = $incomeData['total_income'] ?? 0;
                                    echo "<p>PHP " . number_format($totalIncome, 2) . "</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>

                            <div class="income-container">
                                <h2>Daily Checkouts <i class="fa-solid fa-bed"></i></h2>
                                <?php
                                // Query to count the number of checked-out rooms for today
                                $dailyCheckedOutRoomsQuery = "SELECT COUNT(*) AS daily_checked_out FROM reserve_room_tbl WHERE status = 'checkedOut' AND DATE(date_of_arrival) = CURDATE()";
                                $dailyCheckedOutRoomsResult = $con->query($dailyCheckedOutRoomsQuery);

                                if ($dailyCheckedOutRoomsResult) {
                                    $dailyData = $dailyCheckedOutRoomsResult->fetch_assoc();
                                    $dailyCheckedOut = $dailyData['daily_checked_out'] ?? 0;
                                    echo "<p> {$dailyCheckedOut}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>

                            <div class="income-container">
                                <h2>Monthly Checkouts <i class="fa-solid fa-bed"></i></h2>
                                <?php
                                // Query to count the number of checked-out rooms for the current month
                                $monthlyCheckedOutRoomsQuery = "SELECT COUNT(*) AS monthly_checked_out FROM reserve_room_tbl WHERE status = 'checkedOut' AND MONTH(date_of_arrival) = MONTH(CURDATE()) AND YEAR(date_of_arrival) = YEAR(CURDATE())";
                                $monthlyCheckedOutRoomsResult = $con->query($monthlyCheckedOutRoomsQuery);

                                if ($monthlyCheckedOutRoomsResult) {
                                    $monthlyData = $monthlyCheckedOutRoomsResult->fetch_assoc();
                                    $monthlyCheckedOut = $monthlyData['monthly_checked_out'] ?? 0;
                                    echo "<p> {$monthlyCheckedOut}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>

                            <div class="income-container">
                                <h2>Yearly Checkouts <i class="fa-solid fa-bed"></i></h2>
                                <?php
                                // Query to count the number of checked-out rooms for the current year
                                $yearlyCheckedOutRoomsQuery = "SELECT COUNT(*) AS yearly_checked_out FROM reserve_room_tbl WHERE status = 'checkedOut' AND YEAR(date_of_arrival) = YEAR(CURDATE())";
                                $yearlyCheckedOutRoomsResult = $con->query($yearlyCheckedOutRoomsQuery);

                                if ($yearlyCheckedOutRoomsResult) {
                                    $yearlyData = $yearlyCheckedOutRoomsResult->fetch_assoc();
                                    $yearlyCheckedOut = $yearlyData['yearly_checked_out'] ?? 0;
                                    echo "<p> {$yearlyCheckedOut}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>





                            <div class="income-container">
                                <h2>Total Checkouts <i class="fa-solid fa-bed"></i></h2>
                                <?php
                                // Query to count checked-out room reservations
                                $totalCheckedOutRoomsQuery = "SELECT COUNT(*) AS total_checked_out FROM reserve_room_tbl WHERE status = 'checkedOut'";
                                $totalCheckedOutRoomsResult = $con->query($totalCheckedOutRoomsQuery);

                                if ($totalCheckedOutRoomsResult) {
                                    $checkedOutRoom = $totalCheckedOutRoomsResult->fetch_assoc();
                                    echo "<p> {$checkedOutRoom['total_checked_out']}</p>";
                                } else {
                                    echo "<p>No data available.</p>";
                                }
                                ?>
                            </div>



                        </div>
                        <?php
                        // Query to fetch checked-out room reservations
                        $roomQuery = "SELECT *
FROM reserve_room_tbl 
WHERE status = 'checkedOut'";
                        $roomResult = $con->query($roomQuery);

                        if ($roomResult->num_rows > 0) {
                            while ($row = $roomResult->fetch_assoc()) {
                                // Calculate total price including extended price if present
                                $totalPrice = $row['price'] + ($row['extend_price'] ?? 0);

                                echo "
<div class='report-card'>
<p><strong>Reservation id:</strong> {$row['reserve_id']}</p>
<p><strong>Guest:</strong> {$row['fname']} {$row['lname']}</p>
<p><strong>Checked-in Date:</strong> {$row['date_of_arrival']}</p>
<p style='color:green;'><strong >Status:</strong> Checked Out</p>
<p><strong>Income:</strong> PHP " . number_format($totalPrice, 2) . "</p>
</div>";
                            }
                        } else {
                            echo "<p>No checked-out room reservations.</p>";
                        }
                        ?>
                    </div>


                </div>

                <style>
                    .base-income-container {
                        display: flex;
                        flex-direction: row;
                        flex-wrap: wrap;
                        gap: 5px;
                    }

                    .income-container {
                        border: 1px dashed var(--box-shadow);
                        padding: 10px;
                        flex-grow: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        border-radius: 5px;

                    }

                    .income-container h2 {
                        font-size: 1.2rem;
                        color: var(--seventh-color);
                    }

                    .income-container p {
                        font-size: 1.1rem;
                    }

                    /* Report Card Styling */
                    .report-card {
                        background-color: var(--first-color);
                        border: 1px dashed var(--box-shadow);
                        border-top-left-radius: 5px solid Green;
                        padding: 10px;
                        border-left: 5px solid orange;
                        border-radius: 5px;

                    }

                    .report-card p {

                        color: gray;
                        font-size: 1.2rem;
                    }

                    .report-card p strong {
                        color: var(--seventh-color);


                    }

                    .reports-base-container {
                        display: flex;
                        flex-direction: row;
                        justify-content: space-between;
                        padding: 10px;
                        gap: 10px;

                    }

                    .reports-container {
                        flex-grow: 1;
                        background-color: var(--first-color);
                        padding: 10px;
                        border: 1px solid var(--box-shadow);
                        display: flex;
                        flex-direction: column;
                        gap: 5px;
                        overflow-y: scroll;
                        min-height: 600px;
                        max-height: 600px;

                    }

                    .reports-container h1 {
                        text-align: center;
                        font-size: 2rem;
                        color: var(--pure-white);
                        background-color: var(--eight-color);
                        padding: 5px;
                        border: 1px solid var(--box-shadow);
                        position: sticky;
                        top: 0;
                        z-index: 999;
                    }
                </style>




                <!-- center contianer -->
            </div>

        </section>

    </main>



</body>

</html>