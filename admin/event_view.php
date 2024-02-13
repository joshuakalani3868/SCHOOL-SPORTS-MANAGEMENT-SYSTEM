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

    <title>Event View Details</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Event View Details
                        <a href="event_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $event_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM events WHERE id='$event_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $event = mysqli_fetch_array($query_run);
                            ?>
                            <input type="hidden" name="event_id" value="<?=$event['id']; ?>">
                            <div class="mb-3">
                                <label for="event_name">Event Name</label>
                                <p class="form-control"><?=$event['event_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="type">Type</label>
                                <p class="form-control"><?=$event['type'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <p class="form-control"><?=$event['description'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="start_date">Start Date</label>
                                <p class="form-control"><?=$event['start_date'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="end_date">End Date</label>
                                <p class="form-control"><?=$event['end_date'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="event_time">Event Time</label>
                                <p class="form-control"><?=$event['event_time'];?></p>
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
