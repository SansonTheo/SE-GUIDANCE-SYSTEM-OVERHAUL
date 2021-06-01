<!DOCTYPE html>
<?php 
    include "server.php";
    include "authenticate.php";
    include "authenticateDirector.php";
?>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/viewsessionlist.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: rgb(224, 224, 224); padding-top:60px; min-width:1080px;">
        <div class="toggle-bar">
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
        </div>
        <div class="nav-sidebar">
            <ul>
                <li><span>menu</span></li>
                <li><a href="Page-Director-ViewStudentList.php"><img src="imgs/icon-student.png">student profiling</a>
                <li><a href="javascript:toggleGuidance();"><img src="imgs/icon-counseling.png">counseling index</a>
                    <ul class="guidance-ul">
                        <li><a href="Page-Director-SessionList.php">Sessions</a></li>
                        <li><a href="Page-Director-ReferralList.php">Referrals</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="title-bar">
            <div class="user-toggle" onclick="toggleUser()">
                <div class="user-img">
                    <img src="imgs/new-person.png">
                </div><?php
                    echo $_SESSION['name'];
            ?></div>
            <div class="user-div">
                <ul>
                    <li>Help & Support</li>
                    <li>Contact Us</li>
                    <li onclick="logout();">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>Session List</div>
        </div>
        <div class="center-container">
            <div class="session-list-container">
                <div class="session-window">
                    <div class="sort-buttons" style="width:100%; height:100px; position:relative;">
                        <div onclick="directorSessionAdd()" class="addSession-button">
                            <div class="add-label">
                                Add Session
                            </div>
                            <img src="imgs/new-add.png">
                        </div>
                        <div style="font-size:15px;">
                            Search by:
                        </div>
                        <div>
                            <span style="white-space: nowrap;">
                                <form id="searchForm" action="PageStudentProfiling-ViewList.php" method="post">
                                    <input type="text" id="search-counselor-name" name="search-counselor-name" placeholder="Counselor Name. . ." class="search" style="width:15%;" value="">
                                    <input type="text" id="search-session-date" name="search-session-date" placeholder="Date. . ." class="search" style="width:15%;" value="">
                                </form>
                            </span>
                        </div>
                        <div>
                            <span>
                                <button form="searchForm" class="search-button" type="button" onclick="searchSession();" name="search" style="width:20%; height:30px;">Search</button>
                                <button form="searchForm" class="search-button" type="submit" name="clear" style="width:20%; height:30px;">Clear</button>
                            </span>
                        </div>
                    </div>
                    <div class="list-window">
                        <table id="session-table" class="list-table">
                            <tr>
                                <th class="session-date list-label">
                                    Date
                                </th>
                                <th class="session-time list-label">
                                    Time
                                </th>
                                <th class="session-duration list-label">
                                    Duration
                                </th>
                                <th class="session-counselor list-label">
                                    Counselor
                                </th>
                                <th class="session-status list-label">
                                    Status
                                </th>
                            </tr>
                            <?php
                                $record = mysqli_query($link,"SELECT * FROM session");
                                while($session=mysqli_fetch_array($record)):
                            ?>
                                <tr class="show" name="entry">
                                    <td style="display:none;"><?php
                                        $sessionid = $session['id'];
                                        echo $sessionid;
                                    ?></td>
                                    <td class="session-date"><?php
                                        $date = new DateTime($session['date']);
                                        echo $date->format('D, M j, \'y');                               
                                    ?></td>
                                    <td class="session-time"><?php
                                        $time = new DateTime($session['time']);
                                        echo $time->format('h:i A');                               
                                    ?></td>
                                    <td class="session-duration"><?php
                                        $duration = "";
                                        if($session['endtime'] != "00:00:00"){
                                            $time1 = strtotime($session['time']);
                                            $time2 = strtotime($session['endtime']);
                                            $duration = round(abs($time2 - $time1) / 3600,2) . " Hour/s";
                                        }
                                        echo $duration;                              
                                    ?></td>
                                    <td class="counselor"><?php 
                                        $counselorId = $session['counselorid'];
                                        $counselorList = mysqli_query($link,"SELECT * FROM counselor WHERE id=$counselorId");
                                        $counselor = mysqli_fetch_array($counselorList);
                                        echo $counselor['firstname']." ".$counselor['lastname']; ?></td>
                                    <td><?php
                                        echo $session['status'];
                                    ?></td>
                                    <td style="display:none;"><?php
                                        $dateset = new DateTime($session['dateset']);
                                        $counselorId = $session['setter'];
                                        $counselorList = mysqli_query($link,"SELECT * FROM counselor WHERE id=$counselorId");
                                        $counselor = mysqli_fetch_array($counselorList);
                                        echo $dateset->format('D, M j, Y')." by ".$counselor['firstname']." ".$counselor['lastname'];
                                    ?></td>
                                    <td style="display:none;"><?php 
                                        $currentStudentRecordId = $session['studentid'];
                                        $studentQuery = "SELECT * FROM student WHERE id=$currentStudentRecordId";
                                        $studentList = $link->query($studentQuery);
                                        if($student = mysqli_fetch_array($studentList)){
                                            echo $student['firstname']." ".$student['lastname'];
                                        }
                                    ?></td>
                                    <td style="display:none;"><?php 
                                        $teacherRecordQuery = "SELECT * FROM sessionrecord WHERE type='Teacher' AND sessionid=$sessionid";
                                        $teacherRecordList = $link->query($teacherRecordQuery);
                                        if ($teacherRecordList->num_rows > 0) {
                                            $i = 0;
                                            while($teacherRecord = mysqli_fetch_array($teacherRecordList)):
                                                $currentTeacherRecordId = $teacherRecord['involvedid'];
                                                $teacherQuery = "SELECT * FROM teacher WHERE id=$currentTeacherRecordId";
                                                $teacherList = $link->query($teacherQuery);
                                                if($teacher = mysqli_fetch_array($teacherList)){
                                                    echo $teacher['firstname']." ".$teacher['lastname'];
                                                    $i++;
                                                }
                                            endwhile;
                                        }
                                    ?></td>
                                </tr>
                            <?php
                                endwhile;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="session-schedule-grid-container" id="info-show">
                <div class="session-info-container">
                    <div class="info-show-box">
                        <div class="session-buttons-container">
                            <div class="session-namebuttons">
                                <div class="session-info-button-container">
                                    <a style="visibility:hidden;" class="session-info-button"><img src="imgs/new-view.png" id="view-img"><div class="button-label" id="view">View Session</div></a>
                                    <a style="visibility:hidden;" class="session-info-button"><img src="imgs/new-view.png" id="edit-img"><div class="button-label" id="edit">View Session</div></a>
                                    <a onclick="directorViewSession()" class="session-info-button"><img src="imgs/new-view.png" id="mark-img"><div class="button-label" id="mark">View Session</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="info-subgroup session-info">
                            <p class="info-subgroup-label">&nbsp;Session Details&nbsp;</p>
                            <div>
                                <p class="info-label">Date</p>
                                <p class="info-value" id="show-0"></p>
                            </div>
                            <div>
                                <p class="info-label">Time</p>
                                <p class="info-value" id="show-1"></p>
                            </div>
                            <div>
                                <p class="info-label">Duration</p>
                                <p class="info-value" id="show-2"></p>
                            </div>
                            <div>
                                <p class="info-label">Counselor</p>
                                <p class="info-value" id="show-3"></p>
                            </div>
                            <div>
                                <p class="info-label">Status</p>
                                <p class="info-value" id="show-4"></p>
                            </div>
                            <div>
                                <p class="info-label">Date Created</p>
                                <p class="info-value" id="show-5"></p>
                            </div>
                            <div style="grid-column: span 2;">
                                <p class="info-label">Student</p>
                                <p class="info-value" id="show-6"></p>
                            </div>
                            <div style="grid-column: span 2;">
                                <p class="info-label">Teachers</p>
                                <p class="info-value" id="show-7"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 
                <div class="schedule-container">
                    <div class="time-display">
                        <div></div>
                        <div>7AM</div>
                        <div>8AM</div>
                        <div>9AM</div>
                        <div>10AM</div>
                        <div>11AM</div>
                        <div>12PM</div>
                        <div>1PM</div>
                        <div>2PM</div>
                        <div>3PM</div>
                        <div>4PM</div>
                        <div>5PM</div>
                        <div></div>
                    </div>
                    <div class="schedule">
                        <div class="schedule-day">Mon</div>
                        <div class="schedule-day">Tue</div>
                        <div class="schedule-day">Wed</div>
                        <div class="schedule-day">Thu</div>
                        <div class="schedule-day">Fri</div>
                        <div class="schedule-day">Sat</div>
                        <div class="schedule-day">Sun</div>
                    </div>
                </div>
                -->
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/viewsessionlist.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>