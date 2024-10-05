<?php
require('db_connect.php');
session_start();

// Fetch cottage types
$cottage_type_query = "SELECT cottage_type_id, cottage_type_name, cottage_type_description FROM cottage_type_tbl";
$cottage_types = [];
if ($result = $con->query($cottage_type_query)) {
    while ($row = $result->fetch_assoc()) {
        $cottage_types[] = $row;
    }
    $result->free();
} else {
    $message = 'Failed to fetch cottage types.';
}

// Fetch cottage statuses
$cottage_status_query = "SELECT cottage_status_id, cottage_status_name, cottage_status_description FROM cottage_status_tbl";
$cottage_statuses = [];
if ($result = $con->query($cottage_status_query)) {
    while ($row = $result->fetch_assoc()) {
        $cottage_statuses[] = $row;
    }
    $result->free();
} else {
    $message = 'Failed to fetch cottage statuses.';
}

// Handle form submission for updating or adding items
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = $con->real_escape_string($_POST['name']);
    $description = $con->real_escape_string($_POST['description']);
    $type = $_POST['type'];

    if ($type == 'type') {
        $update_query = "UPDATE cottage_type_tbl SET cottage_type_name = ?, cottage_type_description = ? WHERE cottage_type_id = ?";
        if ($stmt = $con->prepare($update_query)) {
            $stmt->bind_param('ssi', $name, $description, $id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($type == 'status') {
        $update_query = "UPDATE cottage_status_tbl SET cottage_status_name = ?, cottage_status_description = ? WHERE cottage_status_id = ?";
        if ($stmt = $con->prepare($update_query)) {
            $stmt->bind_param('ssi', $name, $description, $id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($type == 'add_type' || $type == 'add_status') {
        $insert_query = $type == 'add_type'
            ? "INSERT INTO cottage_type_tbl (cottage_type_name, cottage_type_description) VALUES (?, ?)"
            : "INSERT INTO cottage_status_tbl (cottage_status_name, cottage_status_description) VALUES (?, ?)";

        if ($stmt = $con->prepare($insert_query)) {
            $stmt->bind_param('ss', $name, $description);
            $stmt->execute();
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets.php'; ?>
    <title>Cottage Extra Settings</title>
    <script src="javascripts/switch.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <style>
        /* Your CSS styles here */
        .main-content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .cottage-box {
            background-color: var(--first-color);
            border: 1px solid var(--seventh-color3);
            border-radius: 8px;
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .cottage-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 18px;
            color: var(--seventh-color);
        }

        .cottage-box p {
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
                    <label><i class="fa-solid fa-campground"></i> Cottage Extra Settings</label>
                </div>
                <!-- Cottage Type Section -->
                <div class="content-container">
                    <label for="">Cottage Type</label>
                    <div class="main-content">
                        <?php if (!empty($cottage_types)): ?>
                            <?php foreach ($cottage_types as $type): ?>
                                <div class="cottage-box" data-id="<?= htmlspecialchars($type['cottage_type_id']) ?>">
                                    <h3><?= htmlspecialchars($type['cottage_type_name']) ?></h3>
                                    <p><strong>ID:</strong> <?= htmlspecialchars($type['cottage_type_id']) ?></p>
                                    <p><strong>Description:</strong> <?= htmlspecialchars($type['cottage_type_description']) ?>
                                    </p>
                                    <div class="button-group">
                                        <button class="edit-button"
                                            onclick="editItem(<?= htmlspecialchars($type['cottage_type_id']) ?>, 'type')">Edit</button>
                                        <button class="delete-button"
                                            onclick="deleteItem(<?= htmlspecialchars($type['cottage_type_id']) ?>, 'type')">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No cottage types found.</p>
                        <?php endif; ?>
                    </div>
                    <button class="add-button" onclick="openAddModal('add_type')">+ Add Cottage Type</button>
                </div>
                <!-- Cottage Status Section -->
                <div class="content-container">
                    <label for="">Cottage Status</label>
                    <div class="main-content">
                        <?php if (!empty($cottage_statuses)): ?>
                            <?php foreach ($cottage_statuses as $status): ?>
                                <div class="cottage-box" data-id="<?= htmlspecialchars($status['cottage_status_id']) ?>">
                                    <h3><?= htmlspecialchars($status['cottage_status_name']) ?></h3>
                                    <p><strong>ID:</strong> <?= htmlspecialchars($status['cottage_status_id']) ?></p>
                                    <p><strong>Description:</strong>
                                        <?= htmlspecialchars($status['cottage_status_description']) ?></p>
                                    <div class="button-group">
                                        <button class="edit-button"
                                            onclick="editItem(<?= htmlspecialchars($status['cottage_status_id']) ?>, 'status')">Edit</button>
                                        <button class="delete-button"
                                            onclick="deleteItem(<?= htmlspecialchars($status['cottage_status_id']) ?>, 'status')">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No cottage statuses found.</p>
                        <?php endif; ?>
                    </div>
                    <button class="add-button" onclick="openAddModal('add_status')">+ Add Cottage Status</button>
                </div>
                <!-- Edit Form Modal -->
                <div id="edit-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeModal()">&times;</span>
                        <form id="edit-form" method="POST" action="">
                            <input type="hidden" id="edit-id" name="id">
                            <input type="hidden" id="edit-type" name="type">
                            <label for="edit-name">Name:</label>
                            <input type="text" id="edit-name" name="name" required>
                            <label for="edit-description">Description:</label>
                            <textarea id="edit-description" name="description" required></textarea>
                            <button type="submit" id="update-button">Save</button>
                        </form>
                    </div>
                </div>

                <!-- Add Form Modal -->
                <div id="add-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeAddModal()">&times;</span>
                        <form id="add-form" method="POST" action="">
                            <input type="hidden" id="add-type" name="type">
                            <label for="add-name">Name:</label>
                            <input type="text" id="add-name" name="name" required>
                            <label for="add-description">Description:</label>
                            <textarea id="add-description" name="description" required></textarea>
                            <button type="submit" id="add-button">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        // Function to populate and display the edit modal
        function editItem(id, type) {
            const itemBox = document.querySelector(`.cottage-box[data-id="${id}"]`);
            if (!itemBox) {
                console.error('Item box not found for ID:', id);
                return;
            }
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-type').value = type;
            document.getElementById('edit-name').value = itemBox.querySelector('h3')?.textContent.trim() || '';
            document.getElementById('edit-description').value = itemBox.querySelector('p:last-child')?.textContent.trim() || '';
            document.getElementById('edit-modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('edit-modal').style.display = 'none';
        }

        document.getElementById('edit-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('cottage_settings_update.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const itemBox = document.querySelector(`.cottage-box[data-id="${formData.get('id')}"]`);
                        if (itemBox) {
                            itemBox.querySelector('h3').textContent = formData.get('name');
                            itemBox.querySelector('p:last-child').textContent = formData.get('description');
                        }
                        closeModal();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function openAddModal(type) {
            document.getElementById('add-type').value = type;
            document.getElementById('add-modal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('add-modal').style.display = 'none';
        }

        document.getElementById('add-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('cottage_settings_add.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const container = document.querySelector(`.content-container .main-content`);
                        const newItemBox = document.createElement('div');
                        newItemBox.className = 'cottage-box';
                        newItemBox.setAttribute('data-id', data.id);
                        newItemBox.innerHTML = `
                  <h3>${formData.get('name')}</h3>
                  <p><strong>ID:</strong> ${data.id}</p>
                  <p><strong>Description:</strong> ${formData.get('description')}</p>
                  <div class="button-group">
                      <button class="edit-button" onclick="editItem(${data.id}, '${formData.get('type')}')">Edit</button>
                      <button class="delete-button" onclick="deleteItem(${data.id}, '${formData.get('type')}')">Delete</button>
                  </div>
              `;
                        container.appendChild(newItemBox);
                        closeAddModal();
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function deleteItem(id, type) {
            if (confirm('Are you sure you want to delete this item?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_item.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        const itemBox = document.querySelector(`.cottage-box[data-id="${id}"]`);
                        if (itemBox) {
                            itemBox.remove();
                        }
                        alert('Item deleted successfully.');
                    } else {
                        alert('Failed to delete the item.');
                    }
                };
                xhr.send(`id=${id}&type=${type}`);
            }
        }

        window.onclick = function (event) {
            if (event.target === document.getElementById('edit-modal')) {
                closeModal();
            }
            if (event.target === document.getElementById('add-modal')) {
                closeAddModal();
            }
        }

    </script>
</body>

</html>