<?php
include ('db_connect.php');

// Default values for logged-out state
$icon_class = "fa-solid fa-arrow-right-to-bracket"; // Default login icon
$link_text = "Log in";
$link_url = "login.php"; // Default to login page
$logout_script = ''; // No logout script for logged-out state

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in
    if (!isset($_SESSION['user_id'])) {
        // Get the user's ID if not already stored in session
        $email = $_SESSION['email'];
        $sql = "SELECT id FROM user_tbl WHERE email= '$email'";
        $result = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['user_id'] = $row['id'];
        }
    }

    // Update values for logged-in state
    $icon_class = "fa-solid fa-right-from-bracket"; // Logout icon class
    $link_text = "Log out";
    $link_url = "#"; // Prevent default action, handled by JS
    $logout_script = '
    <script>
        function handleLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: "Log Out",
                text: "Are you sure you want to log out?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Log Out",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "logout.php";
                    Swal.fire("Logged Out", "You have been logged out successfully!", "success");
                }
            });
        }

        // Update icon class and link behavior
        var loginIcon = document.getElementById("loginIcon");
        loginIcon.className = "fa-solid fa-right-from-bracket";
        loginIcon.onclick = handleLogout;

        // Disable hover effect if logged in
        loginIcon.onmouseover = null;
        loginIcon.onmouseout = null;
        document.querySelector(".tooltip").innerText = "Log out";
    </script>';
}
?>




<!-- javascripts -->
<script src="landing_js/mobileMenu.js" defer></script>
<script src="landing_js/loginButton.js" defer></script>
<script src="landing_js/autowidth.js" defer></script>
<script src="landing_js/switchMode.js" defer></script>
<script src="landing_js/burgerMenu.js" defer></script>
<script src="landing_js/subMenu.js" defer></script>
<script src="landing_js/subMenu2.js" defer></script>


<!-- header -->
<header class="header-main">



    <!-- for web menu -->
    <nav class="header-nav">
        <div class="header-logo">
            <img src="system_images/Picture1.png" id="logoImg">
            <a>Estregan Beach Resort</a>
        </div>

        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>

            <li class="dropdown">
                <a class="reservation"><i class="fa-solid fa-calendar"></i>Reservation <i class="fa-solid fa-caret-down"
                        id="down-arrow"></i></a>
                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-umbrella-beach"></i>Cottages</a>
                    <a href="reservationRoom.php"><i class="fa-solid fa-bed"></i>Rooms</a>
                </div>
            </li>

            <li><a href="myReservation.php"><i class="fa-solid fa-calendar-day"></i> My Reservation</a></li>

            <li class="dropdown">
                <a class="reservation"><i class="fa-solid fa-gear"></i>Settings <i class="fa-solid fa-caret-down"
                        id="down-arrow"></i></a>
                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-address-card"></i>Profile</a>
                    <a href="#"><i class="fa-solid fa-book"></i>History</a>
                    <a href="#"><i class="fa-solid fa-lock"></i>Password and Security</a>
                    <a href="#"><i class="fa-solid fa-headset"></i>Customer Support</a>
                </div>
            </li>






        </ul>

    </nav>


    <!-- Icons Container -->
    <div class="icons-container">

        <!-- First Login Button (Outside Burger Menu) -->
        <div class="header-btn">
            <div class="login-icon">
                <i id="loginIcon" class="<?php echo $icon_class; ?>"></i>
                <span class="tooltip"><?php echo $link_text; ?></span>
            </div>
        </div>

        <div class="switch-mode">
            <i class="fa-regular fa-moon" id="icon"></i>
        </div>

        <div class="burger-icon">
            <i class="fa-solid fa-bars"></i>
        </div>

    </div>

    <!-- Include the logout script -->
    <?php echo $logout_script; ?>


</header>



<!-- burger menu -->
<nav class="burger-menu" id="mySidenav">

    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>

    <a id="submenu1"><i class="fa-solid fa-calendar"></i> Reservation <i class="fa-solid fa-caret-down"></i></a>
    <div class="submenu" id="subMenuContent1">
        <a href="reservationCottage.php"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
        <a href="reservationRoom.php"><i class="fa-solid fa-bed"></i> Rooms</a>
    </div>

    <a id="submenu2"> <i class="fa-solid fa-calendar-day"></i> My Reservation <i class="fa-solid fa-caret-down"></i></a>
    <div class="submenu" id="subMenuContent2">
        <a href="#" onclick="checkLoggedIn(event)"><i class="fa-solid fa-umbrella-beach"></i>My Reserved Cottages</a>
        <a href="myReservationRoom.php" onclick="checkLoggedIn(event)"><i class="fa-solid fa-bed"></i>My Reserved
            Rooms</a>
    </div>


    <a href="profile.php" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-address-card"></i> Profile
    </a>

    <a href="#" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-lock"></i> Password and Security
    </a>

    <a href="#"><i class="fa-solid fa-headset"></i> Customer Support</a>

    <a href="<?php echo $link_url; ?>" id="logoutBtn">
        <i class="fa-solid <?php echo $icon_class; ?>"></i> <?php echo $link_text; ?>
    </a>

    <!-- Include the logout script for burger menu -->
    <?php echo $logout_script; ?>
</nav>


<script>
    function checkLoggedIn(event) {
        if (!<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ? 'true' : 'false'; ?>) {
            event.preventDefault(); // Prevent the default link action
            SweetAlertNotLoggedIn();
        }
    }

    function SweetAlertNotLoggedIn() {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "You must log in first to open this page",
            footer: '<a href="login.php">Log in here</a>'
        });
    }
</script>