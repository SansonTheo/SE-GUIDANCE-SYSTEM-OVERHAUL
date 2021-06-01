
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
                </div>No Username Yet</div>
            <div class="user-div">
                <ul>
                    <li onclick="studentProfile()">Profile</li>
                    <li>Contact Us</li>
                    <li onclick="logout()">Logout</li>
                </ul>
            </div>
            <div class="btn-toggle-nav p-0"  onclick="toggleNav()"><img src="imgs/icon-menu.png" style="height:80%; width:80%;"></div>
            <div class="seal-container"><img src="imgs/wmsu-seal.png"></div>
            <div>Add Personal Data Sheet</div>
        </div>
        <form onsubmit="return validateForm()" id="session-form" method="post" action="addStudent.php" class="center-container">
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
                    <p>Place of Birth</p>
                    <input type="text" placeholder="Place of Birth" id="placeofbirth" name="placeofbirth">
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
                    <p>Course *</p>
                    <input type="text" placeholder="Course" id="course" name="course">
                </div>
                <div class="question-container">
                    <p>College *</p>
                    <input type="text" placeholder="College" id="college" name="college">
                </div>
                <div class="question-container">
                    <p>Level *</p>
                    <select id="level" name="level" style="width:20%;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Schools Attended
                        <span style="font-size:12px;">
                            School, Date of Attendance, Grade/Year Level, and Honors/Awards Received
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="attendedschools" id="attendedschools" form="session-form" placeholder="Write the School, Date of Attendance, Grade/Year Level, and Honors/Awards Received
New Line = New School"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>HS Subjects Liked
                        <span style="font-size:12px;">
                            Subject Name, Grade you attained
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="hsliked" id="hsliked" form="session-form" placeholder="Write the Subject Name and the Grade you attained
New Line = New Subject"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>HS Subjects Disliked
                        <span style="font-size:12px;">
                            Subject Name, Grade you attained
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="hsdisliked" id="hsdisliked" form="session-form" placeholder="Write the Subject Name and the Grade you attained
New Line = New Subject"></textarea>
                </div>
                <div class="question-container">
                    <p>Approximate Highschool Average</p>
                    <input type="number" placeholder="Average" id="hsaverage" name="hsaverage">
                </div>
                <div class="question-container">
                    <p>Rank In Class</p>
                    <input type="text" placeholder="Class Rank" id="classrank" name="classrank">
                </div>
                <div class="question-container">
                    <p>Course previously enrolled in</p>
                    <input type="text" placeholder="Previous Course" id="previouscourse" name="previouscourse">
                </div>
                <div class="question-container">
                    <p>Reason for Shifting/Transferring</p>
                    <input type="text" placeholder="Reason" id="shiftingreason" name="shiftingreason">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Present Educational and Vocational Plans</p>
                    <textarea style="resize:none; height:300px;" name="presentplans" id="presentplans" form="session-form" placeholder="Briefly Write Current Plans"></textarea>
                </div>
                <div class="question-container">
                    <p>How did you make this choice?</p>
                    <select id="choicereason" name="choicereason">
                        <option value="Family Suggestion">Family Suggestion</option>
                        <option value="Family Tradition">Family Tradition</option>
                        <option value="Personal Choice">Personal Choice</option>
                        <option value="Friend's Choice">Friend's Choice</option>
                        <option value="Teacher's Choice">Teacher's Choice</option>
                        <option value="Following the vocation of someone I admire">Following the vocation of someone I admire</option>
                        <option value="Other">Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify How you chose</p>
                    <input type="text" placeholder="Other" id="choicereasonOther" name="choicereasonOther">
                </div>
                <div class="question-container">
                    <p>How did you come to this school?</p>
                    <select id="schoolchoicereason" name="schoolchoicereason">
                        <option value="Personal Choice">Personal Choice</option>
                        <option value="Parent's Choice">Parent's Choice</option>
                        <option value="Friend's Recommendation">Friend's Recommendation</option>
                        <option value="Other">Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify how you came to this school</p>
                    <input type="text" placeholder="Other" id="schoolchoicereasonOther" name="schoolchoicereasonOther">
                </div>
                <div class="question-container">
                    <p style="font-size:17px;">How much do you know of the requirements of the course you are taking up?</p>
                    <select id="requirementknowledge" name="requirementknowledge">
                        <option value="Very Much">Very Much</option>
                        <option value="Much">Much</option>
                        <option value="Enough">Enough</option>
                        <option value="Very Little">Very Little</option>
                        <option value="None">None</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>Where did you get this information?</p>
                    <input type="text" placeholder="Where did you get this information?" id="requirementknowledgesource" name="requirementknowledgesource">
                </div>
                <div class="question-container">
                    <p>Source of Financial Support In College</p>
                    <select id="financialsupport" name="financialsupport">
                        <option value="Family">Family</option>
                        <option value="Savings">Savings</option>
                        <option value="Part-time Work">Part-time Work</option>
                        <option value="Government Aid">Government Aid</option>
                        <option value="Scholarship">Scholarship</option>
                        <option value="Other">Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify your source of financial support</p>
                    <input type="text" placeholder="Source of Financial Support" id="financialsupportOther" name="financialsupportOther">
                </div>
                <div class="question-container">
                    <p style="font-size:17px;">Self-evaluation regarding scholastic standing. Select the one that applies to you</p>
                    <select id="scholasticstanding" name="scholasticstanding">
                        <option value="I barely passed most of my subjects">I barely passed most of my subjects</option>
                        <option value="I failed most of my subjects">I failed most of my subjects</option>
                        <option value="I am having a hard time passing my subjects">I am having a hard time passing my subjects</option>
                        <option value="I have difficulty with some of my subjects">I have difficulty with some of my subjects</option>
                        <option value="I fear I am going to fail this semester">I fear I am going to fail this semester</option>
                        <option value="I am confident I can finish my course">I am confident I can finish my course</option>
                        <option value="I am still adjusting to my studies">I am still adjusting to my studies</option>
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
                        <input type="radio" name="sex" value="Male">
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="sex" value="Female">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="question-container">
                    <p>Nationality *</p>
                    <input type="text" placeholder="Nationality" id="nationality" name="nationality">
                </div>
                <div class="question-container">
                    <p>Religion *</p>
                    <input type="text" placeholder="Religion" id="religion" name="religion">
                </div>
                <div class="question-container">
                    <p>Ethnicity</p>
                    <input type="text" placeholder="Ethnicity" name="ethnicity">
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
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Physical Health & Attributes</p>
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
                    <p>Physically Identifiable Marks<span style="font-size:12px;">
                            Glasses, Moles, Etc.
                        </span></p>
                    <input type="text" placeholder="Physical Marks" id="physicalmarks" name="physicalmarks">
                </div>
                <div class="question-container">
                    <p>Physical Programs Participated<span style="font-size:12px;">
                            Swimming, Sports, Aerobic Fitness, Weight Lifting, etc.
                        </span></p>
                    <input type="text" placeholder="Physical Programs" id="physicalprograms" name="physicalprograms">
                </div>
                <div class="question-container">
                    <p>Physical Ailments that you have<span style="font-size:12px;">
                            Asthma, Allergies, Migraine/Dizziness, etc.
                        </span></p>
                    <input type="text" placeholder="Ailments" id="physicalailments" name="physicalailments">
                </div>
                <div class="question-container">
                    <p>Where do you currently live?</p>
                    <select id="currentresidence" name="currentresidence">
                        <option value="Home">Home</option>
                        <option value="Renting a Room">Renting a Room</option>
                        <option value="Boarding House">Boarding House</option>
                        <option value="Living with Relatives">Living with Relatives</option>
                        <option value="Other">Other (Specify Below)</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>(Other) Specify where you currently live</p>
                    <input type="text" placeholder="Current Residence" id="currentresidenceOther" name="currentresidenceOther">
                </div>
                <div class="question-container">
                    <p>How many persons live in your present place now?</p>
                    <input type="number" placeholder="Number of persons in present place" id="currentresidencenumber" name="currentresidencenumber">
                </div>
                <div class="question-container">
                    <p>How many persons share a room with you?</p>
                    <input type="number" placeholder="Number of persons sharing a room with you" id="shareroomnumber" name="shareroomnumber">
                </div>
                <div class="subgroup-label-container">
                    <p class="subgroup-label">Leisure Time Activities</p>
                </div>
                <div class="question-container">
                    <p>Organizations you are currently a member of On Campus</p>
                    <input type="text" placeholder="On campus Organizations" id="campusorganization" name="campusorganization">
                </div>
                <div class="question-container">
                    <p>Organizations you are currently a member of Off Campus</p>
                    <input type="text" placeholder="Off campus Organizations" id="offcampusorganization" name="offcampusorganization">
                </div>
                <div class="question-container">
                    <p>Awards Received</p>
                    <input type="text" placeholder="Awards Received" id="awards" name="awards">
                </div>
                <div class="question-container">
                    <p>Organizations</p>
                    <input type="text" placeholder="Organizations" id="organization" name="organization">
                </div>
                <div class="question-container">
                    <p>Hobbies and Interests</p>
                    <input type="text" placeholder="Hobbies and Interests" id="hobby" name="hobby">
                </div>
                <div class="subgroup-label-container">
                    <p class="subgroup-label">General Personality Makeup</p>
                </div>
                <div class="question-container" style="height:auto;">
                    <p>Check the Following that Apply</p>
                    <div class="checkbox-container">
                        <input type="checkbox" id="trait1" name="trait1" value="1"><label for="vehicle1">Friendly</label>
                        <input type="checkbox" id="trait2" name="trait2" value="2"><label for="vehicle1">Unhappy</label>
                        <input type="checkbox" id="trait3" name="trait3" value="3"><label for="vehicle1">Cheerful</label>
                        <input type="checkbox" id="trait4" name="trait4" value="4"><label for="vehicle1">Reserved</label>
                        <input type="checkbox" id="trait5" name="trait5" value="5"><label for="vehicle1">Pessimistic</label>
                        <input type="checkbox" id="trait6" name="trait6" value="6"><label for="vehicle1">Lazy</label>
                        <input type="checkbox" id="trait7" name="trait7" value="7"><label for="vehicle1">Stubborn</label>
                        <input type="checkbox" id="trait8" name="trait8" value="8"><label for="vehicle1">Shy</label>
                        <input type="checkbox" id="trait9" name="trait9" value="9"><label for="vehicle1">Submissive</label>
                        <input type="checkbox" id="trait10" name="trait10" value="10"><label for="vehicle1">Capable</label>
                        <input type="checkbox" id="trait11" name="trait11" value="11"><label for="vehicle1">Self-confident</label>
                        <input type="checkbox" id="trait12" name="trait12" value="12"><label for="vehicle1">Excitable</label>
                        <input type="checkbox" id="trait13" name="trait13" value="13"><label for="vehicle1">Tolerant</label>
                        <input type="checkbox" id="trait14" name="trait14" value="14"><label for="vehicle1">Jealous</label>
                        <input type="checkbox" id="trait15" name="trait15" value="15"><label for="vehicle1">Irritable</label>
                        <input type="checkbox" id="trait16" name="trait16" value="16"><label for="vehicle1">Calm</label>
                        <input type="checkbox" id="trait17" name="trait17" value="17"><label for="vehicle1">Talented</label>
                        <input type="checkbox" id="trait18" name="trait18" value="18"><label for="vehicle1">Poor Health</label>
                        <input type="checkbox" id="trait19" name="trait19" value="19"><label for="vehicle1">Anxious</label>
                        <input type="checkbox" id="trait20" name="trait20" value="20"><label for="vehicle1">Quick-tempered</label>
                        <input type="checkbox" id="trait21" name="trait21" value="21"><label for="vehicle1">Frequently Daydreaming</label>
                        <input type="checkbox" id="trait22" name="trait22" value="22"><label for="vehicle1">Depressed</label>
                        <input type="checkbox" id="trait23" name="trait23" value="23"><label for="vehicle1">Cynical</label>
                        <input type="checkbox" id="trait24" name="trait24" value="24"><label for="vehicle1">Tactful</label>
                        <input type="checkbox" id="trait25" name="trait25" value="25"><label for="vehicle1">Lovable</label>
                        <input type="checkbox" id="trait26" name="trait26" value="26"><label for="vehicle1">Easily Exhausted</label>
                        <input type="checkbox" id="trait27" name="trait27" value="27"><label for="vehicle1">Conscientious</label>
                        <input type="checkbox" id="trait28" name="trait28" value="28"><label for="vehicle1">Aloof</label>
                        <input type="checkbox" id="trait29" name="trait29" value="29"><label for="vehicle1">Quiet</label>
                        <input type="checkbox" id="trait30" name="trait30" value="30"><label for="vehicle1">Talkative</label>
                    </div>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Significant Events in your Life</p>
                    <textarea style="resize:none; height:300px;" name="significantevent" id="significantevent" form="session-form" placeholder="Significant Events"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>What things have caused you most humiliation or sense of failure?</p>
                    <textarea style="resize:none; height:300px;" name="humiliation" id="humiliation" form="session-form" placeholder="Explain Briefly"></textarea>
                </div>
                <div class="question-container">
                    <p>Have you had any counseling previously?</p>
                    <select id="previouscounseling" name="previouscounseling">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>If yes, when?</p>
                    <input type="text" placeholder="Previous Counseling Date" id="previouscounselingdate" name="previouscounselingdate">
                </div>
                <div class="question-container">
                    <p>With Whom?</p>
                    <input type="text" placeholder="Previous Counselor" id="previouscounselingcounselor" name="previouscounselingcounselor">
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Briefly write what seem to be your particular problems in any area of your life.</p>
                    <textarea style="resize:none; height:300px;" name="lifeproblems" id="lifeproblems" form="session-form" placeholder="Explain Briefly"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>List up to three names of persons connected in this university or community, who know you personally</p>
                    <textarea style="resize:none; height:300px;" name="connectedperson" id="connectedperson" form="session-form" placeholder="Write their Name, Occupation, Address 
