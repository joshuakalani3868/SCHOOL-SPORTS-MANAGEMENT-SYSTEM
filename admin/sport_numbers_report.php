<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Distribution</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1>Sport Distribution of Students</h1>
        <div class="chart-container">
            <canvas id="sportChart"></canvas>
        </div>

        <?php
        require '../includes/dbh.inc.php'; // Include the database connection file

        // Query to count students in each sport
        $query_sports = "SELECT s.sport_name AS sport_name, COUNT(*) AS student_count 
                         FROM Student_Sports ss
                         INNER JOIN sports s ON ss.sport_id = s.id
                         GROUP BY s.sport_name";
        $stmt = $pdo->query($query_sports);
        $sport_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the results
        foreach ($sport_data as $sport) {
            echo "<p>Number of students in " . $sport['sport_name'] . ": " . $sport['student_count'] . "</p>";
        }

        // Convert data to JSON format
        $data_json = json_encode(array_column($sport_data, 'student_count'), JSON_NUMERIC_CHECK);
        ?>

        <script>
            var ctx = document.getElementById('sportChart').getContext('2d');
            var data = <?php echo $data_json; ?>;
            var sportNames = <?php echo json_encode(array_column($sport_data, 'sport_name')); ?>;
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: sportNames,
                    datasets: [{
                        label: 'Student Distribution by Sport',
                        backgroundColor: [
                            'rgba(255, 102, 0, 0.8)',   // Dark Orange
                            'rgba(0, 128, 255, 0.8)',  // Bright Blue
                            'rgba(255, 204, 0, 0.8)', // Bright Yellow
                            'rgba(65, 105, 225, 0.8)', // Royal Blue
                            'rgba(255, 51, 51, 0.8)', // Red
                            'rgba(30, 144, 255, 0.8)', // Dodger Blue
                            'rgba(255, 127, 80, 0.8)', // Coral
                            'rgba(218, 112, 214, 0.8)', // Orchid
                            'rgba(0, 139, 139, 0.8)', // Dark Cyan
                            'rgba(75, 0, 130, 0.8)', // Indigo
                            'rgba(255, 0, 255, 0.8)' // Magenta
                            // Add more colors as needed
                        ],
                        data: data
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
