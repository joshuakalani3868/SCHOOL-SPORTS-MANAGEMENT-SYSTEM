<?php
require '../includes/dbh.inc.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facility Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<?php include('../includes/student_header.inc.php'); ?>
<body>
<div class="container mt-5">
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="table-responsive">
                    <h4>Facility Details</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Facility Name</th>
                            <th>Facility Type</th>
                            <th>Sports Available</th>
                            <th>Capacity</th>
                            <th>Operating Time Start</th>
                            <th>Operating Time End</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM facilities";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $count = 0; // Initialize counter variable
                            foreach ($query_run as $facility) {
                                $count++; // Increment counter for each iteration
                        ?>
                                <tr>
                                    <td><?= $count; ?></td> <!-- Display entry number -->
                                    <td><?= $facility['facility_name']; ?></td>
                                    <td><?= $facility['facility_type']; ?></td>
                                    <td><?= $facility['sports_available']; ?></td>
                                    <td><?= $facility['capacity']; ?></td>
                                    <td><?= $facility['operating_time_start']; ?></td>
                                    <td><?= $facility['operating_time_end']; ?></td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
