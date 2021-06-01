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
        <link rel="stylesheet" type="text/css" href="css/viewapplylist.css">
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
            <div>Own Referral List</div>
        </div>
        <div style="width: calc(85%); margin-left:10%; height:100%; display:flex; min-width:600px;">
            <div style="height:100%; flex:45%;">
                <div class="student-window">
                    <div class="sort-buttons" style="width:100%; height:120px;">
                        <div onclick="counselorReferralAdd()" class="addSession-button">
                            <div class="add-label">
                                Create Referral
                            </div>
                            <img src="imgs/new-add.png">
                        </div>
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
                    <div class="list-window list-selected" id="pending">
                        <table id="referral-table" class="list-table tableFixHead">
                            <thead>
                                <tr>
                                    <th class="student-id list-label">
                                        Student
                                    </th>
                                    <th class="student-name list-label">
                                        Referred by
                                    </th>
                                    <th class="student-department list-label">
                                        Date Sent
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $userid = $_SESSION['userid'];
                                    $record = mysqli_query($link,"SELECT * FROM referral WHERE referredby='$userid'");
                                    while($referral=mysqli_fetch_array($record)):
                                ?>
                                <tr class="show" name="entry">
                                    <td style="display:none;"><?php
                                        $referralid = $referral['id'];
                                        echo $referralid;
                                    ?></td>
                                    <td class="student-id"><?php
                                        $studentid = $referral['studentid'];
                                        $student =  mysqli_fetch_array(mysqli_query($link,"SELECT * FROM student WHERE id='$studentid'"));
                                        echo $student['firstname']." ".$student['lastname'];
                                    ?></td>
                                    <td class="student-name"><?php
                                        $referredbyid = $referral['referredby'];
                                        $referredbytype = $referral['referredtype'];
                                        $usertype = "";
                                        if($referredbytype == "Teacher"){
                                            $usertype = 'teacher';
                                        }
                                        else if($referredbytype == "Coordinator" || $referredbytype == "Counselor"){
                                            $usertype = 'counselor';
                                        }
                                        $referredby =  mysqli_fetch_array(mysqli_query($link,"SELECT * FROM $usertype WHERE id='$referredbyid'"));
                                        echo $referredby['firstname']." ".$referredby['lastname'];
                                    ?></td>
                                    <td class="student-level"><?php 
                                        $datetimesent = new DateTime($referral['datetimesent']);
                                        echo $datetimesent->format('D, M j, \'y, h:i A');                 
                                    ?></td>
                                    <td class="hidden-input"><?php 
                                        echo $referral['status'];                
                                    ?></td>
                                    <td class="hidden-input"><?php 
                                        $reasons = explode(",",$referral['reasons']);
                                        $reasonStr = implode(", ",$reasons);
                                        echo $reasonStr;               
                                    ?></td>
                                    <td class="hidden-input"><?php 
                                        echo $referral['actiontaken'];                
                                    ?></td>
                                </tr>
                                <?php
                                    endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="info-show" id="info-show" style="flex:45%;">
                <div class="student-profile info-show-box">
                    <div class="info-subgroup student-biographic-info" style="height: 130px;">
                        <p class="info-subgroup-label">&nbsp; Referral Details &nbsp;</p>
                        <div>
                            <p class="info-label">Referred By</p>
                            <p class="info-value" id="show-0"></p>
                        </div>
                        <div>
                            <p class="info-label">Student</p>
                            <p class="info-value" id="show-1"></p>
                        </div>
                        <div>
                            <p class="info-label">Status</p>
                            <p class="info-value" id="show-2"></p>
                        </div>
                        <div>
                            <p class="info-label">Date Sent</p>
                            <p class="info-value" id="show-3"></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info" style="height:150px;">
                        <p class="info-subgroup-label">&nbsp; Issue/Reason for Counseling &nbsp;</p>
                        <div class="info-show-text-area">
                            <p class="info-value info-show-text" id="show-4"></p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info" style="height:150px;">
                        <p class="info-subgroup-label">&nbsp; Course of Action Already Taken &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text" id="show-5"></div>
                        </div>
                    </div>
                    <div class="info-subgroup show-button-info">
                        <p class="info-subgroup-label">&nbsp; Action &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="student-info-button-container">
                                <a style="visibility:hidden;" href="#" class="student-info-button"><img src="imgs/new-forward.png" id="view-img"><div class="button-label" id="view">Refer</div></a>
                                <a onclick="resolveReferralCounselor();" class="student-info-button"><img src="imgs/new-check.png" id="edit-img"><div class="button-label" id="edit">Resolve</div></a>
                                <a onclick="viewReferralCounselor();" class="student-info-button"><img src="imgs/new-view.png" id="print-img"><div class="button-label" id="print" style="font-size:15px; display:flex; justify-content:center;">View</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/viewownreferrallist.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>