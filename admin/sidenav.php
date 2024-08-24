<section class="side-nav">
    <div class="menu-container">
        <div class="logo-container">
            <img src="../system_images/suntree.png" alt="">
            <label for="">Estregan Beach Resort</label>
        </div>

        <div class="menu">
            <div class="item"><a href="dashboard.php"><i class="fa-solid fa-chart-simple"></i> Overview</a></div>

            <div class="item">
                <a href="#" class="dropdown-link"><i class="fa-solid fa-calendar"></i> Reservations <i
                        class="fa-solid fa-caret-down dropdown"></i></a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="dashboardCottageReservation.php" class="sub-menu-item"><i class="fa-solid fa-umbrella-beach"></i> For Cottages</a>
                    <a href="dashboardRoomReservation.php" class="sub-menu-item"><i class="fa-solid fa-bed"></i> For
                        Rooms</a>
                </div>
            </div>

            <div class="item">
                <a href="#" class="dropdown-link"><i class="fa-solid fa-toolbox"></i> Manage <i
                        class="fa-solid fa-caret-down dropdown"></i></a>
                <!-- dropdown -->
                <div class="sub-menu">
                    <a href="#" class="sub-menu-item"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
                    <a href="dashboardRooms.php" class="sub-menu-item"><i class="fa-solid fa-bed"></i> Rooms</a>
                </div>
            </div>

            <div class="item"><a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a></div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dropdownLinks = document.querySelectorAll(".dropdown-link");

                dropdownLinks.forEach(dropdown => {
                    dropdown.addEventListener("click", function (e) {
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
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
    </div>
</section>