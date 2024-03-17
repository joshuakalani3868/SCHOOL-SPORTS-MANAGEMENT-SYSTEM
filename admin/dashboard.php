<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../css/dashboard.css">
    <title> Admin Dashboard</title>
</head>
<body id="body-pd">
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="nav__brand">
                    <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                    <a href="#" class="nav__logo">SSMS</a>
                </div>
                <div class="nav__list">
                    <a href="#" class="nav__link active">
                        <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Dashboard</span>
                    </a>
                    <a href="#" class="nav__link">
                        <ion-icon name="chatbubbles-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Messenger</span>
                    </a>

                    <div class="nav__link collapse">
                        <ion-icon name="folder-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Projects</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                            <a href="sport_details.php" class="collapse__sublink">Sports</a>
                            <a href="facility_details.php" class="collapse__sublink">Sports_Facility</a>
                            <a href="event_details.php" class="collapse__sublink">Sports_Events</a>
                            <a href="team_details.php" class="collapse__sublink">Sports_Team</a>
                            <a href="result_details.php" class="collapse__sublink">Results</a>
                        </ul>
                    </div>

                    <a href="report_details.php" class="nav__link">
                        <ion-icon name="pie-chart-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Reports</span>
                    </a>
                    <div class="nav__link collapse">
                        <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Users</span>

                        <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                        <ul class="collapse__menu">
                        <a href="user_details.php" class="collapse__sublink">Users</a>
                            <a href="#" class="collapse__sublink">Admin</a>
                            <a href="#" class="collapse__sublink">Student</a>
                            <a href="#" class="collapse__sublink">Coach</a>
                        </ul>
                    </div>
                    <a href="#" class="nav__link">
                        <ion-icon name="settings-outline" class="nav__icon"></ion-icon>
                        <span class="nav__name">Settings</span>
                    </a>
                </div>
            </div>

            <a href="../includes/logout.inc.php" class="nav__link">
                <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                <span class="nav__name">Log Out</span>
            </a> 
        </nav>
    </div>

    <h1>Welcome</h1>
    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    
    <!-- ===== MAIN JS ===== -->
    <script src="../js/main.js"></script>
</body>
</html>
