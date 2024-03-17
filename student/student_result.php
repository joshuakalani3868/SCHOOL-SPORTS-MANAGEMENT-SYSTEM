<?php
session_start();
require '../includes/dbh.inc.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                <span>Result Details</span>
                </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>Event Name</th>
                            <th>Sport Name</th>
                            <th>Student Name</th>
                            <th>Sport Type</th>
                            <th>Rank</th>
                            <th>Score Line</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT r.id, e.event_name, s.sport_name, u.username AS student_name, r.sport_type, r.rank, r.score_line 
                        FROM results r
                        JOIN events e ON r.event_id = e.id
                        JOIN sports s ON r.sport_id = s.id
                        LEFT JOIN teams t ON r.student_id = t.student_id
                        LEFT JOIN users u ON t.student_id = u.id";
                        
                        $query_run = $pdo->query($query);

                        if ($query_run->rowCount() > 0) {
                            $count = 0; // Initialize count variable
                            foreach ($query_run as $result) {
                                $count++; // Increment count for each iteration
                                ?>
                                <tr>
                                    <td><?= $count; ?></td> <!-- Display the count -->
                                    <td><?= $result['event_name']; ?></td>
                                    <td><?= $result['sport_name']; ?></td>
                                    <td><?= $result['student_name'] ?? 'N/A'; ?></td>
                                    <td><?= $result['sport_type']; ?></td>
                                    <td><?= $result['rank']; ?></td>
                                    <td><?= $result['score_line']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Record Found!</td></tr>";
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
