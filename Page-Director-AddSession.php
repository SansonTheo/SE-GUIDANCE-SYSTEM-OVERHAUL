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
        <link rel="stylesheet" type="text/css" href="css/session-form.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: rgb(224, 224, 224); padding-top:60px; min-width:800px;">
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
            <div>Add Session</div>
        </div>
        <form name="session-form" id="session-form" onsubmit="return validateForm()" class="center-container" method="post" action="directorCounselingAdd.php">
            <div class="form-label">
                Add Session
                <p class="form-label-subtext">Please Input Information Accurately</p>
                <p class="form-label-subtext">Fields marked with * are required</p>
            </div>
            <div class="subgroup-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Session Information</p>
                </div>
                <div class="question-container">
                    <p class="question-label-with-button">Counselor *
                        <button type="button" class="action-button add-button" style="width:130px; height:28px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addCounselor">
                                Select Counselor
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                •
                            </div>
                        </button>
                    </p>
                    <input class="hidden-input" type="text" name="counselor-id" id="counselor-id">
                    <input type="text" name="counselor-name" id="counselor-name" placeholder="Counselor" readonly="readonly" style="pointer-events: none;">
                </div>
                <div class="question-container">
                    <p>Time start *
                        <span style="font-size:12px;">
                            Office Hours are from 7AM to 5PM
                        </span>
                    </p>
                    <input type="time" name="sessionTimeStart" id="sessionTimeStart" min="07:00" max="17:00" onchange="timeCheck(timeStart)">
                </div>
                <div class="question-container">
                    <p>Time end</p>
                    <input type="time" name="sessionTimeEnd" id="sessionTimeEnd" min="07:00" max="17:00" onchange="timeCheck(timeEnd); chronologyCheck();">
                </div>
                <div class="question-container">
                    <p>Date *</p>
                    <input type="date" name="sessionDate" id="sessionDate">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Additional Info</p>
                    <textarea style="resize:none; height:300px;" name="sessionInfo" id="sessionInfo" form="session-form" placeholder="Additional Notes. . ."></textarea>
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Course of Action</p>
                    <textarea style="resize:none; height:300px;" name="courseOfAction" id="courseOfAction" form="session-form" placeholder="Course of Action. . ."></textarea>
                </div>
            </div>
            <div class="subgroup-container">
                <div class="question-container">
                    <p class="question-label-with-button">Referral *
                        <button type="button" class="action-button add-button" style="width:130px; height:28px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addReferral">
                                Select Referral
                            </div>
                        </button>
                    </p>
                    <input class="hidden-input" type="text" name="referral-id" id="referral-id">
                    <input type="text" name="referall-name" id="referral-name" placeholder="Referral" readonly="readonly" style="pointer-events: none;">
                </div>
            </div>
            <div class="subgroup-container">
                <div class="question-container">
                    <p class="question-label-with-button">Student *
                        <button id="addStudentHide" type="button" class="action-button add-button" style="width:130px; height:28px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addStudent">
                                Select Student
                            </div>
                        </button>
                    </p>
                    <input class="hidden-input" type="text" name="student-id" id="student-id">
                    <input type="text" name="student-name" id="student-name" placeholder="Student" readonly="readonly" style="pointer-events: none;">
                </div>
            </div>
            <div class="subgroup-container buttons">
                <button type="submit" class="action-button" style="width:100px; height:40px;">
                    <div class="action-button-label">
                        Add
                    </div>
                    <div class="action-button-icon">
                        +
                    </div>
                </button>
                <button onclick="directorSessionList();" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
                    Cancel
                </button>
            </div>
        </form>
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
        <div class="counselor-modal-container" id="counselor-modal-container">
            <div class="counselor-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Add Counselor
                    </p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <div class="student-window">
                        <div class="sort-buttons" style="width:100%; height:100px;">
                            <div style="font-size:15px;">
                                Search by:
                            </div>
                            <div>
                                <span style="white-space: nowrap;">
                                    <form id="searchCounselorForm" method="post">
                                        <input type="text" id="search-counselor-name" name="search-counselor-name" placeholder="Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-counselor-department" name="search-counselordepartment-name" placeholder="Department. . ." class="search" style="width:15%;" value="">
                                    </form>
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <span>
                                    <button form="searchCounselorForm" class="search-button" type="button" onclick="searchCounselor();" name="search" style="width:15%; height:30px;">Search</button>
                                    <button form="searchCounselorForm" class="search-button" type="reset" name="clear" style="width:8%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table id="counselor-table" class="generic-table">
                                <tr>
                                    <th class="counselor-add-name list-label">
                                        Name
                                    </th>
                                    <th class="counselor-add-department list-label">
                                        Department
                                    </th>
                                    <th class="counselor-add-college list-label">
                                        College
                                    </th>
                                </tr>
                                <?php
                            $counselorQuery = "SELECT * FROM counselor";
                            $counselorList = $link->query($counselorQuery);
                            if ($counselorList->num_rows > 0) {
                                while($counselor = mysqli_fetch_array($counselorList)):
                                ?>
                                <tr class="show" name="counselorentry" id="counselorEntryId<?php echo $counselor['id']; ?>">
                                    <td style="display:none;" ><?php echo $counselor['id']; ?></td>
                                    <td class="counselor-name"><?php echo $counselor['firstname']." ".$counselor['lastname']; ?></td>
                                    <td class="counselor-department"><?php echo $counselor['department']; ?></td>
                                    <td class="counselor-college"><?php echo $counselor['college']; ?></td>
                                </tr>
                                <?php
                                        endwhile;
                                    }
                                ?>
                                <!-- <tr>
                                    <td class="teacher-add-name">
                                        Arthur Morgan
                                    </td>
                                    <td class="teacher-add-department">
                                        Computer Science
                                    </td>
                                    <td class="teacher-add-college">
                                        Institute of Computer Studies
                                    </td>
                                </tr> -->
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <button id="addCounselorToTable" type="button" class="action-button" style="width:100px; height:30px;">
                            <div class="action-button-label">
                                Select
                            </div>
                            <div class="action-button-icon">
                                •
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeCounselorModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="student-modal-container" id="student-modal-container">
            <div class="student-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Select Student
                    </p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <div class="student-window">
                        <div class="sort-buttons" style="width:100%; height:100px;">
                            <div style="font-size:15px;">
                                Search by:
                            </div>
                            <div>
                                <span style="white-space: nowrap;">
                                    <form id="search-form" name="search-form" method="post">
                                        <input type="text" id="search-student-name" name="search-student-name" placeholder="Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-student-department" name="search-department-name" placeholder="Department. . ." class="search" style="width:15%;" value="">
                                    </form>
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <span>
                                    <button form="search-form" type="button" onclick="searchStudent();" class="search-button" name="search" style="width:15%; height:30px;">Search</button>
                                    <button form="search-form" type="reset" class="search-button" name="clear" style="width:8%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table id="student-table" class="generic-table">
                                <tr>
                                    <th class="student-id list-label">
                                        ID
                                    </th>
                                    <th class="student-name list-label">
                                        Name
                                    </th>
                                    <th class="student-department list-label">
                                        Department
                                    </th>
                                    <th class="student-level list-label">
                                        Yr. Level
                                    </th>
                                </tr>
                                <?php
                                    $studentQuery = "SELECT * FROM student";
                                    $studentList = $link->query($studentQuery);
                                    if ($studentList->num_rows > 0) {
                                        while($student = mysqli_fetch_array($studentList)): ?>
                                <tr class="show" name="studententry" id="studentEntryId<?php echo $student['id'] ?>">
                                    <td style="display:none;"><?php echo $student['id']?></td>
                                    <td class="student-id"><?php echo $student['studentid']; ?></td>
                                    <td class="student-name"><?php echo $student['firstname']." ".$student['lastname']; ?></td>
                                    <td class="student-department"><?php echo $student['department']; ?></td>
                                    <td class="student-level"><?php echo $student['level']; ?></td>
                                </tr>
                                <?php 
                                        endwhile;
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <button id="addStudentToTable" type="button" class="action-button" style="width:100px; height:30px;">
                            <div class="action-button-label">
                                Select
                            </div>
                            <div class="action-button-icon">
                                •
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeStudentModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="referral-modal-container" id="referral-modal-container">
            <div class="referral-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Select Referral
                    </p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <div class="student-window">
                        <div class="sort-buttons" style="width:100%; height:100px;">
                            <div style="font-size:15px;">
                                Search by:
                            </div>
                            <div>
                                <span style="white-space: nowrap;">
                                    <form id="searchForm" method="post">
                                        <input type="text" id="search-referral-student" name="search-referral-student" placeholder="Student Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-referral-referrer" name="search-referral-referrer" placeholder="Referred By. . ." class="search" style="width:15%;" value="">
                                    </form>
                                </span>
                            </div>
                            <div>
                                <span>
                                    <button form="searchForm" class="search-button" onclick="searchReferral()" type="button" name="search" style="width:20%; height:30px;">Search</button>
                                    <button form="searchForm" class="search-button" type="reset" name="clear" style="width:20%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table id="referral-table" class="generic-table">
                                <tr>
                                    <th class="student-id list-label">
                                        Student
                                    </th>
                                    <th class="student-name list-label">
                                        Referred By
                                    </th>
                                    <th class="student-department list-label">
                                        Date Sent
                                    </th>
                                </tr>
                                <?php
                                    $referralQuery = "SELECT * FROM referral WHERE status='Pending'";
                                    $referralList = $link->query($referralQuery);
                                    if ($referralList->num_rows > 0) {
                                        while($referral = mysqli_fetch_array($referralList)): ?>
                                <tr class="show" name="referralentry" id="referralEntryId<?php echo $referral['id'] ?>">
                                    <td style="display:none;"><?php
                                        echo $referral['id'];                     
                                    ?></td>
                                    <?php
                                        $studentid = $referral['studentid'];
                                        $studentRecordQuery = "SELECT * FROM student WHERE id=$studentid";
                                        $studentRecordList = $link->query($studentRecordQuery);
                                        $student = mysqli_fetch_array($studentRecordList);
                                    ?>
                                    <td class="student-name"><?php
                                        echo $student["firstname"]." ".$student["lastname"];
                                    ?></td>
                                    <td class="student-name"><?php
                                        $referrerid = $referral['referredby'];
                                        $referrertype = $referral['referredtype'];
                                        $usertype = "";
                                        if($referrertype == "Teacher"){
                                            $usertype = "teacher";
                                        }
                                        else{
                                            $usertype = "counselor";
                                        }
                                        $referrerList = mysqli_query($link,"SELECT * FROM $usertype WHERE id=$referrerid");
                                        $referrer = mysqli_fetch_array($referrerList);
                                        echo $referrer['firstname']." ".$referrer['lastname'];                      
                                    ?></td>
                                    <td class="hidden-input"><?php
                                        echo $student["id"];
                                    ?></td>
                                    <td class="student-department"><?php 
                                        $datetimesent = new DateTime($referral['datetimesent']);
                                        echo $datetimesent->format('D, M j, \'y, h:i A');                 
                                    ?></td>
                                </tr>
                                <?php 
                                        endwhile;
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <button id="addReferralToTable" type="button" class="action-button" style="width:100px; height:30px;">
                            <div class="action-button-label">
                                Select
                            </div>
                            <div class="action-button-icon">
                                •
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeReferralModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
        <script src="js/director-session-form.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>