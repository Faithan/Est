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

    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="rooms_cottages.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="fullscreen.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Rooms/Cottages</title>
    <script src="javascripts/fullscreen.js" defer></script>
</head>

<body>
    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
        </nav>
    </div>

    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">ROOMS</label>
            </div>

            <div class="table-container">
                <table>
                    <tr>
                        <th>Room Id</th>
                        <th>Room Type</th>
                        <th>Bed Type</th>
                        <th>Bed Quantity</th>
                        <th>No. Person</th>
                        <th>Amenities</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Action</td>
                    </tr>

                    <?php $fetchdata = "SELECT * FROM room_tbl ORDER BY id DESC" ;
                    $result = mysqli_query($con, $fetchdata);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
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
                            <td><?php echo $id ?></td>
                            <td><?php echo $roomType ?></td>
                            <td><?php echo $bedType ?></td>
                            <td><?php echo $bed_quantity ?></td>
                            <td><?php echo $noPersons ?></td>
                            <td><?php echo $amenities ?></td>
                            <td><?php echo $price ?></td>
                            <td><?php echo $status ?></td>
                            <td><img class="room-image" onclick="openFullScreen()" src="<?php echo $photo ?>"></td>

                            <td class="td2">
                                <button class="edit-btn" type="submit" name="manage"><a
                                        href="edit_room.php?manage_id=<?php echo $id; ?>"><i
                                            class="fa-solid fa-pen-to-square"></i>Edit</a></button>
                                <button class="delete-btn" type="submit" name="manage"><a
                                        href="requestlist.php?manage_id=<?php echo $id; ?>"><i class="fa-solid fa-trash"></i>Delete</a></button>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
        </div>
        
    </div>


    <!-- for fullscreen -->
    <div id="fullscreen-overlay">
        <span class="close" onclick="closeFullScreen()">&times;</span>
        <img id="fullscreen-image" src="" alt="">
    </div>
</body>

</html>