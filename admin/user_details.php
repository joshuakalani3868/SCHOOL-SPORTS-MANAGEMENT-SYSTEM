<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_user'])) {
    // Retrieve the user ID from the form
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);
    
    // SQL query to delete the user with the specified ID
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $query_run = mysqli_query($con, $sql);

    if($query_run) {
        // Set success message
        $_SESSION['message'] = "User deleted successfully";
        $_SESSION['msg_type'] = "danger";
    } else {
        // Set error message if deletion fails
        $_SESSION['message'] = "Error deleting user";
        $_SESSION['msg_type'] = "danger";
    }

    // Redirect back to user_details.php
    header("Location: user_details.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Details
                        <a href="user_create.php" class="btn btn-primary float-end">Add User</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM users";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $user) {
                                ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['pwd']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td>
                                        <a href="user_view.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="user_edit.php?id=<?= $user['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <!-- Delete Button and Form -->
                                        <form action="user_details.php" method="POST" class="d-inline">
                                            <input type="hidden" name="delete_user" value="<?= $user['id']; ?>">
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
