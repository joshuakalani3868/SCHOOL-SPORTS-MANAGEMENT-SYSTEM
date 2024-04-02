<?php
session_start();
include('../includes/result.inc.php'); // Include the logic file

// Fetch sports available
$sports = fetchSports(); // Assuming you have a function to fetch sports from the database

// Fetch events available
$events = fetchEvents(); // Fetch events from the database

// Fetch students available
$students = fetchStudents(); // Fetch students from the database
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

    <title>Result Add</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Result Add
                        <a href="result_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../includes/result.inc.php" method="POST">
                        <div class="mb-3">
                            <label for="event_id">Event</label>
                            <select id="event_id" name="event_id" class="form-control">
                                <?php foreach ($events as $event): ?>
                                    <option value="<?php echo $event['id']; ?>"><?php echo $event['event_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sport_id">Sport</label>
                            <select id="sport_id" name="sport_id" class="form-control">
                                <?php foreach ($sports as $sport): ?>
                                    <option value="<?php echo $sport['id']; ?>"><?php echo $sport['sport_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="student_id">Student</label>
                            <select id="student_id" name="student_id" class="form-control">
                                <?php if ($sport_type !== 'team'): ?>
                                    <option value="none">None</option>
                                    <?php foreach ($students as $student): ?>
                                        <option value="<?php echo $student['student_id']; ?>"><?php echo $student['student_name']; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="none" selected>None</option>
                                <?php endif; ?>
                            </select>
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
                            <label for="rank">Rank</label>
                            <select id="rank" name="rank" class="form-control">
                                <option value="winner">Winner</option>
                                <option value="first place">First Place</option>
                                <option value="second place">Second Place</option>
                                <option value="third place">Third Place</option>
                                <option value="participated">Participated</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="score_line">Score Line</label>
                            <input type="text" id="score_line" name="score_line" class="form-control" maxlength="255">
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_result" class="btn btn-primary">Save Result</button>
                        </div>
                    </form>
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
    });
</script>
</body>
</html>
