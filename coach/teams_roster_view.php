<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the roster ID is provided in the URL
if(isset($_GET['id'])) {
    $roster_id = mysqli_real_escape_string($con, $_GET['id']);

    // SQL query to fetch the roster with the specified ID and coach ID
    $query = "SELECT * FROM teams_roster WHERE id='$roster_id' AND coach_id = '" . $_SESSION['user_id'] . "'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $roster = mysqli_fetch_array($query_run);
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

            <title>Roster View Details</title>
        </head>
        <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Roster View Details
                                <a href="teams_roster_details.php" class="btn btn-danger float-end">BACK</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="roster_id" value="<?= $roster['id']; ?>">
                            
                            <div class="mb-3">
                                <label for="day_of_week">Day of Week</label>
                                <p class="form-control"><?= $roster['day_of_week']; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="activity_time_range">Activity Time Range</label>
                                <p class="form-control"><?= $roster['activity_time_range']; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="activity_description">Activity Description</label>
                                <p class="form-control"><?= $roster['activity_description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- Link to the JavaScript file -->
   <script src="../js/script.js"></script>
        </body>
        </html>
        <?php
    } else {
        // If no roster found with the specified ID for the current coach, display a message
        echo "<h4>No such ID Found</h4>";
    }
} else {
    // If no ID provided in the URL, display a message
    echo "<h4>No ID Provided</h4>";
}
?>
