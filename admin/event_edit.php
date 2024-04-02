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
                                    <input type="text" id="event_name" name="event_name" value="<?=$event['event_name'];?>" class="form-control" maxlength="40">
                                </div>
                                <div class="mb-3">
                                    <label for="facility_name">Facility Name</label>
                                    <select id="facility_name" name="facility_name" class="form-control">
                                        <!-- Populate this select dropdown with facilities from your database -->
                                        <?php
                                        $facilities_query = "SELECT id, facility_name FROM facilities";
                                        $facilities_result = mysqli_query($con, $facilities_query);
                                        while ($facility = mysqli_fetch_assoc($facilities_result)) {
                                            $selected = ($event['facility_name'] == $facility['id']) ? 'selected' : '';
                                            echo "<option value='" . $facility['id'] . "' $selected>" . $facility['facility_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="facility_type">Facility Type</label>
                                    <select id="facility_type" name="facility_type" class="form-control">
                                        <option value="indoor" <?php if($event['facility_type'] == 'indoor') echo 'selected'; ?>>Indoor</option>
                                        <option value="outdoor" <?php if($event['facility_type'] == 'outdoor') echo 'selected'; ?>>Outdoor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" maxlength="60" style="max-width: 100%; width: 100%;"><?= $event['description'];?></textarea>
                                    <!-- Set maxlength to limit the number of characters -->
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
                                    <label for="host_school">Host School</label>
                                    <select id="host_school" name="host_school" class="form-control">
                                        <?php
                                        $query = "SELECT school_id, school_name FROM Schools WHERE is_host = 'host'";
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($event['host_school'] == $row['school_id']) ? 'selected' : '';
                                            echo "<option value='" . $row['school_id'] . "' $selected>" . $row['school_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
    <label for="participant_school">Participant School</label>
    <?php
    $selected_participant_schools = explode(',', $event['participant_school']);
    $query = "SELECT school_id, school_name FROM Schools WHERE is_host = 'participant'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $checked = (in_array($row['school_id'], $selected_participant_schools)) ? 'checked' : '';
        echo "<div class='form-check'>";
        echo "<input class='form-check-input' type='checkbox' name='participant_school[]' value='" . $row['school_id'] . "' $checked>";
        echo "<label class='form-check-label'>" . $row['school_name'] . "</label>";
        echo "</div>";
    }
    ?>
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
