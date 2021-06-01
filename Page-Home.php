<!DOCTYPE html>
<?php 
    include "server.php";
    include "authenticate.php";
    include "authenticateGuidance.php";
?>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: rgb(224, 224, 224); padding-top:60px; min-width:1200px;">
        <div class="toggle-bar">
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
        </div>
        <div class="nav-sidebar">
            <ul>
                <li><span>menu</span></li>
                <li><a href="Page-Home.php"><img src="imgs/icon-home.png">home</a></li>
                <li><a href="javascript:toggleProfiling();"><img src="imgs/icon-student.png">student profiling</a>
                    <ul class="profiling-ul">
                        <li><a href="Page-Profiling-StudentList.php">Index</a></li>
                        <li><a href="Page-Profiling-AddStudent.php">Add Student</a></li>
                    </ul>
                </li>
                <li><a href="javascript:toggleGuidance();"><img src="imgs/icon-counseling.png">counseling index</a>
                    <ul class="guidance-ul">
                        <li><a href="Page-Counseling-SessionList.php">Index</a></li>
                        <li><a href="Page-Counseling-AddSession.php">Add Session</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="title-bar">
            <div class="user-toggle" onclick="toggleUser()">
                <div class="user-img">
                    <!-- ADD GEAR ICON -->
                </div>
                <?php echo $_SESSION['name']; ?>
            </div>
            <div class="user-div">
                <ul>
                    <li>Profile</li>
                    <li>Sessions</li>
                    <li onclick="logout()">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>WMSU Guidance</div>
        </div>
        <div class="center-container">
            <div class="profile-label-container">
                Profile
            </div>
            <div class="profile-container">
                <div class="info-subgroup  user-info">
                    <p class="info-subgroup-label">&nbsp; Biographics &nbsp;</p>
                    <div class="subgroup-div" style="grid-column: span 2;">
                        <p class="info-label">Username</p>
                        <p class="info-value"><?php echo $_SESSION['user'] ?></p>
                    </div>
                    <div class="subgroup-div" style="grid-column: span 2;">
                        <p class="info-label">Password</p><?php echo '  <a onclick="changePassword()" style="position:relative; left:100px; top:6px; color:darkblue; font-style:none; font-size:13px;" href="#">Change Password</a>';
                         ?>
                        <p class="info-value"><?php 
                        $passLength = strlen ($_SESSION['pass']);
                        for($i = 0; $i < $passLength; $i++){
                            echo '*';
                        }
                    ?></p>
                    </div>
                    <div class="subgroup-div" style="grid-column: span 2;">
                        <p class="info-label">Type</p>
                        <p class="info-value"><?php echo $_SESSION['type'] ?></p>
                    </div>
                    <div class="subgroup-div" style="grid-column: span 2;">
                        <p class="info-label">Number of My Sessions</p>
                        <p class="info-value">3</p>
                    </div>
                    <div class="subgroup-div" style="grid-column: span 2;">
                        <p class="info-label">Number Sessions</p>
                        <p class="info-value">3</p>
                    </div>
                </div>
            </div>
            <div class="counselor-buttons">
                BUTTONS
            </div>
            <div class="dashboard-label-container">
                Dashboard
            </div>
            <div class="numbers-container">
                <div class="numbers">
                    <div class="numbers-icon">
                    </div>
                    <div class="numbers-name">
                        Students
                        <div class="numbers-data">
                            200
                        </div>
                    </div>
                </div>
                <div class="numbers">
                <div class="numbers-icon">
                    </div>
                    <div class="numbers-name">
                        Sessions
                        <div class="numbers-data">
                            13
                        </div>
                    </div>
                </div>
                <div class="numbers">
                <div class="numbers-icon">
                    </div>
                    <div class="numbers-name">
                        <p style="margin:0px; line-height:15px;">Session</p>
                        <p style="margin:0px; line-height:15px;">Requests</p>
                        <div class="numbers-data">
                            3
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-container">
                <div class="request-pie-chart">
                    <canvas id="requestPieChart" style="height:100%; width:100%;"></canvas>
                </div>
                <div class="session-bar-graph">
                    <canvas id="sessionBarGraph" style="height:100%; width:100%; position:relative;"></canvsa>
                    <?php //SESSION PER MONTH CHART (Scheduled, Requested) ?>
                </div>
            </div>
            <div class="sessions-container">
                MY SESSIONS
            </div>
        </div>
        <div class="page-footer">
            <div class="footer-container">
                <div class="footer-seal-container">
                    <div class="footer-seal">
                        <div class="footer-img-container">
                            <img src="imgs/wmsu-seal.png">
                        </div>
                        <div class="footer-wmsu-container">
                            <p>Western Mindanao</p>
                            <p>State University</p>
                        </div>
                    </div>
                    <div class="footer-location-info" style="font-size:17px;">
                        <p style="font-size:15px;">Guidance and Counseling</p>
                        <p>Normal Road, Baliwasan</p>
                        <p>7000, Zamboanga City</p>
                        <p>Philippines</p>
                    </div>
                </div>
                <div class="footer-buttons-container">
                    <a href="#">Home</a>
                    <a href="#">Student Profiling</a>
                    <a href="#">Guidance Counseling</a>
                </div>
                <div class="footer-buttons-container">
                    <a href="#">About</a>
                    <a href="#">Mission & Vision</a>
                    <a href="#">Support</a>
                    <a href="#">Contact Us:</a>
                    <p class="footer-contact-info">(062) 991 - 6446</p>
                    <p class="footer-contact-info">gcc@wmsu.edu.ph</p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.0/dist/chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/viewstudentlist.js"></script>
        <script src="js/main.js"></script>
        <script>
            var ctx = document.getElementById('requestPieChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Denied', 'Pedding', 'Approved'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
        </script>
        <script>
            var ctx2 = document.getElementById('sessionBarGraph').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
</html>