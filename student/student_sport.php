<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sports.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/font_size.css">
    <title>Select Sports</title>
    <style>
        .success-message {
            background-color: #004b79;
            color: white;
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<?php include('../includes/header.inc.php'); ?>
<body>
    <div class="priceing-table">
        <h1>Select Sports</h1>
        <?php
        // Display session message if available
        if (isset($_SESSION['message'])) {
            echo "<p class='success-message'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']); // Clear the session message after displaying it
        }
        ?>
        <form action="../includes/select_sport.inc.php" method="POST">
            <?php
            // Include database connection
            include '../includes/dbh.inc.php';

            // Function to fetch sports for selection
            function fetchSportsForSelection($pdo) {
                try {
                    $stmt = $pdo->query("SELECT id, sport_name, sport_type, game_type, number_of_players, facility_type FROM Sports");
                    $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $sports;
                } catch (PDOException $e) {
                    // Handle database errors
                    echo "Error: " . $e->getMessage();
                    return array(); // Return an empty array if there's an error
                }
            }

            // Fetch sports from the database
            $sports = fetchSportsForSelection($pdo);

            if (!empty($sports)) {
                // Display sports selection interface
                foreach ($sports as $sport) {
                    echo '<div class="price-grid">';
                    echo '<div class="price-block">';
                    echo '<div class="price-gd-top">';
                    echo '<h4>' . $sport['sport_name'] . '</h4>';
                    echo '</div>';
                    echo '<div class="price-gd-bottom">';
                    echo '<ul>';
                    echo '<li>Sport Type: ' . ucfirst($sport['sport_type']) . '</li>';
                    echo '<li>Game Type: ' . ucfirst($sport['game_type']) . '</li>';
                    echo '<li>Number of Players: ' . $sport['number_of_players'] . '</li>';
                    echo '<li>Facility Type: ' . ucfirst($sport['facility_type']) . '</li>';
                    echo '</ul>';
                    echo '</div>';
                    echo '<div class="price-selet">';
                    
                    // Check if the student has already selected this sport
                    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM student_sports WHERE student_id = :student_id AND sport_id = :sport_id");
                    $stmt_check->bindParam(':student_id', $_SESSION['user_id']);
                    $stmt_check->bindParam(':sport_id', $sport['id']);
                    $stmt_check->execute();
                    $count = $stmt_check->fetchColumn();
                    
                    if ($count > 0) {
                        // If the sport is already selected, display a remove button
                        echo '<button type="submit" name="remove_sport" value="' . $sport['id'] . '">Remove</button>';
                    } else {
                        // If the sport is not selected, display a select button
                        echo '<button type="submit" name="selected_sport" value="' . $sport['id'] . '">Select</button>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No sports available.</p>";
            }
            ?>
        </form>
        
    </div>
    </div>
</body>
</html>
