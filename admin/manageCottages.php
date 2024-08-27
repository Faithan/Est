<?php
include('db_connect.php');
?>

<link rel="stylesheet" type="text/css" href="css/fullscreen.css?v=<?php echo time(); ?>">
<link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
<script src="javascripts/fullscreen.js" defer></script>

<div class="container">
    <div class="header-label">
        <label><i class="fa-solid fa-umbrella-beach"></i> Cottages</label>
    </div>

    <div class="under-buttons-container">
        <div>
            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                    <g>
                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                    </g>
                </svg>
                <input type="search" id="search-input" class="search-input" placeholder="Search">
            </div>
        </div>

        <div class="add-reservation">
            <button onclick="window.location.href = 'cottage_adding.php'" name="add-reservation"><i class="fa-solid fa-plus"></i> Add Cottage</button>
        </div>
    </div>

    <form method="post" action="">
        <table id="cottage-table">
            <thead>
                <tr>
                    <th>Cottage Number</th>
                    <th>Cottage Type</th>
                    <th>Number of Person</th>
                    <th>Day Price</th>
                    <th>Night Price</th>
                    <th>Status</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchdata = "SELECT * FROM cottage_tbl ORDER BY cottage_id DESC";
                $result = mysqli_query($con, $fetchdata);
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['cottage_id'];
                    $cottageNumber = $row['cottage_number'];
                    $cottageType = $row['cottage_type'];
                    $number_of_person = $row['number_of_person'];
                    $dayPrice = $row['day_price'];
                    $nightPrice = $row['night_price'];
                    $status = $row['cottage_status'];
                    $photo = $row['cottage_photo'];
                ?>
                <tr>
                    <td><?php echo $cottageNumber ?></td>
                    <td><?php echo $cottageType ?></td>
                    <td><?php echo $number_of_person ?></td>
                    <td><?php echo $dayPrice ?></td>
                    <td><?php echo $nightPrice ?></td>
                    <td><?php echo $status ?></td>
                    <td><img class="room-image" onclick="openFullScreen()" src="<?php echo $photo ?>"></td>
                    <td class="edit-btn-holder">
                        <div class="edit-btn">
                            <a name="manage" href="edit_cottage.php?manage_id=<?php echo $id; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>

<!-- for fullscreen -->
<div id="fullscreen-overlay">
    <span class="close" onclick="closeFullScreen()">&times;</span>
    <img id="fullscreen-image" src="" alt="">
</div>

<script>
    function searchTable(query) {
        // Get all rows in the table body
        const rows = document.querySelectorAll('#cottage-table tbody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(query)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none'; // Show or hide rows based on match
        });
    }

    // Attach the search function to the input element
    document.getElementById('search-input').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        searchTable(query);
    });
</script>
