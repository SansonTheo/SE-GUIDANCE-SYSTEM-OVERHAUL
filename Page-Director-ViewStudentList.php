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
        <link rel="stylesheet" type="text/css" href="css/viewstudentlist.css">
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
            <div>View Student List</div>
        </div>
        <div style="width: calc(85%); margin-left:10%; height:100%; display:flex; min-width:600px;">
            <div style="height:100%; flex:60%;">
                <div class="student-window">
                    <div class="sort-buttons" style="width:100%; height:120px;">
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
                    <div class="list-window">
                        <table id="student-table" class="list-table tableFixHead">
                            <thead>
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
                                    <th class="student-college list-label">
                                        College
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $studentQuery = "SELECT * FROM student";
                                    $studentList = $link->query($studentQuery);
                                    if ($studentList->num_rows > 0) {
                                        while($student = mysqli_fetch_array($studentList)): ?>
                                <tr name="entry" class="show">
                                    <td style="display:none;"><?php echo $student['id']?></td>
                                    <td class="student-id"><?php echo $student['studentid']; ?></td>
                                    <td class="student-name"><?php echo $student['firstname']." ".$student['lastname']; ?></td>
                                    <td class="student-department"><?php echo $student['department']; ?></td>
                                    <td class="student-level"><?php echo $student['level']; ?></td>
                                    <td class="student-college"><?php echo $student['college']; ?></td>
                                    <td style="display:none;"><?php echo $student['contactno']; ?></td>
                                    <td style="display:none;"><?php echo $student['sex']; ?></td>
                                    <td style="display:none;"><?php echo $student['permstreet'].", ".$student['permbarangay'].", ".$student['permcity'].", ".$student['permprovince']; ?></td>
                                    <td style="display:none;"><?php echo $student['tempstreet'].", ".$student['tempbarangay'].", ".$student['tempcity'].", ".$student['tempprovince']; ?></td>
                                    <td style="display:none;"><?php echo $student['height']."cm"; ?></td>
                                    <td style="display:none;"><?php echo $student['weight']."kg"; ?></td>
                                    <td style="display:none;"><?php echo $student['gender']; ?></td>
                                    <td style="display:none;"><?php echo $student['complexion']; ?></td>
                                    <td style="display:none;"><?php echo $student['ethnicity']; ?></td>
                                    <td style="display:none;"><?php echo $student['religion']; ?></td>
                                    <td style="display:none;"><?php echo $student['civilstatus']; ?></td>
                                    <td style="display:none;"><?php echo $student['birthdate']; ?></td>
                                </tr>
                                <?php 	    
                                        endwhile;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="info-show" id="info-show">
                <div class="student-profile info-show-box">
                    <div class="student-picname">
                        <div class="student-info-pic" style="background-color:rgb(136, 136, 136);"></div>
                        <div class="student-namebuttons">
                            <div class="student-info-button-container">
                                <a style="visibility:hidden;" class="student-info-button"><img src="imgs/new-view.png" id="view-img"><div class="button-label" id="view">View Student</div></a>
                                <a style="visibility:hidden;" class="student-info-button"><img src="imgs/new-view.png" id="edit-img"><div class="button-label" id="edit">View Student</div></a>
                                <a onclick="directorViewStudent()" class="student-info-button"><img src="imgs/new-view.png" id="print-img"><div class="button-label" id="print">View Student</div></a>
                            </div>
                            <div class="student-info-name">
                                <p class="info-label">Fullname</p>
                                <p class="info-value" style="font-size: 20px;" id="show-3"></p>
                            </div>
                        </div>
                    </div>
                    <div class="info-subgroup student-biographic-info">
                        <p class="info-subgroup-label">&nbsp; Biographics &nbsp;</p>
                        <div>
                            <p class="info-label">Birthdate</p>
                            <p class="info-value" id="show-18"></p>
                        </div>
                        <div>
                            <p class="info-label">Age</p>
                            <p class="info-value" id="show-19"></p>
                        </div>
                        <div>
                            <p class="info-label">Sex</p>
                            <p class="info-value" id="show-8"></p>
                        </div>
                        <div>
                            <p class="info-label">Contact No</p>
                            <p class="info-value" id="show-7"></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Permanent Address</p>
                            <p class="info-value" id="show-9"></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Temporary Address</p>
                            <p class="info-value" id="show-10"></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Educational &nbsp;</p>
                        <div>
                            <p class="info-label">Student-ID</p>
                            <p class="info-value" id="show-2"></p>
                        </div>
                        <div>
                            <p class="info-label">Level</p>
                            <p class="info-value" id="show-5"></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Department</p>
                            <p class="info-value" id="show-4"></p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">College</p>
                            <p class="info-value" id="show-6"></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-personal-info">
                        <p class="info-subgroup-label">&nbsp; Personal &nbsp;</p>
                        <div>
                            <p class="info-label">Height</p>
                            <p class="info-value" id="show-11"></p>
                        </div>
                        <div>
                            <p class="info-label">Weight</p>
                            <p class="info-value" id="show-12"></p>
                        </div>
                        <div>
                            <p class="info-label">Gender</p>
                            <p class="info-value" id="show-13"></p>
                        </div>
                        <div>
                            <p class="info-label">Complexion</p>
                            <p class="info-value" id="show-14"></p>
                        </div>
                        <div>
                            <p class="info-label">Ethnicity</p>
                            <p class="info-value"id="show-15"></p>
                        </div>
                        <div>
                            <p class="info-label">Religion</p>
                            <p class="info-value" id="show-16"></p>
                        </div>
                        <div>
                            <p class="info-label">Civil Status</p>
                            <p class="info-value" id="show-17"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/counselorviewstudentlist.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>