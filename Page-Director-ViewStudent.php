<!DOCTYPE html>
<?php 
    include "server.php";
    include "authenticate.php";
    include "authenticateCoordinatorAbove.php";
?>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/studentviewstudent.css">
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
            <div>View Student</div>
        </div>
        <div class="center-container">
            <?php 
                $id=$_REQUEST['id'];
                $record = mysqli_query($link,"SELECT * FROM student WHERE id=$id");
                $student=mysqli_fetch_array($record);
                if(isset($student)){
            ?>
            <div class="info-show">
                <div class="student-info info-show-box">
                    <div class="student-picname">
                        <div class="student-info-pic" style="visibility:hidden; background-color:rgb(136, 136, 136);">
                        </div>
                        <div class="student-namebuttons">
                            <div class="student-info-button-container">
                                <div class="student-info-button-container">
                                    <a style="visibility:hidden;" href="Page-Profiling-EditStudent.php?id=<?php echo $id ?>" class="student-info-button"><img src="imgs/new-edit.png" id="edit-img"><div class="button-label" id="edit">Edit Student</div></a>
                                    <a style="visibility:hidden;" onclick="validateDelete()" class="student-info-button"><img src="imgs/new-delete.png" id="delete-img"><div class="button-label" id="delete">Delete Data</div></a>
                                    <a class="student-info-button"><img src="imgs/new-print.png" id="print-img"><div class="button-label" id="print">Print Data</div></a>
                                </div>
                            </div>
                            <div class="student-info-name">
                                <p class="info-label">Fullname</p>
                                <p class="info-value" style="font-size: 20px;"><?php echo $student['firstname']." ".$student['middlename']." ".$student['lastname']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="info-subgroup  student-biographic-info">
                        <p class="info-subgroup-label">&nbsp; Biographics &nbsp;</p>
                        <div>
                            <p class="info-label">Birthdate</p>
                            <p class="info-value"><?php echo $student['birthdate']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Age</p>
                            <p class="info-value"><?php
                                            $bday = new DateTime($student['birthdate']);
                                            $today = new DateTime(date('m.d.y'));
                                            $diff = $today->diff($bday); 
                                            echo ($diff->y);
                                        ?></p>
                        </div>
                        <div>
                            <p class="info-label">Sex</p>
                            <p class="info-value"><?php echo $student['sex']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Contact No</p>
                            <p class="info-value"><?php echo $student['contactno']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Permanent Address</p>
                            <p class="info-value"><?php echo $student['permstreet'].", ".$student['permbarangay'].", ".$student['permprovince'].", ".$student['permcity']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Temporary Address</p>
                            <p class="info-value"><?php echo $student['tempstreet'].", ".$student['tempbarangay'].", ".$student['tempprovince'].", ".$student['tempcity']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Place Of Birth</p>
                            <p class="info-value"><?php echo $student['placeofbirth']; ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Educational &nbsp;</p>
                        <div>
                            <p class="info-label">Student-ID</p>
                            <p class="info-value"><?php echo $student['studentid']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Level</p>
                            <p class="info-value"><?php echo $student['level']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Department</p>
                            <p class="info-value"><?php echo $student['department']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">College</p>
                            <p class="info-value"><?php echo $student['college']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Course</p>
                            <p class="info-value"><?php echo $student['course']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Attended Schools</p>
                            <p class="info-value"><?php echo $student['attendedschools']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">HS Subjects Liked</p>
                            <p class="info-value"><?php echo $student['hsliked']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">HS Subjects Disliked</p>
                            <p class="info-value"><?php echo $student['hsdisliked']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">HS Average</p>
                            <p class="info-value"><?php echo $student['hsaverage']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Class Rank</p>
                            <p class="info-value"><?php echo $student['classrank']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Previous Course</p>
                            <p class="info-value"><?php echo $student['previouscourse']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Shifting Reason</p>
                            <p class="info-value"><?php echo $student['shiftingreason']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Current Vocational Plans</p>
                            <p class="info-value"><?php echo $student['presentplans']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">How student chose this plan</p>
                            <p class="info-value"><?php echo $student['choicereason']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Reason how student came to this school</p>
                            <p class="info-value"><?php echo $student['schoolchoicereason']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Amount of Knowledge student has about their chosen course</p>
                            <p class="info-value"><?php echo $student['requirementknowledge']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Source of Knowledge student has about their chosen course</p>
                            <p class="info-value"><?php echo $student['requirementknowledgesource']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Student Financial Support Source</p>
                            <p class="info-value"><?php echo $student['financialsupport']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Scholastic Standing</p>
                            <p class="info-value"><?php echo $student['scholasticstanding']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">On Campus Organizations</p>
                            <p class="info-value"><?php echo $student['campusorganization']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Off Campus Organizations</p>
                            <p class="info-value"><?php echo $student['offcampusorganization']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Awards Received</p>
                            <p class="info-value"><?php echo $student['awards']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Organizations</p>
                            <p class="info-value"><?php echo $student['organization']; ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-personal-info">
                        <p class="info-subgroup-label">&nbsp; Personal &nbsp;</p>
                        <div>
                            <p class="info-label">Height</p>
                            <p class="info-value"><?php echo $student['height']."cm"; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Weight</p>
                            <p class="info-value"><?php echo $student['weight']."kg"; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Gender</p>
                            <p class="info-value"><?php echo $student['gender']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Complexion</p>
                            <p class="info-value"><?php echo $student['complexion']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Ethnicity</p>
                            <p class="info-value"><?php echo $student['ethnicity']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Religion</p>
                            <p class="info-value"><?php echo $student['religion']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Civil Status</p>
                            <p class="info-value"><?php echo $student['civilstatus']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Physically Identifiable Marks</p>
                            <p class="info-value"><?php echo $student['physicalmarks']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Physical Programs Participated</p>
                            <p class="info-value"><?php echo $student['physicalprograms']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Physical Ailments</p>
                            <p class="info-value"><?php echo $student['physicalailments']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Hobbies & Interests</p>
                            <p class="info-value"><?php echo $student['hobby']; ?></p>
                        </div>
                        <?php
                            $traitStr = "";
                            if($student['traits'] != ""){
                                $arrayTrait = explode(",",$student['traits']);
                                $traitCount = count($arrayTrait);
                                $arrayName = [
                                    'Friendly',
                                    'Unhappy',
                                    'Cheerful',
                                    'Reserved',
                                    'Pessimistic',
                                    'Lazy',
                                    'Stubborn',
                                    'Shy',
                                    'Submissive',
                                    'Capable',
                                    'Self-confident',
                                    'Excitable',
                                    'Tolerant',
                                    'Jealous',
                                    'Irritable',
                                    'Calm',
                                    'Talented',
                                    'Poor Health',
                                    'Anxious',
                                    'Quick-tempered',
                                    'Frequently Daydreaming',
                                    'Depressed',
                                    'Cynical',
                                    'Tactful',
                                    'Lovable',
                                    'Easily Exhausted',
                                    'Conscientious',
                                    'Aloof',
                                    'Quiet',
                                    'Talkative'
                                ];
                                $trait = $arrayTrait;
                                for($j = 0; $j < $traitCount; $j++){
                                    $tempNum = $arrayTrait[$j] - 1;
                                    $traitStr = $traitStr.$arrayName[$tempNum].", ";
                                }
                            }
                        ?>
                        <div>
                            <p class="info-label">Traits</p>
                            <p class="info-value"><?php echo $traitStr; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Significant Life Events</p>
                            <p class="info-value"><?php echo $student['significantevent']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Events causing Humiliation</p>
                            <p class="info-value"><?php echo $student['humiliation']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Was student previously counseled?</p>
                            <p class="info-value"><?php echo $student['previouscounseling']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Previous Counseling Date</p>
                            <p class="info-value"><?php echo $student['previouscounselingdate']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Previous Counselor</p>
                            <p class="info-value"><?php echo $student['previouscounselingcounselor']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">Areas in Life with Problems</p>
                            <p class="info-value"><?php echo $student['lifeproblems']; ?></p>
                        </div>
                        <div style="grid-column:span 2;">
                            <p class="info-label">People Connected in University</p>
                            <p class="info-value"><?php echo $student['connectedperson']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="update-history-show">
                <div class="student-info info-show-box  update-container" style="margin:0px;">
                    <div class="info-subgroup update-container">
                        <p class="info-subgroup-label">&nbsp; Update History &nbsp;</p>
                        <div class="list-container">
                            <?php
                                $updateRecordQuery = "SELECT * FROM changerecord WHERE studentid=$id";
                                $updateRecordList = $link->query($updateRecordQuery);
                                if ($updateRecordList->num_rows > 0){
                                    while($updateRecord = mysqli_fetch_array($updateRecordList)):
                            ?>
                            <div class="update-info">
                                <p><?php echo $updateRecord['changestr'] ?></p>
                                <p><?php echo $updateRecord['datechanged'] ?></p>
                                <!-- Add <p> for user who changed it -->
                            </div>
                            <?php
                                    endwhile;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="family-relation-show">
                <?php
                    $parentRecordQuery = "SELECT * FROM parentrecord WHERE studentid=$id";
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
                <div class="student-info info-show-box" style="margin:0px;">
                    <div class="info-subgroup family-info">
                        <p class="info-subgroup-label">&nbsp; Father &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Fullname</p>
                            <p class="info-value"><?php echo $father['firstname']." ".$father['middlename']." ".$father['lastname']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Contact Number</p>
                            <p class="info-value"><?php echo $father['contactno']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Address</p>
                            <p class="info-value"><?php echo $father['street'].", ".$father['barangay'].", ".$father['city'].", ".$father['province']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Occupation</p>
                            <p class="info-value"><?php echo $father['occupation']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Employer</p>
                            <p class="info-value"><?php echo $father['employer']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Highest Degree Attained</p>
                            <p class="info-value"><?php echo $father['highestdegree']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Schools Attended</p>
                            <p class="info-value"><?php echo $father['attendedschools']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Hobbies & Interests</p>
                            <p class="info-value"><?php echo $father['hobby']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Religion</p>
                            <p class="info-value"><?php echo $father['religion']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Nationality</p>
                            <p class="info-value"><?php echo $father['nationality']; ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup family-info">
                        <p class="info-subgroup-label">&nbsp; Mother &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Fullname</p>
                            <p class="info-value"><?php echo $mother['firstname']." ".$mother['middlename']." ".$mother['lastname']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Contact Number</p>
                            <p class="info-value"><?php echo $mother['contactno']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Address</p>
                            <p class="info-value"><?php echo $mother['street'].", ".$mother['barangay'].", ".$mother['city'].", ".$mother['province']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Occupation</p>
                            <p class="info-value"><?php echo $mother['occupation']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Employer</p>
                            <p class="info-value"><?php echo $mother['employer']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Highest Degree Attained</p>
                            <p class="info-value"><?php echo $mother['highestdegree']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Schools Attended</p>
                            <p class="info-value"><?php echo $mother['attendedschools']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Hobbies & Interests</p>
                            <p class="info-value"><?php echo $mother['hobby']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Religion</p>
                            <p class="info-value"><?php echo $mother['religion']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Nationality</p>
                            <p class="info-value"><?php echo $mother['nationality']; ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup family-info" style="height:320px;">
                        <p class="info-subgroup-label">&nbsp; Family Information &nbsp;</p>
                        <div style="grid-column: span 2; height:20px;">
                            <p class="info-label">Desired parental traits</p>
                            <p class="info-value"><?php echo $student['parenttraits']; ?></p>
                        </div>
                        <div style="height:20px;">
                            <p class="info-label">Preferred parent to talk to</p>
                            <p class="info-value"><?php echo $student['preferredparent']; ?></p>
                        </div>
                        <div style="height:20px;">
                            <p class="info-label" style="white-space:nowrap;">Parent Marital Status</p>
                            <p class="info-value"><?php echo $student['parentmaritalstatus']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Student's Children</p>
                                <div class="info-value info-show-text" style="height:60px; border: solid black 1px;"><?php echo $student['children']; ?>
                                </div>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Student's Siblings</p>
                                <div class="info-value info-show-text" style="height:60px; border: solid black 1px; margin:0px;"><?php echo $student['siblings']; ?>
                                </div>
                        </div>
                    </div>
                    <div class="info-subgroup family-info" style="height:290px;">
                        <p class="info-subgroup-label">&nbsp; Guardian &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Fullname</p>
                            <p class="info-value"><?php echo $guardian['firstname']." ".$guardian['middlename']." ".$guardian['lastname']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Address</p>
                            <p class="info-value"><?php echo $guardian['street'].", ".$guardian['barangay'].", ".$guardian['city'].", ".$guardian['province']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Occupation</p>
                            <p class="info-value"><?php echo $guardian['occupation']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Contact Number</p>
                            <p class="info-value"><?php echo $guardian['contactno']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Relation</p>
                            <p class="info-value"><?php echo $guardian['relationship']; ?></p>
                        </div>
                    </div>
                    <div class="info-subgroup family-info" style="height:330px;">
                        <p class="info-subgroup-label">&nbsp; Home Information &nbsp;</p>
                        <div>
                            <p class="info-label">Current Residence</p>
                            <p class="info-value"><?php echo $student['currentresidence']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Persons living with student</p>
                            <p class="info-value"><?php echo $student['currentresidencenumber']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">Persons sharing room w/ student</p>
                            <p class="info-value"><?php echo $student['shareroomnumber']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">Languages spoken at home</p>
                            <p class="info-value"><?php echo $student['homelanguage']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">No. of family at home</p>
                            <p class="info-value"><?php echo $student['familyathome']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">No. of extended family at home</p>
                            <p class="info-value"><?php echo $student['relativesathome']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">No. of children at home</p>
                            <p class="info-value"><?php echo $student['childrenathome']; ?></p>
                        </div>
                        <div>
                            <p class="info-label" style="white-space:nowrap;">No. of helpers at home</p>
                            <p class="info-value"><?php echo $student['childrenathome']; ?></p>
                        </div>
                    </div>
                    <?php if($student['civilstatus']=="Married"){
                        $spouseQuery = "SELECT * FROM spouse WHERE spouseid=$id";
                        $spouse = mysqli_fetch_array($link->query($spouseQuery));
                    ?>
                    <div class="info-subgroup family-info">
                        <p class="info-subgroup-label">&nbsp; Spouse &nbsp;</p>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Fullname</p>
                            <p class="info-value"><?php echo $spouse['firstname']." ".$spouse['middlename']." ".$spouse['lastname']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Address</p>
                            <p class="info-value"><?php echo $spouse['street'].", ".$spouse['barangay'].", ".$spouse['city'].", ".$spouse['province']; ?></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Occupation</p>
                            <p class="info-value"><?php echo $spouse['occupation']; ?></p>
                        </div>
                        <div>
                            <p class="info-label">Contact Number</p>
                            <p class="info-value"><?php echo $spouse['contactno']; ?></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="info-subgroup sibling-info">
                        <p class="info-subgroup-label">&nbsp; Siblings &nbsp;</p>
                        <div class="sibling-table-container">
                            <table class="sibling-table">
                                <tr>
                                    <td class="sibling-name sibling-label">
                                        Name
                                    </td>
                                    <td class="sibling-relationship sibling-label">
                                        Relation
                                    </td>
                                </tr>
                                <?php
                                    $siblingRecordQuery = "SELECT * FROM siblingrecord WHERE studentid=$id";
                                    $siblingRecordList = $link->query($siblingRecordQuery);
                                    if ($siblingRecordList->num_rows > 0) {
                                        while($siblingRecord = mysqli_fetch_array($siblingRecordList)):
                                            $currentSiblingId = $siblingRecord['siblingid'];
                                            $siblingQuery = "SELECT * FROM sibling WHERE id=$currentSiblingId";
                                            $siblingList = $link->query($siblingQuery);
                                            $siblingRow = mysqli_fetch_array($siblingList);
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $siblingRow['firstname']." ".$siblingRow['middlename']." ".$siblingRow['lastname'];?>
                                        </td>
                                        <td>
                                            <?php echo $siblingRow['relationship']; ?>
                                        </td>
                                    </tr>
                                <?php 	    
                                        endwhile;
                                    }
                                ?>
                                 <tr>
                                    <td>
                                        Kenneth Rule
                                    </td>
                                    <td>
                                        Brother
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    -->
                </div>
            </div>
                <?php } 
                else{
                ?>
            <div class="info-show">
                <div class="student-info info-show-box" style="height:180px;">
                    <div class="student-picname">
                        <div class="student-namebuttons" >
                            <div class="student-info-button-container">
                                <div class="student-info-button-container">
                                    <a href="Page-Student-EditStudent.php?id=<?php echo $id ?>" class="student-info-button" style="visibility:hidden;"></a>
                                    <a onclick="validateDelete()" class="student-info-button" style="visibility:hidden;"></a>
                                    <a href="Page-Student-Add.php" class="student-info-button"><img src="imgs/new-add.png" id="print-img"><div class="button-label" id="print">Add Student Data</div></a>
                                </div>
                            </div>
                            <div class="student-info-name" >
                                <p class="info-label" style="top:15px; font-size:20px; color:black;">We have detected that you are a new student. Click The button on the upper right to add your Personal Data Sheet.</p>
                            </div>
                        </div>
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
                    <p>Are you sure you want to Delete This Student?</p>
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
        <script src="js/main.js"></script>
        <script src="js/viewsession.js"></script>
    </body>
</html>