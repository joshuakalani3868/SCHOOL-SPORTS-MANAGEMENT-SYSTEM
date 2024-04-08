<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_roster'])) {
    // Retrieve the roster ID from the form
    $roster_id = mysqli_real_escape_string($con, $_POST['delete_roster']);
    
    // SQL query to delete the roster with the specified ID and coach ID
    $sql = "DELETE FROM teams_roster WHERE id = '$roster_id' AND coach_id = '" . $_SESSION['user_id'] . "'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "Roster entry deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting roster entry";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to teams_roster_details.php
    header("Location: teams_roster_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roster Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php include('../includes/coach_header.inc.php'); ?>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        <span>Roster Details</span>
                        <a href="teams_roster_create.php" class="btn btn-primary">Add Roster</a>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            
                            <th>Day of Week</th>
                            <th>Activity Time Range</th>
                            <th>Activity Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Fetch only rosters for the current coach
                        $coach_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM teams_roster WHERE coach_id = '$coach_id'";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $roster) {
                                ?>
                                <tr>
                                    
                                    <td><?= $roster['day_of_week']; ?></td>
                                    <td><?= $roster['activity_time_range']; ?></td>
                                    <td><?= $roster['activity_description']; ?></td>
                                    <td>
                                        <a href="teams_roster_view.php?id=<?= $roster['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="teams_roster_edit.php?id=<?= $roster['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="teams_roster_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_roster" value="<?= $roster['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            } 
                        } else {
                            echo "<h5>No Record Found!</h5>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Link to the JavaScript file -->
<script src="../js/script.js"></script>
</body>
</html>
