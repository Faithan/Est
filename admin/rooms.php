<?php
include ('db_connect.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:../login.php');
    exit();
}



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
    
    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <script src="javascripts/logout.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">
   
    <link rel="stylesheet" type="text/css" href="css/rooms.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/fullscreen.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Rooms</title>
    <script src="javascripts/fullscreen.js" defer></script>
</head>

<body>


    <?php
    include 'header.php'
        ?>


    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">ROOMS</label>
            </div>

            <form method="post" action="" class="table-container">
                <table>
                    <tr>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Bed Type</th>
                        <th>Bed Quantity</th>
                        <th>No. Person</th>
                        <th>Amenities</th>
                        <th>Price (Good for 22hrs)</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Action</td>
                    </tr>

                    <?php $fetchdata = "SELECT * FROM room_tbl ORDER BY id DESC";
                    $result = mysqli_query($con, $fetchdata);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $roomNumber = $row['room_number'];
                        $roomType = $row['room_type'];
                        $bedType = $row['bed_type'];
                        $bed_quantity = $row['bed_quantity'];
                        $noPersons = $row['no_persons'];
                        $amenities = $row['amenities'];
                        $price = $row['price'];
                        $status = $row['status'];
                        $photo = $row['photo'];
                        ?>
                        <tr>
                            <td><?php echo $roomNumber ?></td>
                            <td><?php echo $roomType ?></td>
                            <td><?php echo $bedType ?></td>
                            <td><?php echo $bed_quantity ?></td>
                            <td><?php echo $noPersons ?></td>
                            <td><?php echo $amenities ?></td>
                            <td><?php echo $price ?></td>
                            <td><?php echo $status ?></td>
                            <td><img class="room-image" onclick="openFullScreen()" src="<?php echo $photo ?>"></td>

                            <td class="td2">
                                <a class="edit-btn" name="manage" href="edit_room.php?manage_id=<?php echo $id; ?>"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <!-- <button class="delete-btn" type="submit" name="delete"><i
                                        class="fa-solid fa-trash"></i>Delete</button> -->
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </form>
        </div>

    </div>


    <!-- for fullscreen -->
    <div id="fullscreen-overlay">
        <span class="close" onclick="closeFullScreen()">&times;</span>
        <img id="fullscreen-image" src="" alt="">
    </div>
</body>

</html>