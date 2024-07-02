<div class="items">

    <img src="<?php echo $photo ?>" alt="" >


    <div class="container-of-labels">

        <div class="label-container">
            <div class="title-text"><label><b>Room Number:</b></label></div>
            <div class="detail"><p><?php echo $roomNumber ?></p></div>
        </div>

        <div class="label-container">
            <div class="title-text"><label><b>Room Type:</b></label></div>
            <div class="detail"><p><?php echo $roomType ?></p></div>
        </div>


        <div class="label-container">
            <div class="title-text"><label><b>Bed Type:</b></label></div>
            <div class="detail"><p><?php echo $bedType ?></p></div>
        </div>

        <div class="label-container">
            <div class="title-text"><label><b>No. of Beds:</b></label></div>
            <div class="detail"><p><?php echo $bed_quantity ?></p></div>
        </div>

        <div class="label-container">
            <div class="title-text"><label><b>Number of Persons:</b></label></div>
            <div class="detail"><p><?php echo $noPersons ?></p></div>
        </div>

        <div class="label-container">
            <div class="title-text"><label><b>Amenities:</b></label></div>
            <div class="detail"><p><?php echo $amenities ?></p></div>
        </div>

        <div class="label-container">
            <div class="title-text"><label><b>Price (Good for 22hrs):</b></label></div>
            <div class="detail"><p><?php echo $price ?></p></div>
        </div>

    </div>

    <div class="button-container">

        <a href="reservationForm.php?manage_id=<?php echo $id; ?>" name="book_now"><button class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"
                    class="svg-icon">
                    <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                        <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                        <path d="m8 3v4"></path>
                        <path d="m16 3v4"></path>
                        <path d="m4 11h16"></path>
                    </g>
                </svg>
                <span class="lable">Book Now</span>
            </button></a>
    </div>
</div>