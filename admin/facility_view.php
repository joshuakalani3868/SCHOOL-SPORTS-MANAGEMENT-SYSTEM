<?php
/*session_start();*/
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

    <title>Facility View Details</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Facility View Details
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
                            <input type="hidden" name="facility_id" value="<?=$facility['id']; ?>">
                            <div class="mb-3">
                                <label for="facility_name">Facility Name</label>
                                <p class="form-control"><?=$facility['facility_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="facility_type">Facility Type</label>
                                <p class="form-control"><?=$facility['facility_type'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="sports_available">Sports Available</label>
                                <p class="form-control"><?=$facility['sports_available'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="capacity">Capacity</label>
                                <p class="form-control"><?=$facility['capacity'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="operating_hours">Operating Hours</label>
                                <p class="form-control"><?=$facility['operating_hours'];?></p>
                            </div>
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
