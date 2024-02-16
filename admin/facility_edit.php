<?php
session_start();
require '../includes/dbh.inc.php';
include('../includes/facility.inc.php'); // Include the logic file

// Fetch sports available
$sports = fetchSports(); // Assuming you have a function to fetch sports from the database

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Facility Edit</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Facility Edit
                        <a href="facility_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $facility_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM facilities WHERE id='$facility_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $facility = mysqli_fetch_array($query_run);
                            ?>
                            <form action="../includes/facility.inc.php" method="POST">
                                <input type="hidden" name="facility_id" value="<?=$facility['id']; ?>">
                                <div class="mb-3">
                                    <label for="facility_name">Facility Name</label>
                                    <input type="text" id="facility_name" name="facility_name" value="<?=$facility['facility_name'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="facility_type">Facility Type</label>
                                    <select id="facility_type" name="facility_type" class="form-control">
                                        <option value="indoor" <?php if($facility['facility_type'] == 'indoor') echo 'selected'; ?>>Indoor</option>
                                        <option value="outdoor" <?php if($facility['facility_type'] == 'outdoor') echo 'selected'; ?>>Outdoor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sports_available">Sports Available</label>
                                    <select id="sports_available" name="sports_available" class="form-control">
                                        <?php foreach ($sports as $sport): ?>
                                            <option value="<?php echo $sport['Sport_name']; ?>" <?php if($sport['Sport_name'] == $facility['sports_available']) echo 'selected'; ?>><?php echo $sport['Sport_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="capacity">Capacity</label>
                                    <input type="number" id="capacity" name="capacity" value="<?=$facility['capacity'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="operating_time_start">Operating Time Start</label>
                                    <input type="time" id="operating_time_start" name="operating_time_start" value="<?=$facility['operating_time_start'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="operating_time_end">Operating Time End</label>
                                    <input type="time" id="operating_time_end" name="operating_time_end" value="<?=$facility['operating_time_end'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_facility" class="btn btn-primary">Update Facility</button>
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
