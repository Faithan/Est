<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="slidebox.css?v=<?php echo time(); ?>">

    <title>Document</title>
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="slide-wrapper">
            <button id="prev-slide" class="slide-button">
                << /button>
                    <div class="image-list">
                        <img src="../system_images/Picture1.png" alt="" class="image-item">
                        <img src="../system_images/Picture1.png" alt="" class="image-item">
                        <img src="../system_images/Picture1.png" alt="" class="image-item">
                        <img src="../system_images/Picture1.png" alt="" class="image-item">
                        <img src="../system_images/Picture1.png" alt="" class="item-container">
                        <img src="../system_images/Picture1.png" alt="" class="item-container">
                        <img src="../system_images/Picture1.png" alt="" class="item-container">
                        <img src="../system_images/Picture1.png" alt="" class="item-container">
                    </div>
                    <button id="next-slide" class="slide-button">></button>
        </div>
        <div class="slider-scrollbar">
            <div class="scrollbar-track">
                <div class="scrollbar-thumb"></div>
            </div>
        </div>
    </div>
</body>

</html>

<?php $fetchdata = "SELECT * FROM room_tbl";
                            $result = mysqli_query($con, $fetchdata);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $roomType = $row['room_type'];
                                $noPersons = $row['no_persons'];
                                $amenities = $row['amenities'];
                                $price = $row['price'];
                                $status = $row['status'];
                                $photo = $row['photo'];
                                ?>
                               
                        <div class="item-container">
                        
                            <img  src="<?php echo $photo?>">
             
                            <div class="label-container">
                            <label>
                                <?php echo $roomType ?>
                            </label><br>
                            <label>
                                <?php echo $noPersons ?>
                            </label><br>
                            <label>
                                <?php echo $amenities ?>
                            </label><br>
                            <label>
                                <?php echo $price ?>
                            </label><br>
                            <label>
                                <?php echo $status ?>
                            </label><br>
                            </div>
                        </div>
                            
                        <?php } ?>
