<?php
session_start();
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

    <title>Sport Edit</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sport Edit
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
                            <form action="../includes/sport.inc.php" method="POST">
                                <input type="hidden" name="sport_id" value="<?=$sport['id']; ?>">
                                <div class="mb-3">
                                    <label for="sport_name">Sport Name</label>
                                    <input type="text" id="sport_name" name="sport_name" value="<?=$sport['sport_name'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="sport_type">Sport Type</label>
                                    <select id="sport_type" name="sport_type" class="form-control">
                                        <option value="single" <?php if($sport['sport_type'] == 'single') echo 'selected'; ?>>Single</option>
                                        <option value="double" <?php if($sport['sport_type'] == 'double') echo 'selected'; ?>>Double</option>
                                        <option value="team" <?php if($sport['sport_type'] == 'team') echo 'selected'; ?>>Team</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="game_type">Game Type</label>
                                    <select id="game_type" name="game_type" class="form-control">

                                        <option value="per_meter" <?php if($sport['game_type'] == 'per_meter') echo 'selected'; ?>>Per Meter</option>
                                        <option value="per_quarter" <?php if($sport['game_type'] == 'per_quarter') echo 'selected'; ?>>Per Quater</option>
                                        <option value="per_half" <?php if($sport['game_type'] == 'per_half') echo 'selected'; ?>>Per Half</option>
                                        <option value="per_inning" <?php if($sport['game_type'] == 'per_inning') echo 'selected'; ?>>Per Inning</option>
                                        <option value="per_set" <?php if($sport['game_type'] == 'per_set') echo 'selected'; ?>>Per Set</option>
                                        <option value="per_period" <?php if($sport['game_type'] == 'per_period') echo 'selected'; ?>>Per Period</option>
                                        <option value="per_round" <?php if($sport['game_type'] == 'per_round') echo 'selected'; ?>>Per Round</option>
                                       
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="number_of_players">Number of Players</label>
                                    <input type="number" id="number_of_players" name="number_of_players" value="<?=$sport['number_of_players'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="facility_type">Facility Type</label>
                                    <select id="facility_type" name="facility_type" class="form-control">
                                        <option value="indoor" <?php if($sport['facility_type'] == 'indoor') echo 'selected'; ?>>Indoor</option>
                                        <option value="outdoor" <?php if($sport['facility_type'] == 'outdoor') echo 'selected'; ?>>Outdoor</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_sport" class="btn btn-primary">Update Sport</button>
                                </div>
                            </form>
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
