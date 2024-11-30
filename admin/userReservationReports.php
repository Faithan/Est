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
    <title>User Reports</title>

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
                    <label for=""><i class="fa-solid fa-user-gear"></i> User Reservation Reports</label>
                </div>

                <?php include 'icon-container.php'; ?>
            </div>

            <!-- dynamic content -->
            <div class="center-container" style="background-color:white">
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search users by name, email, or contact..." onkeyup="filterTable()">
                </div>

                <!-- User Table -->
                <div class="table-container">
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Account Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch users from the database
                            $query = "SELECT `id`, `full_name`, `contact_number`, `email`, `gender`, `birthdate`, `address`, `date_created`, `account_status` FROM `user_tbl`";
                            $result = $con->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['full_name']}</td>
                                            <td>{$row['contact_number']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['gender']}</td>
                                            <td>{$row['birthdate']}</td>
                                            <td>{$row['address']}</td>
                                            <td>{$row['account_status']}</td>
                                            <td><button class='view-btn' onclick='viewReservations({$row['id']})'><i class='fa-solid fa-eye'></i> View Reservations</button></td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal -->
                <div id="reservationModal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                        <h2>User Reservations</h2>
                        <div id="reservationDetails">
                            <!-- Cottage and Room Reservations will be dynamically loaded here -->
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
    const table = document.getElementById('userTable');
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
function viewReservations(userId) {
    const modal = document.getElementById('reservationModal');
    const reservationDetails = document.getElementById('reservationDetails');
    modal.style.display = 'block';

    // Fetch user reservations via AJAX
    fetch(`fetch_reservations.php?user_id=${userId}`)
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
#userTable {
    width: 100%;
    border-collapse: collapse;
}
#userTable th, #userTable td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}
#userTable th {
    background-color: #002334;
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
