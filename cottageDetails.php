<?php
include ('db_connect.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in, so the anchor tag is clickable
    // This is just an example, replace with the actual ID value
    $href = "cottageReservationForm.php?manage_id=" . $cottage_id;
    $button_text = "Book Now";
} else {
    // User is not logged in, anchor tag is disabled
    $href = "";
    $button_text = "Login to Book";
}

?>



<div class="items">


    <img src="<?php echo $photo ?>" alt="">


    <div class="container-of-labels">


        <div class="label-container">
            <div class="title-text-bold"><label><b>Day Price:</b></label></div>
            <div class="detail-bold">
                <p>₱<?php echo $dayPrice ?></p>
            </div>
        </div>


        <div class="label-container">
            <div class="title-text-bold"><label><b>Night Price:</b></label></div>
            <div class="detail-bold">
                <p>₱<?php echo $nightPrice ?></p>
            </div>
        </div>



        <div class="label-container">
            <div class="title-text"><label><b>Cottage Type:</b></label></div>
            <div class="detail">
                <p><?php echo $cottageType ?></p>
            </div>
        </div>


        <div class="label-container">
            <div class="title-text"><label><b>Cottage Number:</b></label></div>
            <div class="detail">
                <p><?php echo $cottageNumber ?></p>
            </div>
        </div>


        <div class="label-container">
            <div class="title-text"><label><b>Number of Persons:</b></label></div>
            <div class="detail">
                <p><?php echo $noPersons ?></p>
            </div>
        </div>

    </div>

    <div class="button-container">

        <a href="<?php echo $href; ?>" name="book_now">
            <button class="button" <?php if (empty($href))
                echo 'disabled'; ?>>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"
                    class="svg-icon">
                    <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                        <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                        <path d="m8 3v4"></path>
                        <path d="m16 3v4"></path>
                        <path d="m4 11h16"></path>
                    </g>
                </svg>
                <span class="label"><?php echo $button_text; ?></span>
            </button>
        </a>
    </div>
</div>