<?php
include 'db_connect.php';

// Number of items per page
$items_per_page = 6;

// Get the current page from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the search term from the query string
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Calculate the starting item for the current page
$start_item = ($current_page - 1) * $items_per_page;

// Modify the query to include the search term
$total_items_query = "SELECT COUNT(*) FROM room_tbl WHERE CONCAT(room_number, room_type, bed_type, bed_quantity, no_persons, amenities, price, status) LIKE '%$search_term%'";
$total_items_result = mysqli_query($con, $total_items_query);
$total_items = mysqli_fetch_array($total_items_result)[0];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the items for the current page with the search term
$fetchdata = "SELECT * FROM room_tbl WHERE CONCAT(room_number, room_type, bed_type, bed_quantity, no_persons, amenities, price, status) LIKE '%$search_term%' ORDER BY id DESC LIMIT $start_item, $items_per_page";
$result = mysqli_query($con, $fetchdata);
?>

<div class="container">
    <div class="header-label">
        <label><i class="fa-solid fa-bed"></i> Rooms</label>
    </div>

    <div class="under-buttons-container">
        <!-- Search bar -->
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input type="search" id="search-input" class="search-input" placeholder="Search">
        </div>

        <div class="add-reservation">
            <button onclick="window.location.href = 'room_adding.php'" name="add-reservation"><i class="fa-solid fa-plus"></i> Add Room</button>
        </div>
    </div>

    <form method="post" action="">
        <table id="room-table">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Bed Type</th>
                    <th>Bed Quantity</th>
                    <th>No. Person</th>
                    <th>Amenities</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="room-table-body">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['room_number']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['bed_type']; ?></td>
                    <td><?php echo $row['bed_quantity']; ?></td>
                    <td><?php echo $row['no_persons']; ?></td>
                    <td><?php echo $row['amenities']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><img class="room-image" onclick="openFullScreen()" src="<?php echo $row['photo']; ?>"></td>
                    <td class="edit-btn-holder">
                        <div class="edit-btn">
                            <a name="manage" href="edit_room.php?manage_id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>

    <!-- Pagination Controls -->
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>&search=<?php echo urlencode($search_term); ?>" class="prev">Previous</a>
        <?php else: ?>
            <a href="#" class="disabled prev">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_term); ?>" <?php if ($i == $current_page) echo 'class="active"'; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>&search=<?php echo urlencode($search_term); ?>" class="next">Next</a>
        <?php else: ?>
            <a href="#" class="disabled next">Next</a>
        <?php endif; ?>
    </div>
</div>

<!-- Fullscreen image viewer -->
<div id="fullscreen-overlay">
    <span class="close" onclick="closeFullScreen()">&times;</span>
    <img id="fullscreen-image" src="" alt="">
</div>

<script>
    // Search functionality with debounce
    let debounceTimer;

    document.getElementById('search-input').addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const searchTerm = this.value.trim().toLowerCase();

        debounceTimer = setTimeout(function () {
            fetchRooms(searchTerm, 1); // Fetch results for page 1
        }, 300); // Delay of 300ms before sending the search request
    });

    function fetchRooms(searchTerm, page) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `fetch_rooms.php?search=${encodeURIComponent(searchTerm)}&page=${page}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('room-table-body').innerHTML = response.tableRows;
                document.querySelector('.pagination').innerHTML = response.pagination;
            }
        };
        xhr.send();
    }
</script>
