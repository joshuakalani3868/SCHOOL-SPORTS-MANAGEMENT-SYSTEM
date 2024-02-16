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

    <title>Sport View Details</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sport View Details
                        <a href="sport_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $sport_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM sports WHERE id='$sport_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $sport = mysqli_fetch_array($query_run);
                            ?>
                            <input type="hidden" name="sport_id" value="<?=$sport['id']; ?>">
                            <div class="mb-3">
                                <label for="sport_name">Sport Name</label>
                                <p class="form-control"><?=$sport['sport_name'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="sport_type">Sport Type</label>
                                <p class="form-control"><?=$sport['sport_type'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="game_type">Game Type</label>
                                <p class="form-control"><?=$sport['game_type'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="number_of_players">Number of Players</label>
                                <p class="form-control"><?=$sport['number_of_players'];?></p>
                            </div>
                            <div class="mb-3">
                                <label for="facility_type">Facility Type</label>
                                <p class="form-control"><?=$sport['facility_type'];?></p>
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
