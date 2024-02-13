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

    <title>Event Edit</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Event Edit
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
                            <form action="../includes/event.inc.php" method="POST">
                                <input type="hidden" name="event_id" value="<?=$event['id']; ?>">
                                <div class="mb-3">
                                    <label for="event_name">Event Name</label>
                                    <input type="text" id="event_name" name="event_name" value="<?=$event['event_name'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="indoor" <?php if($event['type'] == 'indoor') echo 'selected'; ?>>Indoor</option>
                                        <option value="outdoor" <?php if($event['type'] == 'outdoor') echo 'selected'; ?>>Outdoor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control"><?=$event['description'];?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" value="<?=$event['start_date'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" value="<?=$event['end_date'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="event_time">Event Time</label>
                                    <input type="time" id="event_time" name="event_time" value="<?=$event['event_time'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_event" class="btn btn-primary">Update Event</button>
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
