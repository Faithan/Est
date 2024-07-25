<?php

include ('db_connect.php');



if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    if (!isset($_SESSION['user_id'])) { // Check if user ID is not already set
        // Retrieve the user's ID from the database based on login credentials
        // Assuming the query retrieves the user ID based on the logged-in username/email
        $user_id = ''; // Initialize user_id

        // Example query to get the user ID from the database using the username/email
        $email = $_SESSION['email']; // Assuming username is stored in the session
        $sql = "SELECT id FROM user_tbl WHERE email= '$email'";
        $result = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['id']; // Store the user ID in user_id variable
        }

        // Store the user ID in the session
        $_SESSION['user_id'] = $user_id; // Store the user ID in the session
    }


    $icon_class = "fa-right-from-bracket"; // Change the icon to a user icon
    $link_text = "Log out"; // Change the text to "My Account"
    $link_url = ''; // Update the URL to the logout page

    // Get the user ID from the session
    $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in 'user_id' session variable

    $logout_script = '
    <script>
        document.getElementById("logoutBtn").addEventListener("click", function (e) {
          e.preventDefault(); // Prevent the default link action
            Swal.fire({
                title: "Log Out",
                text: "Are you sure you want to log out?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, Log Out",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {   
                    // Perform log out action here
                    window.location.href = "logout.php";
                    Swal.fire("Logged Out", "You have been logged out successfully!", "success");
                }
            });
        });
    </script>';




} else {
    $icon_class = "fa-solid fa-right-to-bracket"; // Original icon class
    $link_text = "Log in"; // Original link text
    $link_url = "login.php"; // Original login page URL
    $logout_script = ''; // No logout script needed if not logged in
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




    <!-- icons -->
    <div class="icons-container">

        <div class="header-btn">
            <div class="login-icon" onmouseover="changeIcon(this)" onmouseout="resetIcon(this)">
                <i id="loginIcon" class="fa-solid fa-arrow-right-to-bracket"
                    onclick="window.location.href = 'login.php';"></i>
                <span class="tooltip">Login</span>
            </div>
        </div>

        <div class="switch-mode">
            <i class="fa-regular fa-moon" id="icon"></i>
        </div>

        <div class="burger-icon">
            <i class="fa-solid fa-bars"></i>
        </div>

    </div>



</header>



<!-- burger menu -->
<nav class="burger-menu" id="mySidenav">

    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>

    <a id="submenu1"><i class="fa-solid fa-calendar"></i> Reservation <i class="fa-solid fa-caret-down"></i></a>
    <div class="submenu" id="subMenuContent1">
        <a href="reservationCottage.php"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
        <a href="reservationRoom.php"><i class="fa-solid fa-bed"></i> Rooms</a>
    </div>

    <a  id="submenu2"> <i class="fa-solid fa-calendar-day"></i> My Reservation <i class="fa-solid fa-caret-down"></i></a>
    <div class="submenu" id="subMenuContent2">
        <a href="#" onclick="checkLoggedIn(event)" ><i class="fa-solid fa-umbrella-beach"></i>My Reserved Cottages</a>
        <a href="myReservationRoom.php"  onclick="checkLoggedIn(event)"><i class="fa-solid fa-bed"></i>My Reserved Rooms</a>
    </div>

    
    <a href="profile.php" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-address-card"></i> Profile
    </a>

    <a href="#" onclick="checkLoggedIn(event)">
        <i class="fa-solid fa-lock"></i> Password and Security
    </a>

    <a href="#"><i class="fa-solid fa-headset"></i> Customer Support</a>
    <a href="<?php echo $link_url; ?>" id="logoutBtn"><i class="fa-solid <?php echo $icon_class; ?>"></i>
        <?php echo $link_text; ?></a>

    <?php echo $logout_script; ?>
</nav>


<script>
    function checkLoggedIn(event) {
        // Check if the user is not logged in
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