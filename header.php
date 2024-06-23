<!-- javascripts -->
<script src="landing_js/loginButton.js" defer></script>
<script src="landing_js/autowidth.js" defer></script>




<!-- header -->
<header class="header-main">

<div class="header-logo">
    <img src="system_images/Picture1.png">
    <a class="logoLabel">Estregan Beach Resort</a>
</div>

<nav class="header-nav">
    <ul>
        <li><a onclick="confirm('You have to log in first!')">Home</a></li>
        <li><a href="user/view_about.php">About</a></li>
        <li class="dropdown">
            <a href="user/view_rooms.php" class="reservation">Reservation <i
                    class="fa-solid fa-caret-down"></i></a>
            <div class="dropdown-content">
                <a onclick="confirm('You have to log in first!')">Cottages</a>
                <a href="user/view_rooms.php">Rooms</a>

        <li><a href="user/view_contact.php">Contact</a></li>
    </ul>

    <div class="header-btn">
        <div class="login-icon" onmouseover="changeIcon(this)" onmouseout="resetIcon(this)">
            <i id="loginIcon" class="fa-solid fa-arrow-right-to-bracket"></i>
            <span class="tooltip">Login</span>
        </div>
    </div>

</nav>

</header>