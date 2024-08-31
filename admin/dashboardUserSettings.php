<?php
require 'db_connect.php';
session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <title>User Settings</title>

    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

        <?php
        include 'sidenav.php'
            ?>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-user-gear"></i> User Settings</label>
                </div>

                <div class="title-head-right">


                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">
                <div class="second-container">


                    <div class="stat-container">
                        <div class="sbox">
                            <label for="">New User<em>(Today)</em></label>
                            <?php
                            // Query to count the number of new users registered today
                            $new_user_query = "SELECT COUNT(*) as new_users FROM user_tbl WHERE DATE(date_created) = CURDATE()";
                            $new_user_result = mysqli_query($con, $new_user_query);

                            if ($new_user_result) {
                                $row = mysqli_fetch_assoc($new_user_result);
                                $new_users = $row['new_users'];
                            } else {
                                $new_users = 0; // Default value if query fails
                            }
                            ?>



                            <p><?php echo $new_users; ?></p>
                            <?php if ($new_users > 0): ?>
                                <span class="red-dot"></span> <!-- Red dot notification -->
                            <?php endif; ?>
                        </div>




                        <div class="sbox">
                            <label for="">Total User <i class="fa-solid fa-users"></i></label>
                            <?php
                            // Query to count the total number of users
                            $total_user_query = "SELECT COUNT(*) as total_users FROM user_tbl";
                            $total_user_result = mysqli_query($con, $total_user_query);

                            if ($total_user_result) {
                                $row = mysqli_fetch_assoc($total_user_result);
                                $total_users = $row['total_users'];
                            } else {
                                $total_users = 0; // Default value if query fails
                            }
                            ?>
                            <p><?php echo $total_users; ?></p>
                        </div>

                        <div class="char-container">
                            <?php
                            // PHP code to fetch data from user_tbl
                            $query = "SELECT DATE(date_created) as date, COUNT(*) as user_count FROM user_tbl GROUP BY DATE(date_created)";
                            $result = $con->query($query);

                            $dates = [];
                            $user_counts = [];

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $dates[] = $row['date'];
                                    $user_counts[] = $row['user_count'];
                                }
                            }

                            // Convert PHP arrays to JavaScript
                            $dates_json = json_encode($dates);
                            $user_counts_json = json_encode($user_counts);
                            ?>

                            <canvas id="userChart"></canvas>

                            <script>
                                const ctx = document.getElementById('userChart').getContext('2d');

                                const userChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: <?php echo $dates_json; ?>, // X-axis labels
                                        datasets: [{
                                            label: 'Number of Users',
                                            data: <?php echo $user_counts_json; ?>, // Y-axis data
                                            borderColor: 'rgba(75, 192, 192, 1)', // Line color
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Area under the line
                                            borderWidth: 2,
                                            fill: true,
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Date Created',
                                                    color: 'gray' // Gray text color for x-axis
                                                },
                                                ticks: {
                                                    color: 'gray' // Gray text color for x-axis ticks
                                                }
                                            },
                                            y: {
                                                title: {
                                                    display: true,
                                                    text: 'Number of Users',
                                                    color: 'gray' // Gray text color for y-axis
                                                },
                                                beginAtZero: true,
                                                ticks: {
                                                    color: 'gray' // Gray text color for y-axis ticks
                                                }
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                labels: {
                                                    color: 'gray' // Gray text color for legend
                                                }
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>
                        <!-- end of stat-container -->






                        <div class="user-table-container">

                            <div class="search-container">
                                <!-- search bar -->
                                <div class="group">
                                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                                        <g>
                                            <path
                                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                            </path>
                                        </g>
                                    </svg>
                                    <input type="search" id="search-input" class="search-input" placeholder="Search">
                                </div>

                                <div class="add-reservation">
                                    <button name="add-reservation" onclick="window.location.href='add_user.php';">
                                        <i class="fa-solid fa-plus"></i> ADD NEW USER
                                    </button>
                                </div>
                            </div>

                            <?php
                            // Number of items per page
                            $items_per_page = 10;

                            // Get the current page from the query string, default to 1 if not set
                            $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

                            // Get the search term from the query string
                            $search_term = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                            // Calculate the starting item for the current page
                            $start_item = ($current_page - 1) * $items_per_page;

                            // Modify the query to include the search term
                            $total_items_query = "SELECT COUNT(*) FROM user_tbl WHERE CONCAT(full_name, email, address) LIKE '%$search_term%'";
                            $total_items_result = mysqli_query($con, $total_items_query);
                            $total_items = mysqli_fetch_array($total_items_result)[0];

                            // Calculate the total number of pages
                            $total_pages = ceil($total_items / $items_per_page);

                            // Fetch the items for the current page with the search term
                            $fetchdata = "SELECT * FROM user_tbl WHERE CONCAT(full_name, email, address) LIKE '%$search_term%' ORDER BY id DESC LIMIT $start_item, $items_per_page";
                            $result = mysqli_query($con, $fetchdata);
                            ?>

                            <table id="user-table">
                                <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Date Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user-table-body">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['full_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['date_created']; ?></td>
                                            <td><?php echo $row['account_status']; ?></td>
                                            <td class="edit-btn-holder">
                                                <div class="edit-btn">
                                                    <a name="manage"
                                                        href="edit_user.php?manage_id=<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            

                            <!-- Pagination Controls -->
                            <div class="pagination">
                                <?php if ($current_page > 1): ?>
                                    <a href="?page=<?php echo $current_page - 1; ?>&search=<?php echo urlencode($search_term); ?>"
                                        class="prev">Previous</a>
                                <?php else: ?>
                                    <a href="#" class="disabled prev">Previous</a>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_term); ?>" <?php if ($i == $current_page)
                                              echo 'class="active"'; ?>>
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>

                                <?php if ($current_page < $total_pages): ?>
                                    <a href="?page=<?php echo $current_page + 1; ?>&search=<?php echo urlencode($search_term); ?>"
                                        class="next">Next</a>
                                <?php else: ?>
                                    <a href="#" class="disabled next">Next</a>
                                <?php endif; ?>
                            </div>

                            <!-- Add JavaScript for dynamic search functionality -->
                            <script>
                                let debounceTimer;

                                document.getElementById('search-input').addEventListener('input', function () {
                                    clearTimeout(debounceTimer);
                                    const searchTerm = this.value.trim().toLowerCase();

                                    debounceTimer = setTimeout(function () {
                                        fetchUsers(searchTerm, 1); // Fetch results for page 1
                                    }, 300); // Delay of 300ms before sending the search request
                                });

                                function fetchUsers(searchTerm, page) {
                                    const xhr = new XMLHttpRequest();
                                    xhr.open('GET', `fetch_users.php?search=${encodeURIComponent(searchTerm)}&page=${page}`, true);
                                    xhr.onload = function () {
                                        if (xhr.status === 200) {
                                            const response = JSON.parse(xhr.responseText);
                                            document.getElementById('user-table-body').innerHTML = response.tableRows;
                                            document.querySelector('.pagination').innerHTML = response.pagination;
                                        }
                                    };
                                    xhr.send();
                                }
                            </script>

                        </div>
                        <!-- end -->






                    </div>


                </div>

            </div>


        </section>

    </main>



</body>

</html>