<?php
include 'db_connect.php';
session_start();

$response = ['success' => false, 'message' => ''];

// Validate manage_id
if (isset($_GET['manage_id'])) {
    $manage_id = intval($_GET['manage_id']);
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = ?";
    if ($stmt = $con->prepare($manage_query)) {
        $stmt->bind_param('i', $manage_id);
        $stmt->execute();
        $manage_result = $stmt->get_result();
        $manage_data = $manage_result->fetch_assoc();
        $stmt->close();
    } else {
        $response['message'] = 'Failed to prepare SQL statement for fetching cottage details.';
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


    <title>Edit Cottage</title>

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

                    <div class="item"><a href="dashboardCottages.php"><i class="fa-regular fa-circle-left"></i>
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

                    <label for=""><i class="fa-solid fa-gear"></i> Edit Cottage</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">

                <form id="update_form" action="update_photo_cottage.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="cottage_id" value="<?php echo $manage_data['cottage_id']; ?>">
                    <div class="image-container">
                        <div class="prev-image-container">
                            <label>Previous Photo:</label>
                            <img class="prev-image" src="<?php echo $manage_data['cottage_photo']; ?>"
                                alt="Previous photo">
                        </div>

                        <div class="new-image-container">
                            <label>Upload New Photo:</label>
                            <div class="image-holder" id="photo_preview"></div>
                            <input type="file" id="photo" name="cottage_photo" accept="image/*">
                            <button type="submit" name="update_photo"><i class="fa-solid fa-floppy-disk"></i> Update
                                Photo</button>
                        </div>
                    </div>
                </form>

                <script>
                    const photoInput = document.getElementById('photo');
                    const photoPreview = document.getElementById('photo_preview');

                    photoInput.addEventListener('change', function () {
                        const file = this.files[0];

                        if (file && file.type.startsWith('image/')) {
                            const reader = new FileReader();

                            reader.onload = function (e) {
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

                    document.getElementById('update_form').addEventListener('submit', function (event) {
                        event.preventDefault(); // Prevent default form submission

                        const formData = new FormData(this);

                        fetch('update_photo_cottage.php', {
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





















                <form action="update_cottage.php" method="POST" enctype="multipart/form-data" class="create-room-form">

                    <div class="input-fields-container">

                        <div class="input-fields-subcontainer">
                            <label>Cottage Number:</label>
                            <input type="number" name="cottage_number" id="cottage_number" class="input_fields"
                                 value="<?php echo $manage_data['cottage_number']; ?>"
                                required>
                        </div>


                        <div class="input-fields-subcontainer">
                            <label for="cottage_type">Cottage Type:</label>
                            <?php
                            // Assuming you've included the necessary database connection file
                            
                            // Query to select cottage room type names
                            $sql = "SELECT DISTINCT cottage_type_name FROM cottage_type_tbl";
                            $result = $con->query($sql);

                            $selectBox = "<select name='cottage_type' id='cottage_type' class='select_fields' onchange='changeColorSelect(this)' required>";
                            $selectBox .= "<option disabled selected value=''>Choose an Option</option>";

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $cottageType = ucwords(strtolower($row["cottage_type_name"])); // Capitalize and format the room type
                            
                                    // Check if the current room type matches the one in $manage_data and mark it as selected
                                    $selected = ($manage_data['cottage_type'] == $cottageType) ? 'selected' : '';

                                    // Add the option to the select box
                                    $selectBox .= "<option value='" . $cottageType . "' " . $selected . ">" . $cottageType . "</option>";
                                }
                            } else {
                                $selectBox .= "<option value=''>No room types found.</option>";
                            }

                            $selectBox .= "</select>";

                            echo $selectBox;
                            ?>

                        </div>



                        <div class="input-fields-subcontainer">
                            <label>Number of Persons:</label>
                            <input type="number" name="number_of_person" id="number_of_person" class="input_fields"
                                 value="<?php echo $manage_data['number_of_person']; ?>"
                                required>
                        </div>

                        <div class="input-fields-subcontainer">
                            <label>Day Price:</label>
                            <input type="number" name="day_price" id="day_price" class="input_fields"
                                 value="<?php echo $manage_data['day_price']; ?>" required>
                        </div>

                        <div class="input-fields-subcontainer">
                            <label>Night Price:</label>
                            <input type="number" name="night_price" id="night_price" class="input_fields"
                                 value="<?php echo $manage_data['night_price']; ?>" required>
                        </div>

                        <div class="input-fields-subcontainer">
                            <label for="cottage_status">Cottage Status:</label>
                            <?php
                            // Query to select distinct cottage status names from the cottage_status_tbl
                            $sql = "SELECT DISTINCT cottage_status_name FROM cottage_status_tbl";
                            $result = $con->query($sql);

                            $selectBox = "<select name='cottage_status' id='cottage_status' class='select_fields' onchange='changeColorSelect(this)' required>";
                            $selectBox .= "<option disabled selected value=''>Choose an Option</option>";

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $cottageStatus = ucwords(strtolower($row["cottage_status_name"])); // Capitalize and format the cottage status
                            
                                    $selected = ($manage_data['cottage_status'] == $cottageStatus) ? 'selected' : '';

                                    $selectBox .= "<option value='" . $cottageStatus . "' " . $selected . ">" . $cottageStatus . "</option>";
                                }
                            } else {
                                $selectBox .= "<option value=''>No cottage statuses found.</option>";
                            }

                            $selectBox .= "</select>";

                            echo $selectBox;
                            ?>
                        </div>

                        <!-- id -->
                        <input type="hidden" name="cottage_id" value="<?php echo $manage_data['cottage_id']; ?>">

                    </div>

                    <div class="button-container">
                        <button type="submit" name="save" class="save-btn"><i class="fa-solid fa-download"></i> Save
                            Changes</button>
                        <button type="button" name="delete" class="delete-btn" onclick="confirmDelete()"><i
                                class="fa-solid fa-trash"></i> Delete</button>
                    </div>

                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.querySelector('form.create-room-form');
                        const cottageNumberInput = document.getElementById('cottage_number');
                        const cottageTypeSelect = document.getElementById('cottage_type');
                        const numberOfPersonsInput = document.getElementById('number_of_person');
                        const dayPriceInput = document.getElementById('day_price');
                        const nightPriceInput = document.getElementById('night_price');
                        const cottageStatusSelect = document.getElementById('cottage_status');

                        let originalCottageNumber = cottageNumberInput.value;
                        let originalCottageType = cottageTypeSelect.value;
                        let originalNumberOfPersons = numberOfPersonsInput.value;
                        let originalDayPrice = dayPriceInput.value;
                        let originalNightPrice = nightPriceInput.value;
                        let originalCottageStatus = cottageStatusSelect.value;

                        form.addEventListener('submit', function (event) {
                            event.preventDefault(); // Prevent the default form submission

                            // Check if values have changed
                            const isCottageNumberChanged = cottageNumberInput.value !== originalCottageNumber;
                            const isCottageTypeChanged = cottageTypeSelect.value !== originalCottageType;
                            const isNumberOfPersonsChanged = numberOfPersonsInput.value !== originalNumberOfPersons;
                            const isDayPriceChanged = dayPriceInput.value !== originalDayPrice;
                            const isNightPriceChanged = nightPriceInput.value !== originalNightPrice;
                            const isCottageStatusChanged = cottageStatusSelect.value !== originalCottageStatus;

                            if (isCottageNumberChanged || isCottageTypeChanged || isNumberOfPersonsChanged || isDayPriceChanged ||
                                isNightPriceChanged || isCottageStatusChanged) {
                                Swal.fire({
                                    title: 'Save Changes?',
                                    text: 'Are you sure you want to save the changes?',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, save',
                                    cancelButtonText: 'No, cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Create a FormData object and submit the form via AJAX
                                        const formData = new FormData(form);

                                        fetch('update_cottage.php', {
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
                                                        window.location.href = 'dashboardCottages.php'; // Redirect after success
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
        var id = document.querySelector('input[name="cottage_id"]').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_cottage.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    Swal.fire({
                        title: 'Deleted Successfully',
                        text: 'The item has been deleted.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'dashboardCottages.php'; // Replace with your desired page after deletion
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
        xhr.send('cottage_id=' + id);
    }
</script>