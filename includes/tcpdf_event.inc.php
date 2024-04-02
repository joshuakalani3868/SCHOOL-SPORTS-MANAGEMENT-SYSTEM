<?php
// Include Composer autoloader
require_once '../vendor/autoload.php';

// Include database connection
require 'dbh.inc.php';

// Function to generate PDF
function generatePDF($data, $pdo) {
    // Create new PDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Events Details');
    $pdf->SetSubject('Event Details');
    $pdf->SetKeywords('Event, Details, PDF');

    // Add a page
$pdf->AddPage();

// Set some content to display
$content = '<h1>Event Details</h1>';
$content .= '<table border="1" style="border-collapse: collapse; width: 100%;">'; // Added style attributes for table
$content .= '<tr><th style="padding: 2px;">NO</th><th style="padding: 2px;">Event Name</th><th style="padding: 2px;">Facility Name</th><th style="padding: 2px;">Start Date</th><th style="padding: 2px;">End Date</th><th style="padding: 2px;">Event Time</th><th style="padding: 2px;">Host School</th><th style="padding: 2px;">Participant Schools</th></tr>'; // Added padding for table headers

foreach ($data as $event) {
    $content .= '<tr>';
    $content .= '<td style="padding: 2px;">' . $event['id'] . '</td>'; // Added padding for table cells
    $content .= '<td style="padding: 2px;">' . $event['event_name'] . '</td>';
    $content .= '<td style="padding: 2px;">' . $event['facility_name'] . '</td>';
    $content .= '<td style="padding: 2px;">' . $event['start_date'] . '</td>';
    $content .= '<td style="padding: 2px;">' . $event['end_date'] . '</td>';
    $content .= '<td style="padding: 2px;">' . $event['event_time'] . '</td>';
    $content .= '<td style="padding: 2px;">' . $event['host_school_name'] . '</td>';
    $content .= '<td style="padding: 2px;">';
    
    // Fetch participant schools and add to HTML table
    $participant_schools = explode(',', $event['participant_school']);
    foreach ($participant_schools as $school_id) {
        $stmt = $pdo->prepare("SELECT school_name FROM Schools WHERE school_id = :school_id");
        $stmt->bindParam(':school_id', $school_id);
        $stmt->execute();
        $school = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($school) {
            $content .= $school['school_name'] . "<br>";
        }
    }

    $content .= '</td>';
    $content .= '</tr>';
}

$content .= '</table>';




    // Print content onto the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('event_details.pdf', 'D');
}

// Fetch data from database
try {
    $stmt = $pdo->query("SELECT e.*, f.facility_name, hs.school_name AS host_school_name, GROUP_CONCAT(ps.school_id) AS participant_school
                           FROM events e
                           INNER JOIN facilities f ON e.facility_name = f.id
                           INNER JOIN Schools hs ON e.host_school = hs.school_id
                           INNER JOIN Schools ps ON FIND_IN_SET(ps.school_id, e.participant_school) > 0
                           GROUP BY e.id");
    
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Call function to generate PDF
        generatePDF($data, $pdo);
    } else {
        echo "No Record Found!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
