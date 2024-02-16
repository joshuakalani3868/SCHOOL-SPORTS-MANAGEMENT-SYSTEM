<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_sport'])) {
    // Retrieve the sport ID from the form
    $sport_id = mysqli_real_escape_string($con, $_POST['delete_sport']);
    
    // SQL query to delete the sport with the specified ID
    $sql = "DELETE FROM sports WHERE id = '$sport_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "Sport deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting sport";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to sport_details.php
    header("Location: sport_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sport Details</title>
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
                <span>Sport Details</span>
                  <div>
                   <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                   <a href="sport_create.php" class="btn btn-primary">Add Sport</a>
                   </div>
                </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sport Name</th>
                            <th>Sport Type</th>
                            <th>Game Type</th>
                            <th>Number of Players</th>
                            <th>Facility Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM sports";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $sport) {
                                ?>
                                <tr>
                                    <td><?= $sport['id']; ?></td>
                                    <td><?= $sport['sport_name']; ?></td>
                                    <td><?= $sport['sport_type']; ?></td>
                                    <td><?= $sport['game_type']; ?></td>
                                    <td><?= $sport['number_of_players']; ?></td>
                                    <td><?= $sport['facility_type']; ?></td>
                                    <td>
                                        <a href="sport_view.php?id=<?= $sport['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="sport_edit.php?id=<?= $sport['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="sport_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_sport" value="<?= $sport['id']; ?>">
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
