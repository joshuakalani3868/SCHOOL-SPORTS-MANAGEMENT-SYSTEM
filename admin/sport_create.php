<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sport Add</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sport Add
                        <a href="sport_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../includes/sport.inc.php" method="POST">
                        <div class="mb-3">
                            <label for="sport_name">Sport Name</label>
                            <input type="text" id="sport_name" name="sport_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sport_type">Sport Type</label>
                            <select id="sport_type" name="sport_type" class="form-control">
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="game_type">Game Type</label>
                            <select id="game_type" name="game_type" class="form-control">
                                <option value="per_meter">Per Meter</option>
                                <option value="per_quarter">Per Quater</option>
                                <option value="per_half">Per Half</option>
                                <option value="per_inning">Per Inning</option>
                                <option value="per_set">Per Set</option>
                                <option value="per_period">Per Period</option>
                                <option value="per_round">Per Round</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="number_of_players">Number of Players</label>
                            <input type="number" id="number_of_players" name="number_of_players" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="facility_type">Facility Type</label>
                            <select id="facility_type" name="facility_type" class="form-control">
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_sport" class="btn btn-primary">Save Sport</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
