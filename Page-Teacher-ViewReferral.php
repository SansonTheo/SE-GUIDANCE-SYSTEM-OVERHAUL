<!DOCTYPE html>
<?php 
    include "server.php";
    include "authenticate.php";
    include "authenticateTeacherAbove.php";
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
                <li><a href="Page-Teacher-Home.php"><img src="imgs/icon-home.png">home</a></li>
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
                    <li onclick="teacherList();">Your Referrals</li>
                    <li>Contact Us</li>
                    <li onclick="logout();">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>View Referral</div>
        </div>
        <div class="center-container">
            <?php 
                $id=$_REQUEST['id'];
                $record = mysqli_query($link,"SELECT * FROM referral WHERE id=$id");
                $referral = mysqli_fetch_array($record);
            ?>
            <div class="info-show" style="grid-row: span 3;">
                <div class="student-info info-show-box">
                    <div class="student-picname">
                        <div class="student-namebuttons">
                            <div class="student-info-button-container" style="height:30px;">
                                <div class="student-info-button-container" style="height:30px;">
                                    <a style="visibility:hidden;"><img src="imgs/new-check.png" id="check-img"><div class="button-label" id="check">Mark as Finished</div></a>
                                    <a style="visibility:hidden;" href="Page-Counseling-EditSession.php?id=<?php echo $id; ?>" class="student-info-button"><img src="imgs/new-check.png" id="edit-img"><div class="button-label" id="edit" style="font-size:13px;">Mark Resolved</div></a>
                                    <a style="<?php if($referral['status'] == "Resolved"){ echo "visibility:hidden;"; } ?>" href="Page-Teacher-Resolve.php?id=<?php echo $id; ?>" class="student-info-button"><img src="imgs/new-check.png" id="delete-img"><div class="button-label" id="delete">Mark Resolved</div></a>
                                    <a href="#" class="student-info-button"><img src="imgs/new-print.png" id="print-img"><div class="button-label" id="print">Print Data</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-subgroup session-main-info" style="height:230px;">
                        <p class="info-subgroup-label">&nbsp; Session Details &nbsp;</p>
                        <?php
                            $studentid = $referral['studentid'];
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
                        <div>
                            <p class="info-label">Referrer Type</p>
                            <p class="info-value"><?php
                                echo $referrertype;                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Date and Time Sent</p>
                            <p class="info-value"><?php 
                                $datetimesent = new DateTime($referral['datetimesent']);
                                echo $datetimesent->format('D, M j, \'y, h:i A');                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Status</p>
                            <p class="info-value"><?php 
                                echo $referral['status'];                
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Marked resolved by</p>
                            <p class="info-value"><?php
                                if($referral['status'] == "Resolved"){
                                    $resolverid = $referral['resolvedby'];
                                    $resolvedsql = "SELECT * FROM user WHERE id='$resolverid'";
                                    $resolver = mysqli_fetch_array(mysqli_query($link,$resolvedsql));
                                    $type = $resolver['type'];
                                    $originalid = $resolver["referenceid"];
                                    if($type == "Teacher"){
                                        $resolversql = "SELECT * FROM teacher WHERE id='$originalid'";
                                    }
                                    else{
                                        $resolversql = "SELECT * FROM counselor WHERE id='$originalid'";
                                    }
                                    $thisresolver = mysqli_fetch_array(mysqli_query($link,$resolversql));
                                    echo $thisresolver["firstname"]." ".$thisresolver["lastname"];
                                }
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Date Resolved</p>
                            <p class="info-value"><?php 
                            if($referral['datetimeresolved'] != "0000-00-00 00:00:00"){
                                $datetimeresolved = new DateTime($referral['datetimeresolved']);
                                echo $datetimeresolved->format('D, M j, \'y, h:i A');         
                            }       
                            ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Problem History &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text"><?php
                                echo $referral['problemhistory'];
                            ?></div>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Action Taken &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text"><?php
                                echo $referral['actiontaken'];
                            ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="student-info-show">
                <div class="student-info info-show-box  student-container" style="margin:0px;">
                    <div class="info-subgroup student-container">
                        <p class="info-subgroup-label">&nbsp; Reasons for Referral &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <div class="info-value info-show-text" style="height:200px; border: solid black 1px; margin:0px; padding-left:4px;"><?php 
                                $reasons = explode(",",$referral['reasons']);
                                $reasonStr = implode(", ",$reasons);
                                echo $reasonStr; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="update-history-show">
                <div class="student-info info-show-box  teacher-container" style="margin:0px;height:515px;">
                    <div class="info-subgroup session-main-info" style="height:calc(100% - 20px);">
                        <p class="info-subgroup-label">&nbsp; Session Details &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Were the parents already contacted?</p>
                            <p class="info-value"><?php
                                echo $referral['contactedparents'];                 
                            ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Date of contacting Parents</p>
                            <p class="info-value"><?php
                                echo $referral['contactedparentsdate'];                 
                            ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Outcome of contacting Parents</p>
                            <div class="info-value info-show-text" style="top:30px; height:50px; border: solid black 1px; margin:0px; padding-left:4px;"><?php echo $referral['contactedparentsoutcome']; ?>
                            </div>
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
                            <p class="info-label">Father Name</p>
                            <p class="info-value"><?php
                                echo $father['firstname']." ".$father['lastname'];                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Father Contact</p>
                            <p class="info-value"><?php
                                echo $father['contactno'];                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Mother Name</p>
                            <p class="info-value"><?php
                                echo $mother['firstname']." ".$mother['lastname'];                 
                            ?></p>
                        </div>
                        <div>
                            <p class="info-label">Mother Contact</p>
                            <p class="info-value"><?php
                                echo $mother['contactno'];                 
                            ?></p>
                        </div>
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
                        <div style="visibility:hidden; height:50px; grid-column:span 2;">
                            <p class="info-label">View Student</p>
                            <button onclick="viewStudentProfile(<?php echo $studentid; ?>)" type="button" style="background-color:#8A3838; height:50px; width:200px; position:relative; top:30px; left:7px; color:white; border-radius:5px;">View Student</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="update-history-show" style="height:300px; visibility:hidden;">
                <div class="student-info info-show-box  parent-container" style="margin:0px;">
                    <div class="info-subgroup student-container">
                        <p class="info-subgroup-label">&nbsp; Past Referrals &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <div class="info-value info-show-text" style="height:84px; border: solid black 1px; margin:0px; padding-left:4px;"><?php 
                                echo $referral['referralhistory']; 
                            ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="update-history-show" style="height:120px;">
                <div class="student-info info-show-box  parent-container" style="margin:0px;">
                    <div class="info-subgroup student-container">
                        <p class="info-subgroup-label">&nbsp; Past Referrals &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <div class="info-value info-show-text" style="height:84px; border: solid black 1px; margin:0px; padding-left:4px;"><?php 
                                echo $referral['referralhistory']; 
                            ?></div>
                        </div>
                    </div>
                </div>
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