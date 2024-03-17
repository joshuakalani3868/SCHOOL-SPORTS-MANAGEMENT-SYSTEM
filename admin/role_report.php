<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Distribution</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1>Role Distribution of Users</h1>
        <div class="chart-container">
            <canvas id="roleChart"></canvas>
        </div>

        <?php
        require '../includes/dbh.inc.php'; // Include the database connection file

        // Query to count users for each role
        $query_coach = "SELECT COUNT(*) AS count_coach FROM users WHERE role = 'coach'";
        $result_coach = $pdo->query($query_coach)->fetch(PDO::FETCH_ASSOC);
        $count_coach = $result_coach['count_coach'];

        $query_student = "SELECT COUNT(*) AS count_student FROM users WHERE role = 'student'";
        $result_student = $pdo->query($query_student)->fetch(PDO::FETCH_ASSOC);
        $count_student = $result_student['count_student'];

        $query_admin = "SELECT COUNT(*) AS count_admin FROM users WHERE role = 'admin'";
        $result_admin = $pdo->query($query_admin)->fetch(PDO::FETCH_ASSOC);
        $count_admin = $result_admin['count_admin'];

        // Output the results
        echo "<p>Number of coaches: " . $count_coach . "</p>";
        echo "<p>Number of students: " . $count_student . "</p>";
        echo "<p>Number of admins: " . $count_admin . "</p>";

        // Convert data to JSON format
        $data_json = json_encode([
            'Coach' => $count_coach,
            'Student' => $count_student,
            'Admin' => $count_admin
        ]);
        ?>

        <script>
            var ctx = document.getElementById('roleChart').getContext('2d');
            var data = <?php echo $data_json; ?>;
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Role Distribution',
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
</body>

</html>
