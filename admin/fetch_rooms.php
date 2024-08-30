<?php
include 'db_connect.php';

// Number of items per page
$items_per_page = 6;

// Get the current page from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Get the search term from the query string
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Calculate the starting item for the current page
$start_item = ($current_page - 1) * $items_per_page;

// Modify the query to include the search term
$total_items_query = "SELECT COUNT(*) FROM room_tbl WHERE CONCAT(room_number, room_type, bed_type, amenities) LIKE '%$search_term%'";
$total_items_result = mysqli_query($con, $total_items_query);
$total_items = mysqli_fetch_array($total_items_result)[0];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the items for the current page with the search term
$fetchdata = "SELECT * FROM room_tbl WHERE CONCAT(room_number, room_type, bed_type, amenities) LIKE '%$search_term%' ORDER BY id DESC LIMIT $start_item, $items_per_page";
$result = mysqli_query($con, $fetchdata);

$tableRows = '';
while ($row = mysqli_fetch_assoc($result)) {
    $tableRows .= "<tr>
        <td>{$row['room_number']}</td>
        <td>{$row['room_type']}</td>
        <td>{$row['bed_type']}</td>
        <td>{$row['bed_quantity']}</td>
        <td>{$row['no_persons']}</td>
        <td>{$row['amenities']}</td>
        <td>{$row['price']}</td>
        <td>{$row['status']}</td>
        <td><img class='room-image' onclick='openFullScreen()' src='{$row['photo']}' alt='Room Photo'></td>
        <td class='edit-btn-holder'>
            <div class='edit-btn'>
                <a name='manage' href='edit_room.php?manage_id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i></a>
            </div>
        </td>
    </tr>";
}

// Generate pagination links
$pagination = '';
if ($current_page > 1) {
    $pagination .= "<a href='?page=" . ($current_page - 1) . "&search=" . urlencode($search_term) . "' class='prev'>Previous</a>";
} else {
    $pagination .= "<a href='#' class='disabled prev'>Previous</a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= "<a href='?page=$i&search=" . urlencode($search_term) . "' " . ($i == $current_page ? 'class="active"' : '') . ">$i</a>";
}

if ($current_page < $total_pages) {
    $pagination .= "<a href='?page=" . ($current_page + 1) . "&search=" . urlencode($search_term) . "' class='next'>Next</a>";
} else {
    $pagination .= "<a href='#' class='disabled next'>Next</a>";
}

// Return JSON response
echo json_encode([
    'tableRows' => $tableRows,
    'pagination' => $pagination
]);
?>
