<?php
require 'db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'assets.php'; ?>
    <title>Room Reservations</title>

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
                    <label for=""><i class="fa-solid fa-clipboard-list"></i> Room Reservations</label>
                </div>

                <?php include 'icon-container.php'; ?>
            </div>

            <!-- dynamic content -->
            <div class="center-container" style="background-color:white">
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search rooms by room number, type, or status..." onkeyup="filterTable()">
                </div>

                <!-- Room Table -->
                <div class="table-container">
                    <table id="roomTable">
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Bed Type</th>
                                <th>Number of Beds</th>
                                <th>Max Persons</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch rooms from the database
                            $query = "SELECT `id`, `room_number`, `room_type`, `bed_type`, `bed_quantity`, `no_persons`, `price`, `status` , `photo` 
                                      FROM `room_tbl`";
                            $result = $con->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['room_number']}</td>
                                            <td>{$row['room_type']}</td>
                                            <td>{$row['bed_type']}</td>
                                            <td>{$row['bed_quantity']}</td>
                                            <td>{$row['no_persons']}</td>
                                            <td>{$row['price']}</td>
                                            <td>{$row['status']}</td>
                                            <td><img src='{$row['photo']}' alt='Cottage Photo' style='max-width:100px; max-height:50px;'></td>
                                            <td><button class='view-btn' onclick='viewRoomUsers({$row['id']})'><i class='fa-solid fa-eye'></i> View Reservations</button></td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No rooms found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                <div id="reservationModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                        <h2>Users Who Reserved This Room</h2>
                        <div id="reservationDetails">
                            <!-- User details will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

<script>
// JavaScript for search functionality
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const table = document.getElementById('roomTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;
        for (let j = 0; j < cells.length - 1; j++) {
            if (cells[j].textContent.toLowerCase().includes(input)) {
                found = true;
                break;
            }
        }
        rows[i].style.display = found ? '' : 'none';
    }
}

// JavaScript for modal functionality
function viewRoomUsers(roomId) {
    const modal = document.getElementById('reservationModal');
    const reservationDetails = document.getElementById('reservationDetails');
    modal.style.display = 'block';

    // Fetch users who reserved the room via AJAX
    fetch(`fetch_room_users.php?room_id=${roomId}`)
        .then(response => response.text())
        .then(data => {
            reservationDetails.innerHTML = data;
        });
}

function closeModal() {
    const modal = document.getElementById('reservationModal');
    modal.style.display = 'none';
}
</script>

<style>
/* Styles for search bar */
.search-bar {
    margin: 10px 0;
}
.search-bar input {
    width: 300px;
    padding: 10px;
    font-size: 1.5rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
}
#roomTable {
    width: 100%;
    border-collapse: collapse;
}
#roomTable th, #roomTable td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}
#roomTable th {
    background-color: #002334;
    color: white;
}
.view-btn {
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.view-btn:hover {
    background-color: #45a049;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}
.modal-content {
    background-color: #fff;
    margin: 10px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    width: 80%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close-btn:hover, .close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

</html>
