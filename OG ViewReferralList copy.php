<!DOCTYPE html>
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
                <li><a href="Page-Guidance-Index.php"><img src="imgs/icon-home.png">home</a></li>
                <li><a href="javascript:toggleProfiling();"><img src="imgs/icon-student.png">student profiling</a>
                    <ul class="profiling-ul">
                        <li><a href="javascript:void(0);">Index</a></li>
                        <li><a href="javascript:void(0);">Add Student</a></li>
                        <li><a href="javascript:void(0);">View Demographics</a></li>
                    </ul>
                </li>
                <li><a href="javascript:toggleGuidance();"><img src="imgs/icon-counseling.png">counseling index</a>
                    <ul class="guidance-ul">
                        <li><a href="javascript:void(0);">Index</a></li>
                        <li><a href="javascript:void(0);">Add Session</a></li>
                        <li><a href="javascript:void(0);">View Calendar</a></li>
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
        <div style="width: calc(85%); margin-left:10%; height:100%; display:flex; min-width:600px;">
            <div class="category-container">
                <div class="category-buttons-container">
                    <p class="category-container-label">
                        Application Status
                    </p>
                    <div class="category-label category-selected" id="category-pending" name="category-button">
                        Pending
                    </div>
                    <div class="category-label" id="category-scheduled" name="category-button">
                        Scheduled
                    </div>
                </div>
            </div>
            <div style="height:100%; flex:45%;">
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
                    <div class="list-window list-selected" id="pending">
                        <table class="list-table tableFixHead">
                            <thead>
                                <tr>
                                    <th class="student-id list-label">
                                        Sender
                                    </th>
                                    <th class="student-name list-label">
                                        Counselor
                                    </th>
                                    <th class="student-department list-label">
                                        Student/s
                                    </th>
                                    <th class="student-level list-label">
                                        Date
                                    </th>
                                    <th class="student-college list-label">
                                        Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="student-id">
                                        Chadston Radstone
                                    </td>
                                    <td class="student-name">
                                        Arthur Morgan
                                    </td>
                                    <td class="student-department">
                                        Theo Sanson
                                    </td>
                                    <td class="student-level">
                                        01/19/2022
                                    </td>
                                    <td class="student-college">
                                        4PM
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="list-window" id="scheduled">
                        <table class="list-table tableFixHead">
                            <thead>
                                <tr>
                                    <th class="student-id list-label">
                                        Sender
                                    </th>
                                    <th class="student-name list-label">
                                        Counselor
                                    </th>
                                    <th class="student-department list-label">
                                        Student/s
                                    </th>
                                    <th class="student-level list-label">
                                        Date
                                    </th>
                                    <th class="student-college list-label">
                                        Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="student-id">
                                        Chadston Radstone
                                    </td>
                                    <td class="student-name">
                                        Arthur Morgan
                                    </td>
                                    <td class="student-department">
                                        Theo Sanson
                                    </td>
                                    <td class="student-level">
                                        01/19/2022
                                    </td>
                                    <td class="student-college">
                                        4PM
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="list-window" id="approved">
                        <table class="list-table tableFixHead">
                            <thead>
                                <tr>
                                    <th class="student-id list-label">
                                        Sender
                                    </th>
                                    <th class="student-name list-label">
                                        Counselor
                                    </th>
                                    <th class="student-department list-label">
                                        Student/s
                                    </th>
                                    <th class="student-level list-label">
                                        Date
                                    </th>
                                    <th class="student-college list-label">
                                        Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="student-id">
                                        Chadston Radstone
                                    </td>
                                    <td class="student-name">
                                        Arthur Morgan
                                    </td>
                                    <td class="student-department">
                                        Theo Sanson
                                    </td>
                                    <td class="student-level">
                                        01/19/2022
                                    </td>
                                    <td class="student-college">
                                        4PM
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="list-window" id="denied">
                        <table class="list-table tableFixHead">
                            <thead>
                                <tr>
                                    <th class="student-id list-label">
                                        Sender
                                    </th>
                                    <th class="student-name list-label">
                                        Counselor
                                    </th>
                                    <th class="student-department list-label">
                                        Student/s
                                    </th>
                                    <th class="student-level list-label">
                                        Date
                                    </th>
                                    <th class="student-college list-label">
                                        Time
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="student-id">
                                        Chadston Radstone
                                    </td>
                                    <td class="student-name">
                                        Arthur Morgan
                                    </td>
                                    <td class="student-department">
                                        Theo Sanson
                                    </td>
                                    <td class="student-level">
                                        01/19/2022
                                    </td>
                                    <td class="student-college">
                                        4PM
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="info-show" style="flex:45%;">
                <div class="student-profile info-show-box">
                    <div class="info-subgroup student-biographic-info">
                        <p class="info-subgroup-label">&nbsp; Referral Details &nbsp;</p>
                        <div>
                            <p class="info-label">Sender</p>
                            <p class="info-value">Chadston Radstone</p>
                        </div>
                        <div>
                            <p class="info-label">Date Requested</p>
                            <p class="info-value">01/19/22</p>
                        </div>
                        <div>
                            <p class="info-label">Counselor</p>
                            <p class="info-value">Arthur Morgan</p>
                        </div>
                        <div>
                            <p class="info-label">Time Requested</p>
                            <p class="info-value">4PM</p>
                        </div>
                        <div>
                            <p class="info-label">Status</p>
                            <p class="info-value">Pending</p>
                        </div>
                        <div>
                            <p class="info-label">Date Sent</p>
                            <p class="info-value">01/18/2022</p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Student/s</p>
                            <p class="info-value">Theo Sanson</p>
                        </div>
                        <div style="grid-column: span 2;">
                            <p class="info-label">Teacher/s</p>
                            <p class="info-value">Chadston Radstone</p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Issue/Reason for Counseling &nbsp;</p>
                        <div class="info-show-text-area">
                            <p class="info-value info-show-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                    <div class="info-subgroup student-educational-info">
                        <p class="info-subgroup-label">&nbsp; Recommended Course of Action &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="info-value info-show-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                        </div>
                    </div>
                    <div class="info-subgroup show-button-info">
                        <p class="info-subgroup-label">&nbsp; Action &nbsp;</p>
                        <div class="info-show-text-area">
                            <div class="student-info-button-container">
                                <a href="#" class="student-info-button"><img src="imgs/new-check.png" id="view-img"><div class="button-label" id="view">Approve</div></a>
                                <a href="#" class="student-info-button"><img src="imgs/new-deny.png" id="edit-img"><div class="button-label" id="edit">Deny</div></a>
                                <a href="#" class="student-info-button"><img src="imgs/new-schedule.png" id="print-img"><div class="button-label" id="print">Approve <br> & Create Session</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="js/viewapplylist.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>