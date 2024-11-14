<!-- JavaScript Files -->
<script src="landing_js/mobileMenu.js" defer></script>
<script src="landing_js/loginButton.js" defer></script>
<script src="landing_js/autowidth.js" defer></script>
<script src="landing_js/switchMode.js" defer></script>
<script src="landing_js/burgerMenu.js" defer></script>
<script src="landing_js/subMenu.js" defer></script>
<script src="landing_js/subMenu2.js" defer></script>
















<?php
include('db_connect.php');

// Default values for logged-out state
$icon_class = "fa-solid fa-arrow-right-to-bracket";
$link_text = "Log in";
$link_url = "login.php";
$logout_script = '';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in
    if (!isset($_SESSION['user_id'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT id FROM user_tbl WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['user_id'] = $row['id'];
        }
    }

    // Update values for logged-in state
    $icon_class = "fa-solid fa-right-from-bracket";
    $link_text = "Log out";
    $link_url = "#";
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
                }
            });
        }

        window.addEventListener("load", function() {
            var loginIcon = document.getElementById("loginIcon");
            var burgerLoginIcon = document.getElementById("burgerLoginIcon");

            if (loginIcon) {
                loginIcon.className = "' . $icon_class . '";
                loginIcon.onclick = handleLogout;
                document.querySelector(".tooltip").innerText = "Log out";
            }

            if (burgerLoginIcon) {
                burgerLoginIcon.className = "' . $icon_class . '";
                burgerLoginIcon.onclick = handleLogout;
                document.querySelector(".burger-tooltip").innerText = "Log out";
            }
        });
    </script>';
}


$user_id = $_SESSION['user_id'] ?? null;

// Check for pending reservations in reserve_cottage_tbl
$cottage_pending = false;
$sql_cottage = "SELECT reserve_id FROM reserve_cottage_tbl WHERE user_id = '$user_id' AND reserve_status = 'pending'";
$result_cottage = mysqli_query($con, $sql_cottage);
if (mysqli_num_rows($result_cottage) > 0) {
    $cottage_pending = true;
}

// Check for pending reservations in reserve_room_tbl
$room_pending = false;
$sql_room = "SELECT reserve_id FROM reserve_room_tbl WHERE user_id = '$user_id' AND status = 'pending'";
$result_room = mysqli_query($con, $sql_room);
if (mysqli_num_rows($result_room) > 0) {
    $room_pending = true;
}

// Check if either table has pending reservations
$any_pending = $cottage_pending || $room_pending;
?>


<style>
    .red-dot {
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        position: absolute;
        top: 4px;
        right: 4px;
    }

    .reservation-link {
        position: relative;
    }

    .mobile-reservation-link {
        position: relative;
    }

    .mobile-reservation-item {
        position: relative;
    }
</style>


<!-- Header -->
<header class="header-main">
    <!-- Web Menu -->
    <nav class="header-nav">
        <div class="header-logo">
            <img src="system_images/Picture1.png" id="logoImg">
            <a>Estregan Beach Resort</a>
        </div>

        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>

            <li class="dropdown">
                <a class="reservation"><i class="fa-solid fa-calendar"></i>Reservation <i class="fa-solid fa-caret-down" id="down-arrow"></i></a>
                <div class="dropdown-content">
                    <a href="reservationCottage.php"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
                    <a href="reservationRoom.php"><i class="fa-solid fa-bed"></i>Rooms</a>
                </div>
            </li>


            <li class="dropdown">
                <a href="#" class="reservation-link">
                    <?php if ($any_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                        <span class="red-dot"></span>
                    <?php endif; ?>
                    <i class="fa-solid fa-calendar-day"></i> My Reservation
                </a>
                <div class="dropdown-content">
                    <a href="myReservationCottage.php" onclick="checkLoggedIn(event)" class="reservation-item">
                        <?php if ($cottage_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                            <span class="red-dot"></span>
                        <?php endif; ?>
                        <i class="fa-solid fa-umbrella-beach"></i>For Cottages
                    </a>
                    <a href="myReservationRoom.php" onclick="checkLoggedIn(event)" class="reservation-item">
                        <?php if ($room_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                            <span class="red-dot"></span>
                        <?php endif; ?>
                        <i class="fa-solid fa-bed"></i>For Rooms
                    </a>
                </div>
            </li>

            <li class="dropdown">
                <a class="reservation"><i class="fa-solid fa-gear"></i>Settings <i class="fa-solid fa-caret-down" id="down-arrow"></i></a>
                <div class="dropdown-content">
                    <a href="profile.php" onclick="checkLoggedIn(event)"><i class="fa-solid fa-address-card"></i> Profile</a>
                    <a href="history.php" onclick="checkLoggedIn(event)"><i class="fa-solid fa-book"></i>History</a>

                </div>
            </li>
        </ul>
    </nav>

    <!-- Icons Container -->
    <div class="icons-container">
        <!-- Login Button -->
        <div class="header-btn">
            <a href="<?php echo $link_url; ?>" class="login-icon">
                <i id="loginIcon" class="<?php echo $icon_class; ?>"></i>
                <span class="tooltip"><?php echo $link_text; ?></span>
            </a>
        </div>

        <div class="switch-mode">
            <i class="fa-regular fa-moon" id="icon"></i>
        </div>

        <div class="burger-icon">
            <i class="fa-solid fa-bars"></i>
            <?php if ($any_pending) : ?>
                <?php if ($room_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <span class="red-dot"></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include the logout script -->
    <?php echo $logout_script; ?>
</header>






















<!-- Burger Menu -->
<nav class="burger-menu" id="mySidenav">
    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>

    <a id="submenu1"><i class="fa-solid fa-calendar"></i> Reservation <i class="fa-solid fa-caret-down"></i></a>
    <div class="submenu" id="subMenuContent1">
        <a href="reservationCottage.php"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
        <a href="reservationRoom.php"><i class="fa-solid fa-bed"></i> Rooms</a>
    </div>


    <!-- Mobile Menu -->
    <a id="submenu2" class="mobile-reservation-link">
        <?php if ($any_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
            <span class="red-dot"></span>
        <?php endif; ?>
        <i class="fa-solid fa-calendar-day"></i> My Reservation <i class="fa-solid fa-caret-down"></i>
    </a>

    <div class="submenu" id="subMenuContent2">
        <a href="myReservationCottage.php" onclick="checkLoggedIn(event)" class="mobile-reservation-item">
            <?php if ($cottage_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                <span class="red-dot"></span>
            <?php endif; ?>
            <i class="fa-solid fa-umbrella-beach"></i>For Cottages
        </a>
        <a href="myReservationRoom.php" onclick="checkLoggedIn(event)" class="mobile-reservation-item">
            <?php if ($room_pending && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                <span class="red-dot"></span>
            <?php endif; ?>
            <i class="fa-solid fa-bed"></i>For Rooms
        </a>
    </div>

    <a href="profile.php" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-address-card"></i> Profile
    </a>

    <a href="history.php" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-book"></i> History
    </a>



    <!-- Include the logout script for burger menu -->
    <?php echo $logout_script; ?>
</nav>

<script>
    function checkLoggedIn(event) {
        if (!<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ? 'true' : 'false'; ?>) {
            event.preventDefault();
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