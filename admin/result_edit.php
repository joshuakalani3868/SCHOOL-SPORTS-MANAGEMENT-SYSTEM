<?php
session_start();
require '../includes/dbh.inc.php';
include('../includes/result.inc.php'); // Include the logic file

// Fetch sports available
$sports = fetchSports(); // Assuming you have a function to fetch sports from the database
$events = fetchEvents(); // Assuming you have a function to fetch events from the database
$students = fetchStudents(); // Assuming you have a function to fetch students from the database
$schools = fetchSchools(); // Assuming you have a function to fetch schools from the database

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

    <title>Result Edit</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Result Edit
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
                            <form action="../includes/result.inc.php" method="POST">
                                <input type="hidden" name="result_id" value="<?=htmlspecialchars($result['id']); ?>">
                                <div class="mb-3">
                                    <label for="event_id">Event</label>
                                    <select id="event_id" name="event_id" class="form-control">
                                        <?php foreach ($events as $event): ?>
                                            <option value="<?=htmlspecialchars($event['id']); ?>" <?php if($event['id'] == $result['event_id']) echo 'selected'; ?>><?php echo htmlspecialchars($event['event_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sport_id">Sport</label>
                                    <select id="sport_id" name="sport_id" class="form-control">
                                        <?php foreach ($sports as $sport): ?>
                                            <option value="<?=htmlspecialchars($sport['id']); ?>" <?php if($sport['id'] == $result['sport_id']) echo 'selected'; ?>><?php echo htmlspecialchars($sport['sport_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="student_id">Student</label>
                                    <select id="student_id" name="student_id" class="form-control">
                                        <?php if ($result['sport_type'] !== 'team'): ?>
                                            <option value="none">None</option>
                                            <?php foreach ($students as $student): ?>
                                                <option value="<?=htmlspecialchars($student['student_id']); ?>" <?php if($student['student_id'] == $result['student_id']) echo 'selected'; ?>><?php echo htmlspecialchars($student['student_name']); ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="none" selected>None</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sport_type">Sport Type</label>
                                    <select id="sport_type" name="sport_type" class="form-control">
                                        <option value="single" <?php if($result['sport_type'] == 'single') echo 'selected'; ?>>Single</option>
                                        <option value="double" <?php if($result['sport_type'] == 'double') echo 'selected'; ?>>Double</option>
                                        <option value="team" <?php if($result['sport_type'] == 'team') echo 'selected'; ?>>Team</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="rank">Rank</label>
                                    <select id="rank" name="rank" class="form-control">
                                        <option value="winner" <?php if($result['rank'] == 'winner') echo 'selected'; ?>>Winner</option>
                                        <option value="first place" <?php if($result['rank'] == 'first place') echo 'selected'; ?>>First Place</option>
                                        <option value="second place" <?php if($result['rank'] == 'second place') echo 'selected'; ?>>Second Place</option>
                                        <option value="third place" <?php if($result['rank'] == 'third place') echo 'selected'; ?>>Third Place</option>
                                        <option value="participated" <?php if($result['rank'] == 'participated') echo 'selected'; ?>>Participated</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="score_line">Score Line</label>
                                    <input type="text" id="score_line" name="score_line" value="<?=htmlspecialchars($result['score_line']);?>" class="form-control" maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="draw_a_id">Draw A School</label>
                                    <select id="draw_a_id" name="draw_a_id" class="form-control">
                                        <?php foreach ($schools as $school): ?>
                                            <option value="<?=htmlspecialchars($school['school_id']); ?>" <?php if($school['school_id'] == $result['draw_a_id']) echo 'selected'; ?>><?php echo htmlspecialchars($school['school_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="draw_b_id">Draw B School</label>
                                    <select id="draw_b_id" name="draw_b_id" class="form-control">
                                        <?php foreach ($schools as $school): ?>
                                            <option value="<?=htmlspecialchars($school['school_id']); ?>" <?php if($school['school_id'] == $result['draw_b_id']) echo 'selected'; ?>><?php echo htmlspecialchars($school['school_name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_result" class="btn btn-primary">Update Result</button>
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
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#student_id').select2(); // Initialize Select2 on your student select element
        $('#draw_a_id, #draw_b_id').select2(); // Initialize Select2 on your draw A and draw B select elements
    });
</script>
</body>
</html>
