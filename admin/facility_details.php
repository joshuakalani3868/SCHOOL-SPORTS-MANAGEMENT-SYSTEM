<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_facility'])) {
    // Retrieve the facility ID from the form
    $facility_id = mysqli_real_escape_string($con, $_POST['delete_facility']);
    
    // SQL query to delete the facility with the specified ID
    $sql = "DELETE FROM facilities WHERE id = '$facility_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "Facility deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting facility";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to facility_details.php
    header("Location: facility_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facility Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4 class="d-flex justify-content-between align-items-center">
                <span>Facility Details</span>
                  <div>
                   <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                   <a href="facility_create.php" class="btn btn-primary">Add Facility</a>
                   </div>
                </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Facility Name</th>
                            <th>Facility Type</th>
                            <th>Sports Available</th>
                            <th>Capacity</th>
                            <th>Operating Time Start</th>
                            <th>Operating Time End</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM facilities";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $facility) {
                                ?>
                                <tr>
                                    <td><?= $facility['id']; ?></td>
                                    <td><?= $facility['facility_name']; ?></td>
                                    <td><?= $facility['facility_type']; ?></td>
                                    <td><?= $facility['sports_available']; ?></td>
                                    <td><?= $facility['capacity']; ?></td>
                                    <td><?= $facility['operating_time_start']; ?></td>
                                    <td><?= $facility['operating_time_end']; ?></td>
                                    <td>
                                        <a href="facility_view.php?id=<?= $facility['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="facility_edit.php?id=<?= $facility['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="facility_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_facility" value="<?= $facility['id']; ?>">
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
