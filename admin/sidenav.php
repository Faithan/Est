<section class="side-nav">
    <div class="menu-container">
        <div class="logo-container">
            <img src="../system_images/suntree.png" alt="">
            <label for="">Estregan Beach Resort</label>
        </div>

        <div class="menu">
            <div class="item"><a href="dashboard.php"><i class="fa-solid fa-chart-simple"></i> Overview</a></div>

            <div class="item">

                <a href="#" class="dropdown-link"><i class="fa-solid fa-clipboard-list"></i> Reports <i
                        class="fa-solid fa-caret-down dropdown"></i></a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="cottageReservationReports.php" class="sub-menu-item" style="font-size: 1.3rem;"> <i class="fa-solid fa-campground"></i> For Cottage Reservations</a>
                    <a href="roomReservationReports.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-bed"></i> For Room Reservations</a>
                    <a href="userReservationReports.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-user"></i>For User's Reservation</a>
                    <a href="cottageReports.php" class="sub-menu-item" style="font-size: 1.3rem;"> <i class="fa-solid fa-campground"></i> For Cottages</a>
                    <a href="roomReports.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-bed"></i> For Rooms</a>
                </div>
            </div>


            <div class="item"><a href="calendar.php"><i class="fa-solid fa-calendar-days"></i> Calendar</a></div>

            <?php
            // Query the database for pending reservations
            // Assuming you have already set up a database connection

            // Query for pending cottages
            $query_cottage = "SELECT COUNT(*) FROM reserve_cottage_tbl WHERE reserve_status = 'pending'";
            $result_cottage = mysqli_query($con, $query_cottage);
            $count_cottage = mysqli_fetch_array($result_cottage)[0];

            // Query for pending rooms
            $query_room = "SELECT COUNT(*) FROM reserve_room_tbl WHERE status = 'pending'";
            $result_room = mysqli_query($con, $query_room);
            $count_room = mysqli_fetch_array($result_room)[0];

            // Calculate the total number of pending reservations
            $total_pending = $count_cottage + $count_room;
            ?>

            <div class="item">
                <a href="#" class="dropdown-link">
                    <i class="fa-solid fa-calendar"></i> Reservations
                    <?php if ($total_pending > 0): ?>
                        <!-- Red dot notification if there are pending reservations -->
                        <span class="notification-dot"></span>
                    <?php endif; ?>
                    <i class="fa-solid fa-caret-down dropdown"></i>
                </a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="dashboardCottageReservation.php" class="sub-menu-item" style="font-size: 1.3rem;">
                        <i class="fa-solid fa-campground"></i> For Cottages
                    </a>
                    <a href="dashboardRoomReservation.php" class="sub-menu-item" style="font-size: 1.3rem;">
                        <i class="fa-solid fa-bed"></i> For Rooms
                    </a>
                </div>
            </div>

            <style>
                /* Red dot notification */
                .notification-dot {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    border-radius: 50%;
                    display: inline-block;
                }

                .item {
                    position: relative;
                }
            </style>


            <div class="item">
                <a href="#" class="dropdown-link"><i class="fa-solid fa-toolbox"></i> Manage <i
                        class="fa-solid fa-caret-down dropdown"></i></a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="dashboardCottages.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-campground"></i>
                        Cottages</a>
                    <a href="dashboardRooms.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-bed"></i> Rooms</a>
                </div>
            </div>


            <div class="item">
                <a href="#" class="dropdown-link"><i class="fa-solid fa-gear"></i> Settings <i
                        class="fa-solid fa-caret-down dropdown"></i></a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="dashboardUserSettings.php" class="sub-menu-item" style="font-size: 1.3rem;"> <i class="fa-solid fa-user"></i> User</a>
                    <a href="extraSettings.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-gears"></i> Extra</a>
                    <a href="admin_settings.php" class="sub-menu-item" style="font-size: 1.3rem;"><i class="fa-solid fa-user-tie"></i> Admin Settings</a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const dropdownLinks = document.querySelectorAll(".dropdown-link");

                dropdownLinks.forEach(dropdown => {
                    dropdown.addEventListener("click", function(e) {
                        e.preventDefault(); // Prevent default anchor behavior for dropdown links

                        const submenu = this.nextElementSibling;

                        if (submenu.style.maxHeight) {
                            // Close the submenu smoothly
                            submenu.style.maxHeight = null;
                            submenu.style.opacity = "0";
                            setTimeout(() => {
                                submenu.style.display = "none";
                            }, 400); // Match this duration with the transition duration
                        } else {
                            // Open the submenu smoothly
                            submenu.style.display = "block";
                            submenu.style.maxHeight = submenu.scrollHeight + "px";
                            submenu.style.opacity = "1";
                        }
                    });
                });
            });
        </script>
    </div>

    <div class="logout-container">
        <a href="#" id="logoutLink"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
    </div>
</section>


<script>
    document.getElementById('logoutLink').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log out!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to the logout page
                window.location.href = 'logout.php'; // Replace with your logout URL
            }
        });
    });
</script>