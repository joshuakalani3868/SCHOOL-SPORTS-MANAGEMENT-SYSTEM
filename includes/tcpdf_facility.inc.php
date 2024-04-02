<?php
// Include Composer autoloader
require_once '../vendor/autoload.php';

// Include database connection
require 'dbh.inc.php';

// Function to generate PDF
function generatePDF($data) {
    // Create new PDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Facility Details');
    $pdf->SetSubject('Facility Details');
    $pdf->SetKeywords('Facility, Details, PDF');

    // Add a page
    $pdf->AddPage();

    // Set some content to display
    $content = '<h1>Facility Details</h1>';
    $content .= '<table border="1" style="border-collapse: collapse; width: 100%;">'; // Added style attributes for table
    $content .= '<tr><th style="padding: 2px;">NO</th><th style="padding: 2px;">Facility Name</th><th style="padding: 2px;">Facility Type</th><th style="padding: 2px;">Sports Available</th><th style="padding: 2px;">Capacity</th><th style="padding: 2px;">Operating Time Start</th><th style="padding: 2px;">Operating Time End</th></tr>'; // Added padding for table headers

    foreach ($data as $facility) {
        $content .= '<tr>';
        $content .= '<td style="padding: 2px;">' . $facility['id'] . '</td>'; // Added padding for table cells
        $content .= '<td style="padding: 2px;">' . $facility['facility_name'] . '</td>';
        $content .= '<td style="padding: 2px;">' . $facility['facility_type'] . '</td>';
        $content .= '<td style="padding: 2px;">' . $facility['sports_available'] . '</td>';
        $content .= '<td style="padding: 2px;">' . $facility['capacity'] . '</td>';
        $content .= '<td style="padding: 2px;">' . $facility['operating_time_start'] . '</td>';
        $content .= '<td style="padding: 2px;">' . $facility['operating_time_end'] . '</td>';
        $content .= '</tr>';
    }

    $content .= '</table>';

    // Print content onto the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('facility_details.pdf', 'D');
}

// Fetch data from database
try {
    $stmt = $pdo->query("SELECT * FROM facilities");
    
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Call function to generate PDF
        generatePDF($data);
    } else {
        echo "No Record Found!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
