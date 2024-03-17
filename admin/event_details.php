<?php
session_start();
require '../includes/dbh.inc.php';

// Function to delete event
function deleteEvent($pdo, $event_id) {
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :event_id");

    if ($stmt) {
        // Bind parameter
        $stmt->bindParam(':event_id', $event_id);

        // Execute the statement
        try {
            $stmt->execute();
            $_SESSION['message'] = "Event deleted successfully!";
            $_SESSION['msg_type'] = "danger";
            header("Location: event_details.php");
            exit(0);
        } catch (PDOException $e) {
            $_SESSION['message'] = "Failed to delete event! Error: " . $e->getMessage();
            $_SESSION['msg_type'] = "danger";
            header("Location: event_details.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
        $_SESSION['msg_type'] = "danger";
        header("Location: event_details.php");
        exit(0);
    }
}

// Check if the delete button is clicked
if(isset($_POST['delete_event'])) {
    // Retrieve the event ID from the form
    $event_id = $_POST['delete_event'];
    deleteEvent($pdo, $event_id);
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
                <div class="card-body">
                    <div class="table-responsive">
                    <div style="overflow-x: auto; width: 1500px;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Event Name</th>
                                        <th>Facility Name</th> <!-- Modified: Display Facility Name -->
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
                                    $query = "SELECT e.*, f.facility_name 
                                            FROM events e
                                            INNER JOIN facilities f ON e.facility_name = f.id"; // Adjusted query to join with facilities table
                                    $query_run = $pdo->query($query);

                                    if ($query_run->rowCount() > 0) {
                                        $count = 0; // Initialize counter variable
                                        foreach ($query_run as $event) {
                                            $count++; // Increment counter for each iteration
                                    ?>
                                                <tr>
                                                    <td><?= $count; ?></td> <!-- Display entry number -->
                                                    <td><?= $event['event_name']; ?></td>
                                                    <td><?= $event['facility_name']; ?></td> <!-- Display facility_name -->
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
