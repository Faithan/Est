<?php
require 'db_connect.php';
session_start();

// Check for form submission to filter by date range
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

// Prepare the SQL query with optional date filtering for room reservation details
$query = "SELECT 
            `reserve_id`, 
            `user_id`, 
            `status`, 
            `reservation_type`, 
            `fname`, 
            `mname`, 
            `lname`, 
            `address`, 
            `phone_number`, 
            `email`, 
            `date_of_arrival`, 
            `time_of_arrival`, 
            `room_number`, 
            `room_type`, 
            `bed_type`, 
            `bed_quantity`, 
            `number_of_person`, 
            `amenities`, 
            `price`, 
            `special_request`, 
            `photo`, 
            `reference_number`, 
            `reservation_fee`, 
            `extra_bed_and_person`, 
            `total_fee`, 
            `payment`, 
            `balance`, 
            `extend_time`, 
            `extend_price`, 
            `additional_payment`, 
            `time_out`, 
            `rejection_reason`
          FROM `reserve_room_tbl` WHERE 1";

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
$income_query = "SELECT SUM(reservation_fee + payment + additional_payment) as total_income 
                 FROM reserve_room_tbl WHERE 1";
if ($from_date && $to_date) {
    $income_query .= " AND date_of_arrival BETWEEN ? AND ?";
}
$income_stmt = $con->prepare($income_query);
if ($from_date && $to_date) {
    $income_stmt->bind_param("ss", $from_date, $to_date);
}
$income_stmt->execute();
$income_data = $income_stmt->get_result()->fetch_assoc();

// Calculate total reservations based on filtered date range
$total_reservations_query = "SELECT COUNT(*) as total_reservations 
                             FROM reserve_room_tbl WHERE 1";
if ($from_date && $to_date) {
    $total_reservations_query .= " AND date_of_arrival BETWEEN ? AND ?";
}
$total_reservations_stmt = $con->prepare($total_reservations_query);
if ($from_date && $to_date) {
    $total_reservations_stmt->bind_param("ss", $from_date, $to_date);
}
$total_reservations_stmt->execute();
$total_reservations_data = $total_reservations_stmt->get_result()->fetch_assoc();

// Most reserved room calculation (unaffected by filter date)
$most_reserved_query = "SELECT room_number, COUNT(room_number) as reservation_count 
                        FROM reserve_room_tbl 
                        GROUP BY room_number 
                        ORDER BY reservation_count DESC LIMIT 1";
$most_reserved_result = $con->query($most_reserved_query);
$most_reserved_room = $most_reserved_result->fetch_assoc();
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


    <title>Room Reservation Reports</title>
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
                    <label><i class="fa-solid fa-clipboard-list"></i> Room Reservation Reports</label>
                </div>
                <?php include 'icon-container.php' ?>
            </div>

            <div class="center-container" style="background-color: white;">
                <div id="center-container">
                    <div class="report-container" id="report-container">

                        <div style="margin-bottom: 10px; ">
                            <h2><i class="fa-solid fa-bed"></i> Estregan Room Reservation Reports</h2>
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
                                <h3>Total Income (Filtered)</h3>
                                <p>
                                    <?php echo $income_data ? number_format($income_data['total_income'], 2) : '0.00'; ?> PHP
                                </p>
                            </div>
                            <div>
                                <h3>Total Reservations (Filtered)</h3>
                                <p>
                                    <?php echo $total_reservations_data ? $total_reservations_data['total_reservations'] : '0'; ?>
                                </p>
                            </div>
                            <div>
                                <h3>Most Reserved Room No.</h3>
                                <p>
                                    <?php echo $most_reserved_room ? $most_reserved_room['room_number'] : 'N/A'; ?>
                                </p>
                                <p>
                                    <?php echo $most_reserved_room ? $most_reserved_room['reservation_count'] . ' Reservations' : 'N/A'; ?>
                                </p>
                            </div>
                        </div>

                        <div class="data-table">
                            <table class="reservation-data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reservation Type</th>
                                        <th>Date</th>
                                        <th>Room Number</th>
                                        <th>Photo</th>
                                        <th>Extra B&P</th>
                                        <th>Reservation Payment</th>
                                        <th>Payment</th>
                                        <th>Additional Payment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row['reserve_id']; ?></td>
                                                <td><?php echo $row['reservation_type']; ?></td>
                                                <td><?php echo $row['date_of_arrival']; ?></td>
                                                <td><?php echo $row['room_number']; ?></td>
                                                <td>
                                                    <?php if (!empty($row['photo'])): ?>
                                                        <img src="<?php echo $row['photo']; ?>" alt="Room Photo" style="width: 50px; height: auto;">
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $row['extra_bed_and_person']; ?></td>
                                                <td><?php echo number_format($row['reservation_fee'], 2); ?> PHP</td>
                                                <td><?php echo number_format($row['payment'], 2); ?> PHP</td>
                                                <td><?php echo number_format($row['additional_payment'], 2); ?> PHP</td>
                                                <td><?php echo $row['status']; ?></td>


                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="33">No data available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                <!-- for print div -->
                <div style="text-align: center; margin-bottom: 20px; padding:10px;">
                    <a href="generateRoom_pdf.php?from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>" target="_blank">
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
        border: 1px solid var(--box-shadow);
        flex-grow: 1;
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