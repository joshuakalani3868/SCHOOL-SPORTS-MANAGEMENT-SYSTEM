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

    <title>user edit</title>
  </head>
  <body>


    <div class="container mt-5">
       


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User view details
                        <a href="user_details.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                    if(isset($_GET['id']))
                    {
                        $user_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query ="SELECT * FROM users WHERE id='$user_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) >0)
                        {
                            $user = mysqli_fetch_array($query_run);
                            ?>
                           
    <input type="hidden" name="user_id" value="<?=$user['id']; ?>">



    <div class="mb-3">
        <label for="name">Username</label>
        <p class="form-control">
        <?=$user['username'];?>
        </p>


    </div>
    <div class="mb-3">
        <label for="pwd">User password</label>
        <p class="form-control">
        <?=$user['pwd'];?>
        </p>
    </div>
    <div class="mb-3">
        <label for="email">User email</label>
        <p class="form-control">
        <?=$user['email'];?>
        </p>
    </div>
    

                            
                            <?php

                        }
                        else {
                            echo "<h4>No such Id Found</h4>";
                        }
                    } 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