New Line = New Person"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>What help do you want to obtain from the Guidance and Counseling Center?</p>
                    <textarea style="resize:none; height:300px;" name="helpdetails" id="helpdetails" form="session-form" placeholder="Write Briefly"></textarea>
                </div>
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
                    <p>Fullname *<span style="font-size:12px;">
                            Put + before First Name if deceased
                        </span></p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="fatherFirstname" name="fatherFirstname">
                        <input class="familyname" placeholder="Middlename" id="fatherMiddlename" name="fatherMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="fatherLastname" name="fatherLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="fatherContact">
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
                    <p>Name of Firm/Employer</p>
                    <input type="text" placeholder="Employer" name="fatheremployer">
                </div>
                <div class="question-container">
                    <p>Highest Degree/Grade Attained</p>
                    <input type="text" placeholder="Highest Degree/Grade" name="fatherhighestdegree">
                </div>
                <div class="question-container">
                    <p>Schools Attended</p>
                    <input type="text" placeholder="Schools Attended" name="fatherattendedschools">
                </div>
                <div class="question-container">
                    <p>Hobbies/Interests</p>
                    <input type="text" placeholder="Hobbies / Interests" name="fatherhobby">
                </div>
                <div class="question-container">
                    <p>Religion</p>
                    <input type="text" placeholder="Religion" name="fatherreligion">
                </div>
                <div class="question-container">
                    <p>Nationality</p>
                    <input type="text" placeholder="Nationality" name="fathernationality">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Mother Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname * <span style="font-size:12px;">
                            Put + before First Name if deceased
                        </span></p>
                    <div class="form-span">
                        <input class="familyname" placeholder="Firstname" style="margin-left:0px;" id="motherFirstname" name="motherFirstname">
                        <input class="familyname" placeholder="Middlename" id="motherMiddlename" name="motherMiddlename">
                        <input class="familyname" placeholder="Lastname" style="margin-right:0px;" id="motherLastname" name="motherLastname">
                    </div>
                </div>
                <div class="question-container">
                    <p>Contact Number</p>
                    <input type="text" placeholder="Contact Number" name="motherContact">
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
                    <p>Name of Firm/Employer</p>
                    <input type="text" placeholder="Employer" name="motheremployer">
                </div>
                <div class="question-container">
                    <p>Highest Degree/Grade Attained</p>
                    <input type="text" placeholder="Highest Degree/Grade" name="motherhighestdegree">
                </div>
                <div class="question-container">
                    <p>Schools Attended</p>
                    <input type="text" placeholder="Schools Attended" name="motherattendedschools">
                </div>
                <div class="question-container">
                    <p>Hobbies/Interests</p>
                    <input type="text" placeholder="Hobbies / Interests" name="motherhobby">
                </div>
                <div class="question-container">
                    <p>Religion</p>
                    <input type="text" placeholder="Religion" name="motherreligion">
                </div>
                <div class="question-container">
                    <p>Nationality</p>
                    <input type="text" placeholder="Nationality" name="mothernationality">
                </div>
                <div class="question-container">
                    <p>Which of His / Her Traits would you like to have?</p>
                    <input type="text" placeholder="Parent Traits" name="parenttraits">
                </div>
                <div class="question-container">
                    <p>With whom would you rather discuss your problem?</p>
                    <input type="text" placeholder="Parent" name="preferredparent">
                </div>
                <div class="question-container">
                    <p>Marital Status of Parents</p>
                    <select id="parentmaritalstatus" name="parentmaritalstatus">
                        <option value="Parents married in the Church/Mosque">Parents married in the Church/Mosque</option>
                        <option value="Parents married civilly">Parents married civilly</option>
                        <option value="Parents living together">Parents living together</option>
                        <option value="Parents separated">Parents separated</option>
                        <option value="Father remarried">Father remarried</option>
                        <option value="Mother remarried">Mother remarried</option>
                    </select>
                </div>
                <div class="question-container">
                    <p>Language or Dialects spoken at home</p>
                    <input type="text" placeholder="Home Languages" name="homelanguage">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">No. of Persons Living at Home</p>
                </div>
                <div class="question-container">
                    <p>Members of Family</p>
                    <input type="number" placeholder="No. of Family living at home" name="familyathome">
                </div>
                <div class="question-container">
                    <p>Relatives</p>
                    <input type="number" placeholder="No. of Extended Relatives living at home" name="relativesathome">
                </div>
                <div class="question-container">
                    <p>Children</p>
                    <input type="number" placeholder="No. of your children (if any) living at home" name="childrenathome">
                </div>
                <div class="question-container">
                    <p>House Helpers</p>
                    <input type="number" placeholder="No. of Helpers living at home" name="helpersathome">
                </div>
                <div class="subgroup-label-container family-label-container">
                    <p class="subgroup-label family-label">Guardian Information *</p>
                </div>
                <div class="question-container">
                    <p>Fullname *<span style="font-size:12px;">
                            Person to contact in case of emergency
                        </span></p>
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
                <div class="question-container" style="height:160px;">
                    <p>Children (If any)
                        <span style="font-size:12px;">
                            Name, School/Occupation, Grade/Year or Firm/Employer
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="children" id="children" form="session-form" placeholder="Write their Name, School/Occupation, Grade/Year or Firm/Employer 
New Line = New Person"></textarea>
                </div>
                <div class="question-container" style="height:160px;">
                    <p>Siblings (If any)
                        <span style="font-size:12px;">
                            Name, Sex, Civil Status, Age, School/Occupation, Grade/Year or Firm/Employer
                        </span>
                    </p>
                    <textarea style="resize:none; height:300px;" name="siblings" id="siblings" form="session-form" placeholder="Write their Name, Sex, Civil Status, Age, School/Occupation, Grade/Year or Firm/Employer 
New Line = New Person"></textarea>
                </div>
            </div>
            <div class="subgroup-container buttons">
                <button type="submit" class="action-button" style="width:100px; height:40px;">
                    <div class="action-button-label">
                        Submit
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
        <script src="js/student-info-form.js"></script>
    </body>
</html>