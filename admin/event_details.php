<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_event'])) {
    // Retrieve the event ID from the form
    $event_id = mysqli_real_escape_string($con, $_POST['delete_event']);
    
    // SQL query to delete the event with the specified ID
    $sql = "DELETE FROM events WHERE id = '$event_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "Event deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting event";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to event_details.php
    header("Location: event_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <style>
        /* CSS to limit width and wrap text in the description textarea */
        #description {
            max-width: 20%; /* Adjust as needed */
            width: 10%; /* Adjust as needed */
            height: auto; /* Auto height to allow vertical expansion */
            word-wrap: break-word; /* Ensure words wrap to the next line */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4 class="d-flex justify-content-between align-items-center">
                <span>Event Details</span>
                  <div>
                   <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                   <a href="event_create.php" class="btn btn-primary">Add Event</a>
                   </div>
                </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Event Name</th>
                            <th>Facility Type</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Event Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM events";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $count = 0; // Initialize counter variable
                            foreach ($query_run as $event) {
                                $count++; // Increment counter for each iteration
                        ?>
                                <tr>
                                    <td><?= $count; ?></td> <!-- Display entry number -->
                                    <td><?= $event['event_name']; ?></td>
                                    <td><?= $event['facility_type']; ?></td>
                                    <td><?= $event['description']; ?></td>
                                    <td><?= $event['start_date']; ?></td>
                                    <td><?= $event['end_date']; ?></td>
                                    <td><?= $event['event_time']; ?></td>
                                    <td>
                                        <a href="event_view.php?id=<?= $event['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="event_edit.php?id=<?= $event['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="event_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_event" value="<?= $event['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            } 
                        } else {
                            echo "<h5>No Record Found!</h5>";
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
</body>
</html>
