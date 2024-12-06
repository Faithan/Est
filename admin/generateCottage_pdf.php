<?php

require_once 'tcpdf/tcpdf.php'; // Include the TCPDF library
require 'db_connect.php'; // Include your database connection

// Fetch date filter values from GET request (query string)
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';

// Ensure date format is in 'YYYY-MM-DD'
if ($from_date) {
    $from_date = date('Y-m-d', strtotime($from_date));
}
if ($to_date) {
    $to_date = date('Y-m-d', strtotime($to_date));
}

$query = "SELECT `reserve_id`, `user_id`, `date_of_arrival`, `time`, `price`
            FROM `reserve_cottage_tbl`
            WHERE `reserve_status` = 'checkedOut'"; // Filter by checkedOut status

// Add date filter if applicable
if ($from_date && $to_date) {
    $query .= " AND date_of_arrival BETWEEN ? AND ?";
} elseif ($from_date) {
    $query .= " AND date_of_arrival >= ?";
} elseif ($to_date) {
    $query .= " AND date_of_arrival <= ?";
}

// Prepare the SQL statement
$stmt = $con->prepare($query);

if ($from_date && $to_date) {
    $stmt->bind_param("ss", $from_date, $to_date);
} elseif ($from_date) {
    $stmt->bind_param("s", $from_date);
} elseif ($to_date) {
    $stmt->bind_param("s", $to_date);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if data is returned
if ($result->num_rows > 0) {
    // Data found
} else {
    // No data found
    echo "No checked-out reservations found.";
    exit;
}

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Cottage Reservation Report');
$pdf->SetSubject('Report');
$pdf->SetKeywords('TCPDF, PDF, report, reservations');

// Add a page
$pdf->AddPage();

// Set default font
$pdf->SetFont('helvetica', '', 10);


// Title
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 10, 'ESTREGAN BEACH RESORT', 0, 1, 'C');

// Subheader with contact info
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 0, 'Address: Estregan Beach Resort, 9215 Pikalawag SND, Lanao Del Norte.', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: 0977-804-3668', 0, 1, 'C');
$pdf->Cell(0, 0, 'Email: info@estreganbeachresort.com', 0, 1, 'C');

// Title for the report
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 5, 'Cottage Reservation Report (Checked Out)', 0, 1, 'L');

// Filtered Date Range
$pdf->SetFont('helvetica', '', 12);
$date_range = "From: " . ($from_date ? date('F j, Y', strtotime($from_date)) : 'All') .
              " To: " . ($to_date ? date('F j, Y', strtotime($to_date)) : 'All');
$pdf->Cell(0, 10, $date_range, 0, 1, 'L');

// Table headers with adjusted column widths
$pdf->SetFont('helvetica', 'B', 10);
$headers = ['Reservation ID', 'User ID', 'Date', 'Time', 'Income']; 
$columnWidths = [30, 30, 40, 60, 30]; // Adjust the column widths to fit the page

// Print headers
$pdf->Ln(1); // Space before headers
foreach ($headers as $key => $header) {
    $pdf->Cell($columnWidths[$key], 10, $header, 1, 0, 'C');
}
$pdf->Ln();

// Table content
$pdf->SetFont('helvetica', '', 10);
$total_price = 0;   
while ($row = $result->fetch_assoc()) {
    $user= $row['user_id'];
    $formatted_date = date('F j, Y', strtotime($row['date_of_arrival'])); // Format date
    $pdf->Cell($columnWidths[0], 10, $row['reserve_id'], 1, 0, 'C');
    
    // Use MultiCell for User ID to handle long text
    $pdf->Cell($columnWidths[1], 10, $user, 1, 0,'C');
    $pdf->Cell($columnWidths[2], 10, $formatted_date, 1, 0, 'C');
    $pdf->Cell($columnWidths[3], 10, $row['time'], 1, 0, 'C');
    $pdf->Cell($columnWidths[4], 10, number_format($row['price'], 2) . ' PHP', 1, 1, 'C');
    
    $total_price += $row['price']; // Calculate total price
}

// Total income 
$pdf->Ln(1);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 0, 'Total Income: ' . number_format($total_price, 2) . ' PHP', 0, 1, 'R');

// Add space for signature
$pdf->Ln(15); // Space before signature
$pdf->SetFont('helvetica', 'I', 12);
$pdf->Cell(0, 10, 'Approved by: ________________________', 0, 1, 'R');

// Output the PDF
$pdf->Output('Cottage_Reservation_Report.pdf', 'D'); // Forces download
