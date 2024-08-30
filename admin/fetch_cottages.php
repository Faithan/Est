<?php
include 'db_connect.php';

// Number of items per page
$items_per_page = 6; // Adjust to match your room page if needed

// Get the current page from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Get the search term from the query string
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Calculate the starting item for the current page
$start_item = ($current_page - 1) * $items_per_page;

// Modify the query to include the search term
$total_items_query = "SELECT COUNT(*) FROM cottage_tbl WHERE CONCAT(cottage_number, cottage_type, number_of_person, day_price, night_price, cottage_status) LIKE '%$search_term%'";
$total_items_result = mysqli_query($con, $total_items_query);
$total_items = mysqli_fetch_array($total_items_result)[0];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the items for the current page with the search term
$fetchdata = "SELECT * FROM cottage_tbl WHERE CONCAT(cottage_number, cottage_type, number_of_person, day_price, night_price, cottage_status) LIKE '%$search_term%' ORDER BY cottage_id DESC LIMIT $start_item, $items_per_page";
$result = mysqli_query($con, $fetchdata);

$tableRows = '';
while ($row = mysqli_fetch_assoc($result)) {
    $tableRows .= "<tr>
        <td>{$row['cottage_number']}</td>
        <td>{$row['cottage_type']}</td>
        <td>{$row['number_of_person']}</td>
        <td>{$row['day_price']}</td>
        <td>{$row['night_price']}</td>
        <td>{$row['cottage_status']}</td>
        <td><img class='room-image' onclick='openFullScreen()' src='{$row['cottage_photo']}' alt='Cottage Photo'></td>
        <td class='edit-btn-holder'>
            <div class='edit-btn'>
                <a name='manage' href='edit_cottage.php?manage_id={$row['cottage_id']}'><i class='fa-solid fa-pen-to-square'></i></a>
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
