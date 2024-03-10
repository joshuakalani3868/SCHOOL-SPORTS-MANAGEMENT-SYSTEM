<?php
// Start session
session_start();

// Include necessary files
require '../includes/dbh.inc.php';
require '../includes/team.inc.php';
// require_once('../includes/tcpdf.inc.php');// Include TCPDF library


// Check if user is logged in and is a coach
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'coach') {
    // Redirect unauthorized users to login page
    header("Location: ../admin/index.php");
    exit();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Team Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php include('../includes/coach_header.inc.php'); ?>
<body>
<div class="container mt-5">
    <!-- Include message display -->
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        <span>Coach Team Details</span>
                        <div>
                        <a href="../includes/tcpdf.inc.php" class="btn btn-primary me-2">Download PDF</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body table responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coach Name</th>
                            <th>Sport Name</th>
                            <th>Student Names</th>
                        </tr>
                        </thead>
                        <tbody>
<?php
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
        $count = 0;
        while ($team = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $count = $count + 1;
?>
            <tr>
                <td><?= $count; ?></td>
                <td><?= $team['coach_name']; ?></td>
                <td><?= $team['sport_name']; ?></td>
                <td><?= $team['student_names']; ?></td>
            </tr>
<?php
        } 
    } else {
        echo "<tr><td colspan='4'><h5>No Record Found!</h5></td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>