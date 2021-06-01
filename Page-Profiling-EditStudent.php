<!DOCTYPE html>
<?php
    include "server.php";
    include "authenticate.php";
    include "authenticateGuidance.php";
?>
<html>
    <head>
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/edit-info-form.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body style="background-color: rgb(224, 224, 224); padding-top:60px; min-width:800px;" onload="addEditSiblingListener()">
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
        <form onsubmit="return validateForm()" method="post" action="edit.php" class="center-container" id="main-form">
        <?php 
            $id=$_REQUEST['id'];
            $record = mysqli_query($link,"SELECT * FROM student WHERE id=$id");
            $student=mysqli_fetch_array($record);
        ?>
            <input class="hidden-input" name="id" value="<?php echo $id; ?>">
            <div class="form-label">
                Edit Student
                <p class="form-label-subtext">Please Input Information Accurately</p>
                <p class="form-label-subtext">Fields marked with * are required</p>
            </div>
            <div class="subgroup-container biographics">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Biographic Information</p>
                </div>
                <div class="question-container">
                    <p>Firstname *</p>
                    <input type="text" placeholder="First Name" id="firstname" name="firstname" value="<?php echo $student['firstname']?>">
                </div>
                <div class="question-container">
                    <p>Middlename *</p>
                    <input type="text" placeholder="Middle Name" id="middlename" name="middlename" value="<?php echo $student['middlename']?>">
                </div>
                <div class="question-container">
                    <p>Lastname *</p>
                    <input type="text" placeholder="Last Name" id="lastname" name="lastname" value="<?php echo $student['lastname']?>">
                </div>
                <div class="question-container">
                    <p>Birthdate *</p>
                    <input type="date" id="birthDate" name="birthDate" value="<?php echo $student['birthdate']?>">
                </div>
                <div class="question-container">
                    <p>Contact Number *</p>
                    <input type="text" placeholder="Contact Number" id="contact" name="contact" value="<?php echo $student['contactno']?>">
                </div>
                <div class="question-container">
                    <p>Permanent Address *</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" id="street" name="street" value="<?php echo $student['permstreet']?>">
                        <input class="address" placeholder="Barangay" id="barangay" name="barangay" value="<?php echo $student['permbarangay']?>">
                        <input class="address" placeholder="City" id="city" name="city" value="<?php echo $student['permcity']?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" id="province" name="province" value="<?php echo $student['permprovince']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Temporary Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="boarderStreet" value="<?php echo $student['tempstreet']?>">
                        <input class="address" placeholder="Barangay" name="boarderBarangay" value="<?php echo $student['tempbarangay']?>">
                        <input class="address" placeholder="City" name="boarderCity" value="<?php echo $student['tempcity']?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="boarderProvince" value="<?php echo $student['tempprovince']?>">
                    </div>
                </div>
            </div>
            <div class="subgroup-container educational">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Educational Information</p>
                </div>
                <div class="question-container">
                    <p>Student ID *</p>
                    <input type="text" placeholder="Student ID" id="studentId" name="studentId" value="<?php echo $student['studentid']?>">
                </div>
                <div class="question-container">
                    <p>Department *</p>
                    <input type="text" placeholder="Department" id="department" name="department" value="<?php echo $student['department']?>">
                </div>
                <div class="question-container">
                    <p>College *</p>
                    <input type="text" placeholder="College" id="college" name="college" value="<?php echo $student['college']?>">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Level *</p>
                    <label class="radio-container">1
                        <input type="radio" name="level" value="1" <?php if($student['level'] == "1") {echo "checked=\"checked\"";} ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">2
                        <input type="radio" name="level" value="2" <?php if($student['level'] == "2") {echo "checked=\"checked\"";} ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">3
                        <input type="radio" name="level" value="3" <?php if($student['level'] == "3") {echo "checked=\"checked\"";} ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">4
                        <input type="radio" name="level" value="4" <?php if($student['level'] == "4") {echo "checked=\"checked\"";} ?>>
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
                        <input type="radio" name="sex" value="Male" <?php if($student['sex'] == "Male") {echo "checked=\"checked\"";} ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="sex" value="Female" <?php if($student['sex'] == "Female") {echo "checked=\"checked\"";} ?>>
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
                    <input type="text" placeholder="Gender" name="gender" value="<?php echo $student['gender']?>">
                </div>
                <div class="question-container">
                    <p>Height (cm)</p>
                    <input type="text" placeholder="Height (cm)" name="height" value="<?php echo $student['height']?>">
                </div>
                <div class="question-container">
                    <p>Weight (kg)</p>
                    <input type="text" placeholder="Weight (kg)" name="weight" value="<?php echo $student['weight']?>">
                </div>
                <div class="question-container">
                    <p>Complexion</p>
                    <input type="text" placeholder="Complexion" name="complexion" value="<?php echo $student['complexion']?>">
                </div>
                <div class="question-container">
                    <p>Ethnicity</p>
                    <input type="text" placeholder="Ethnicity" name="ethnicity" value="<?php echo $student['ethnicity']?>">
                </div>
                <div class="question-container">
                    <p>Nationality *</p>
                    <input type="text" placeholder="Nationality" id="nationality" name="nationality" value="<?php echo $student['nationality']?>">
                </div>
                <div class="question-container">
                    <p>Religion *</p>
                    <input type="text" placeholder="Religion" id="religion" name="religion" value="<?php echo $student['religion']?>">
                </div>
            </div>
            <div class="subgroup-container familial">
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
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Familial Information</p>
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Father Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="hidden-input" id="fatherId" name="fatherId" value="<?php echo $father['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="fatherFirstname" name="fatherFirstname" value="<?php echo $father['firstname']?>">
                        <input class="familyname" placeholder="Middlename" id="fatherMiddlename" name="fatherMiddlename" value="<?php echo $father['middlename']?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="fatherLastname" name="fatherLastname" value="<?php echo $father['lastname']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="fatherStreet" value="<?php echo $father['street']; ?>">
                        <input class="address" placeholder="Barangay" name="fatherBarangay" value="<?php echo $father['barangay']; ?>">
                        <input class="address" placeholder="City" name="fatherCity" value="<?php echo $father['city']; ?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="fatherProvince" value="<?php echo $father['province']; ?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="fatherOccupation" value="<?php echo $father['occupation']?>">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="fatherContact" value="<?php echo $father['contactno']?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Mother Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="hidden-input" id="motherId" name="motherId" value="<?php echo $mother['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="motherFirstname" name="motherFirstname" value="<?php echo $mother['firstname']?>">
                        <input class="familyname" placeholder="Middlename" id="motherMiddlename" name="motherMiddlename" value="<?php echo $mother['middlename']?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="motherLastname" name="motherLastname" value="<?php echo $mother['lastname']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="motherStreet" value="<?php echo $mother['street']; ?>">
                        <input class="address" placeholder="Barangay" name="motherBarangay" value="<?php echo $mother['barangay']; ?>">
                        <input class="address" placeholder="City" name="motherCity" value="<?php echo $mother['city']; ?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="motherProvince" value="<?php echo $mother['province']; ?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="motherOccupation" value="<?php echo $mother['occupation']?>">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="motherContact" value="<?php echo $mother['contactno']?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Guardian Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="hidden-input" id="guardianId" name="guardianId" value="<?php echo $guardian['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="guardianFirstname" name="guardianFirstname" value="<?php echo $guardian['firstname']?>">
                        <input class="familyname" placeholder="Middlename" id="guardianMiddlename" name="guardianMiddlename" value="<?php echo $guardian['middlename']?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="guardianLastname" name="guardianLastname" value="<?php echo $guardian['lastname']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="guardianStreet" value="<?php echo $guardian['street']; ?>">
                        <input class="address" placeholder="Barangay" name="guardianBarangay"  value="<?php echo $guardian['barangay']; ?>">
                        <input class="address" placeholder="City" name="guardianCity"  value="<?php echo $guardian['city']; ?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="guardianProvince" value="<?php echo $guardian['province']; ?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="guardianOccupation" value="<?php echo $guardian['occupation']?>">
                </div>
                <div class="question-container">
                    <p>Relation</p>
                    <input type="text" placeholder="Relation" name="guardianRelationship"  value="<?php echo $guardian['relationship']?>">
                </div>
                <div class="question-container">
                    <p>Contact Number *</p>
                    <input type="text" placeholder="Contact Number" id="guardianContact" name="guardianContact"  value="<?php echo $guardian['contactno']?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Spouse Information (If applicable)</p>
                </div>
                <div class="question-container">
                    <p>Fullname</p>
                    <?php
                        $spouse['id'] = ''; 
                        $spouse['firstname'] = '';
                        $spouse['middlename'] = '';
                        $spouse['maidenname'] = '';
                        $spouse['lastname'] = '';
                        $spouse['street'] = '';
                        $spouse['barangay'] = '';
                        $spouse['city'] = '';
                        $spouse['province'] = '';
                        $spouse['occupation'] = '';
                        $spouse['contactno'] = '';
                        if($student['civilstatus']=="Married"){
                            $spouseQuery = "SELECT * FROM spouse WHERE spouseid=$id";
                            $spouse = mysqli_fetch_array($link->query($spouseQuery));
                        }
                    ?>
                    <div class="form-span">
                        <input class="hidden-input" id="spouseId" name="spouseId" value="<?php echo $spouse['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" name="spouseFirstname" value="<?php echo $spouse['firstname']; ?>">
                        <input class="familyname" placeholder="Middlename" name="spouseMiddlename" value="<?php echo $spouse['middlename']; ?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" name="spouseLastname" value="<?php echo $spouse['lastname']; ?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Address</p>
                    <div class="form-span">
                        <input class="address" placeholder="Street" style="margin-left:0px;" name="spouseStreet" value="<?php echo $spouse['street']; ?>">
                        <input class="address" placeholder="Barangay" name="spouseBarangay" value="<?php echo $spouse['barangay']; ?>">
                        <input class="address" placeholder="City" name="spouseCity" value="<?php echo $spouse['city']; ?>">
                        <input class="address" placeholder="Province" style="margin-right:0px;" name="spouseProvince" value="<?php echo $spouse['province']; ?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Occupation</p>
                    <input type="text" placeholder="Occupation" name="spouseOccupation" value="<?php echo $spouse['occupation']; ?>">
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="spouseContact"  value="<?php echo $spouse['contactno']; ?>">
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
                    <input type="text" style="display:none; visibility:hidden" id="siblingCount" name="siblingCount" value="<?php $siblingCount = mysqli_num_rows($link->query("SELECT * FROM siblingrecord WHERE studentid=$id")) - 1; echo $siblingCount; ?>">
                    <input type="text" style="display:none; visibility:hidden" id="originalSiblingCount" name="originalSiblingCount" value="<?php echo $siblingCount; ?>">
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
                    <?php   $siblingRecordQuery = "SELECT * FROM siblingrecord WHERE studentid=$id";
                            $siblingRecordList = $link->query($siblingRecordQuery);
                            if($siblingCount > -1){
                                $i = 0; 
                                while($siblingRecord = mysqli_fetch_array($siblingRecordList)):
                                    $currentSiblingId = $siblingRecord['siblingid'];
                                    $siblingQuery = "SELECT * FROM sibling WHERE id=$currentSiblingId";
                                    $sibling = mysqli_fetch_array($link->query($siblingQuery));
                    ?>
                        <tr id="tr-sibling-edit<?php echo $i; ?>">
                            <td id="sibling-edit-name<?php echo $i ?>">
                                <?php echo $sibling['firstname']." ".$sibling['middlename']." ".$sibling['lastname'] ?>
                            </td>
                            <td id="sibling-edit-relation<?php echo $i ?>">
                                <?php echo $sibling['relationship']; ?>
                            </td>
                            <td class="sibling-edit" id="sibling-edit<?php echo $i; ?>" name="<?php echo $i; ?>">
                                <button type="button" style="font-weight:700;">Edit</button>
                            </td>
                            <td style="display:none;">
                                <input type="text" class="hidden-input" id="siblingWillDelete<?php echo $i; ?>" name="siblingWillDelete<?php echo $i; ?>" value="no">
                                <input type="text" class="hidden-input" id="siblingId<?php echo $i; ?>" name="siblingId<?php echo $i; ?>" value="<?php echo $sibling['id']; ?>">
                                <input type="text" class="hidden-input" id="siblingFirstname<?php echo $i; ?>" name="siblingFirstname<?php echo $i; ?>" value="<?php echo $sibling['firstname']; ?>">
                                <input type="text" class="hidden-input" id="siblingMiddlename<?php echo $i; ?>" name="siblingMiddlename<?php echo $i; ?>" value="<?php echo $sibling['middlename']; ?>">
                                <input type="text" class="hidden-input" id="siblingLastname<?php echo $i; ?>" name="siblingLastname<?php echo $i; ?>" value="<?php echo $sibling['lastname']; ?>">
                                <input type="text" class="hidden-input" id="siblingRelation<?php echo $i; ?>" name="siblingRelation<?php echo $i; ?>" value="<?php echo $sibling['relationship']; ?>">
                            </td>
                        </tr>
                    <?php           $i++;
                                endwhile;
                            }
                    ?>
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
                        Edit
                    </div>
                    <div class="action-button-icon">
                        <img src="imgs/new-edit.png">
                    </div>
                </button>
                <button onclick="cancel(<?php echo $id ?>)" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
                    Cancel
                </button>
                <div class="normal-button" style="position:absolute; left:70px; pointer-events:none;">
                    Record All Changes
                </div>
                <label class="switch" style="position:absolute; left: 10px;">
                    <input type="checkbox" onchange="recordOrNot();">
                    <span class="slider round"></span>
                </label>
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
        <div class="sibling-modal-container" id="sibling-modal-container-add">
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
        <div class="sibling-modal-container" id="sibling-modal-container-edit">
            <div class="sibling-modal" style="height:320px;">
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Add Sibling</p>
                </div>
                <div class="question-container" style="height:30px;">
                    <label class="radio-container" style="border-radius:10px;">Mark Sibling for Deletion
                            <input type="checkbox" id="mark-for-delete" name="mark-for-delete" value="yes">
                            <span class="checkmark" style="border-radius:10px;"></span>
                    </label>
                </div>
                <div class="question-container">
                    <p>Fullname *</p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="siblingFirstname-edit">
                        <input class="familyname" placeholder="Middlename" id="siblingMiddlename-edit">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="siblingLastname-edit">
                    </div>
                </div>
                <div class="question-container" style="height:180px;">
                    <p>Sex *</p>
                    <label class="radio-container">Male
                        <input type="radio" name="sibling-relation-edit" id="siblingMale" value="Brother">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="sibling-relation-edit" id="siblingFemale" value="Sister">
                        <span class="checkmark"></span>
                    </label>
                    <div class="buttons">
                        <button class="action-button" id="editSiblingToTable" style="width:80px; height:30px;">
                            <div class="action-button-label">
                                Edit
                            </div>
                        </button>
                        <button type="button" class="normal-button" style="width:70px; height:30px; margin-right:10px;" id="closeEditSiblingModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/edit-info-form.js"></script>
        <script src="js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
    </body>
</html>