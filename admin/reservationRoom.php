<?php
require('db_connect.php');


?>


<div class="container">
    <div class="header-label">
        <label><i class="fa-solid fa-bed"></i> Reservation For Rooms</label>
    </div>

    <div class="buttons-container">
        <button onclick="showTable(0, 0)" id="pending-btn" class="pending-btn"><i
                class="fa-solid fa-hourglass-half"></i> Pendings</button>
        <button onclick="showTable(1, 1)" id="confirmed-btn"><i class="fa-regular fa-calendar-check"></i>
            Confirmed</button>
        <button onclick="showTable(2, 2)" id="checkedIn-btn"><i class="fa-solid fa-check-to-slot"></i> Checked
            In</button>
        <button onclick="showTable(3, 3)" id="extended-btn"><i class="fa-solid fa-hourglass-start"></i> Extended
            Stay</button>
        <button onclick="showTable(4, 4)" id="checkedOut-btn"><i class="fa-solid fa-user-check"></i> Checked
            Out</button>
        <button onclick="showTable(5, 5)" id="rejected-btn" class="rejected-btn"><i class="fa-solid fa-user-xmark"></i>
            Rejected</button>
    </div>

    <div class="under-buttons-container">
        <div class="select-type">
            <label>Type of Reservation:</label>
            <select>
                <option value="all">All</option>
                <option value="walk-in">Walk-in</option>
                <option value="online">Online</option>
            </select>
        </div>

        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                    </path>
                </g>
            </svg>
            <input type="search" class="search-input" placeholder="Search">
        </div>

        <div class="add-reservation">
            <label><em>For Walk-in <i class="fa-solid fa-hand-point-left fa-flip-horizontal"></i></em></label>
            <button name="add-reservation"><i class="fa-solid fa-plus"></i> ADD RESERVATION</button>
        </div>
    </div>

    <?php
    function renderTable($con, $status)
    {
        $fetchdata = "SELECT * FROM reserve_room_tbl WHERE status='$status' ORDER BY reserve_id DESC";
        $result = mysqli_query($con, $fetchdata);

        echo '<form method="post" action=""  id="table-container-' . $status . '">';
        echo '<table><tr>
            <th>Reserve ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Date of Arrival</th>
            <th>Room Type</th>
            <th>Bed Type</th>
            <th>Bed Quantity</th>
            <th>Number of Person</th>
            <th>Amenities</th>
            <th>Price (Good for 22 hours)</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                <td>' . $row['reserve_id'] . '</td>
                <td>' . $row['fname'] . '</td>
                <td>' . $row['lname'] . '</td>
                <td>' . $row['address'] . '</td>
                <td>' . $row['phone_number'] . '</td>
                <td class="email">' . $row['email'] . '</td>
                <td>' . $row['date_of_arrival'] . '</td>
                <td>' . $row['room_type'] . '</td>
                <td>' . $row['bed_type'] . '</td>
                <td>' . $row['bed_quantity'] . '</td>
                <td>' . $row['number_of_person'] . '</td>
                <td>' . $row['amenities'] . '</td>
                <td>' . $row['price'] . '</td>
                <td class="table-image-container"><img class="reservation-image" onclick="openFullScreen()" src="' . $row['photo'] . '"></td>
                <td class="edit-btn" ><a href="room_' . $status . '.php?manage_id=' . $row['reserve_id'] . '"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
            </tr>';
        }

        echo '</table></form>';
    }

    renderTable($con, 'pending');
    renderTable($con, 'confirmed');
    renderTable($con, 'checkedIn');
    renderTable($con, 'extended');
    renderTable($con, 'checkedOut');
    renderTable($con, 'rejected');
    ?>

</div>


<script>
    function showTable(tableIndex, buttonIndex) {
        // Array of table and button IDs
        const tables = ["table-container-pending", "table-container-confirmed", "table-container-checkedIn", "table-container-extended", "table-container-checkedOut", "table-container-rejected"];
        const buttons = ["pending-btn", "confirmed-btn", "checkedIn-btn", "extended-btn", "checkedOut-btn", "rejected-btn"];
        const colors = { active: 'white', inactive: '#002334', rejectedActive: '#650000', rejectedInactive: 'white' };

        // Set table display
        tables.forEach((table, index) => {
            document.getElementById(table).style.display = index === tableIndex ? "block" : "none";
        });

        // Set button styles
        buttons.forEach((button, index) => {
            const btnElement = document.getElementById(button);
            if (index === buttonIndex) {
                btnElement.style.backgroundColor = button === "rejected-btn" ? colors.rejectedInactive : colors.active;
                btnElement.style.color = button === "rejected-btn" ? colors.rejectedActive : colors.inactive;
            } else {
                btnElement.style.backgroundColor = colors.inactive;
                btnElement.style.color = colors.active;
            }
        });

        // Store active table in localStorage
        localStorage.setItem('activeTable', tables[tableIndex]);
    }

    window.onload = function () {
        const activeTableMap = {
            "table-container-pending": 0,
            "table-container-confirmed": 1,
            "table-container-checkedIn": 2,
            "table-container-extended": 3,
            "table-container-checkedOut": 4,
            "table-container-rejected": 5
        };

        const activeTable = localStorage.getItem('activeTable');
        console.log('Active Table from LocalStorage:', activeTable);  // Debugging line
        if (activeTable && activeTableMap.hasOwnProperty(activeTable)) {
            showTable(activeTableMap[activeTable], activeTableMap[activeTable]);
        }
    };

    // Attach functions to buttons
    document.getElementById("pending-btn").onclick = () => showTable(0, 0);
    document.getElementById("confirmed-btn").onclick = () => showTable(1, 1);
    document.getElementById("checkedIn-btn").onclick = () => showTable(2, 2);
    document.getElementById("extended-btn").onclick = () => showTable(3, 3);
    document.getElementById("checkedOut-btn").onclick = () => showTable(4, 4);
    document.getElementById("rejected-btn").onclick = () => showTable(5, 5);
</script>


