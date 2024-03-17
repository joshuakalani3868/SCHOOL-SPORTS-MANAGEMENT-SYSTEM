<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image: url('../img/pexels-tembela-bohle-2803160.jpg'); /* Add your background image URL here */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7); /* Adjust alpha value to make it more translucent */
            padding: 20px;
            border-radius: 10px; /* Add some rounded corners */
        }

        h2 {
            margin-bottom: 30px;
            color: #333; /* Text color */
        }

        .report-link {
            display: block;
            margin-bottom: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #333;
            background-color: #f0f0f0; /* Add a light gray background for links */
            padding: 10px 20px;
            border-radius: 5px; /* Add some rounded corners to links */
            transition: background-color 0.3s ease; /* Smooth transition effect */
        }

        .report-link:hover {
            background-color: #0069d9; /* Change background color on hover */
            color: #fff; /* Change text color on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reports Dashboard</h2>
        <a href="age_category_report.php" class="report-link">Age Category Report</a>
        <a href="gender_report.php" class="report-link">Gender Report</a>
        <a href="role_report.php" class="report-link">Role Report</a>
        <a href="sport_numbers_report.php" class="report-link">Sports Numbers Report</a>
        <!-- Add more links for other report categories -->
    </div>
</body>

</html>
