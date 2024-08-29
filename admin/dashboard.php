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



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">
                <div class="second-container">
                    <div class="smallbox-container">
                        <!-- Total Revenue -->
                        <div class="sbox">
                            <label for="">Total Revenue</label>
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
                            <label for="">Total Cottage Revenue</label>
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
                            <label for="">Total Room Revenue</label>
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



                        <div class="sbox">
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
                        </div>






                        <div class="sbox">
                            <label for="">Total User</label>
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

                            // Define an array of colors for the bars
                            const colors = [
                                'rgba(255, 99, 132, 0.6)', // Red
                                'rgba(54, 162, 235, 0.6)', // Blue
                                'rgba(255, 206, 86, 0.6)', // Yellow
                                'rgba(75, 192, 192, 0.6)', // Green
                                'rgba(153, 102, 255, 0.6)', // Purple
                                'rgba(255, 159, 64, 0.6)'  // Orange
                            ];

                            // Create Room Reservations chart
                            const ctxRooms = document.getElementById('roomReservationChart').getContext('2d');
                            const roomReservationChart = new Chart(ctxRooms, {
                                type: 'bar',
                                data: {
                                    labels: datesRooms,
                                    datasets: [{
                                        label: 'Number of Reservations',
                                        data: reservationCountsRooms,
                                        backgroundColor: function (context) {
                                            const index = context.dataIndex % colors.length;
                                            return colors[index];
                                        },
                                        borderColor: 'rgba(0, 0, 0, 0.1)',
                                        borderWidth: 1,
                                        borderRadius: 10 // Rounded corners on bars
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
                                            color: 'var(--text-color)' // Editable via CSS
                                        },
                                        legend: {
                                            labels: {
                                                color: 'var(--text-color)' // Editable via CSS
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: '#333',
                                            titleColor: '#fff',
                                            bodyColor: '#fff'
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Date of Arrival',
                                                color: 'var(--text-color)' // Editable via CSS
                                            },
                                            ticks: {
                                                color: 'var(--text-color)' // Editable via CSS
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Reservations',
                                                color: 'var(--text-color)' // Editable via CSS
                                            },
                                            ticks: {
                                                color: 'var(--text-color)' // Editable via CSS
                                            }
                                        }
                                    }
                                }
                            });

                            // Create Cottage Reservations chart
                            const ctxCottages = document.getElementById('cottageReservationChart').getContext('2d');
                            const cottageReservationChart = new Chart(ctxCottages, {
                                type: 'bar',
                                data: {
                                    labels: datesCottages,
                                    datasets: [{
                                        label: 'Number of Reservations',
                                        data: reservationCountsCottages,
                                        backgroundColor: function (context) {
                                            const index = context.dataIndex % colors.length;
                                            return colors[index];
                                        },
                                        borderColor: 'rgba(0, 0, 0, 0.1)',
                                        borderWidth: 1,
                                        borderRadius: 10 // Rounded corners on bars
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
                                            color: 'var(--text-color)' // Editable via CSS
                                        },
                                        legend: {
                                            labels: {
                                                color: 'var(--text-color)' // Editable via CSS
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: '#333',
                                            titleColor: '#fff',
                                            bodyColor: '#fff'
                                        }
                                    },
                                    scales: {
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Date of Arrival',
                                                color: 'var(--text-color)' // Editable via CSS
                                            },
                                            ticks: {
                                                color: 'var(--text-color)' // Editable via CSS
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Number of Reservations',
                                                color: 'var(--text-color)' // Editable via CSS
                                            },
                                            ticks: {
                                                color: 'var(--text-color)' // Editable via CSS
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