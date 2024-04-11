<?php
include ('db_connect.php');
session_start();
?>

<?php
if (isset ($_POST['addroom'])) {
  $roomType = $_POST['room_type'];
  $noPersons = $_POST['no_persons'];
  $amenities = $_POST['amenities'];
  $price = $_POST['price'];
  $status = $_POST['status'];

  $photo = $_FILES['photo'];

  $filename = $_FILES['photo']['name'];
  $filetempname = $_FILES['photo']['tmp_name'];
  $filsize = $_FILES['photo']['size'];
  $fileerror = $_FILES['photo']['error'];
  $filetype = $_FILES['photo']['type'];

  $fileext = explode('.', $filename);
  $filetrueext = strtolower(end($fileext));
  $array = ['jpg', 'png', 'jpeg'];


  if (in_array($filetrueext, $array)) {
    if ($fileerror === 0) {
      if ($filsize < 1000000) {
        $filenewname = $filename;
        $filedestination = '../images/' . $filenewname;
        if ($filename) {
          move_uploaded_file($filetempname, $filedestination);
        }
        $savedata = "INSERT INTO room_tbl  VALUES ('','$roomType','$noPersons','$amenities','$price','$status','../images/$filenewname')";

        if (mysqli_query($con, $savedata)) {
          echo "<script> alert('data inserted succesfully')</script>";
        } else {
          echo "Error:" . $sql . "<br>" . mysqli_error($con);
        }
      } else {
        echo '<script> alert("your file is too big!") </script>';
      }
    }
  } else {
    echo '<script> alert("cant upload this type of file!") </script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="add_room.css?v=<?php echo time(); ?>">
  <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
  <title>Add_Room</title>
</head>

<body>

<div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
        </nav>
    </div>


  <div class="form-holder">


    <div>
      <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
      <div class="head-label">
            <label class="header_text">ADD ROOM</label><br>
          </div>

        <div class="line-a">
          <div class="input_field_holder">
            <label for="room_type">Room Type:</label><br>
            <select name="room_type" id="room_type" class="select_fields"  required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Standard">Standard</option>
              <option value="Superior">Superior</option>
              <option value="Family">Family</option>
              <option value="Barkadahan">Barkadahan</option>
              <option value="Exclusive Suite">Exclusive Suite</option>
            </select>
              <br>

            <label for="room_type">Number of Persons:</label><br>
            <input type="number" name="no_persons" id="no_persons" class="input_fields" required><br>

            <label for="room_type">Amenities:</label><br>
            <input type="text" name="amenities" id="amenities" class="input_fields" required><br>

            <label for="room_type">Rate per Hours:</label><br>
            <input type="number" name="price" id="price" class="input_fields" required><br>

            <label for="room_type">Status:</label><br>
            <select name="status" id="status" class="select_fields" required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Available">Available</option>
              <option value="Coming soon">Coming Soon</option>
              <option value="Under Management">Under Management</option>
              <option value="Unavailable">Unavailable</option>
             
            </select>
              <br>
          </div>
        </div>

        <div class="line-b">
          <div class="center-label">
            <label for="room_type">Photo:</label><br>
          </div>

          <div class="center-label-image">
            <div class="image-holder" id="photo_preview"></div>
          </div>

          <div class="center-label">
            <input type="file" id="photo_input" name="photo" accept="image/*" required><br>
          </div>

          <div class="center-label">
            <button type="submit" name="addroom" class="button1">Save</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <script src="javascripts/add_room.js"></script>
</body>
</html>