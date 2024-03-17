<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gender Distribution</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1>Gender Distribution of Students</h1>
        <div class="chart-container">
            <canvas id="genderChart"></canvas>
        </div>

        <?php
        require '../includes/dbh.inc.php'; // Include the database connection file

        // Query to count male students
        $query_male = "SELECT COUNT(*) AS count_male FROM users WHERE role = 'student' AND gender = 'male'";
        $result_male = $pdo->query($query_male)->fetch(PDO::FETCH_ASSOC);
        $count_male = $result_male['count_male'];

        // Query to count female students
        $query_female = "SELECT COUNT(*) AS count_female FROM users WHERE role = 'student' AND gender = 'female'";
        $result_female = $pdo->query($query_female)->fetch(PDO::FETCH_ASSOC);
        $count_female = $result_female['count_female'];

        // Output the results
        echo "<p>Number of male students: " . $count_male . "</p>";
        echo "<p>Number of female students: " . $count_female . "</p>";

        // Convert data to JSON format
        $data_json = json_encode([
            'Male' => $count_male,
            'Female' => $count_female
        ]);
        ?>

        <script>
            var ctx = document.getElementById('genderChart').getContext('2d');
            var data = <?php echo $data_json; ?>;
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Gender Distribution',
                        backgroundColor: [
                            'rgba(0, 128, 255, 0.8)', // More saturated blue
                            'rgba(255, 69, 0, 0.8)' // More saturated red
                        ],
                        data: Object.values(data)
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>
    </div>
</body>

</html>
