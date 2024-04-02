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

    <title>Add School</title>
</head>
<body>
<div class="container mt-5">
    <?php include('../includes/message.inc.php');?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add School
                        <a href="school_details.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../includes/school.inc.php" method="POST">
                        <div class="mb-3">
                            <label for="school_name">School Name</label>
                            <input type="text" id="school_name" name="school_name" class="form-control" maxlength="50" required>
                        </div>
                        <div class="mb-3">
                            <label for="school_location">School Location</label>
                            <input type="text" id="school_location" name="school_location" class="form-control" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="contact_person_name">Contact Person Name</label>
                            <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="contact_person_email">Contact Person Email</label>
                            <input type="email" id="contact_person_email" name="contact_person_email" class="form-control" maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="contact_person_phone">Contact Person Phone</label>
                            <input type="tel" id="contact_person_phone" name="contact_person_phone" class="form-control" maxlength="15">
                        </div>
                        <div class="mb-3">
                            <label for="is_host">Is Host</label>
                            <select id="is_host" name="is_host" class="form-control">
                                <option value="host">Host</option>
                                <option value="participant">Participant</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_school" class="btn btn-primary">Save School</button>
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
