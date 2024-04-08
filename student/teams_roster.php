<?php
session_start();
require '../includes/dbh.inc.php';

// Fetch coach_id and name associated with the student from the teams table
$student_id = $_SESSION['user_id']; // Assuming student ID is stored in the session
$query_teams = "SELECT teams.coach_id, users.username 
                FROM teams 
                INNER JOIN users ON teams.coach_id = users.id 
                WHERE teams.student_id = '$student_id' AND users.role = 'coach'";
$query_teams_run = mysqli_query($con, $query_teams);

// Initialize an empty array to store coach IDs and names associated with the student
$coaches = [];

// Fetch coach IDs and names associated with the student and store them in the array
if (mysqli_num_rows($query_teams_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_teams_run)) {
        $coaches[] = $row;
    }
}

// Fetch rosters based on the coach IDs associated with the student
$rosters = [];
foreach ($coaches as $index => $coach) {
    $coach_id = $coach['coach_id'];
    $coach_name = $coach['username'];
    
    // Set coach name only for the first row associated with each coach
    $coach_name_displayed = false;
    
    $query = "SELECT * FROM teams_roster WHERE coach_id = '$coach_id'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            // Set coach name only for the first row associated with each coach
            if (!$coach_name_displayed) {
                $row['coach_name'] = $coach_name;
                $coach_name_displayed = true;
            } else {
                $row['coach_name'] = ''; // Set empty coach name for subsequent rows
            }
            $rosters[] = $row;
        }
    }
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
<?php include('../includes/student_header.inc.php'); ?>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Roster Details</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Coach Name</th>
                            <th>Day of Week</th>
                            <th>Activity Time Range</th>
                            <th>Activity Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($rosters)) {
                            foreach ($rosters as $roster) {
                                ?>
                                <tr>
                                    <td><?= $roster['coach_name']; ?></td>
                                    <td><?= $roster['day_of_week']; ?></td>
                                    <td><?= $roster['activity_time_range']; ?></td>
                                    <td><?= $roster['activity_description']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='4'>No Record Found!</td></tr>";
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
