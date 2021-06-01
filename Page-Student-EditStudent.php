<!DOCTYPE html>
<?php
    include "server.php";
    include "authenticate.php";
    include "authenticateStudent.php";
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
                <li><a href="Page-Student-Home.php"><img src="imgs/icon-home.png">home</a></li>
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
                    <li onclick="studentProfile()">Profile</li>
                    <li>Contact Us</li>
                    <li onclick="logout()">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>Edit Student Personal Data Sheet</div>
        </div>
        <form onsubmit="return validateForm()" id="session-form" method="post" action="editStudent.php" class="center-container" id="main-form">
        <?php 
            $id=$_SESSION['userid'];
            $record = mysqli_query($link,"SELECT * FROM student WHERE id=$id");
            $student=mysqli_fetch_array($record);
        ?>
            <input class="hidden-input" name="id" value="<?php echo $id; ?>">
            <div class="form-label">
                Edit Your Personal Data Sheet
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
                    <p>Place of Birth</p>
                    <input type="text" placeholder="Place of Birth" id="placeofbirth" name="placeofbirth" value="<?php echo $student['placeofbirth']?>">
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
                    <p>Course *</p>
                    <input type="text" placeholder="Course" id="course" name="course" value="<?php echo $student['course']?>">
                </div>
                <div class="question-container">
                    <p>College *</p>
                    <input type="text" placeholder="College" id="college" name="college" value="<?php echo $student['college']?>">
                </div>
                <div class="question-container">
                    <p>Level *</p>
                    <select id="level" name="level" style="width:20%;">
                        <option value="1" <?php if($student['level'] == "1"){ echo 'selected'; } ?>>1</option>
                        <option value="2" <?php if($student['level'] == "2"){ echo 'selected'; } ?>>2</option>
                        <option value="3" <?php if($student['level'] == "3"){ echo 'selected'; } ?>>3</option>
                        <option value="4" <?php if($student['level'] == "4"){ echo 'selected'; } ?>>4</option>
                    </select>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Schools Attended
                        <span style="font-size:12px;">
                            School, Date of Attendance, Grade/Year Level, and Honors/Awards Received
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="attendedschools" id="attendedschools" form="session-form" placeholder="Write the School, Date of Attendance, Grade/Year Level, and Honors/Awards Received
New Line = New School"><?php echo $student['attendedschools']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>HS Subjects Liked
                        <span style="font-size:12px;">
                            Subject Name, Grade you attained
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="hsliked" id="hsliked" form="session-form" placeholder="Write the Subject Name and the Grade you attained
New Line = New Subject"><?php echo $student['hsliked']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>HS Subjects Disliked
                        <span style="font-size:12px;">
                            Subject Name, Grade you attained
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="hsdisliked" id="hsdisliked" form="session-form" placeholder="Write the Subject Name and the Grade you attained
New Line = New Subject"><?php echo $student['hsdisliked']; ?></textarea>
                </div>
                <div class="question-container">
                    <p>Approximate Highschool Average</p>
                    <input type="number" placeholder="Average" id="hsaverage" name="hsaverage" value="<?php echo $student['hsaverage']?>">
                </div>
                <div class="question-container">
                    <p>Rank In Class</p>
                    <input type="text" placeholder="Class Rank" id="classrank" name="classrank" value="<?php echo $student['classrank']?>">
                </div>
                <div class="question-container">
                    <p>Course previously enrolled in</p>
                    <input type="text" placeholder="Previous Course" id="previouscourse" name="previouscourse" value="<?php echo $student['previouscourse']?>">
                </div>
                <div class="question-container">
                    <p>Reason for Shifting/Transferring</p>
                    <input type="text" placeholder="Reason" id="shiftingreason" name="shiftingreason" value="<?php echo $student['shiftingreason']?>">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Present Educational and Vocational Plans</p>
                    <textarea style="resize:none; height:300px;" name="presentplans" id="presentplans" form="session-form" placeholder="Briefly Write Current Plans"><?php echo $student['presentplans']?></textarea>
                </div>
                <div class="question-container">
                    <p>How did you make this choice?</p>
                    <select id="choicereason" name="choicereason">
                        <option value="Family Suggestion" <?php if($student['choicereason'] == "Family Suggestion"){ echo 'selected'; } ?>>Family Suggestion</option>
                        <option value="Family Tradition" <?php if($student['choicereason'] == "Family Tradition"){ echo 'selected'; } ?>>Family Tradition</option>
                        <option value="Personal Choice" <?php if($student['choicereason'] == "Personal Choice"){ echo 'selected'; } ?>>Personal Choice</option>
                        <option value="Friend's Choice" <?php if($student['choicereason'] == "Friend's Choice"){ echo 'selected'; } ?>>Friend's Choice</option>
                        <option value="Teacher's Choice" <?php if($student['choicereason'] == "Teacher's Choice"){ echo 'selected'; } ?>>Teacher's Choice</option>
                        <option value="Following the vocation of someone I admire" <?php if($student['choicereason'] == "Following the vocation of someone I admire"){ echo 'selected'; } ?>>Following the vocation of someone I admire</option>
                        <option value="Other" <?php if($student['choicereason'] != "Family Suggestion" && $student['choicereason'] != "Family Tradition" && $student['choicereason'] != "Personal Choice" && $student['choicereason'] != "Friend's Choice" && $student['choicereason'] != "Teacher's Choice" && $student['choicereason'] != "Following the vocation of someone I admire"){ echo 'selected'; } ?>>Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify How you chose</p>
                    <input type="text" placeholder="Other" id="choicereasonOther" name="choicereasonOther" value="<?php if($student['choicereason'] != "Family Suggestion" && $student['choicereason'] != "Family Tradition" && $student['choicereason'] != "Personal Choice" && $student['choicereason'] != "Friend's Choice" && $student['choicereason'] != "Teacher's Choice" && $student['choicereason'] != "Following the vocation of someone I admire"){ echo $student['choicereason']; } ?>">
                </div>
                <div class="question-container">
                    <p>How did you come to this school?</p>
                    <select id="schoolchoicereason" name="schoolchoicereason">
                        <option value="Personal Choice" <?php if($student['schoolchoicereason'] == "Personal Choice"){ echo 'selected'; } ?>>Personal Choice</option>
                        <option value="Parent's Choice" <?php if($student['schoolchoicereason'] == "Parent's Choice"){ echo 'selected'; } ?>>Parent's Choice</option>
                        <option value="Friend's Recommendation" <?php if($student['schoolchoicereason'] == "Friend's Recommendation"){ echo 'selected'; } ?>>Friend's Recommendation</option>
                        <option value="Other" <?php if($student['schoolchoicereason'] != "Personal Choice" && $student['schoolchoicereason'] != "Parent's Choice" && $student['schoolchoicereason'] != "Friend's Recommendation"){ echo 'selected'; } ?>>Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify how you came to this school</p>
                    <input type="text" placeholder="Other" id="schoolchoicereasonOther" name="schoolchoicereasonOther" value="<?php if($student['schoolchoicereason'] != "Personal Choice" && $student['schoolchoicereason'] != "Parent's Choice" && $student['schoolchoicereason'] != "Friend's Recommendation"){ echo $student['schoolchoicereason']; } ?>">
                </div>
                <div class="question-container">
                    <p style="font-size:17px;">How much do you know of the requirements of the course you are taking up?</p>
                    <select id="requirementknowledge" name="requirementknowledge">
                        <option value="Very Much" <?php if($student['requirementknowledge'] == "Very Much"){ echo 'selected'; } ?>>Very Much</option>
                        <option value="Much" <?php if($student['requirementknowledge'] == "Much"){ echo 'selected'; } ?>>Much</option>
                        <option value="Enough" <?php if($student['requirementknowledge'] == "Enough"){ echo 'selected'; } ?>>Enough</option>
                        <option value="Very Little" <?php if($student['requirementknowledge'] == "Very Little"){ echo 'selected'; } ?>>Very Little</option>
                        <option value="None" <?php if($student['requirementknowledge'] == "None"){ echo 'selected'; } ?>>None</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>Where did you get this information?</p>
                    <input type="text" placeholder="Where did you get this information?" id="requirementknowledgesource" name="requirementknowledgesource" value="<?php echo $student['requirementknowledgesource']; ?>">
                </div>
                <div class="question-container">
                    <p>Source of Financial Support In College</p>
                    <select id="financialsupport" name="financialsupport">
                        <option value="Family" <?php if($student['financialsupport'] == "Family"){ echo 'selected'; } ?>>Family</option>
                        <option value="Savings" <?php if($student['financialsupport'] == "Savings"){ echo 'selected'; } ?>>Savings</option>
                        <option value="Part-time Work" <?php if($student['financialsupport'] == "Part-time Work"){ echo 'selected'; } ?>>Part-time Work</option>
                        <option value="Government Aid" <?php if($student['financialsupport'] == "Government Aid"){ echo 'selected'; } ?>>Government Aid</option>
                        <option value="Scholarship" <?php if($student['financialsupport'] == "Scholarship"){ echo 'selected'; } ?>>Scholarship</option>
                        <option value="Other"<?php if($student['financialsupport'] != "Family" && $student['financialsupport'] != "Savings" && $student['financialsupport'] != "Part-time Work" && $student['financialsupport'] != "Government Aid" && $student['financialsupport'] != "Scholarship"){ echo 'selected'; } ?>>Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify your source of financial support</p>
                    <input type="text" placeholder="Source of Financial Support" id="financialsupportOther" name="financialsupportOther" value="<?php if($student['financialsupport'] != "Family" && $student['financialsupport'] != "Savings" && $student['financialsupport'] != "Part-time Work" && $student['financialsupport'] != "Government Aid" && $student['financialsupport'] != "Scholarship"){ echo $student['financialsupport']; } ?>">
                </div>
                <div class="question-container">
                    <p style="font-size:17px;">Self-evaluation regarding scholastic standing. Select the one that applies to you</p>
                    <select id="scholasticstanding" name="scholasticstanding">
                        <option value="I barely passed most of my subjects" <?php if($student['scholasticstanding'] == "I barely passed most of my subjects"){ echo 'selected'; } ?>>I barely passed most of my subjects</option>
                        <option value="I failed most of my subjects" <?php if($student['scholasticstanding'] == "I failed most of my subjects"){ echo 'selected'; } ?>>I failed most of my subjects</option>
                        <option value="I am having a hard time passing my subjects" <?php if($student['scholasticstanding'] == "I am having a hard time passing my subjects"){ echo 'selected'; } ?>>I am having a hard time passing my subjects</option>
                        <option value="I have difficulty with some of my subjects" <?php if($student['scholasticstanding'] == "I have difficulty with some of my subjects"){ echo 'selected'; } ?>>I have difficulty with some of my subjects</option>
                        <option value="I fear I am going to fail this semester" <?php if($student['scholasticstanding'] == "I fear I am going to fail this semester"){ echo 'selected'; } ?>>I fear I am going to fail this semester</option>
                        <option value="I am confident I can finish my course" <?php if($student['scholasticstanding'] == "I am confident I can finish my course"){ echo 'selected'; } ?>>I am confident I can finish my course</option>
                        <option value="I am still adjusting to my studies" <?php if($student['scholasticstanding'] == "I am still adjusting to my studies"){ echo 'selected'; } ?>>I am still adjusting to my studies</option>
                    </select>
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
                    <p>Nationality *</p>
                    <input type="text" placeholder="Nationality" id="nationality" name="nationality" value="<?php echo $student['nationality']?>">
                </div>
                <div class="question-container">
                    <p>Religion *</p>
                    <input type="text" placeholder="Religion" id="religion" name="religion" value="<?php echo $student['religion']?>">
                </div>
                <div class="question-container">
                    <p>Ethnicity</p>
                    <input type="text" placeholder="Ethnicity" name="ethnicity" value="<?php echo $student['ethnicity']?>">
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
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Physical Health & Attributes</p>
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
                    <p>Physically Identifiable Marks<span style="font-size:12px;">
                            Glasses, Moles, Etc.
                        </span></p>
                    <input type="text" placeholder="Physical Marks" id="physicalmarks" name="physicalmarks" value="<?php echo $student['physicalmarks']?>">
                </div>
                <div class="question-container">
                    <p>Physical Programs Participated<span style="font-size:12px;">
                            Swimming, Sports, Aerobic Fitness, Weight Lifting, etc.
                        </span></p>
                    <input type="text" placeholder="Physical Programs" id="physicalprograms" name="physicalprograms" value="<?php echo $student['physicalprograms']?>">
                </div>
                <div class="question-container">
                    <p>Physical Ailments that you have<span style="font-size:12px;">
                            Asthma, Allergies, Migraine/Dizziness, etc.
                        </span></p>
                    <input type="text" placeholder="Ailments" id="physicalailments" name="physicalailments" value="<?php echo $student['physicalailments']?>">
                </div>
                <div class="question-container">
                    <p>Where do you currently live?</p>
                    <select id="currentresidence" name="currentresidence">
                        <option value="Home" <?php if($student['currentresidence'] == "Home"){ echo 'selected'; } ?>>Home</option>
                        <option value="Renting a Room" <?php if($student['currentresidence'] == "Renting a Room"){ echo 'selected'; } ?>>Renting a Room</option>
                        <option value="Boarding House" <?php if($student['currentresidence'] == "Boarding House"){ echo 'selected'; } ?>>Boarding House</option>
                        <option value="Living with Relatives" <?php if($student['currentresidence'] == "Living with Relatives"){ echo 'selected'; } ?>>Living with Relatives</option>
                        <option value="Other" <?php if($student['currentresidence'] != "Home" && $student['currentresidence'] != "Renting a Room" && $student['currentresidence'] != "Boarding House" && $student['currentresidence'] != "Living with Relatives"){ echo 'selected'; } ?>>Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify where you currently live</p>
                    <input type="text" placeholder="Current Residence" id="currentresidenceOther" name="currentresidenceOther" value="<?php if($student['currentresidence'] != "Home" && $student['currentresidence'] != "Renting a Room" && $student['currentresidence'] != "Boarding House" && $student['currentresidence'] != "Living with Relatives"){ echo $student['currentresidence']; } ?>">
                </div>
                <div class="question-container">
                    <p>How many persons live in your present place now?</p>
                    <input type="number" placeholder="Number of persons in present place" id="currentresidencenumber" name="currentresidencenumber" value="<?php echo $student['currentresidencenumber']; ?>">
                </div>
                <div class="question-container">
                    <p>How many persons share a room with you?</p>
                    <input type="number" placeholder="Number of persons sharing a room with you" id="shareroomnumber" name="shareroomnumber" value="<?php echo $student['shareroomnumber']; ?>">
                </div>
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Leisure Time Activities</p>
                </div>
                <div class="question-container">
                    <p>Organizations you are currently a member of On Campus</p>
                    <input type="text" placeholder="On campus Organizations" id="campusorganization" name="campusorganization" value="<?php echo $student['campusorganization']; ?>">
                </div>
                <div class="question-container">
                    <p>Organizations you are currently a member of Off Campus</p>
                    <input type="text" placeholder="Off campus Organizations" id="offcampusorganization" name="offcampusorganization" value="<?php echo $student['offcampusorganization']; ?>">
                </div>
                <div class="question-container">
                    <p>Awards Received</p>
                    <input type="text" placeholder="Awards Received" id="awards" name="awards" value="<?php echo $student['awards']; ?>">
                </div>
                <div class="question-container">
                    <p>Organizations</p>
                    <input type="text" placeholder="Organizations" id="organization" name="organization" value="<?php echo $student['organization']; ?>">
                </div>
                <div class="question-container">
                    <p>Hobbies and Interests</p>
                    <input type="text" placeholder="Hobbies and Interests" id="hobby" name="hobby" value="<?php echo $student['hobby']; ?>">
                </div>
                
                <div class="subgroup-label-container">
                    <p class="subgroup-label">General Personality Makeup</p>
                </div>
                <div class="question-container" style="height:auto;">
                    <?php 
                        $arrayName = [
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                            "",
                        ];
                        $arrayTrait = explode(",",$student['traits']);
                        for($k = 0; $k < count($arrayTrait); $k++){
                            $traitNum = $arrayTrait[$k] - 1;
                            $arrayName[$traitNum] = "Check";
                        }
                    ?>
                    <p>Check the Following that Apply</p>
                    <div class="checkbox-container">
                        <input type="checkbox" id="trait1" name="trait1" value="1" <?php if($arrayName[0]!=""){ echo 'checked'; } ?>><label for="vehicle1">Friendly</label>
                        <input type="checkbox" id="trait2" name="trait2" value="2" <?php if($arrayName[1]!=""){ echo 'checked'; } ?>><label for="vehicle1">Unhappy</label>
                        <input type="checkbox" id="trait3" name="trait3" value="3" <?php if($arrayName[2]!=""){ echo 'checked'; } ?>><label for="vehicle1">Cheerful</label>
                        <input type="checkbox" id="trait4" name="trait4" value="4" <?php if($arrayName[3]!=""){ echo 'checked'; } ?>><label for="vehicle1">Reserved</label>
                        <input type="checkbox" id="trait5" name="trait5" value="5" <?php if($arrayName[4]!=""){ echo 'checked'; } ?>><label for="vehicle1">Pessimistic</label>
                        <input type="checkbox" id="trait6" name="trait6" value="6" <?php if($arrayName[5]!=""){ echo 'checked'; } ?>><label for="vehicle1">Lazy</label>
                        <input type="checkbox" id="trait7" name="trait7" value="7" <?php if($arrayName[6]!=""){ echo 'checked'; } ?>><label for="vehicle1">Stubborn</label>
                        <input type="checkbox" id="trait8" name="trait8" value="8" <?php if($arrayName[7]!=""){ echo 'checked'; } ?>><label for="vehicle1">Shy</label>
                        <input type="checkbox" id="trait9" name="trait9" value="9" <?php if($arrayName[8]!=""){ echo 'checked'; } ?>><label for="vehicle1">Submissive</label>
                        <input type="checkbox" id="trait10" name="trait10" value="10" <?php if($arrayName[9]!=""){ echo 'checked'; } ?>><label for="vehicle1">Capable</label>
                        <input type="checkbox" id="trait11" name="trait11" value="11" <?php if($arrayName[10]!=""){ echo 'checked'; } ?>><label for="vehicle1">Self-confident</label>
                        <input type="checkbox" id="trait12" name="trait12" value="12" <?php if($arrayName[11]!=""){ echo 'checked'; } ?>><label for="vehicle1">Excitable</label>
                        <input type="checkbox" id="trait13" name="trait13" value="13" <?php if($arrayName[12]!=""){ echo 'checked'; } ?>><label for="vehicle1">Tolerant</label>
                        <input type="checkbox" id="trait14" name="trait14" value="14" <?php if($arrayName[13]!=""){ echo 'checked'; } ?>><label for="vehicle1">Jealous</label>
                        <input type="checkbox" id="trait15" name="trait15" value="15" <?php if($arrayName[14]!=""){ echo 'checked'; } ?>><label for="vehicle1">Irritable</label>
                        <input type="checkbox" id="trait16" name="trait16" value="16" <?php if($arrayName[15]!=""){ echo 'checked'; } ?>><label for="vehicle1">Calm</label>
                        <input type="checkbox" id="trait17" name="trait17" value="17" <?php if($arrayName[16]!=""){ echo 'checked'; } ?>><label for="vehicle1">Talented</label>
                        <input type="checkbox" id="trait18" name="trait18" value="18" <?php if($arrayName[17]!=""){ echo 'checked'; } ?>><label for="vehicle1">Poor Health</label>
                        <input type="checkbox" id="trait19" name="trait19" value="19" <?php if($arrayName[18]!=""){ echo 'checked'; } ?>><label for="vehicle1">Anxious</label>
                        <input type="checkbox" id="trait20" name="trait20" value="20" <?php if($arrayName[19]!=""){ echo 'checked'; } ?>><label for="vehicle1">Quick-tempered</label>
                        <input type="checkbox" id="trait21" name="trait21" value="21" <?php if($arrayName[20]!=""){ echo 'checked'; } ?>><label for="vehicle1">Frequently Daydreaming</label>
                        <input type="checkbox" id="trait22" name="trait22" value="22" <?php if($arrayName[21]!=""){ echo 'checked'; } ?>><label for="vehicle1">Depressed</label>
                        <input type="checkbox" id="trait23" name="trait23" value="23" <?php if($arrayName[22]!=""){ echo 'checked'; } ?>><label for="vehicle1">Cynical</label>
                        <input type="checkbox" id="trait24" name="trait24" value="24" <?php if($arrayName[23]!=""){ echo 'checked'; } ?>><label for="vehicle1">Tactful</label>
                        <input type="checkbox" id="trait25" name="trait25" value="25" <?php if($arrayName[24]!=""){ echo 'checked'; } ?>><label for="vehicle1">Lovable</label>
                        <input type="checkbox" id="trait26" name="trait26" value="26" <?php if($arrayName[25]!=""){ echo 'checked'; } ?>><label for="vehicle1">Easily Exhausted</label>
                        <input type="checkbox" id="trait27" name="trait27" value="27" <?php if($arrayName[26]!=""){ echo 'checked'; } ?>><label for="vehicle1">Conscientious</label>
                        <input type="checkbox" id="trait28" name="trait28" value="28" <?php if($arrayName[27]!=""){ echo 'checked'; } ?>><label for="vehicle1">Aloof</label>
                        <input type="checkbox" id="trait29" name="trait29" value="29" <?php if($arrayName[28]!=""){ echo 'checked'; } ?>><label for="vehicle1">Quiet</label>
                        <input type="checkbox" id="trait30" name="trait30" value="30" <?php if($arrayName[29]!=""){ echo 'checked'; } ?>><label for="vehicle1">Talkative</label>
                    </div>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Significant Events in your Life</p>
                    <textarea style="resize:none; height:300px;" name="significantevent" id="significantevent" form="session-form" placeholder="Significant Events"><?php echo $student['significantevent']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>What things have caused you most humiliation or sense of failure?</p>
                    <textarea style="resize:none; height:300px;" name="humiliation" id="humiliation" form="session-form" placeholder="Explain Briefly"><?php echo $student['humiliation']; ?></textarea>
                </div>
                <div class="question-container">
                    <p>Have you had any counseling previously?</p>
                    <select id="previouscounseling" name="previouscounseling">
                        <option value="Yes" <?php if($student['previouscounseling'] == "Yes"){ echo 'selected'; } ?>>Yes</option>
                        <option value="No" <?php if($student['previouscounseling'] == "No"){ echo 'selected'; } ?>>No</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>If yes, when?</p>
                    <input type="text" placeholder="Previous Counseling Date" id="previouscounselingdate" name="previouscounselingdate" value="<?php echo $student['previouscounselingdate']; ?>">
                </div>
                <div class="question-container">
                    <p>With Whom?</p>
                    <input type="text" placeholder="Previous Counselor" id="previouscounselingcounselor" name="previouscounselingcounselor" value="<?php echo $student['previouscounselingcounselor']; ?>">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Briefly write what seem to be your particular problems in any area of your life.</p>
                    <textarea style="resize:none; height:300px;" name="lifeproblems" id="lifeproblems" form="session-form" placeholder="Explain Briefly"><?php echo $student['lifeproblems']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>List up to three names of persons connected in this university or community, who know you personally</p>
                    <textarea style="resize:none; height:300px;" name="connectedperson" id="connectedperson" form="session-form" placeholder="Write their Name, Occupation, Address 
