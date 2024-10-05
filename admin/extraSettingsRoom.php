<?php
// index.php

// Include database connection and other necessary files
include 'db_connect.php'; // Make sure this file contains your database connection logic
session_start();

// Fetch room types, bed types, and room statuses from the database
$query_room_types = "SELECT * FROM room_type_tbl";
$query_bed_types = "SELECT * FROM bed_type_tbl";
$query_room_statuses = "SELECT * FROM room_status_tbl";

$room_types = mysqli_query($con, $query_room_types);
$bed_types = mysqli_query($con, $query_bed_types);
$room_statuses = mysqli_query($con, $query_room_statuses);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets.php'; ?>
    <title>Room Extra Settings</title>
    <script src="javascripts/switch.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
</head>
<body>
    <main>
        <?php include 'sidenav.php'; ?>
        <section class="middle-container">
            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-gears"></i> Extra Settings</label>
                </div>
                <?php include 'icon-container.php'?>
            </div>
            <!-- dynamic content -->
            <div class="center-container">
                <div class="head-label-container">
                    <label><i class="fa-solid fa-campground"></i> Room Extra Settings</label>
                </div>
                <!-- Room Type Section -->
                <div class="content-container">
                    <label for="">Room Type</label>
                    <div class="main-content">
                        <?php if (mysqli_num_rows($room_types) > 0): ?>
                            <?php while ($room_type = mysqli_fetch_assoc($room_types)): ?>
                                <div class="room-box">
                                    <h3><?php echo htmlspecialchars($room_type['room_type_name']); ?></h3>
                                    <p><strong>ID:</strong> <?php echo htmlspecialchars($room_type['room_type_id']); ?></p>
                                    <p><?php echo htmlspecialchars($room_type['room_type_description']); ?></p>
                                    <div class="button-group">
                                        <button class="edit-button"
                                            onclick="openEditModal('edit_room_type', <?php echo $room_type['room_type_id']; ?>, '<?php echo htmlspecialchars($room_type['room_type_name']); ?>', '<?php echo htmlspecialchars($room_type['room_type_description']); ?>')">Edit</button>
                                        <button class="delete-button"
                                            onclick="deleteItem('delete_room_type', <?php echo $room_type['room_type_id']; ?>)">Delete</button>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <button class="add-button" onclick="openAddModal('room_type')"><i class="fa fa-plus"></i> Add Room Type</button>
                </div>

                <!-- Room Bed Type Section -->
                <div class="content-container">
                    <label for="">Room Bed Type</label>
                    <div class="main-content">
                        <?php if (mysqli_num_rows($bed_types) > 0): ?>
                            <?php while ($bed_type = mysqli_fetch_assoc($bed_types)): ?>
                                <div class="room-box">
                                    <h3><?php echo htmlspecialchars($bed_type['bed_type_name']); ?></h3>
                                    <p><strong>ID:</strong> <?php echo htmlspecialchars($bed_type['bed_type_id']); ?></p>
                                    <p><?php echo htmlspecialchars($bed_type['bed_type_description']); ?></p>
                                    <div class="button-group">
                                        <button class="edit-button"
                                            onclick="openEditModal('edit_bed_type', <?php echo $bed_type['bed_type_id']; ?>, '<?php echo htmlspecialchars($bed_type['bed_type_name']); ?>', '<?php echo htmlspecialchars($bed_type['bed_type_description']); ?>')">Edit</button>
                                        <button class="delete-button"
                                            onclick="deleteItem('delete_bed_type', <?php echo $bed_type['bed_type_id']; ?>)">Delete</button>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <button class="add-button" onclick="openAddModal('bed_type')"><i class="fa fa-plus"></i> Add Bed Type</button>
                </div>

                <!-- Room Status Section -->
                <div class="content-container">
                    <label for="">Room Status</label>
                    <div class="main-content">
                        <?php if (mysqli_num_rows($room_statuses) > 0): ?>
                            <?php while ($room_status = mysqli_fetch_assoc($room_statuses)): ?>
                                <div class="room-box">
                                    <h3><?php echo htmlspecialchars($room_status['room_status_name']); ?></h3>
                                    <p><strong>ID:</strong> <?php echo htmlspecialchars($room_status['room_status_id']); ?></p>
                                    <p><?php echo htmlspecialchars($room_status['room_status_description']); ?></p>
                                    <div class="button-group">
                                        <button class="edit-button"
                                            onclick="openEditModal('edit_room_status', <?php echo $room_status['room_status_id']; ?>, '<?php echo htmlspecialchars($room_status['room_status_name']); ?>', '<?php echo htmlspecialchars($room_status['room_status_description']); ?>')">Edit</button>
                                        <button class="delete-button"
                                            onclick="deleteItem('delete_room_status', <?php echo $room_status['room_status_id']; ?>)">Delete</button>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <button class="add-button" onclick="openAddModal('room_status')"><i class="fa fa-plus"></i> Add Room Status</button>
                </div>
            </div>
        </section>

        <!-- Edit Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
                <form action="room_settings_update.php" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="hidden" name="edit_type" id="edit_type">
                    <label for="edit_name">Name:</label>
                    <input type="text" name="edit_name" id="edit_name">
                    <label for="edit_description">Description:</label>
                    <textarea name="edit_description" id="edit_description" rows="4"></textarea>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>

        <!-- Add Modal -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal('addModal')">&times;</span>
                <form action="room_settings_add.php" method="POST">
                    <input type="hidden" name="add_type" id="add_type">
                    <label for="add_name">Name:</label>
                    <input type="text" name="add_name" id="add_name">
                    <label for="add_description">Description:</label>
                    <textarea name="add_description" id="add_description" rows="4"></textarea>
                    <button type="submit">Add</button>
                </form>
            </div>
        </div>
    </main>

    <script>
    function openEditModal(type, id, name, description) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
        document.getElementById('editModal').style.display = 'block';
    }

    function openAddModal(type) {
        document.getElementById('add_type').value = type;
        document.getElementById('add_name').value = '';
        document.getElementById('add_description').value = '';
        document.getElementById('addModal').style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function deleteItem(type, id) {
    if (confirm('Are you sure you want to delete this item?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'room_settings_delete.php'; // Make sure this matches your PHP file

        const inputType = document.createElement('input');
        inputType.type = 'hidden';
        inputType.name = 'type';
        inputType.value = type;
        form.appendChild(inputType);

        const inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = id;
        form.appendChild(inputId);

        document.body.appendChild(form);
        form.submit();
    }
}

    </script>
</body>
</html>













<style>
        /* Your CSS styles here */
        
        .main-content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .room-box {
            background-color: var(--first-color);
            border: 1px solid var(--seventh-color3);
            border-radius: 8px;
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .room-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
            color: var(--seventh-color);
        }

        .room-box p {
            margin: 5px 0;
            font-size: 14px;
            color: var(--seventh-color);
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .edit-button,
        .delete-button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .edit-button {
            background-color: var(--proceed-bgcolor);
            color: var(--proceed-color);
            border: 1px solid var(--seventh-color3);
        }

        .delete-button {
            background-color: var(--cancel-bgcolor);
            color: var(--cancel-color);
            border: 1px solid var(--seventh-color3);
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .add-button {
            background-color: var(--first-color2);
            color: var(--seventh-color);
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
        }

        .add-button:hover {
            background-color: #218838;
            color: var(--pure-white);
            transition: ease-in-out 0.3s;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: var(--first-color);
            margin: 10% auto;
            padding: 20px;
            border: 1px solid var(--seventh-color3);
            width: 50%;
            border-radius: 8px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
        }

        .modal label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--seventh-color);
        }

        .modal input,
        .modal textarea {
            width: 97%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid var(--seventh-color3);
            border-radius: 4px;
            background-color: var(--first-color2);
            color: var(--seventh-color);
        }

        .modal button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #0056b3;
        }
    </style>