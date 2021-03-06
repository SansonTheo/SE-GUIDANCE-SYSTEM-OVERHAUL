<!DOCTYPE html>
<?php 
    include "server.php";
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
                    PIC
                </div>
                Username
            </div>
            <div class="user-div">
                <ul>
                    <li>Profile</li>
                    <li>Sessions</li>
                    <li>Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>WMSU Guidance</div>
        </div>
        <form name="session-form" id="session-form" onsubmit="return validateForm()" class="center-container" method="post" action="counselingEdit.php">
            <?php 
                $id=$_REQUEST['id'];
                $record = mysqli_query($link,"SELECT * FROM session WHERE id=$id");
                $session=mysqli_fetch_array($record);
                $sessionid = $session['id'];
            ?>
            <div class="form-label">
                Edit Session
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
                                ???
                            </div>
                        </button>
                    </p>
                    <input class="hidden-input" type="text" name="session-id" id="session-id" value="<?php echo $sessionid; ?>">
                    <?php
                        $counselorId = $session['counselorid'];
                        $counselorQuery = "SELECT * FROM counselor WHERE id=$counselorId";
                        $counselorList = $link->query($counselorQuery);
                        $counselorEdit = mysqli_fetch_array($counselorList);
                        $counselorName = $counselorEdit['firstname']." ".$counselorEdit['lastname'];
                    ?>
                    <input class="hidden-input" type="text" name="counselor-id" id="counselor-id" value="<?php echo $counselorId; ?>">
                    <input type="text" name="counselor-name" id="counselor-name" placeholder="Counselor" readonly="readonly" style="pointer-events: none;" value="<?php echo $counselorName; ?>">
                </div>
                <div class="question-container">
                    <p>Time start *
                        <span style="font-size:12px;">
                            Office Hours are from 7AM to 5PM
                        </span>
                    </p>
                    <input type="time" name="sessionTimeStart" id="sessionTimeStart" min="07:00" max="17:00" onchange="timeCheck(timeStart)" value="<?php echo $session['time']; ?>">
                </div>
                <div class="question-container">
                    <p>Time end</p>
                    <input type="time" name="sessionTimeEnd" id="sessionTimeEnd" min="07:00" max="17:00" onchange="timeCheck(timeEnd); chronologyCheck();" value="<?php if($session['endtime']!="00:00:00"){ echo $session['endtime']; } ?>">
                </div>
                <div class="question-container">
                    <p>Date *</p>
                    <input type="date" name="sessionDate" id="sessionDate" value="<?php echo $session['date'] ?>">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Additional Info</p>
                    <textarea style="resize:none; height:300px;" name="sessionInfo" id="sessionInfo" form="session-form" placeholder="Issue Description. . ."><?php echo $session['sessiondesc'] ?></textarea>
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Course of Action</p>
                    <textarea style="resize:none; height:300px;" name="courseOfAction" id="courseOfAction" form="session-form" placeholder="Course of Action. . ."><?php echo $session['action'] ?></textarea>
                </div>
            </div>
            <div class="subgroup-container list-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Students</p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <p class="question-label-with-button">Students Involved *
                        <button type="button" class="action-button add-button" style="width:110px; height:30px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addStudent">
                                Add Student
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                +
                            </div>
                        </button>
                    </p>
                    <p style="font-size:12px;">At least 1 (Students marked in Red will be deleted)</p>
                    <div class="table-container">
                        <input type="text" class="hidden-input" id="studentCount" name="studentCount" value="<?php 
                            $studentCount = mysqli_num_rows($link->query("SELECT * FROM sessionrecord WHERE type='Student' AND sessionid=$id")) - 1;
                            echo $studentCount; 
                        ?>">
                        <input type="text" class="hidden-input" id="originalStudentCount" name="originalStudentCount" value="<?php 
                            echo $studentCount;
                        ?>">
                        <table class="generic-table student-table">
                            <tr>
                                <th class="student-name table-label">
                                    Name
                                </th>
                                <th class="student-department table-label">
                                    Department
                                </th>
                                <th class="student-remove table-label">
                                </th>
                            </tr>
                            <?php
                            $studentRecordQuery = "SELECT * FROM sessionrecord WHERE type='Student' AND sessionid=$id";
                            $studentRecordList = $link->query($studentRecordQuery);
                            if($studentCount > -1){
                                $i = 0; 
                                while($studentRecord = mysqli_fetch_array($studentRecordList)):
                                    $currentStudentId = $studentRecord['involvedid'];
                                    $studentQuery = "SELECT * FROM student WHERE id=$currentStudentId";
                                    $student = mysqli_fetch_array($link->query($studentQuery));
                            ?>
                            <tr id="tr-student-edit<?php echo $i; ?>">
                                <td class="student-name" id="student-edit-name<?php echo $i ?>">
                                    <input type="text" class="hidden-input" id="studentWillDelete<?php echo $i; ?>" name="studentWillDelete<?php echo $i; ?>" value="no">
                                    <?php echo $student['firstname']." ".$student['lastname'] ?>
                                </td>
                                <td class="student-department" id="student-edit-relation<?php echo $i ?>">
                                    <?php echo $student['department']; ?>
                                </td>
                                <td class="student-remove" class="student-edit" id="student-edit<?php echo $i; ?>" name="<?php echo $i; ?>">
                                    <input type="text" class="hidden-input" name="studentId<?php echo $i ?>" id="studentId<?php echo $i ?>" value="<?php echo $student['id']; ?>"> <!-- NEW -->
                                    <button type="button" style="font-weight:700;">Delete</button>
                                </td>
                            </tr>
                            <?php           $i++;
                                    endwhile;
                                }
                        ?>
                        <!--
                            <tr>
                                <td class="student-name">
                                    Theo Sanson
                                </td>
                                <td class="student-department">
                                    Computer Science
                                </td>
                                <td class="student-remove">
                                    <button class="remove-button" type="button">
                                        X
                                    </button>
                                </td>
                            </tr>
                        -->
                        <tr style="display:none;" id="student-null">
                        </tr>
                        </table>
                        <div style="display:none;" id="student-post-null"></div>
                    </div>
                </div>
            </div>
            <div class="subgroup-container list-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Teachers</p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <p class="question-label-with-button">Teachers Involved
                        <button type="button" class="action-button add-button" style="width:110px; height:30px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addTeacher">
                                Add Teacher
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                +
                            </div>
                        </button>
                    </p>
                    <div class="table-container">
                        <input type="text" class="hidden-input" id="teacherCount" name="teacherCount" value="<?php 
                            $teacherCount = mysqli_num_rows($link->query("SELECT * FROM sessionrecord WHERE type='Teacher' AND sessionid=$id")) - 1;
                            echo $teacherCount; 
                        ?>">
                        <input type="text" class="hidden-input" id="originalTeacherCount" name="originalTeacherCount" value="<?php 
                            echo $teacherCount;
                        ?>">
                        <table class="generic-table teacher-table">
                            <tr>
                                <th class="teacher-name table-label">
                                    Name
                                </th>
                                <th class="teacher-department table-label">
                                    Department
                                </th>
                                <th class="teacher-remove table-label">
                                </th>
                            </tr>
                        <?php
                            $teacherRecordQuery = "SELECT * FROM sessionrecord WHERE type='Teacher' AND sessionid=$id";
                            $teacherRecordList = $link->query($teacherRecordQuery);
                            if($teacherCount > -1){
                                $i = 0; 
                                while($teacherRecord = mysqli_fetch_array($teacherRecordList)):
                                    $currentTeacherId = $teacherRecord['involvedid'];
                                    $teacherQuery = "SELECT * FROM teacher WHERE id=$currentTeacherId";
                                    $teacher = mysqli_fetch_array($link->query($teacherQuery));
                            ?>
                            <tr id="tr-teacher-edit<?php echo $i; ?>">
                                <td class="teacher-name" id="teacher-edit-name<?php echo $i ?>">
                                    <input type="text" class="hidden-input" id="teacherWillDelete<?php echo $i; ?>" name="teacherWillDelete<?php echo $i; ?>" value="no">
                                    <?php echo $teacher['firstname']." ".$teacher['lastname'] ?>
                                </td>
                                <td class="teacher-department" id="teacher-edit-relation<?php echo $i ?>">
                                    <?php echo $teacher['department']; ?>
                                </td>
                                <td class="teacher-remove" class="teacher-edit" id="teacher-edit<?php echo $i; ?>" name="<?php echo $i; ?>">
                                    <input type="text" class="hidden-input" name="teacherId<?php echo $i ?>" id="teacherId<?php echo $i ?>" value="<?php echo $teacher['id']; ?>"> <!-- NEW -->
                                    <button type="button" style="font-weight:700;">Delete</button>
                                </td>
                            </tr>
                            <?php           $i++;
                                    endwhile;
                                }
                        ?>
                            <!--
                            <tr>
                                <td class="teacher-name">
                                    Chadston Radstone
                                </td>
                                <td class="teacher-department">
                                    Information Technology
                                </td>
                                <td class="teacher-remove">
                                    <button class="remove-button" type="button">
                                        X
                                    </button>
                                </td>
                            </tr>
                            -->
                            <tr style="display:none;" id="teacher-null">
                            </tr>
                        </table>
                        <div style="display:none;" id="teacher-post-null"></div>
                    </div>
                </div>
            </div>
            <div class="subgroup-container list-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Parents</p>
                </div>
                <div class="question-container" style="height: calc(100% - 35px);">
                    <p class="question-label-with-button">Parents Involved
                        <button type="button" class="action-button add-button" style="width:110px; height:30px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addParent">
                                Add Parent
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                +
                            </div>
                        </button>
                    </p>
                    <div class="table-container">
                        <input type="text" class="hidden-input" id="parentCount" name="parentCount" value="<?php 
                            $parentCount = mysqli_num_rows($link->query("SELECT * FROM sessionrecord WHERE type='Parent' AND sessionid=$id")) - 1;
                            echo $parentCount; 
                        ?>">
                        <input type="text" class="hidden-input" id="originalParentCount" name="originalParentCount" value="<?php 
                            echo $parentCount;
                        ?>">
                        <table class="generic-table parent-table">
                            <tr>
                                <th class="parent-name table-label">
                                    Name
                                </th>
                                <th class="parent-contact table-label">
                                    Contact
                                </th>
                                <th class="parent-remove table-label">
                                </th>
                            </tr>
                        <?php
                            $parentRecordQuery = "SELECT * FROM sessionrecord WHERE type='Parent' AND sessionid=$id";
                            $parentRecordList = $link->query($parentRecordQuery);
                            if($parentCount > -1){
                                $i = 0; 
                                while($parentRecord = mysqli_fetch_array($parentRecordList)):
                                    $currentParentId = $parentRecord['involvedid'];
                                    $parentQuery = "SELECT * FROM parent WHERE id=$currentParentId";
                                    $parent = mysqli_fetch_array($link->query($parentQuery));
                            ?>
                            <tr id="tr-parent-edit<?php echo $i; ?>">
                                <td class="parent-name" id="parent-edit-name<?php echo $i ?>">
                                    <input type="text" class="hidden-input" id="parentWillDelete<?php echo $i; ?>" name="parentWillDelete<?php echo $i; ?>" value="no">
                                    <?php echo $parent['firstname']." ".$parent['lastname'] ?>
                                </td>
                                <td class="parent-contact" id="parent-edit-relation<?php echo $i ?>">
                                    <?php echo $parent['contactno']; ?>
                                </td>
                                <td class="parent-remove" class="parent-edit" id="parent-edit<?php echo $i; ?>" name="<?php echo $i; ?>">
                                    <input type="text" class="hidden-input" name="parentId<?php echo $i ?>" id="parentId<?php echo $i ?>" value="<?php echo $parent['id']; ?>"> <!-- NEW -->
                                    <button type="button" style="font-weight:700;">Delete</button>
                                </td>
                            </tr>
                            <?php           $i++;
                                    endwhile;
                                }
                        ?>
                            <!--
                            <tr>
                                <td class="parent-name">
                                    Eduardo F. Sanson
                                </td>
                                <td class="parent-department">
                                    09777777777
                                </td>
                                <td class="parent-remove">
                                    <button class="remove-button" type="button">
                                        X
                                    </button>
                                </td>
                            </tr> -->
                            <tr style="display:none;" id="parent-null">
                            </tr>
                        </table>
                        <div style="display:none;" id="parent-post-null"></div>
                    </div>
                </div>
            </div>
            <div class="subgroup-container buttons">
                <button type="submit" class="action-button" style="width:100px; height:40px;">
                    <div class="action-button-label">
                        Edit
                    </div>
                    <div class="action-button-icon">
                        +
                    </div>
                </button>
                <button onclick="cancel(<?php echo $sessionid; ?>)" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
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
                                ???
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
                                <!-- <tr>
                                    <td class="student-id">
                                        BG201802094
                                    </td>
                                    <td class="student-name">
                                        Theo Sanson
                                    </td>
                                    <td class="student-department">
                                        Computer Science
                                    </td>
                                    <td class="student-level">
                                        3
                                    </td>
                                </tr> -->
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
                                <!--
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
                                    -->
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
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
        <script src="js/edit-session-form.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>