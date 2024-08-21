<?php
include('db_connect.php');



if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}



?>


<script src="javascripts/logout.js" defer></script>

<link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="css/fullscreen.css?v=<?php echo time(); ?>">
<link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
<script src="javascripts/fullscreen.js" defer></script>





    <div class="container">
        <div class="header-label">
            <label for=""><i class="fa-solid fa-bed"></i> ROOMS</label>
        </div>

        <div class="under-buttons-container">
            <div class="select-type">
                <label for="">Type of Room:</label>
                <select name="" id="">
                    <option value="all">All</option>
                    <option value="walk-in">Walk-in</option>
                    <option value="online">Online</option>
                </select>
            </div>

            <div>
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="search-input">
                </div>
            </div>

            <div class="add-reservation">
                <button onclick="window.location.href = 'room_adding.php'" name="add-reservation"><i
                        class="fa-solid fa-plus"></i> ADD ROOM</button>
            </div>
        </div>



        <form method="post" action="" >
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

                        <td class="edit-btn-holder">
                            <div class="edit-btn">
                                <a name="manage" href="edit_room.php?manage_id=<?php echo $id; ?>"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </div>


                        </td>
                    </tr>

                <?php } ?>
            </table>
        </form>
    </div>


    <!-- for fullscreen -->
    <div id="fullscreen-overlay">
        <span class="close" onclick="closeFullScreen()">&times;</span>
        <img id="fullscreen-image" src="" alt="">
    </div>