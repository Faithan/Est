<!-- javascripts -->
<script src="landing_js/loginButton.js" defer></script>
<script src="landing_js/autowidth.js" defer></script>
<script src="landing_js/switchMode.js" defer></script>



<!-- header -->
<header class="header-main">

    <nav class="header-nav">
        <div class="header-logo">
            <img src="system_images/Picture1.png" id="logoImg">
            <a >Estregan Beach Resort</a>
        </div>

        <ul>
            <li><a href="#">Home</a></li>
            <li class="dropdown">
                <a href="#" class="reservation">Reservation <i class="fa-solid fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a href="#">Cottages</a>
                    <a href="#">Rooms</a>
            </li>
            <li><a href="#">About</a></li>

            <li><a href="#">Contact</a></li>
        </ul>



    </nav>

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
    </div>



</header>

<!-- <i class="fa-regular fa-sun"></i> -->