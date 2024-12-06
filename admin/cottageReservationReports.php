    <?php
    require 'db_connect.php';
    session_start();

    // Check for form submission to filter by date range
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

    // Prepare the SQL query with optional date filtering for the reserve details
    $query = "SELECT `reserve_id`, `user_id`, `reserve_status`, `reserve_type`, `first_name`, `middle_name`, `last_name`, 
                    `reserve_address`, `phone_number`, `email`, `date_of_arrival`, `time`, `price`, `payment`, `balance`, 
                    `cottage_number`, `cottage_type`, `number_of_person`, `special_request`, `cottage_photo`, 
                    `reference_number`, `cottage_reserve_fee`, `rejection_reason` 
            FROM `reserve_cottage_tbl` WHERE 1";

    if ($from_date && $to_date) {
        $query .= " AND date_of_arrival BETWEEN ? AND ?";
    }

    $stmt = $con->prepare($query);
    if ($from_date && $to_date) {
        $stmt->bind_param("ss", $from_date, $to_date);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Calculate total income with optional date filter
    $income_query = "SELECT SUM(cottage_reserve_fee + payment) as total_income FROM reserve_cottage_tbl WHERE 1";
    if ($from_date && $to_date) {
        $income_query .= " AND date_of_arrival BETWEEN ? AND ?";
    }
    $income_stmt = $con->prepare($income_query);
    if ($from_date && $to_date) {
        $income_stmt->bind_param("ss", $from_date, $to_date);
    }
    $income_stmt->execute();
    $income_data = $income_stmt->get_result()->fetch_assoc();

    // Calculate total reservations based on the filtered date
    $reservation_query = "SELECT COUNT(*) as total_reservations FROM reserve_cottage_tbl WHERE 1";
    if ($from_date && $to_date) {
        $reservation_query .= " AND date_of_arrival BETWEEN ? AND ?";
    }
    $reservation_stmt = $con->prepare($reservation_query);
    if ($from_date && $to_date) {
        $reservation_stmt->bind_param("ss", $from_date, $to_date);
    }
    $reservation_stmt->execute();
    $reservation_data = $reservation_stmt->get_result()->fetch_assoc();

    // Most reserved cottage calculation
    $most_reserved_query = "SELECT cottage_number, COUNT(cottage_number) as reservation_count 
                            FROM reserve_cottage_tbl 
                            WHERE date_of_arrival BETWEEN ? AND ?
                            GROUP BY cottage_number 
                            ORDER BY reservation_count DESC LIMIT 1";

    $most_reserved_stmt = $con->prepare($most_reserved_query);
    $most_reserved_stmt->bind_param("ss", $from_date, $to_date);
    $most_reserved_stmt->execute();
    $most_reserved_result = $most_reserved_stmt->get_result();

    // Check if there are results
    if ($most_reserved_result && mysqli_num_rows($most_reserved_result) > 0) {
        $most_reserved_cottage = $most_reserved_result->fetch_assoc();
    } else {
        $most_reserved_cottage = ['cottage_number' => 'N/A', 'reservation_count' => 0];
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'assets.php'; ?>
        <title>Cottage Reservation Reports</title>

        <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    </head>

    <body>
        <main>
            <?php include 'sidenav.php'; ?>

            <section class="middle-container">
                <div class="header-container">
                    <div class="title-head">
                        <label><i class="fa-solid fa-clipboard-list"></i> Cottage Reservation Reports</label>
                    </div>
                    <?php include 'icon-container.php' ?>
                </div>

                <div class="center-container" style="background-color: white;">

                    <div class="report-container" id="report-container">

                        <div style="margin-bottom: 10px; ">
                            <h2><i class="fa-solid fa-campground"></i> Estregan Cottage Reservation Reports</h2>
                        </div>

                        <div class="filters">
                            <form method="POST" action="">
                                <label for="from_date">From: </label>
                                <input type="date" id="from_date" name="from_date" value="<?php echo $from_date; ?>">
                                <label for="to_date">To: </label>
                                <input type="date" id="to_date" name="to_date" value="<?php echo $to_date; ?>">
                                <button type="submit">Filter</button>
                            </form>
                        </div>

                        <div class="summary-box">
                            <div>
                                <h3>Total Income</h3>
                                <p><?php echo number_format($income_data['total_income'], 2); ?> PHP</p>
                            </div>
                            <div>
                                <h3>Total Reservations</h3>
                                <p><?php echo $reservation_data['total_reservations']; ?></p>
                            </div>
                            <div>
                                <h3>Most Reserved Cottage No.</h3>
                                <p><?php echo $most_reserved_cottage['cottage_number']; ?></p>
                                <p><?php echo $most_reserved_cottage['reservation_count']; ?> Reservations</p>
                            </div>
                        </div>

                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Reservation ID</th>
                                   
                                      
                                        <th>Type</th>
                                        <th>Date of Arrival</th>
                                        <th>Time</th>
                                        <th>Cottage Number</th>
                                        <th>Cottage Type</th>
                                        <th>Cottage Photo</th>
                                        <th>Price</th>
                                        <th>Cottage Reserve Payment</th>
                                        <th>Payment</th>
                                        <th>Balance</th>
                                        <th>Status</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['reserve_id']; ?></td>
                                         
                                          
                                            <td><?php echo $row['reserve_type']; ?></td>
                                            <td><?php echo $row['date_of_arrival']; ?></td>
                                            <td><?php echo $row['time']; ?></td>
                                            <td><?php echo $row['cottage_number']; ?></td>
                                            <td><?php echo $row['cottage_type']; ?></td>
                                            <td>
                                                <?php if ($row['cottage_photo']): ?>
                                                    <img src="<?php echo $row['cottage_photo']; ?>" alt="Cottage Photo" style="max-width: 30px; max-height: 30px; object-fit: cover;">
                                                <?php else: ?>
                                                    No Image
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo number_format($row['price'], 2); ?> PHP</td>
                                            <td><?php echo number_format($row['cottage_reserve_fee'], 2); ?> PHP</td>
                                            <td><?php echo number_format($row['payment'], 2); ?> PHP</td>
                                            <td><?php echo number_format($row['balance'], 2); ?> PHP</td>
                                            <td><?php echo $row['reserve_status']; ?></td>




                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="no-records">No records found for the selected date range.</div>
                        <?php endif; ?>

                    </div>

                    <!-- for print div -->
                    <div style="text-align: center; margin-bottom: 20px; padding:10px;">
                        <a href="generateCottage_pdf.php?from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>" target="_blank">
                            <button style="padding:5px;"><i class="fa-solid fa-download"></i> Download Report</button>
                        </a>
                    </div>





                </div>


            </section>
        </main>
    </body>

    </html>















    <style>
        .report-container {
            padding: 20px;
            background-color: white;

        }

        .filters {
            margin-bottom: 20px;
        }

        .filters input[type="date"] {
            padding: 8px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .filters button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filters button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #888;
        }

        .summary-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 10px;
        }

        .summary-box div {
            background-color: var(--first-color);
            padding: 10px;
            border-radius: 5px;

            text-align: center;
            flex: 1;
            border: 1px solid var(--box-shadow);

        }


        .summary-box div h3 {
            margin: 0;
            font-size: 1rem;
            color: gray;
        }

        .summary-box div p {
            font-weight: bold;
            font-size: 2rem;
            margin: 5px 0;
            color: gray;
            text-align: center;
            color: var(--seventh-color);
        }
    </style>