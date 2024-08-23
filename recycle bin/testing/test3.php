<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test3.css?v=<?php echo time(); ?>">

    <title>Document</title>
</head>

<body>
    <h1>Welcome to My Webpage</h1>

    <button id="openModalBtn">Open Modal</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modal Title</h2>
            <p>This is the modal content.</p>
        </div>
    </div>
    <script src="test3.js"></script>
</body>

</html>