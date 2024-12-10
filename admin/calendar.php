<?php
require 'db_connect.php';
session_start();

// Fetch reserve cottage data where reserve_status is either 'confirmed' or 'checkedIn'
$cottage_query = "SELECT date_of_arrival FROM reserve_cottage_tbl WHERE reserve_status IN ('pending','confirmed', 'checkedIn')";
$cottage_result = mysqli_query($con, $cottage_query);
$cottage_dates = [];
while ($row = mysqli_fetch_assoc($cottage_result)) {
    $cottage_dates[] = $row['date_of_arrival'];
}

// Fetch reserve room data where status is either 'confirmed', 'checkedIn', or 'extended'
$room_query = "SELECT date_of_arrival FROM reserve_room_tbl WHERE status IN ('pending','confirmed', 'checkedIn', 'extended')";
$room_result = mysqli_query($con, $room_query);
$room_dates = [];
while ($row = mysqli_fetch_assoc($room_result)) {
    $room_dates[] = $row['date_of_arrival'];
}

// Merge the arrays for easier processing
$all_dates = array_merge($cottage_dates, $room_dates);
?>

<script>
    // Pass PHP dates to JavaScript
    var reservedDates = <?php echo json_encode($all_dates); ?>;
</script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php include 'assets.php' ?>

    <title>Calendar</title>

    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">


    <link href='../calendar_ext/fullcalendar.min.css' rel='stylesheet' />
    <script src='../calendar_ext/jquery.min.js'></script>
    <script src='../calendar_ext/moment.min.js'></script>
    <script src='../calendar_ext/fullcalendar.min.js'></script>
</head>

<body>

    <main>

        <?php include 'sidenav.php'; ?>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-calendar-days"></i> Calendar</label>
                </div>

                <?php include 'icon-container.php'; ?>
            </div>

            <!-- dynamic content -->
            <div class="center-container">
                <div id="calendar"></div>
            </div>


            <!-- Custom Modal -->
            <div id="reservationModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h5>Reservation Details</h5>
                    <div id="modalBody">
                        <!-- Reservation details will appear here -->
                    </div>
                </div>
            </div>



        </section>

    </main>


</body>

</html>




<script>
    $(document).ready(function() {
        var reservedCottageDates = <?php echo json_encode($cottage_dates); ?>;
        var reservedRoomDates = <?php echo json_encode($room_dates); ?>;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                ...reservedCottageDates.map(date => ({
                    title: 'Cottage Reserved',
                    start: date,
                    allDay: true,
                    color: '#00527e', // Green for cottages
                    type: 'cottage'
                })),
                ...reservedRoomDates.map(date => ({
                    title: 'Room Reserved',
                    start: date,
                    allDay: true,
                    color: '#D62828', // Blue for rooms
                    type: 'room'
                }))
            ],
            editable: true,
            eventLimit: true,
            eventClick: function(event) {
                // Fetch the details for the clicked date
                var date = event.start.format('YYYY-MM-DD');
                fetchReservationDetails(date, event.type);
            }
        });

        // Function to fetch reservation details via AJAX or direct
        function fetchReservationDetails(date, type) {
            $.ajax({
                url: 'fetch_reservation_details.php', // Create this PHP file to return details
                type: 'POST',
                data: {
                    date: date,
                    type: type
                },
                success: function(response) {
                    // Populate modal with response
                    $('#modalBody').html(response);
                    // Show the modal
                    document.getElementById("reservationModal").style.display = "block";
                }
            });
        }

        // Close the modal when clicking on the close button
        $('.close-btn').click(function() {
            document.getElementById("reservationModal").style.display = "none";
        });

        // Close the modal when clicking outside of the modal content
        window.onclick = function(event) {
            var modal = document.getElementById("reservationModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });
</script>













<style>
    #calendar {
        background-color: var(--first-color);

    }

    table{
        background-color: var(--first-color);
    }
    
    /* Customize the calendar header */
    .fc-header-toolbar {
        background-color: var(--first-color);
        /* Light background color for header */
  
        /* Subtle border at the bottom */
        padding: 10px;
        /* Padding for spacing */
        color: var(--seventh-color);
        margin: 0;
    }

    /* Style the calendar title */
    .fc-title {
        font-weight: bold;
        /* Make the title bold */
        font-size: 1.5em;
        /* Larger font size for title */

    }

    /* Style buttons in the header */
    .fc-button {
        background-color: var(--first-color2);
        /* Primary color for buttons */
        color: var(--seventh-color);
        /* Text color */
        border: none;
        /* Remove default border */
        border-radius: 4px;
        /* Rounded corners */
        padding: 5px 10px;
        /* Padding for better click area */
        transition: background-color 0.3s;
        /* Transition for hover effect */
    }

    .fc-button-group button span{
        color: #18191A;
     
    }
    /* Change button color on hover */
    .fc-button:hover {
        background-color: var(--seventh-color2);
        /* Darker blue on hover */
    }

    /* Style the days in the calendar */
    .fc-day {
        border: 1px solid var(--seventh-color);
        /* Light border for each day */
        background-color: var(--first-color2);
        /* White background for days */
    }

    /* Customize the current day */
    .fc-today {
        background-color: #d1e7dd;
        /* Light green background for today */
        font-weight: bold;
        /* Make today's date bold */
    }


    .fc-event {
        padding: 5px;
        border-radius: 4px;
        cursor: pointer;
    }

    .fc-event[type='cottage'] {
        background-color: #81C5F3;
        /* Green for cottage reservations */
        color: white;
    }

    .fc-event[type='room'] {
        background-color: #FF9AAF;
        /* Blue for room reservations */
        color: white;
    }


    /* Change event color on hover */
    .fc-event:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    /* Style for the selected date range */
    .fc-highlight {
        background-color: rgba(0, 123, 255, 0.2);
        /* Light blue highlight */
    }

    /* Adjust the week and month view */
    .fc-day-grid .fc-day-number {
        font-weight: bold;
        /* Bold day numbers */
        font-size: 1.1em;
        /* Slightly larger font for day numbers */

    }


    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 9999;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        background-color: rgba(0, 0, 0, 0.5);
        /* Black background with opacity */
        overflow: auto;
    
    }

    /* Modal Content */
    .modal-content {
        background-color: var(--first-color2);
        margin: 2% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        /* Could be more or less, depending on screen size */
        border-radius: 10px;
    }

    .modal-content h5 {
        font-size: 2rem;
        color: var(--seventh-color);
        margin-bottom: 10px;
    }

    #modalBody {
        display: flex;
        flex-direction: column;
        color: var(--seventh-color);
      
       
        gap: 10px;
    }

    #modalBody .reserve-box{
        background-color: var(--first-color);
        padding: 10px;
        border-radius: 5px;
    }

    #modalBody img{
        max-height: 200px;
        max-width: 200px;
    }

    /* Close Button */
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }


    /* Responsive adjustments */
    @media (max-width: 768px) {
        .fc-header-toolbar {
            font-size: 0.9em;
            /* Smaller font size on mobile */
        }
    }
</style>