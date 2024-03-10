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
    $pdf->SetTitle('Coach Team Details');
    $pdf->SetSubject('Coach Team Details');
    $pdf->SetKeywords('Team, Details, PDF');

    // Add a page
    $pdf->AddPage();

    // Set some content to display
$content = '<h1>Coach Team Details</h1>';
$content .= '<table border="1" style="border-collapse: collapse; width: 100%;">'; // Added style attributes for table
$content .= '<tr><th style="padding: 10px;">N.O</th><th style="padding: 10px;">Coach Name</th><th style="padding: 10px;">Sport Name</th><th style="padding: 10px;">Student Names</th></tr>'; // Added padding for table headers

foreach ($data as $team) {
    $content .= '<tr>';
    $content .= '<td style="padding: 10px;">' . $team['id'] . '</td>'; // Added padding for table cells
    $content .= '<td style="padding: 10px;">' . $team['coach_name'] . '</td>';
    $content .= '<td style="padding: 10px;">' . $team['sport_name'] . '</td>';
    $content .= '<td style="padding: 10px;"><ol style="margin: 0; padding-left: 20px;">'; // Added padding and margin for ordered list
    $content .= '<li style="margin-bottom: 5px;">' . str_replace(', ', '</li><li style="margin-bottom: 5px;">', $team['student_names']) . '</li>';
    $content .= '</ol></td>';
    $content .= '</tr>';
}

$content .= '</table>';

    // Print content onto the PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('coach_team.pdf', 'D');
}

// Fetch data from database
try {
    $stmt = $pdo->prepare("SELECT t.id, uc.username AS coach_name, s.sport_name, GROUP_CONCAT(us.username ORDER BY us.username DESC SEPARATOR ', ') AS student_names
                           FROM teams t
                           INNER JOIN users uc ON t.coach_id = uc.id
                           INNER JOIN sports s ON t.sport_id = s.id
                           INNER JOIN users us ON t.student_id = us.id
                           WHERE t.coach_id = :coach_id
                           GROUP BY t.coach_id, t.sport_id");
    $stmt->bindParam(':coach_id', $_SESSION['user_id']);
    $stmt->execute();
    
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
