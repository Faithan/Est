<?php
require 'db_connect.php';

// Number of items per page
$items_per_page = 10;

// Get the current page from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Get the search term from the query string
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Calculate the starting item for the current page
$start_item = ($current_page - 1) * $items_per_page;

// Modify the query to include the search term, handle empty search term
$search_condition = $search_term ? "WHERE CONCAT(full_name, email, address) LIKE '%$search_term%'" : '';
$total_items_query = "SELECT COUNT(*) FROM user_tbl $search_condition";
$total_items_result = mysqli_query($con, $total_items_query);
$total_items = mysqli_fetch_array($total_items_result)[0];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the items for the current page with the search term
$fetchdata = "SELECT * FROM user_tbl $search_condition ORDER BY id DESC LIMIT $start_item, $items_per_page";
$result = mysqli_query($con, $fetchdata);

// Generate table rows
$tableRows = '';
while ($row = mysqli_fetch_assoc($result)) {
    $tableRows .= "<tr>
        <td>{$row['id']}</td>
        <td>{$row['full_name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['address']}</td>
        <td>{$row['date_created']}</td>
        <td>{$row['account_status']}</td>
        <td class='edit-btn-holder'>
            <div class='edit-btn'>
                <a name='manage' href='edit_user.php?manage_id={$row['id']}'>
                    <i class='fa-solid fa-pen-to-square'></i>
                </a>
            </div>
        </td>
    </tr>";
}

// Generate pagination links
$pagination = '';
if ($current_page > 1) {
    $pagination .= "<a href='#' onclick='fetchUsers(\"$search_term\", " . ($current_page - 1) . ")' class='prev'>Previous</a>";
} else {
    $pagination .= "<a href='#' class='disabled prev'>Previous</a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= "<a href='#' onclick='fetchUsers(\"$search_term\", $i)' " . ($i == $current_page ? 'class="active"' : '') . ">$i</a>";
}

if ($current_page < $total_pages) {
    $pagination .= "<a href='#' onclick='fetchUsers(\"$search_term\", " . ($current_page + 1) . ")' class='next'>Next</a>";
} else {
    $pagination .= "<a href='#' class='disabled next'>Next</a>";
}

// Return JSON response
echo json_encode([
    'tableRows' => $tableRows,
    'pagination' => $pagination
]);
?>
