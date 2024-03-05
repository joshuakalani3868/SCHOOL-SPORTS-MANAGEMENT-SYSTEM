<?php
session_start();
require '../includes/dbh.inc.php';
include('../includes/team.inc.php');

// Fetch coaches where role is 'coach'
$coaches = fetchCoaches();

// Fetch sports available
$sports = fetchSports();

// Initialize $students array
$students = array();

// Initialize $team array to hold team details
$team = array();

// Check if team_id is provided in the URL
if(isset($_GET['id'])) {
    $team_id = mysqli_real_escape_string($con, $_GET['id']);
    
    // Fetch team details from the database
    $query ="SELECT * FROM teams WHERE id='$team_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $team = mysqli_fetch_assoc($query_run);

        // Check if sport_id is set and fetch students for the selected sport
        if (isset($team['sport_id'])) {
            $sport_id = $team['sport_id'];
            $students = fetchStudentsBySport($sport_id);
        }
    } else {
        $_SESSION['message'] = "No such team found!";
        header("Location: team_details.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Team ID not provided!";
    header("Location: team_details.php");
    exit();
}

// Handle form submission
if(isset($_POST['update_team'])) {
    $team_id = $_POST['team_id'];
    $coach_id = $_POST['coach_id'];
    $sport_id = $_POST['sport_id'];
    $student_id = $_POST['student_id'];

    // Update Team
    $result = updateCoachStudent($team_id, $coach_id, $sport_id, $student_id);

    if ($result) {
        $_SESSION['message'] = "Team updated successfully!";
        header("Location: team_details.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update Team.";
        header("Location: team_edit.php?id=$team_id");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit Team</title>
</head>
<body>

<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Team
                        <a href="team_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="team_edit.php" method="POST">
                        <input type="hidden" name="team_id" value="<?=$team['id']; ?>">
                        <div class="mb-3">
                            <label for="coach_id">Coach</label>
                            <select id="coach_id" name="coach_id" class="form-control">
                                <?php foreach ($coaches as $coach): ?>
                                    <option value="<?php echo $coach['id']; ?>" <?php if($coach['id'] == $team['coach_id']) echo 'selected'; ?>><?php echo $coach['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sport_id">Sport</label>
                            <select id="sport_id" name="sport_id" class="form-control">
                                <?php foreach ($sports as $sport): ?>
                                    <option value="<?php echo $sport['id']; ?>" <?php if($sport['id'] == $team['sport_id']) echo 'selected'; ?>><?php echo $sport['sport_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <button type="submit" name="update_team" class="btn btn-primary">Update Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
