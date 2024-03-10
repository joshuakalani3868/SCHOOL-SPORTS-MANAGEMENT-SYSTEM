<?php
session_start();
require '../includes/dbh.inc.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Roster Edit</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Roster Edit
                        <a href="teams_roster_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $roster_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM teams_roster WHERE id='$roster_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $roster = mysqli_fetch_array($query_run);
                            ?>
                            <form action="../includes/teams_roster.inc.php" method="POST">
                                <input type="hidden" name="roster_id" value="<?=$roster['id']; ?>">
                                
                                <div class="mb-3">
                                  <label for="day_of_week">Day of Week</label>
                                  <select id="day_of_week" name="day_of_week" class="form-control">
                                        <option value="Monday" <?php if($roster['day_of_week'] == 'Monday') echo 'selected'; ?>>Monday</option>
                                        <option value="Tuesday" <?php if($roster['day_of_week'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                                        <option value="Wednesday" <?php if($roster['day_of_week'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                                        <option value="Thursday" <?php if($roster['day_of_week'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                                        <option value="Friday" <?php if($roster['day_of_week'] == 'Friday') echo 'selected'; ?>>Friday</option>
                                        <option value="Saturday" <?php if($roster['day_of_week'] == 'Saturday') echo 'selected'; ?>>Saturday</option>
                                        <option value="Sunday" <?php if($roster['day_of_week'] == 'Sunday') echo 'selected'; ?>>Sunday</option>
                                 </select>
                                </div>
                                <div class="mb-3">
                                    <label for="activity_time_range">Activity Time Range</label>
                                    <input type="text" id="activity_time_range" name="activity_time_range" value="<?=$roster['activity_time_range'];?>" class="form-control" maxlength="50">
                                </div>
                                <div class="mb-3">
                                    <label for="activity_description">Activity Description</label>
                                    <textarea id="activity_description" name="activity_description" class="form-control" maxlength="255"><?=$roster['activity_description'];?></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_roster" class="btn btn-primary">Update Roster</button>
                                </div>
                            </form>
                        <?php
                        }
                        else {
                            echo "<h4>No such ID Found</h4>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
