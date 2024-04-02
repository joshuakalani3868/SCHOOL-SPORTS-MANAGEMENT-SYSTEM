<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_school'])) {
    // Retrieve the school ID from the form
    $school_id = mysqli_real_escape_string($con, $_POST['delete_school']);
    
    // SQL query to delete the school with the specified ID
    $sql = "DELETE FROM Schools WHERE school_id = '$school_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "School deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting school";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to school_details.php
    header("Location: school_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Details</title>
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
                        <span>School Details</span>
                        <div>
                            <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                            <a href="school_create.php" class="btn btn-primary">Add School</a>
                        </div>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>School Name</th>
                            <th>School Location</th>
                            <th>Contact Person Name</th>
                            <th>Contact Person Email</th>
                            <th>Contact Person Phone</th>
                            <th>Is Host</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM Schools";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $school) {
                                ?>
                                <tr>
                                    <td><?= $school['school_id']; ?></td>
                                    <td><?= $school['school_name']; ?></td>
                                    <td><?= $school['school_location']; ?></td>
                                    <td><?= $school['contact_person_name']; ?></td>
                                    <td><?= $school['contact_person_email']; ?></td>
                                    <td><?= $school['contact_person_phone']; ?></td>
                                    <td><?= $school['is_host']; ?></td>
                                    <td>
                                        
                                        <a href="school_edit.php?id=<?= $school['school_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="school_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_school" value="<?= $school['school_id']; ?>">
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
