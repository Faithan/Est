<?php
// Check if the form fields are set in the $_POST array
if (isset($_POST['selectedRoomType'], $_POST['selectedNoPersons'], $_POST['selectedAmenities'], $_POST['selectedPrice'], $_POST['selectedStatus'], $_POST['selectedPhoto'])) {
  // Retrieve the stored data from the $_POST array
  $roomType = $_POST['selectedRoomType'];
  $noPersons = $_POST['selectedNoPersons'];
  $amenities = $_POST['selectedAmenities'];
  $price = $_POST['selectedPrice'];
  $status = $_POST['selectedStatus'];
  $photo = $_POST['selectedPhoto'];

  // Display the selected room details
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Room Details</title>
  </head>
  <body>
    <img src="<?php echo $photo ?>" alt="Selected Room">
    <h2><?php echo $roomType ?></h2>
    <p><b>Number of Persons:</b> <?php echo $noPersons ?></p>
    <p><b>Amenities:</b> <?php echo $amenities ?></p>
    <p><b>Rate per Hour:</b> <?php echo $price ?></p>
    <p><b>Status:</b> <?php echo $status ?></p>

    <form action="process-booking.php" method="post">
      <input type="submit" value="Submit">
      <button type="button" onclick="window.history.back()">Cancel</button>
    </form>
  </body>
  </html>

<?php
} else {
  // Handle the case when the form fields are not set
  echo "Please fill in all the required fields.";
}
?>