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
        <link rel="stylesheet" type="text/css" href="css/viewsession.css">
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
            <div>View Session</div>
        </div>
        <div class="center-container">
            <?php 
                $id=$_REQUEST['id'];
                $record = mysqli_query($link,"SELECT * FROM session WHERE id=$id");
                $session = mysqli_fetch_array($record);
            ?>
            <div class="info-show" style="grid-row: span 3;">
                <div class="student-info info-show-box">
                    <div class="student-picname">
                        <div class="student-namebuttons">
                            <div class="student-info-button-container">
                                <div class="student-info-button-container">
                                    <a <?php if($session['status'] == "Finished"){ echo "Style='Visibility:hidden;'";} ?> href="directorCounselingComplete.php?id=<?php echo $id; ?>" class="student-info-button"><img src="imgs/new-check.png" id="check-img"><div class="button-label" id="check">Mark as Finished</div></a>
                                    <a <?php if($session['status'] == "Finished"){ echo "Style='Visibility:hidden;'";} ?> href="Page-Director-EditSession.php?id=<?php echo $id; ?>" class="student-info-button"><img src="imgs/new-edit.png" id="edit-img"><div class="button-label" id="edit">Edit Session</div></a>
                                    <a <?php if($session['status'] == "Finished"){ echo "Style='Visibility:hidden;'";} ?> onclick="validateDelete()" class="student-info-button"><img src="imgs/new-delete.png" id="delete-img"><div class="button-label" id="delete">Delete Data</div></a>
                                    <a href="#" class="student-info-button"><img src="imgs/new-print.png" id="print-img"><div class="button-label" id="print">Print Data</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-subgroup session-main-info">
                        <p class="info-subgroup-label">&nbsp; Session Details &nbsp;</p>
                        <div>
                            <p class="info-label">Date</p>
                            <p class="info-value"><?php 
                                $date = new DateTime($session['date']);
                                echo $date->format('D, M j, \'y');    
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Time</p>
                            <p class="info-value"><?php
                                        $time = new DateTime($session['time']);
                                        echo $time->format('h:i A');                               
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Duration</p>
                            <p class="info-value"><?php
                                $duration = "";
                                if($session['endtime'] != "00:00:00"){
                                    $time1 = strtotime($session['time']);
                                    $time2 = strtotime($session['endtime']);
                                    $duration = round(abs($time2 - $time1) / 3600,2) . " Hour/s";
                                }
                                echo $duration;                              
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Counselor</p>
                            <p class="info-value"><?php 
                                $counselorId = $session['counselorid'];
                                $counselorList = mysqli_query($link,"SELECT * FROM counselor WHERE id=$counselorId");
                                $counselor = mysqli_fetch_array($counselorList);
                                echo $counselor['firstname']." ".$counselor['lastname']; 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Status</p>
                            <p class="info-value"><?php
                                echo $session['status'];
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Date Created</p>
                            <p class="info-value"><?php
                                $dateset = new DateTime($session['dateset']);
                                $counselorId = $session['setter'];
                                $counselorList = mysqli_query($link,"SELECT * FROM counselor WHERE id=$counselorId");
                                $counselor = mysqli_fetch_array($counselorList);
                                echo $dateset->format('D, M j, Y')." by ".$counselor['firstname']." ".$counselor['lastname'];
                            ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Counseling Description &nbsp;</p>
                        <div class="info-show-text-area">
                            <p class="info-value info-show-text"><?php
                                echo $session['sessiondesc'];
                            ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Course of Action &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text"><?php
                                echo $session['action'];
                            ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-info-show">
                <div class="student-info info-show-box  teacher-container" style="margin:0px;">
                    <div class="info-subgroup session-main-info" style="height:215px; position:relative; width:calc(100% - 10px);">
                        <p class="info-subgroup-label">&nbsp; Student Details &nbsp;</p>
                        <?php
                            $studentid = $session['studentid'];
                            $studentRecordQuery = "SELECT * FROM student WHERE id=$studentid";
                            $studentRecordList = $link->query($studentRecordQuery);
                            $student = mysqli_fetch_array($studentRecordList);
                        ?>
                        <div>
                            <p class="info-label">Student Name</p>
                            <p class="info-value"><?php
                                echo $student["firstname"]." ".$student["lastname"];
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Student Contact</p>
                            <p class="info-value"><?php
                                echo $student["contactno"];
                            ?></p>
                        </div>
                        <?php
                            $parentRecordQuery = "SELECT * FROM parentrecord WHERE studentid=$studentid";
                            $parentRecordList = $link->query($parentRecordQuery);
                            if ($parentRecordList->num_rows > 0) {
                                while($parentRecord = mysqli_fetch_array($parentRecordList)):
                                    $currentParentId = $parentRecord['parentid'];
                                    $fatherQuery = "SELECT * FROM parent WHERE id=$currentParentId AND relationship='Father'";
                                    $motherQuery = "SELECT * FROM parent WHERE id=$currentParentId AND relationship='Mother'";
                                    $guardianQuery = "SELECT * FROM parent WHERE id=$currentParentId";
                                    $fathertemp = mysqli_fetch_array($link->query($fatherQuery));
                                    $mothertemp = mysqli_fetch_array($link->query($motherQuery));
                                    $guardiantemp = mysqli_fetch_array($link->query($guardianQuery));
                                    if($fathertemp != NULL){
                                        $father = $fathertemp;
                                    }
                                    else if($mothertemp != NULL){
                                        $mother = $mothertemp;
                                    }
                                    if($guardiantemp != NULL){
                                        $guardian = $guardiantemp;
                                    }
                                endwhile;
                            }
                        ?>
                        <div>
                            <p class="info-label">Guardian Name</p>
                            <p class="info-value"><?php
                                echo $guardian['firstname']." ".$guardian['lastname'];                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Guardian Contact</p>
                            <p class="info-value"><?php
                                echo $guardian['contactno'];                 
                            ?></p>
                        </div>
                        <div style="height:50px; grid-column:span 2;">
                            <p class="info-label">View Student</p>
                            <button onclick="directorViewStudentProfile(<?php echo $studentid; ?>)" type="button" style="background-color:#8A3838; height:50px; width:200px; position:relative; top:30px; left:0px; color:white; border-radius:5px;">View Student</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $referralid=$session['referralid'];
                $record = mysqli_query($link,"SELECT * FROM referral WHERE id=$referralid");
                $referral = mysqli_fetch_array($record);
                if(isset($referral)){
            ?>
            <div class="update-history-show" style="grid-row:span 2;">
                <div class="student-info info-show-box  teacher-container" style="margin:0px;">
                    <div class="info-subgroup session-main-info" style="height:80px; margin-bottom:10px;">
                        
                        <p class="info-subgroup-label">&nbsp; Referral Details &nbsp;</p>
                        <div>
                            <p class="info-label">Date Sent</p>
                            <p class="info-value"><?php 
                                $datetimesent = new DateTime($referral['datetimesent']);
                                echo $datetimesent->format('D, M j, \'y, h:i A');                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Referrer</p>
                            <p class="info-value"><?php
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
                            ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-container" style="height:200px;">
                        <p class="info-subgroup-label">&nbsp; Reasons for Referral &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <div class="info-value info-show-text" style="height:180px; border: solid black 1px; margin:0px; padding-left:4px;"><?php 
                                $reasons = explode(",",$referral['reasons']);
                                $reasonStr = implode(", ",$reasons);
                                echo $reasonStr; ?>
                            </div>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info" style="height:170px;">
                        <p class="info-subgroup-label">&nbsp; Action Taken &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text"><?php
                                echo $referral['actiontaken'];
                            ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
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
        <div class="delete-modal-container" id="delete-modal-container">
            <div class="delete-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Confirmation</p>
                </div>
                <div class="question-container" style="font-size:22px; margin-top:20px;">
                    <p>Are you sure you want to Delete This Session?</p>
                </div>
                <div class="question-container" style="height:180px; margin-top:40px;">
                    <div class="buttons" style="display:flex; flex-direction:row-reverse;">
                        <button onclick="confirmDelete(<?php echo $id; ?>)" class="action-button" id="addSiblingToTable" style="width:100px; height:30px;">
                            <div class="action-button-label">
                                Delete
                            </div>
                            <div class="action-button-icon">
                                 <img src="imgs/new-delete.png">
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeDeleteModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/viewsession.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>