<?php
include('db_connect.php');
session_start();

// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Fetch checked-out reservations from both reserve_room_tbl and reserve_cottage_tbl
$roomQuery = "
    SELECT reserve_id, user_id, status, room_number, room_type, price, date_of_arrival, photo 
    FROM reserve_room_tbl 
    WHERE user_id = $user_id AND status = 'checkedOut'
    ORDER BY date_of_arrival DESC";

$cottageQuery = "
    SELECT reserve_id, user_id, reserve_status, cottage_number, cottage_type, price, date_of_arrival, cottage_photo 
    FROM reserve_cottage_tbl 
    WHERE user_id = $user_id AND reserve_status = 'checkedOut'
    ORDER BY date_of_arrival DESC";

// Execute both queries
$roomResult = mysqli_query($con, $roomQuery);
$cottageResult = mysqli_query($con, $cottageQuery);

// Combine both results into one array
$reservations = [];

while ($row = mysqli_fetch_assoc($roomResult)) {
    $reservations[] = $row;
}

while ($row = mysqli_fetch_assoc($cottageResult)) {
    $reservations[] = $row;
}

// Sort the combined results by date_of_arrival
usort($reservations, function ($a, $b) {
    return strtotime($b['date_of_arrival']) - strtotime($a['date_of_arrival']);
});
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/myReservationRoom.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>History</title>

</head>

<body>

    <button onclick="scrollToTop()" id="scrollToTopBtn"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- for header -->
    <?php include 'header.php' ?>




    <main class="rooms-main-container">
        <div class="wrapper-main">

            <?php if (count($reservations) > 0): ?>
                <?php foreach ($reservations as $reservation) :      ?>
                    
                    <div class="reservation-card">
                        <!-- Display label for Room or Cottage -->
                        <?php if (isset($reservation['room_number'])): ?>

                            <img src="<?php echo str_replace('../', '', $reservation['photo']); ?>" alt="Room Image">
                            <div class="info">
                                <label for="" class="reservation-label" style="background-color: #2980B9;">Room Reservation</label>
                                <p class="title">Room Number: <?php echo $reservation['room_number']; ?> - <?php echo $reservation['room_type']; ?></p>
                                <p class="date">Date of Arrival: <?php echo date('F d, Y', strtotime($reservation['date_of_arrival'])); ?></p>
                                <p >Reservation Status: <?php echo $reservation['status']; ?></p>
                                <a href="viewReservationRoom.php?manage_id=<?php echo $reservation['reserve_id']; ?>"><i class="fa-regular fa-eye"></i> OPEN</a>
                            </div>
                        <?php else: ?>

                            <img src="<?php echo str_replace('../', '', $reservation['cottage_photo']); ?>" alt="Cottage Image">
                            <div class="info">
                                <label for="" class="reservation-label"  style="background-color: red;">Cottage Reservation</label>
                                <p class="title">Cottage Number: <?php echo $reservation['cottage_number']; ?> - <?php echo $reservation['cottage_type']; ?></p>
                                <p class="date">Date of Arrival: <?php echo date('F d, Y', strtotime($reservation['date_of_arrival'])); ?></p>
                                <p >Reservation Status: <?php echo $reservation['reserve_status']; ?></p>
                                <a href="viewReservationCottage.php?manage_id=<?php echo $reservation['reserve_id']; ?>"><i class="fa-regular fa-eye"></i> OPEN</a> 
                            </div>
                        <?php endif; ?>

                        <div class="price">
                            ₱<?php echo number_format($reservation['price'], 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No checked-out reservations found.</p>
            <?php endif; ?>

        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>


<style>
    /* Custom card design */
    .reservation-card {
        display: flex;
        flex-direction: column;
        background: var(--first-color);
        border-radius: 8px;
        padding: 20px;
        margin: 10px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .reservation-card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .reservation-card .info {
        padding: 10px 0;
    }

    .reservation-card .info p {
        margin: 5px 0;
        color: var(--seventh-color);
    }

    .reservation-card .info a {
        font-size: 1.5rem;
        color: var(--seventh-color);
    }

    .reservation-card .info .title {
        font-weight: bold;
        color: var(--seventh-color);
    }

    .reservation-card .info .date {
        color: var(--seventh-color);
    }

    .reservation-card .price {
        font-size: 1.8rem;
        color: #e74c3c;
        font-weight: bold;
    }

    .reservation-card .reservation-label {
        background-color: #2980b9;
        color: #fff;
        padding: 5px 15px;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
        align-self: flex-start;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {

        .reservation-card {
            padding: 15px;
            margin: 5px 0;
        }

        .reservation-card img {
            width: 100%;
            height: auto;
        }


        .reservation-card .info .title {
            font-size: 14px;
        }

        .reservation-card .price {
            font-size: 16px;
        }
    }

    /* PC View Styles */
    @media (min-width: 769px) {

        .reservation-card {
            display: flex;
            flex-direction: row;
            padding: 25px;
        }

    
        .reservation-card img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
        }

        .reservation-card .info {
            flex-grow: 1;
        }

        .reservation-card .info .title {
            font-size: 16px;
        }

        .reservation-card .price {
            font-size: 20px;
        }
    }
</style>