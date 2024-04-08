<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Distribution</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?php include('../includes/coach_header.inc.php'); ?>
<body>
    <div class="container">
        <h1>Age Distribution of Students</h1>
        <div class="chart-container">
            <canvas id="ageChart"></canvas>
        </div>

        <?php
        require '../includes/dbh.inc.php'; // Include the database connection file

        // Query to count students below 18 years
        $query_below_18 = "SELECT COUNT(*) AS count_below_18 FROM users WHERE role = 'student' AND age < 18";
        $result_below_18 = $pdo->query($query_below_18)->fetch(PDO::FETCH_ASSOC);
        $count_below_18 = $result_below_18['count_below_18'];

        // Query to count students between 18 and 22 years
        $query_18_to_22 = "SELECT COUNT(*) AS count_18_to_22 FROM users WHERE role = 'student' AND age BETWEEN 18 AND 22";
        $result_18_to_22 = $pdo->query($query_18_to_22)->fetch(PDO::FETCH_ASSOC);
        $count_18_to_22 = $result_18_to_22['count_18_to_22'];

        // Query to count students above 22 years
        $query_above_22 = "SELECT COUNT(*) AS count_above_22 FROM users WHERE role = 'student' AND age > 22";
        $result_above_22 = $pdo->query($query_above_22)->fetch(PDO::FETCH_ASSOC);
        $count_above_22 = $result_above_22['count_above_22'];

        // Output the results
        echo "<p>Number of students below 18 years: " . $count_below_18 . "</p>";
        echo "<p>Number of students between 18 and 22 years: " . $count_18_to_22 . "</p>";
        echo "<p>Number of students above 22 years: " . $count_above_22 . "</p>";

        // Convert data to JSON format
        $data_json = json_encode([
            'Below 18' => $count_below_18,
            '18 to 22' => $count_18_to_22,
            'Above 22' => $count_above_22
        ]);
        ?>

        <script>
            var ctx = document.getElementById('ageChart').getContext('2d');
            var data = <?php echo $data_json; ?>;
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Age Distribution',
                        backgroundColor: [
                            'rgba(255, 69, 0, 0.8)', // More saturated red
                            'rgba(0, 128, 255, 0.8)', // More saturated blue
                            'rgba(255, 215, 0, 0.8)' // More saturated yellow
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
    <!-- Link to the JavaScript file -->
   <script src="../js/script.js"></script>
</body>

</html>
