<?php
require('db_connect.php');
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


    <title>Dashboard</title>


    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

        <section class="side-nav">
            <div class="menu-container">
                <div class="logo-container">
                    <img src="../system_images/suntree.png" alt="">
                    <label for="">Estregan Beach Resort</label>
                </div>

                <div class="menu">

                    <div class="item"><a href="" id="selected"><i class="fa-solid fa-chart-simple"></i> Overview</a>
                    </div>

                    <div class="item"><a href=""><i class="fa-solid fa-calendar"></i> Reservations <i
                                class="fa-solid fa-caret-down dropdown"></i>
                        </a>
                        <!-- dropdown -->

                        <div class="sub-menu">
                            <a href="" class="sub-menu-item"><i class="fa-solid fa-umbrella-beach"></i> For Cottages</a>
                            <a href="" class="sub-menu-item"><i class="fa-solid fa-bed"></i> For Rooms</a>
                        </div>
                    </div>

                    <div class="item"><a href=""><i class="fa-solid fa-toolbox"></i> Manage <i
                                class="fa-solid fa-caret-down dropdown"></i></a>
                        <!-- dropdown -->

                        <div class="sub-menu">
                            <a href="" class="sub-menu-item"><i class="fa-solid fa-umbrella-beach"></i>Cottages</a>
                            <a href="" class="sub-menu-item"><i class="fa-solid fa-bed"></i>Rooms</a>
                        </div>
                    </div>
                    <div class="item"><a href=""><i class="fa-solid fa-gear"></i> Settings</a></div>

                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const dropdowns = document.querySelectorAll(".item > a");

                        dropdowns.forEach(dropdown => {
                            dropdown.addEventListener("click", function (e) {
                                e.preventDefault(); // Prevent default anchor behavior

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
                <a><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
            </div>


        </section>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                    <img src="../system_images/Picture1.png" alt="">
                    <label for="">Dashboard</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">

                <?php
                include 'reservationRoom.php';
                ?>

            </div>















        </section>

    </main>



</body>

</html>