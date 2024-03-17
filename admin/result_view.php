<?php
/*session_start();*/
require '../includes/dbh.inc.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Result View Details</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Result View Details
                        <a href="result_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $result_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM results WHERE id='$result_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $result = mysqli_fetch_array($query_run);
                            ?>
                            <input type="hidden" name="result_id" value="<?=$result['id']; ?>">
                            <div class="mb-3">
                                <label for="event_name">Event</label>
                                <p class="form-control"><?=$result['event_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="sport_name">Sport</label>
                                <p class="form-control"><?=$result['sport_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="student_name">Student</label>
                                <p class="form-control"><?=$result['student_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="sport_type">Sport Type</label>
                                <p class="form-control"><?=$result['sport_type'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="rank">Rank</label>
                                <p class="form-control"><?=$result['rank'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="score_line">Score Line</label>
                                <p class="form-control"><?=$result['score_line'];?></p>
                            </div>
                            <?php
                        }
                        else {
                            echo "<h4>No such ID Found</h4>";
                        }
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
