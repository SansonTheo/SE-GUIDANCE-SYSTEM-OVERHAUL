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
                <li><a href="javascript:toggleProfiling();"><img src="imgs/icon-student.png">Counselor Actions</a>
                    <ul class="profiling-ul">
                        <li><a href="Page-Counselor-ViewStudentList.php">Students Index</a></li>
                        <li><a href="Page-Counselor-Home.php">Referrals Index</a></li>
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
                    <li onclick="counselorList();">Your Referrals</li>
                    <li>Contact Us</li>
                    <li onclick="logout();">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>Resolve Referral</div>
        </div>
        <form name="session-form" id="session-form" onsubmit="return validateForm()" class="center-container" method="post" action="resolve.php">
        <?php 
                $id=$_REQUEST['id'];
                $record = mysqli_query($link,"SELECT * FROM referral WHERE id=$id");
                $referral = mysqli_fetch_array($record);
        ?>
            <div class="form-label">
                Mark Referral as Resolved
                <p class="form-label-subtext">Please Input Information Accurately</p>
                <p class="form-label-subtext">Fields marked with * are required</p>
            </div>
            <div class="subgroup-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Session Information</p>
                </div>
                <div class="question-container">
                    <p class="question-label-with-button">Student
                    </p>
                    <input class="hidden-input" type="text" name="student-id" id="counselor-id" value="<?php echo $referral['studentid']; ?>">
                    <input class="hidden-input" type="text" name="referral-id" id="referral-id" value="<?php echo $id; ?>">
                    <input class="hidden-input" type="text" name="currentlevel" id="currentlevel" value="<?php echo $referral['currentlevel']; ?>">
                    <input class="hidden-input" type="text" name="referralhistory" id="referralhistory" value="<?php echo $referral['referralhistory']; ?>">
                    <?php
                            $studentid = $referral['studentid'];
                            $studentRecordQuery = "SELECT * FROM student WHERE id=$studentid";
                            $studentRecordList = $link->query($studentRecordQuery);
                            $student = mysqli_fetch_array($studentRecordList);
                    ?>
                    <input type="text" name="student-name" id="counselor-name" placeholder="Student" readonly="readonly" style="pointer-events: none; background-color:whitesmoke;" value="<?php
                                echo $student["firstname"]." ".$student["lastname"];
                            ?>">
                    <input class="hidden-input" type="text" name="resolvedby" id="resolvedby" value="<?php echo $_SESSION['trueid']; ?>">
                </div>
                <!--
                <div class="question-container" style="height:auto;">
                    <p>What Problems have you been experiencing with this student?</p>
                    <div class="checkbox-container">
                        <?php
                            $arrayBlank = [
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                                "",
                            ];
                            $otherReason = "";
                            $arrayReason = explode(",",$referral['reasons']);
                            $numvar = count($arrayReason);
                            $arrayBase = [
                                "Tardiness",
                                "Deviant Behavior",
                                "Absenteeism",
                                "Academic Problems",
                                "Emotional Problems",
                                "Family Concerns",
                                "Aggressive Behavior",
                                "Bullying"
                            ];
                            for($i = 0; $i < count($arrayReason); $i++){
                                if($arrayReason[$i] == "Tardiness"){
                                    $arrayBlank[0] = "checked";
                                }
                                else if($arrayReason[$i] == "Deviant"){
                                    $arrayBlank[1] = "checked";
                                }
                                else if($arrayReason[$i] == "Absenteeism"){
                                    $arrayBlank[2] = "checked";
                                }
                                else if($arrayReason[$i] == "Academic Problems"){
                                    $arrayBlank[3] = "checked";
                                }
                                else if($arrayReason[$i] == "Emotional Problems"){
                                    $arrayBlank[4] = "checked";
                                }
                                else if($arrayReason[$i] == "Family Concerns"){
                                    $arrayBlank[5] = "checked";
                                }
                                else if($arrayReason[$i] == "Aggressive Behavior"){
                                    $arrayBlank[6] = "checked";
                                }
                                else if($arrayReason[$i] == "Bullying"){
                                    $arrayBlank[7] = "checked";
                                }
                                else if($arrayReason[$i] == "Bullying"){
                                    $arrayBlank[8] = "checked";
                                }
                                else{
                                    $otherReason = $arrayReason[$i].",";
                                }
                            }
                        ?>
                        <input type="checkbox" id="trait1" name="trait1" value="Tardiness" <?php echo $arrayBlank[0]; ?>><label for="vehicle1">Tardiness</label>
                        <input type="checkbox" id="trait2" name="trait2" value="Deviant Behavior" <?php echo $arrayBlank[1]; ?>><label for="vehicle1">Deviant Behavior</label>
                        <input type="checkbox" id="trait3" name="trait3" value="Absenteeism" <?php echo $arrayBlank[2]; ?>><label for="vehicle1">Absenteeism</label>
                        <input type="checkbox" id="trait4" name="trait4" value="Academic Problems" <?php echo $arrayBlank[3]; ?>><label for="vehicle1">Academic Problems</label>
                        <input type="checkbox" id="trait5" name="trait5" value="Emotional Problems" <?php echo $arrayBlank[4]; ?>><label for="vehicle1">Emotional Problems</label>
                        <input type="checkbox" id="trait6" name="trait6" value="Family Concerns" <?php echo $arrayBlank[5]; ?>><label for="vehicle1">Family Concerns</label>
                        <input type="checkbox" id="trait7" name="trait7" value="Aggressive Behavior" <?php echo $arrayBlank[6]; ?>><label for="vehicle1">Aggressive Behavior</label>
                        <input type="checkbox" id="trait8" name="trait8" value="Bullying" <?php echo $arrayBlank[7]; ?>><label for="vehicle1">Bullying</label>
                    </div>
                </div> -->
                <div class="question-container">
                    <p>Other Reasons</p>
                    <input style="pointer-events: none; background-color:whitesmoke;" readonly="readonly" type="text" name="trait10" id="trait10" placeholder="Specify Other Reasons" value="<?php 
                    $reasons = explode(",",$referral['reasons']);
                    $reasonStr = implode(", ",$reasons);
                    echo $reasonStr;
                ?>">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Problem History</p>
                    <textarea style="padding-left:10px; pointer-events: none; resize:none; height:300px; background-color:whitesmoke;" name="problemhistory" id="problemhistory" form="session-form" placeholder="Clarify Referral Problem / History. . ." readonly="readonly"><?php echo $referral['problemhistory']?></textarea>
                </div>
                <div class="question-container" style="height:300px;">
                    <p>What actions were taken to resolve this issue?</p>
                    <textarea style="resize:none; height:300px; padding-left:10px;" name="actiontaken" id="actiontaken" form="session-form" placeholder="Explain Actions Already Taken. . ."><?php echo $referral['actiontaken']?></textarea>
                </div>
                <div class="question-container">
                <?php
                    $value = [
                        "",
                        "",
                        "",
                        ""
                    ];
                    if($referral['contactedparents'] == "Yes"){
                        $value[0] = "selected";
                        $value[1] = "disabled";
                        $value[2] = "readonly='readonly'";
                        $value[3] = "background-color:whitesmoke";
                    }
                    else{
                        $value[1] = "selected";
                    }
                ?>
                    <p>Have you contacted the parents of the student previously?</p>
                    <select id="contactedparents" name="contactedparents">
                        <option value="Yes" <?php echo $value[0]; ?>>Yes</option>
                        <option value="No" <?php echo $value[1]; ?>>No</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>If yes, when have you contacted the parents?</p>
                    <input style="<?php echo $value[3] ?>" type="text" name="contactedparentsdate" id="contactedparentsdate" placeholder="Date Parents were Contacted" <?php echo $value[2]; ?> value="<?php echo $referral['contactedparentsdate']; ?>">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>What was the outcome when you contacted the parents?</p>
                    <textarea style="resize:none; height:300px;<?php echo $value[3] ?>" name="contactedparentsoutcome" id="contactedparentsoutcome" form="session-form" placeholder="Explain what the outcome with the parents was. . ."  <?php echo $value[2]; ?>><?php echo $referral['contactedparentsoutcome']; ?></textarea>
                </div>
            </div>
            <div class="subgroup-container buttons">
                <button type="submit" class="action-button" style="width:130px; height:40px;">
                    <div class="action-button-label">
                        Mark Resolved
                    </div>
                </button>
                <button onclick="counselorReturnToOwnReferral(<?php echo $id?>)" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
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
                                    <form id="searchForm" action="PageStudentProfiling-ViewList.php" method="post">
                                        <input type="text" id="search-student-name" name="search-student-name" placeholder="Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-department-name" name="search-department-name" placeholder="Department. . ." class="search" style="width:15%;" value="">
                                        <input form="searchForm" type="text" id="search-college-name" name="search-college-name" placeholder="College. . ." class="search" style="width:15%;" value=""> 
                                    </form>
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <span>
                                    <button form="searchForm" class="search-button" type="submit" name="search" style="width:15%; height:30px;">Search</button>
                                    <button form="searchForm" class="search-button" type="submit" name="clear" style="width:8%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                        <table class="generic-table">
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
                                </tr>
                                <?php
                                    $studentQuery = "SELECT * FROM student";
                                    $studentList = $link->query($studentQuery);
                                    if ($studentList->num_rows > 0) {
                                        while($student = mysqli_fetch_array($studentList)): ?>
                                <tr class="show" name="counselorentry" id="counselorEntryId<?php echo $student['id'] ?>">
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
                        <button id="addCounselorToTable" type="button" class="action-button" style="width:100px; height:30px;">
                            <div class="action-button-label">
                                Select
                            </div>
                            <div class="action-button-icon">
                                •
                            </div>
                        </button>
                        <button onclick="teacherList()" type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeCounselorModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div> <!--
        <div class="student-modal-container" id="student-modal-container">
            <div class="student-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Add Student
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
                                    <form id="searchForm" action="PageStudentProfiling-ViewList.php" method="post">
                                        <input type="text" id="search-student-name" name="search-student-name" placeholder="Student Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-department-name" name="search-department-name" placeholder="Department. . ." class="search" style="width:15%;" value="">
                                    </form>
                                </span>
                            </div>
                            <div>
                                <span>
                                    <input form="searchForm" type="text" id="search-level" name="search-level" placeholder="Level. . ." class="search" style="width:15%;" value="">
                                    <input form="searchForm" type="text" id="search-college-name" name="search-college-name" placeholder="College. . ." class="search" style="width:15%;" value=""> &nbsp;
                                    <button form="searchForm" class="search-button" type="submit" name="search" style="width:20%; height:30px;">Search</button>
                                    <button form="searchForm" class="search-button" type="submit" name="clear" style="width:20%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table class="generic-table">
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
                        <button id="addStudentToTable" type="button" class="action-button" style="width:80px; height:30px;">
                            <div class="action-button-label">
                                Add
                            </div>
                            <div class="action-button-icon">
                                +
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeStudentModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="teacher-modal-container" id="teacher-modal-container">
            <div class="teacher-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Add Teacher
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
                                    <form id="searchForm" action="PageStudentProfiling-ViewList.php" method="post">
                                        <input type="text" id="search-student-name" name="search-student-name" placeholder="Teacher Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-department-name" name="search-department-name" placeholder="Department. . ." class="search" style="width:15%;" value="">
                                        <input form="searchForm" type="text" id="search-college-name" name="search-college-name" placeholder="College. . ." class="search" style="width:15%;" value=""> 
                                    </form>
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <span>
                                    <button form="searchForm" class="search-button" type="submit" name="search" style="width:15%; height:30px;">Search</button>
                                    <button form="searchForm" class="search-button" type="submit" name="clear" style="width:8%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table class="generic-table">
                                <tr>
                                    <th class="teacher-add-id list-label">
                                        ID
                                    </th>
                                    <th class="teacher-add-name list-label">
                                        Name
                                    </th>
                                    <th class="teacher-add-department list-label">
                                        Department
                                    </th>
                                    <th class="teacher-add-college list-label">
                                        College
                                    </th>
                                    <?php
                                    $teacherQuery = "SELECT * FROM teacher";
                                    $teacherList = $link->query($teacherQuery);
                                    if ($teacherList->num_rows > 0) {
                                        while($teacher = mysqli_fetch_array($teacherList)): ?>
                                            <tr class="show" name="teacherentry" id="teacherEntryId<?php echo $teacher['id'] ?>">
                                                <td style="display:none;"><?php echo $teacher['id']?></td>
                                                <td style="teacher-add-id"><?php echo $teacher['facultyid']?></td>
                                                <td class="teacher-add-name"><?php echo $teacher['firstname']." ".$teacher['lastname']; ?></td>
                                                <td class="teacher-add-department"><?php echo $teacher['department']; ?></td>
                                                <td class="teacher-add-college"><?php echo $teacher['college']; ?></td>
                                            </tr>
                                <?php 
                                        endwhile;
                                    }
                                ?>
                                    <td class="teacher-add-id">
                                        BG201802094
                                    </td>
                                    <td class="teacher-add-name">
                                        Chadston Radstone
                                    </td>
                                    <td class="teacher-add-department">
                                        Computer Science
                                    </td>
                                    <td class="teacher-add-college">
                                        Institute of Computer Studies
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <button id="addTeacherToTable" type="button" class="action-button" style="width:80px; height:30px;">
                            <div class="action-button-label">
                                Add
                            </div>
                            <div class="action-button-icon">
                                +
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeTeacherModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="parent-modal-container" id="parent-modal-container">
            <div class="parent-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label" style="margin:0px;">
                        Add Parent
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
                                    <form id="searchForm" action="PageStudentProfiling-ViewList.php" method="post">
                                        <input type="text" id="search-student-name" name="search-student-name" placeholder="Student Name. . ." class="search" style="width:15%;" value="">
                                        <input type="text" id="search-parent-name" name="search-college-name" placeholder="Parent Name. . ." class="search" style="width:15%;" value=""> 
                                    </form>
                                </span>
                            </div>
                            <div style="margin-top:10px;">
                                <span>
                                    <button form="searchForm" class="search-button" type="submit" name="search" style="width:15%; height:30px;">Search</button>
                                    <button form="searchForm" class="search-button" type="submit" name="clear" style="width:8%; height:30px;">Clear</button>
                                </span>
                            </div>
                        </div>
                        <div class="table-container" style="height:70%;">
                            <table class="generic-table">
                                <tr>
                                    <th class="parent-add-name list-label">
                                        Name
                                    </th>
                                    <th class="parent-add-relation list-label">
                                        Relation/s
                                    </th>
                                </tr>
                                <?php
                                    $parentQuery = "SELECT * FROM parent";
                                    $parentList = $link->query($parentQuery);
                                    if ($parentList->num_rows > 0) {
                                        while($parent = mysqli_fetch_array($parentList)): ?>
                                            <tr class="show" name="parententry" id="parentEntryId<?php echo $parent['id'] ?>">
                                                <td style="display:none;"><?php echo $parent['id']; ?></td>
                                                <td class="parent-add-name"><?php echo $parent['firstname']." ".$parent['lastname']; ?></td>
                                                <td style="display:none;"><?php echo $parent['contactno']; ?></td>
                                                <?php
                                                        $parentId = $parent['id'];
                                                        $childRecordQuery = "SELECT * FROM parentrecord WHERE parentid=$parentId";
                                                        $childRecordList =  $link->query($childRecordQuery);
                                                        if ($childRecordList->num_rows > 0) {
                                                ?>
                                                <td class="parent-add-relation"><?php while($childRecord = mysqli_fetch_array($childRecordList)):$currentStudentId = $childRecord['studentid'];$childQuery = "SELECT * FROM student WHERE id=$currentStudentId";$childList = $link->query($childQuery);while($child = mysqli_fetch_array($childList)):$childname = $child['firstname']." ".$child['middlename']." ".$child['lastname'];echo $childname."<br>";endwhile;endwhile; ?></td>
                                                <?php
                                                        }
                                                ?>
                                            </tr>
                                <?php 
                                        endwhile;
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <button id="addParentToTable" type="button" class="action-button" style="width:80px; height:30px;">
                            <div class="action-button-label">
                                Add
                            </div>
                            <div class="action-button-icon">
                                +
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeParentModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
        <script src="js/referral-form.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>