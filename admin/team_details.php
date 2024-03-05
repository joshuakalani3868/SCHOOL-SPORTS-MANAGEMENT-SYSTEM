<?php
// Start session
session_start();

// Include necessary files
require '../includes/dbh.inc.php';
require '../includes/team.inc.php';

// Handle delete action
if(isset($_POST['delete_team'])) {
    $team_id = $_POST['delete_team'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM teams WHERE id = :team_id");
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();

        // Set success message
        $_SESSION['message'] = "Team deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } catch (PDOException $e) {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting team: " . $e->getMessage();
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to team_details.php
    header("Location: team_details.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <!-- Include message display -->
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        <span>Team Details</span>
                        <div>
                            <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                            <a href="team_create.php" class="btn btn-primary">Add Team</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coach Name</th>
                            <th>Sport Name</th>
                            <th>Student Names</th>
                            <th>Action</th>
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
                           GROUP BY t.coach_id, t.sport_id");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        while ($team = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <tr>
                <td><?= $team['id']; ?></td>
                <td><?= $team['coach_name']; ?></td>
                <td><?= $team['sport_name']; ?></td>
                <td><?= $team['student_names']; ?></td>
                <td>
                    <a href="team_view.php?id=<?= $team['id']; ?>" class="btn btn-info btn-sm">View</a>
                    <a href="team_edit.php?id=<?= $team['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                    <form action="team_details.php" method="POST" class="d-inline">
                        <input type="hidden" name="delete_team" value="<?= $team['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
<?php
        } 
    } else {
        echo "<tr><td colspan='5'><h5>No Record Found!</h5></td></tr>";
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
