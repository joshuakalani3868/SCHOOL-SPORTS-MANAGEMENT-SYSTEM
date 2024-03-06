<?php
session_start();
include('../includes/dbh.inc.php'); // Include the database connection
include('../includes/team.inc.php'); // Include the logic file

// Fetch coaches where role is 'coach'
$coaches = fetchCoaches(); // Assuming you have a function to fetch coaches from the database

// Fetch sports available
$sports = fetchSports(); // Assuming you have a function to fetch sports from the database

// Initialize $students array
$students = array();

// Check if sport_id is set and fetch students for the selected sport
if (isset($_POST['sport_id'])) {
    $sport_id = $_POST['sport_id'];
    $students = fetchStudentsBySport($sport_id);
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

    <title>Team Add</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Team Add
                        <a href="team_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../includes/team.inc.php" method="POST">
                        <div class="mb-3">
                            <label for="coach_id">Coach</label>
                            <select id="coach_id" name="coach_id" class="form-control">
                                <?php foreach ($coaches as $coach): ?>
                                    <option value="<?php echo $coach['id']; ?>"><?php echo $coach['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sport_id">Sport</label>
                            <select id="sport_id" name="sport_id" class="form-control">
                                <?php foreach ($sports as $sport): ?>
                                    <option value="<?php echo $sport['id']; ?>"><?php echo $sport['sport_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                    
                        <div class="mb-3">
                            <button type="submit" name="save_team" class="btn btn-primary">Save Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>
