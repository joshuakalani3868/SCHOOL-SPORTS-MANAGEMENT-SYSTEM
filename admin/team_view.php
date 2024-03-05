<?php
require '../includes/dbh.inc.php';

if(isset($_GET['id'])) {
    $team_id = $_GET['id'];
    
    try {
        // Prepare the SQL statement with JOINs to fetch actual names
        $stmt = $pdo->prepare("SELECT t.id, uc.username AS coach_name, s.sport_name, GROUP_CONCAT(us.username ORDER BY us.username DESC SEPARATOR ', ') AS student_names
                           FROM teams t
                           INNER JOIN users uc ON t.coach_id = uc.id
                           INNER JOIN sports s ON t.sport_id = s.id
                           INNER JOIN users us ON t.student_id = us.id
                           WHERE t.id = :team_id
                           GROUP BY t.coach_id, t.sport_id");
        $stmt->bindParam(':team_id', $team_id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            while ($team = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
            <!doctype html>
            <html lang="en">
            <head>
                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

                <title>Team View Details</title>
            </head>
            <body>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Team View Details
                                    <a href="team_details.php" class="btn btn-danger float-end">BACK</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="team_id" value="<?= $team['id']; ?>">
                                <div class="mb-3">
                                    <label for="coach_name">Coach Name</label>
                                    <p class="form-control"><?= $team['coach_name']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="sport_name">Sport Name</label>
                                    <p class="form-control"><?= $team['sport_name']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="student_names">Student Names</label>
                                    <p class="form-control"><?= $team['student_names']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            </body>
            </html>
<?php
            } // Closing curly brace for while loop
        } else {
            echo "<h4>No such ID Found</h4>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
