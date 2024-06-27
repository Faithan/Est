<!-- javascripts -->
<script src="landing_js/mobileMenu.js" defer></script>
<script src="landing_js/loginButton.js" defer></script>
<script src="landing_js/autowidth.js" defer></script>
<script src="landing_js/switchMode.js" defer></script>
<script src="landing_js/burgerMenu.js" defer></script>
<script src="landing_js/subMenu.js" defer></script>


<!-- header -->


<header class="header-main">



    <!-- for web menu -->
    <nav class="header-nav">
        <div class="header-logo">
            <img src="system_images/Picture1.png" id="logoImg">
            <a>Estregan Beach Resort</a>
        </div>

        <ul>
            <li><a href="#">Home</a></li>

            <li class="dropdown">
                <a href="#" class="reservation">Reservation <i class="fa-solid fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a href="#">Cottages</a>
                    <a href="#">Rooms</a>
                </div>
            </li>

            <li><a href="#">About</a></li>

            <li><a href="#">Contact</a></li>
        </ul>



    </nav>




    <!-- icons -->
    <div class="icons-container">

        <div class="header-btn">
            <div class="login-icon" onmouseover="changeIcon(this)" onmouseout="resetIcon(this)">
                <i id="loginIcon" class="fa-solid fa-arrow-right-to-bracket"></i>
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
    
        <a href="#"><i class="fa-solid fa-house"></i> Home</a>
        <a href="#" id="submenu1"><i class="fa-solid fa-calendar"></i> Reservation <i class="fa-solid fa-caret-down"></i></a>
        <div class="submenu" id="subMenuContent1">
            <a href="#"><i class="fa-solid fa-umbrella-beach"></i> Cottages</a>
            <a href="#"><i class="fa-solid fa-bed"></i> Rooms</a>
        </div>
        <a href="#"><i class="fa-solid fa-address-card"></i> About</a>
        <a href="#"><i class="fa-solid fa-phone"></i> Contact</a>
</nav>

