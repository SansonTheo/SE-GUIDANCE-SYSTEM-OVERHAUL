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
            <div>Create Referral</div>
        </div>
        <form name="session-form" id="session-form" onsubmit="return validateForm()" class="center-container" method="post" action="addReferralTeacher.php">
            <div class="form-label">
                Referral Form
                <p class="form-label-subtext">Please Input Information Accurately</p>
                <p class="form-label-subtext">Fields marked with * are required</p>
            </div>
            <div class="subgroup-container">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Session Information</p>
                </div>
                <div class="question-container">
                    <p class="question-label-with-button">Student *
                        <button type="button" class="action-button add-button" style="width:130px; height:28px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addCounselor">
                                Select Student
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                •
                            </div>
                        </button>
                    </p>
                    <input class="hidden-input" type="text" name="student-id" id="counselor-id">
                    <input type="text" name="student-name" id="counselor-name" placeholder="Student" readonly="readonly" style="pointer-events: none;">
                </div>
                <div class="question-container" style="height:auto;">
                    <p>What Problems have you been experiencing with this student?</p>
                    <div class="checkbox-container">
                        <input type="checkbox" id="trait1" name="trait1" value="Tardiness"><label for="vehicle1">Tardiness</label>
                        <input type="checkbox" id="trait2" name="trait2" value="Deviant Behavior"><label for="vehicle1">Deviant Behavior</label>
                        <input type="checkbox" id="trait3" name="trait3" value="Absenteeism"><label for="vehicle1">Absenteeism</label>
                        <input type="checkbox" id="trait4" name="trait4" value="Academic Problems"><label for="vehicle1">Academic Problems</label>
                        <input type="checkbox" id="trait5" name="trait5" value="Emotional Problems"><label for="vehicle1">Emotional Problems</label>
                        <input type="checkbox" id="trait6" name="trait6" value="Family Concerns"><label for="vehicle1">Family Concerns</label>
                        <input type="checkbox" id="trait7" name="trait7" value="Aggressive Behavior"><label for="vehicle1">Aggressive Behavior</label>
                        <input type="checkbox" id="trait8" name="trait8" value="Bullying"><label for="vehicle1">Bullying</label>
                    </div>
                </div>
                <div class="question-container">
                    <p>Other Reasons</p>
                    <input type="text" name="trait9" id="trait9hide" placeholder="Specify Other Reasons">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>Problem History</p>
                    <textarea style="resize:none; height:300px;" name="problemhistory" id="problemhistory" form="session-form" placeholder="Clarify Referral Problem / History. . ."></textarea>
                </div>
                <div class="question-container" style="height:300px;">
                    <p>What actions have you already taken? (If Applicable)</p>
                    <textarea style="resize:none; height:300px;" name="actiontaken" id="actiontaken" form="session-form" placeholder="Explain Actions Already Taken. . ."></textarea>
                </div>
                <div class="question-container">
                    <p>Have you contacted the parents of the student already?</p>
                    <select id="contactedparents" name="contactedparents">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>If yes, when have you contacted the parents?</p>
                    <input type="text" name="contactedparentsdate" id="contactedparentsdate" placeholder="Date Parents were Contacted">
                </div>
                <div class="question-container" style="height:300px;">
                    <p>What was the outcome when you contacted the parents?</p>
                    <textarea style="resize:none; height:300px;" name="contactedparentsoutcome" id="contactedparentsoutcome" form="session-form" placeholder="Explain what the outcome with the parents was. . ."></textarea>
                </div>
            </div>
            <div class="subgroup-container buttons">
                <button type="submit" class="action-button" style="width:130px; height:40px;">
                    <div class="action-button-label">
                        Submit Referral
                    </div>
                </button>
                <button onclick="teacherList()" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
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
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeCounselorModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
        <script src="js/referral-form.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>