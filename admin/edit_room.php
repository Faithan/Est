    <?php
    include 'db_connect.php';
    session_start();

    $response = ['success' => false, 'message' => ''];

    // Validate manage_id
    if (isset($_GET['manage_id'])) {
        $manage_id = intval($_GET['manage_id']);
        $manage_query = "SELECT * FROM room_tbl WHERE id = ?";
        if ($stmt = $con->prepare($manage_query)) {
            $stmt->bind_param('i', $manage_id);
            $stmt->execute();
            $manage_result = $stmt->get_result();
            $manage_data = $manage_result->fetch_assoc();
            $stmt->close();
        } else {
            $response['message'] = 'Failed to prepare SQL statement for fetching room details.';
            echo json_encode($response);
            exit;
        }
    }

    ?>







    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- important files -->
        <?php
        include 'assets.php'
        ?>


        <title>Edit Room</title>

        <script src="javascripts/switch.js"></script>

        <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/edit_roomAndcottage.css?v=<?php echo time(); ?>">
        <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

    </head>

    <body>

        <main>

            <section class="side-nav">
                <div class="menu-container">
                    <div class="logo-container">
                        <img src="../system_images/suntree.png" alt="">
                        <label for="">Estregan Beach Resort</label>
                    </div>

                    <div class="menu">

                        <div class="item"><a href="dashboardRooms.php"><i class="fa-regular fa-circle-left"></i>
                                Return</a>
                        </div>
                    </div>
                </div>

                <?php
                include 'logoutbtn.php'
                ?>
            </section>


            <section class="middle-container">

                <div class="header-container">
                    <div class="title-head">

                        <label for=""><i class="fa-solid fa-gear"></i> Edit Room</label>
                    </div>

                    <?php include 'icon-container.php' ?>
                </div>











                <!-- dynamic content -->

                <div class="center-container">

                    <form id="update_form" action="update_photo_room.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $manage_data['id']; ?>">
                        <div class="image-container">
                            <div class="prev-image-container">
                                <label>Previous Photo:</label>
                                <img class="prev-image" src="<?php echo $manage_data['photo']; ?>" alt="Previous photo">
                            </div>

                            <div class="new-image-container">
                                <label>Upload New Photo:</label>
                                <div class="image-holder" id="photo_preview"></div>
                                <input type="file" id="photo" name="photo" accept="image/*">
                                <button type="submit" name="update_photo"><i class="fa-solid fa-floppy-disk"></i> Update
                                    Photo</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        const photoInput = document.getElementById('photo');
                        const photoPreview = document.getElementById('photo_preview');

                        photoInput.addEventListener('change', function() {
                            const file = this.files[0];

                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    const image = document.createElement('img');
                                    image.src = e.target.result;
                                    image.style.maxWidth = '100%';
                                    image.style.maxHeight = '100%';

                                    photoPreview.innerHTML = '';
                                    photoPreview.appendChild(image);
                                }
                                reader.readAsDataURL(file);
                            } else {
                                photoPreview.innerHTML = 'Please select a valid image file.';
                            }
                        });

                        document.getElementById('update_form').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent default form submission

                            const formData = new FormData(this);

                            fetch('update_photo_room.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: data.message,
                                            icon: 'success'
                                        }).then(() => {
                                            location.reload(); // Refresh the page or redirect as needed
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while updating the photo.',
                                        icon: 'error'
                                    });
                                });
                        });
                    </script>





















                    <form action="update_room.php" method="POST" enctype="multipart/form-data" class="create-room-form">

                        <div class="input-fields-container">

                            <div class="input-fields-subcontainer">
                                <label>Room Number:</label>
                                <input type="number" name="room_number" id="room_number" class="input_fields"
                                    value="<?php echo $manage_data['room_number']; ?>" required>
                            </div>

                            <div class="input-fields-subcontainer">
                                <label for="room_type">Room Type:</label>
                                <?php
                                // Assuming you've included the necessary database connection file

                                // Query to select distinct room type names
                                $sql = "SELECT DISTINCT room_type_name FROM room_type_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='room_type' id='room_type' class='select_fields' onchange='changeColorSelect(this)' required>";
                                $selectBox .= "<option disabled selected value=''>Choose an Option</option>";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $roomType = ucwords(strtolower($row["room_type_name"])); // Capitalize and format the room type

                                        // Check if the current room type matches the one in $manage_data and mark it as selected
                                        $selected = ($manage_data['room_type'] == $roomType) ? 'selected' : '';

                                        // Add the option to the select box
                                        $selectBox .= "<option value='" . $roomType . "' " . $selected . ">" . $roomType . "</option>";
                                    }
                                } else {
                                    $selectBox .= "<option value=''>No room types found.</option>";
                                }

                                $selectBox .= "</select>";

                                echo $selectBox;
                                ?>

                            </div>

                            <div class="input-fields-subcontainer">
                                <label for="bed_type">Bed Type:</label>
                                <?php
                                // Assuming you've included the necessary database connection file

                                // Query to select distinct bed type names
                                $sql = "SELECT DISTINCT bed_type_name FROM bed_type_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='bed_type' id='bed_type' class='select_fields' onchange='changeColorSelect(this)' required>";
                                $selectBox .= "<option disabled selected value=''>Choose an Option</option>";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $bedType = ucwords(strtolower($row["bed_type_name"])); // Capitalize and format the bed type

                                        // Ensure the manage_data bed type is trimmed and formatted the same way for comparison
                                        $selected = (trim(ucwords(strtolower($manage_data['bed_type']))) == $bedType) ? 'selected' : '';

                                        // Add the option to the select box
                                        $selectBox .= "<option value='" . $bedType . "' " . $selected . ">" . $bedType . "</option>";
                                    }
                                } else {
                                    $selectBox .= "<option value=''>No bed types found.</option>";
                                }

                                $selectBox .= "</select>";

                                echo $selectBox;
                                ?>
                            </div>



                            <div class="input-fields-subcontainer">
                                <label>Number of Bed:</label>
                                <input type="number" name="bed_quantity" id="bed_quantity" class="input_fields"
                                    value="<?php echo $manage_data['bed_quantity']; ?>"
                                    required>
                            </div>

                            <div class="input-fields-subcontainer">
                                <label>Number of Persons:</label>
                                <input type="number" name="no_persons" id="no_persons" class="input_fields"
                                    value="<?php echo $manage_data['no_persons']; ?>" required>
                            </div>

                            <div class="input-fields">
                                <label for="amenities">Amenities:</label>
                                <div class="custom-select">
                                    <div id="amenitiesSelectBox" class="select-box" onclick="toggleDropdown()">
                                        <span id="selectedAmenities">Select Amenities</span>
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                    <div id="amenitiesDropdown" class="dropdown-content">
                                        <?php
                                        // Fetch amenities from the database
                                        $sql = "SELECT amenity_name FROM room_amenities_tbl";
                                        $result = $con->query($sql);

                                        // Split the previously selected amenities into an array
                                        $selectedAmenities = explode(',', $manage_data['amenities']); // Assuming you stored them as a comma-separated string

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $amenityName = ucwords(strtolower($row["amenity_name"])); // Capitalize and format the amenity name
                                                // Check if the amenity is in the selected amenities array
                                                $checked = in_array($amenityName, $selectedAmenities) ? 'checked' : '';
                                                echo "<label><input type='checkbox' value='$amenityName' onchange='updateSelectedAmenities()' $checked> $amenityName</label><br>";
                                            }
                                        } else {
                                            echo "<label>No amenities found.</label>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="amenities" id="selectedAmenitiesInput" class="amenities">
                            </div>



                            <script>
                                function toggleDropdown() {
                                    const dropdown = document.getElementById("amenitiesDropdown");
                                    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
                                }

                                function updateSelectedAmenities() {
                                    const checkboxes = document.querySelectorAll('#amenitiesDropdown input[type="checkbox"]');
                                    let selected = [];

                                    checkboxes.forEach((checkbox) => {
                                        if (checkbox.checked) {
                                            selected.push(checkbox.value);
                                        }
                                    });

                                    // Update the displayed selected amenities
                                    const selectedText = selected.length > 0 ? selected.join(', ') : 'Select Amenities';
                                    document.getElementById("selectedAmenities").textContent = selectedText;

                                    // Update the hidden input value for form submission
                                    document.getElementById("selectedAmenitiesInput").value = selected.join(', ');
                                }

                                // Close dropdown when clicking outside of it
                                window.onclick = function(event) {
                                    const dropdown = document.getElementById("amenitiesDropdown");
                                    const selectBox = document.getElementById("amenitiesSelectBox");

                                    // Check if the click was outside the dropdown and the select box
                                    if (!event.target.matches('.select-box') && !selectBox.contains(event.target)) {
                                        if (dropdown.style.display === "block") {
                                            dropdown.style.display = "none";
                                        }
                                    }
                                };
                            </script>

                            <style>
                                .custom-select {
                                    position: relative;
                                    display: inline-block;
                                    width: 100%;
                                }

                                .select-box {
                                    border: 1px solid #ccc;
                                    padding: 10px;
                                    cursor: pointer;
                                    background-color: var(--first-color);
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    font-size: 1.4rem;
                                    border-radius: 5px;
                                    color: var(--seventh-color);
                                }

                                .select-box span {
                                    flex-grow: 1;

                                }

                                .dropdown-content {
                                    display: none;
                                    position: absolute;

                                    border: 1px solid #ccc;
                                    width: 100%;
                                    z-index: 1;
                                    max-height: 200px;
                                    overflow-y: auto;
                                    background-color: var(--first-color);
                                    color: var(--seventh-color);
                                }

                                .dropdown-content label {
                                    display: block;
                                    padding: 10px;
                                    cursor: pointer;
                                    font-size: 1.2rem;
                                }

                                .dropdown-content label:hover {
                                    background-color: var(--seventh-color3);
                                }

                                .dropdown-content input {
                                    margin-right: 10px;
                                }
                            </style>

                            <div class="input-fields-subcontainer">
                                <label>Price (Good for 22hrs):</label>
                                <input type="number" name="price" id="price" class="input_fields"
                                    value="<?php echo $manage_data['price']; ?>" required>
                            </div>

                            <div class="input-fields-subcontainer">
                                <label for="status">Status:</label>
                                <?php
                                // Assuming you've included the necessary database connection file

                                // Query to select distinct status names from the room_status_table
                                $sql = "SELECT DISTINCT room_status_name FROM room_status_tbl";
                                $result = $con->query($sql);

                                $selectBox = "<select name='status' id='status' class='select_fields' onchange='changeColorSelect(this)' required>";
                                $selectBox .= "<option disabled selected value=''>Choose an Option</option>";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $status = ucwords(strtolower($row["room_status_name"])); // Capitalize and format the status name

                                        // Check if the current status matches the one in $manage_data and mark it as selected
                                        $selected = ($manage_data['status'] == $status) ? 'selected' : '';

                                        // Add the option to the select box
                                        $selectBox .= "<option value='" . $status . "' " . $selected . ">" . $status . "</option>";
                                    }
                                } else {
                                    $selectBox .= "<option value=''>No statuses found.</option>";
                                }

                                $selectBox .= "</select>";

                                echo $selectBox;
                                ?>
                            </div>


                            <!-- id -->
                            <input type="hidden" name="id" value="<?php echo $manage_data['id']; ?>">

                        </div>

                        <div class="button-container">
                            <button type="submit" name="save" class="save-btn"><i class="fa-solid fa-download"></i> Save
                                Changes</button>
                            <button type="button" name="delete" class="delete-btn" onclick="confirmDelete()"><i
                                    class="fa-solid fa-trash"></i> Delete</button>
                        </div>






                    </form>



                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.querySelector('form.create-room-form');
                            const roomNumberInput = document.getElementById('room_number');
                            const roomTypeSelect = document.getElementById('room_type');
                            const bedTypeSelect = document.getElementById('bed_type');
                            const bedQuantityInput = document.getElementById('bed_quantity');
                            const noPersonsInput = document.getElementById('no_persons');
                            const amenitiesInput = document.querySelector('.amenities'); // Select by class
                            const priceInput = document.getElementById('price');
                            const statusSelect = document.getElementById('status');

                            let originalRoomNumber = roomNumberInput.value;
                            let originalRoomType = roomTypeSelect.value;
                            let originalBedType = bedTypeSelect.value;
                            let originalBedQuantity = bedQuantityInput.value;
                            let originalNoPersons = noPersonsInput.value;
                            let originalAmenities = amenitiesInput.value; // Now correctly captures the value using class
                            let originalPrice = priceInput.value;
                            let originalStatus = statusSelect.value;

                            form.addEventListener('submit', function(event) {
                                event.preventDefault(); // Prevent the default form submission

                                // Check if values have changed
                                const isRoomNumberChanged = roomNumberInput.value !== originalRoomNumber;
                                const isRoomTypeChanged = roomTypeSelect.value !== originalRoomType;
                                const isBedTypeChanged = bedTypeSelect.value !== originalBedType;
                                const isBedQuantityChanged = bedQuantityInput.value !== originalBedQuantity;
                                const isNoPersonsChanged = noPersonsInput.value !== originalNoPersons;
                                const isAmenitiesChanged = amenitiesInput.value !== originalAmenities; // Check against class
                                const isPriceChanged = priceInput.value !== originalPrice;
                                const isStatusChanged = statusSelect.value !== originalStatus;

                                if (isRoomNumberChanged || isRoomTypeChanged || isBedTypeChanged || isBedQuantityChanged ||
                                    isNoPersonsChanged || isAmenitiesChanged || isPriceChanged || isStatusChanged) {

                                    Swal.fire({
                                        title: 'Save Changes?',
                                        text: 'Are you sure you want to save the changes?',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, save',
                                        cancelButtonText: 'No, cancel'
                                    }).then(result => {
                                        if (result.isConfirmed) {
                                            // Create a FormData object and submit the form via AJAX
                                            const formData = new FormData(form);

                                            fetch('update_room.php', {
                                                    method: 'POST',
                                                    body: formData
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    console.log('Response Data:', data); // Log the received data to check the response
                                                    if (data.success) {
                                                        console.log('Success block executed'); // Log to check if this block runs
                                                        Swal.fire({
                                                            title: 'Success!',
                                                            text: data.message,
                                                            icon: 'success'
                                                        }).then(() => {
                                                            window.location.href = 'dashboardRooms.php'; // Redirect after success
                                                        });
                                                    } else {
                                                        console.log('Error block executed'); // Log to check if this block runs
                                                        Swal.fire({
                                                            title: 'Error!',
                                                            text: data.message,
                                                            icon: 'error'
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error); // Log any errors
                                                    Swal.fire({
                                                        title: 'Error!',
                                                        text: 'An error occurred while saving changes.',
                                                        icon: 'error'
                                                    });
                                                });
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'No Changes Detected',
                                        text: 'No changes were detected. Please modify the values before saving.',
                                        icon: 'info'
                                    });
                                }
                            });
                        });
                    </script>






                </div>
                <!-- end of content-container -->















            </section>

        </main>



    </body>

    </html>





    <!-- for delete button -->
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem();
                }
            });
        }

        function deleteItem() {
            var id = document.querySelector('input[name="id"]').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_room.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'Deleted Successfully',
                            text: 'The item has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'dashboardRooms.php'; // Replace with your desired page after deletion
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Error',
                            text: 'Failed to delete the item.',
                            icon: 'error'
                        });
                    }
                }
            };
            xhr.send('id=' + id);
        }
    </script>