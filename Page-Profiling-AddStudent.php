
<!DOCTYPE html>
<?php
    include "server.php";
    include "authenticate.php";
?>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/info-form.css">
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
        <form onsubmit="return validateForm()" method="post" action="edit.php" class="center-container">
            <div class="form-label">
                Add Student
                <p class="form-label-subtext">Please Input Information Accurately</p>
                <p class="form-label-subtext">Fields marked with * are required</p>
            </div>
            <div class="subgroup-container biographics">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Biographic Information</p>
                </div>
                <div class="question-container">
                    <p>Firstname *</p>
                    <input type="text" placeholder="First Name" id="firstname" name="firstname">
                </div>
                <div class="question-container">
                    <p>Middlename *</p>
                    <input type="text" placeholder="Middle Name" id="middlename" name="middlename">
                </div>
                <div class="question-container">
                    <p>Lastname *</p>
                    <input type="text" placeholder="Last Name" id="lastname" name="lastname">
                </div>
                <div class="question-container">
                    <p>Birthdate *</p>
                    <input type="date" id="birthDate" name="birthDate">
                </div>
                <div class="question-container">
                    <p>Contact Number *</p>
                    <input type="text" placeholder="Contact Number" id="contact" name="contact">
                </div>
                <div class="question-container">
                    <p>Permanent Address *</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" id="street" name="street">
                        <input class="address" placeholder="Barangay" id="barangay" name="barangay">
                        <input class="address" placeholder="City" id="city" name="city">
                        <input class="address" placeholder="Province" style="margin-right:0px;" id="province" name="province">
                    </div>
                </div>
                <div class="question-container">
                    <p>Temporary Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="boarderStreet">
                        <input class="address" placeholder="Barangay" name="boarderBarangay">
                        <input class="address" placeholder="City" name="boarderCity">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="boarderProvince">
                    </div>
                </div>
            </div>
            <div class="subgroup-container educational">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Educational Information</p>
                </div>
                <div class="question-container">
                    <p>Student ID *</p>
                    <input type="text" placeholder="Student ID" id="studentId" name="studentId">
                </div>
                <div class="question-container">
                    <p>Department *</p>
                    <input type="text" placeholder="Department" id="department" name="department">
                </div>
                <div class="question-container">
                    <p>College *</p>
                    <input type="text" placeholder="College" id="college" name="college">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Level *</p>
                    <label class="radio-container">1
                        <input type="radio" name="level" value="1">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">2
                        <input type="radio" name="level" value="2">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">3
                        <input type="radio" name="level" value="3">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">4
                        <input type="radio" name="level" value="4">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="subgroup-container personal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Personal Information</p>
                </div>
                <div class="question-container" style="height:100px;">
                    <p>Sex *</p>
                    <label class="radio-container">Male
                        <input type="radio" name="sex" value="Male">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="sex" value="Female">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="question-container">
                    <span class="gender-span">
                        Gender
                        <span style="font-size:12px;">
                            (Optional)
                        </span>
                    </span>
                    <input type="text" placeholder="Gender" name="gender">
                </div>
                <div class="question-container">
                    <p>Height (cm)</p>
                    <input type="text" placeholder="Height (cm)" name="height">
                </div>
                <div class="question-container">
                    <p>Weight (kg)</p>
                    <input type="text" placeholder="Weight (kg)" name="weight">
                </div>
                <div class="question-container">
                    <p>Complexion</p>
                    <input type="text" placeholder="Complexion" name="complexion">
                </div>
                <div class="question-container">
                    <p>Ethnicity</p>
                    <input type="text" placeholder="Ethnicity" name="ethnicity">
                </div>
                <div class="question-container">
                    <p>Nationality *</p>
                    <input type="text" placeholder="Nationality" id="nationality" name="nationality">
                </div>
                <div class="question-container">
                    <p>Religion *</p>
                    <input type="text" placeholder="Religion" id="religion" name="religion">
                </div>
            </div>
            <div class="subgroup-container familial">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Familial Information</p>
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Father Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="fatherFirstname" name="fatherFirstname">
                        <input class="familyname" placeholder="Middlename" id="fatherMiddlename" name="fatherMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="fatherLastname" name="fatherLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="fatherStreet">
                        <input class="address" placeholder="Barangay" name="fatherBarangay">
                        <input class="address" placeholder="City" name="fatherCity">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="fatherProvince">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="fatherOccupation">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="fatherContact">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Mother Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="motherFirstname" name="motherFirstname">
                        <input class="familyname" placeholder="Middlename" id="motherMiddlename" name="motherMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="motherLastname" name="motherLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="motherStreet">
                        <input class="address" placeholder="Barangay" name="motherBarangay">
                        <input class="address" placeholder="City" name="motherCity">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="motherProvince">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="motherOccupation">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="motherContact">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Guardian Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="guardianFirstname" name="guardianFirstname">
                        <input class="familyname" placeholder="Middlename" id="guardianMiddlename" name="guardianMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="guardianLastname" name="guardianLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="guardianStreet">
                        <input class="address" placeholder="Barangay" name="guardianBarangay">
                        <input class="address" placeholder="City" name="guardianCity">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="guardianProvince">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="guardianOccupation">
                </div>
                <div class="question-container">
                    <p>Relation</p>
                    <input type="text" placeholder="Relation" name="guardianRelationship">
                </div>
                <div class="question-container">
                    <p>Contact Number *</p>
                    <input type="text" placeholder="Contact Number" id="guardianContact" name="guardianContact">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Spouse Information (If applicable)</p>
                </div>
                <div class="question-container">
                    <p>Fullname</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" name="spouseFirstname">
                        <input class="familyname" placeholder="Middlename" name="spouseMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" name="spouseLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="spouseStreet">
                        <input class="address" placeholder="Barangay" name="spouseBarangay">
                        <input class="address" placeholder="City" name="spouseCity">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="spouseProvince">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="spouseOccupation">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="spouseContact">
                </div>
                <div class="subgroup-label-container family-label-container" style="margin-bottom:10px;">
                    <p class="subgroup-label family-label" style="display:flex; width:280px;">
                        Siblings 
                        <button type="button" class="action-button" style="width:110px; height:30px; margin-left:10px;">
                            <div class="action-button-label" style="font-size: 12px; flex:80%;" id="addSibling">
                                Add Sibling
                            </div>
                            <div class="action-button-icon" style="flex:20%;">
                                +
                            </div>
                        </button>
                    </p>
                </div>
                <div class="question-container sibling-table-container" style="height:200px;">
                    <input type="text" class="hidden-input" id="siblingCount" name="siblingCount" value="-1">
                    <table class="sibling-table">
                        <tr>
                            <th class="sibling-name sibling-label">
                                Name
                            </th>
                            <th class="sibling-relationship sibling-label">
                                Relationship
                            </th>
                            <th class="sibling-remove sibling-label">
                            </th>
                        </tr>
                    <!--
                        <tr>
                            <td>
                                Kenneth Rule
                            </td>
                            <td>
                                Brother
                            </td>
                            <td class="sibling-remove">
                                <button type="button">
                                    X
                                </button>
                            </td>
                        </tr>
                    -->
                        <tr style="display:none;" id="sibling-null">
                        </tr>
                    </table>
                    <div style="display:none;" id="sibling-post-null"></div>
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
                <button type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
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
        <div class="sibling-modal-container" id="sibling-modal-container">
            <div class="sibling-modal">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Add Sibling</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="siblingFirstname">
                        <input class="familyname" placeholder="Middlename" id="siblingMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="siblingLastname">
                    </div>
                </div>
                <div class="question-container" style="height:180px;">
                    <p>Sex *</p>
                    <label class="radio-container">Male
                        <input type="radio" name="sibling-relation" value="Brother">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="sibling-relation" value="Sister">
                        <span class="checkmark"></span>
                    </label>
                    <div class="buttons">
                        <button class="action-button" id="addSiblingToTable" style="width:80px; height:30px;">
                            <div class="action-button-label">
                                Add
                            </div>
                            <div class="action-button-icon">
                                +
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeSiblingModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
        <script src="js/info-form.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>