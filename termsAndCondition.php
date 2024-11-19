<?php
include('db_connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Reset CSS -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- JavaScript -->
    <script src="landing_js/mobileMenu.js" defer></script>

    <?php include 'important.php'; ?>

    <!-- Current page CSS -->
    <link rel="stylesheet" href="landing_css/index.css?v=<?php echo time(); ?>">

    <title>Terms and Conditions - Estregan Beach Resort</title>

    <style>
        /* Styles for the Terms and Conditions Page */
        .terms-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: var(--first-color);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .terms-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .terms-header h1 {
            font-size: 2.5rem;
            color: var(--seventh-color);
            margin-bottom: 10px;
        }

        .terms-header p {
            font-size: 1.4rem;
            color: #666;
        }

        .terms-content {
            font-size: 1.4rem;
            line-height: 1.8;
            color: gray;
        }

        .terms-content h2 {
            font-size: 1.5rem;
            color: blue;
            margin-top: 30px;
            
        }

        .terms-content ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        .terms-content ul li {
            margin-bottom: 8px;
        }

        .terms-footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9rem;
            color: #999;
        }

        /* Footer style */
        footer {
            background-color: #003366;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>

</head>

<body>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Terms and Conditions Page -->
    <div class="terms-container">
        <div class="terms-header">
            <h1>Terms and Conditions</h1>
            <p>Welcome to Estregan Beach Resort! Please read our Terms and Conditions carefully before using our services.</p>
        </div>

        <div class="terms-content">
            <h2>1. Introduction</h2>
            <p>These terms and conditions govern your use of Estregan Beach Resort's website and services. By using our website, you agree to comply with and be bound by these terms.</p>

            <h2>2. Booking and Reservations</h2>
            <p>All reservations made through the Estregan Beach Resort website are subject to availability and confirmation. Please ensure that you provide accurate and complete information when booking your accommodation.</p>

            <h2>3. Payment Policy</h2>
            <ul>
                <li>Payments for reservations must be made at the time of booking or as specified in the reservation confirmation.</li>
               
                <li>Failure to make the payment as required may result in the cancellation of your reservation.</li>
            </ul>
            
            <h2>4. Cancellation and Refund Policy</h2>

            <ul>
                <li>Cancellations made 48 hours before the check-in date are eligible for a full refund.</li>
                <li>Cancellations made less than 48 hours before check-in may incur a cancellation fee.</li>
                <li>No refunds will be given for no-shows or early checkouts.</li>
            </ul>

            <h2>5. Behavior and Conduct</h2>
            <p>Guests are expected to behave respectfully and responsibly during their stay at Estregan Beach Resort. Any disruptive or inappropriate behavior may result in immediate removal from the premises without a refund.</p>

            <h2>6. Liability</h2>
            <p>Estregan Beach Resort is not liable for any loss or damage to personal belongings during your stay. We recommend guests keep their valuables secure at all times.</p>

            <h2>7. Privacy Policy</h2>
            <p>Your privacy is important to us. We collect personal data only as required for booking and reservation purposes. For more information, please refer to our Privacy Policy.</p>
        </div>

        <div class="terms-footer">
            <p>If you have any questions or concerns about our Terms and Conditions, please contact us at info@estreganresort.com.</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body>

</html>
