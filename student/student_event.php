<?php
session_start();
require '../includes/dbh.inc.php';

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
<?php include('../includes/student_header.inc.php'); ?>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        <span>Event Details</span>
                        
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
