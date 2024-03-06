<?php
session_start();
require '../includes/dbh.inc.php';

// Check if the delete button is clicked
if(isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    
    // Using prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");

    if ($stmt) {
        $stmt->bindParam(':user_id', $user_id);

        try {
            $stmt->execute();
            $_SESSION['message'] = "User deleted successfully";
            $_SESSION['msg_type'] = "danger";
        } catch (PDOException $e) {
            $_SESSION['message'] = "Error deleting user";
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Failed to prepare the statement!";
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
                <h4 class="d-flex justify-content-between align-items-center">
                <span>User Details</span>
            <div>
                <a href="dashboard.php" class="btn btn-primary me-2">Home</a>
                <a href="user_create.php" class="btn btn-primary">Add User</a>
        </div>
</h4>

                    
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th> <!-- New role column -->
                            <th>Age</th> <!-- New age column -->
                            <th>Gender</th> <!-- New gender column -->
                            <th>Phone Number</th> <!-- New phone_number column -->
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
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['role']; ?></td> <!-- Display role -->
                                    <td><?= $user['age']; ?></td> <!-- Display age -->
                                    <td><?= $user['gender']; ?></td> <!-- Display gender -->
                                    <td><?= $user['phone_number']; ?></td> <!-- Display phone_number -->
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