New Line = New Person"><?php echo $student['connectedperson']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>What help do you want to obtain from the Guidance and Counseling Center?</p>
                    <textarea style="resize:none; height:300px;" name="helpdetails" id="helpdetails" form="session-form" placeholder="Write Briefly"><?php echo $student['helpdetails']; ?></textarea>
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
                    <p>Fullname *<span style="font-size:12px;">
                            Put + before First Name if deceased
                        </span></p>
                    <div class="form-span">
                        <input class="hidden-input" id="fatherId" name="fatherId" value="<?php echo $father['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="fatherFirstname" name="fatherFirstname" value="<?php echo $father['firstname']?>">
                        <input class="familyname" placeholder="Middlename" id="fatherMiddlename" name="fatherMiddlename" value="<?php echo $father['middlename']?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="fatherLastname" name="fatherLastname" value="<?php echo $father['lastname']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="fatherContact" value="<?php echo $father['contactno']?>">
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
                    <input type="text" placeholder="Occupation" name="fatherOccupation" value="<?php echo $father['occupation']; ?>">
                </div>
                <div class="question-container">
                    <p>Name of Firm/Employer</p>
                    <input type="text" placeholder="Employer" name="fatheremployer" value="<?php echo $father['employer']; ?>">
                </div>
                <div class="question-container">
                    <p>Highest Degree/Grade Attained</p>
                    <input type="text" placeholder="Highest Degree/Grade" name="fatherhighestdegree" value="<?php echo $father['highestdegree']; ?>">
                </div>
                <div class="question-container">
                    <p>Schools Attended</p>
                    <input type="text" placeholder="Schools Attended" name="fatherattendedschools" value="<?php echo $father['attendedschools']; ?>">
                </div>
                <div class="question-container">
                    <p>Hobbies/Interests</p>
                    <input type="text" placeholder="Hobbies / Interests" name="fatherhobby" value="<?php echo $father['hobby']; ?>">
                </div>
                <div class="question-container">
                    <p>Religion</p>
                    <input type="text" placeholder="Religion" name="fatherreligion" value="<?php echo $father['religion']; ?>">
                </div>
                <div class="question-container">
                    <p>Nationality</p>
                    <input type="text" placeholder="Nationality" name="fathernationality" value="<?php echo $father['nationality']; ?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Mother Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *<span style="font-size:12px;">
                            Put + before First Name if deceased
                    </span></p>
                    <div class="form-span">
                        <input class="hidden-input" id="motherId" name="motherId" value="<?php echo $mother['id']; ?>">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="motherFirstname" name="motherFirstname" value="<?php echo $mother['firstname']?>">
                        <input class="familyname" placeholder="Middlename" id="motherMiddlename" name="motherMiddlename" value="<?php echo $mother['middlename']?>">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="motherLastname" name="motherLastname" value="<?php echo $mother['lastname']?>">
                    </div>
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="motherContact" value="<?php echo $mother['contactno']?>">
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
                    <p>Name of Firm/Employer</p>
                    <input type="text" placeholder="Employer" name="motheremployer" value="<?php echo $mother['employer']; ?>">
                </div>
                <div class="question-container">
                    <p>Highest Degree/Grade Attained</p>
                    <input type="text" placeholder="Highest Degree/Grade" name="motherhighestdegree" value="<?php echo $mother['highestdegree']; ?>">
                </div>
                <div class="question-container">
                    <p>Schools Attended</p>
                    <input type="text" placeholder="Schools Attended" name="motherattendedschools" value="<?php echo $mother['attendedschools']; ?>">
                </div>
                <div class="question-container">
                    <p>Hobbies/Interests</p>
                    <input type="text" placeholder="Hobbies / Interests" name="motherhobby" value="<?php echo $mother['hobby']; ?>">
                </div>
                <div class="question-container">
                    <p>Religion</p>
                    <input type="text" placeholder="Religion" name="motherreligion" value="<?php echo $mother['religion']; ?>">
                </div>
                <div class="question-container">
                    <p>Nationality</p>
                    <input type="text" placeholder="Nationality" name="mothernationality" value="<?php echo $mother['nationality']; ?>">
                </div>
                <div class="question-container">
                    <p>Which of His / Her Traits would you like to have?</p>
                    <input type="text" placeholder="Parent Traits" name="parenttraits" value="<?php echo $student['parenttraits']; ?>">
                </div>
                <div class="question-container">
                    <p>With whom would you rather discuss your problem?</p>
                    <input type="text" placeholder="Parent" name="preferredparent" value="<?php echo $student['preferredparent']; ?>">
                </div>
                <div class="question-container">
                    <p>Marital Status of Parents</p>
                    <select id="parentmaritalstatus" name="parentmaritalstatus">
                        <option value="Parents married in the Church/Mosque" <?php if($student['parentmaritalstatus'] == "Parents married in the Church/Mosque"){ echo 'selected'; } ?>>Parents married in the Church/Mosque</option>
                        <option value="Parents married civilly" <?php if($student['parentmaritalstatus'] == "Parents married civilly"){ echo 'selected'; } ?>>Parents married civilly</option>
                        <option value="Parents living together" <?php if($student['parentmaritalstatus'] == "Parents living together"){ echo 'selected'; } ?>>Parents living together</option>
                        <option value="Parents separated" <?php if($student['parentmaritalstatus'] == "Parents separated"){ echo 'selected'; } ?>>Parents separated</option>
                        <option value="Father remarried" <?php if($student['parentmaritalstatus'] == "Father remarried"){ echo 'selected'; } ?>>Father remarried</option>
                        <option value="Mother remarried" <?php if($student['parentmaritalstatus'] == "Mother remarried"){ echo 'selected'; } ?>>Mother remarried</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>Language or Dialects spoken at home</p>
                    <input type="text" placeholder="Home Languages" name="homelanguage" value="<?php echo $student['homelanguage']; ?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">No. of Persons Living at Home</p>
                </div>
                <div class="question-container">
                    <p>Members of Family</p>
                    <input type="number" placeholder="No. of Family living at home" name="familyathome" value="<?php echo $student['familyathome']; ?>">
                </div>
                <div class="question-container">
                    <p>Relatives</p>
                    <input type="number" placeholder="No. of Extended Relatives living at home" name="relativesathome" value="<?php echo $student['relativesathome']; ?>">
                </div>
                <div class="question-container">
                    <p>Children</p>
                    <input type="number" placeholder="No. of your children (if any) living at home" name="childrenathome" value="<?php echo $student['childrenathome']; ?>">
                </div>
                <div class="question-container">
                    <p>House Helpers</p>
                    <input type="number" placeholder="No. of Helpers living at home" name="helpersathome" value="<?php echo $student['helpersathome']; ?>">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Guardian Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *<span style="font-size:12px;">
                            Person to contact in case of emergency
                        </span></p>
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
                <div class="question-container" style="height:160px;">
                    <p>Children (If any)
                        <span style="font-size:12px;">
                            Name, School/Occupation, Grade/Year or Firm/Employer
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="children" id="children" form="session-form" placeholder="Write their Name, School/Occupation, Grade/Year or Firm/Employer 
New Line = New Person"><?php echo $student['children']; ?></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Siblings (If any)
                        <span style="font-size:12px;">
                            Name, Sex, Civil Status, Age, School/Occupation, Grade/Year or Firm/Employer
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="siblings" id="siblings" form="session-form" placeholder="Write their Name, Sex, Civil Status, Age, School/Occupation, Grade/Year or Firm/Employer 
New Line = New Person"><?php echo $student['siblings']; ?></textarea>
                </div>
                <div class="subgroup-label-container family-label-container" style="margin-bottom:10px;display:none;">
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
                <div class="question-container sibling-table-container" style="height:200px;display:none;">
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
                <button onclick="studentProfile()" type="button" class="normal-button" style="width:80px; height:40px; margin-right:10px;">
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
        <script src="js/student-info-form.js"></script>
        <script src="js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>      
    </body>
</html>