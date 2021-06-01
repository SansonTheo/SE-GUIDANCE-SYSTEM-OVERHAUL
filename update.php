<?php
    include "server.php";
    $id = mysqli_real_escape_string($link,$_POST['id']);

    $changed = "Changed ";
	$from = " from ";
	$to = " to ";
    
    //SPOUSE UPDATE
        $spouseId = mysqli_real_escape_string($link,$_POST['spouseId']);
        $spouseFirstname = mysqli_real_escape_string($link,$_POST['spouseFirstname']);
        $spouseLastname = mysqli_real_escape_string($link,$_POST['spouseLastname']);
        if($spouseId == "" && $spouseFirstname != "" && $spouseLastname != ""){ //Adds Spouse (Newly Married)
            $changestr = "Added Spouse ".$spouseFirstname." ".$spouseLastname;
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
            mysqli_query($link,$changequery);
            $civilstatus = "Married";
            echo $civilstatus;
        }
        else if($spouseId != "" && $spouseFirstname == "" && $spouseLastname == ""){ //Removes Spouse (Newly Separated) :(
            $record = mysqli_query($link,"SELECT * FROM spouse WHERE id=$spouseId");
            $spouse = mysqli_fetch_array($record);
            $changestr = "Removed Spouse ".$spouse['firstname']." ".$spouse['lastname'];
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
            mysqli_query($link,$changequery);
            $civilstatus = "Single";
            echo $civilstatus;
        }
        else if($spouseId != "" && $spouseFirstname != "" && $spouseLastname != ""){ //Updates Spouse Already Married
            $record = mysqli_query($link,"SELECT * FROM spouse WHERE id=$spouseId");
            $spouse = mysqli_fetch_array($record);
            $spouseNew = array(
                mysqli_real_escape_string($link,$_POST['spouseFirstname']),
                mysqli_real_escape_string($link,$_POST['spouseMiddlename']),
                mysqli_real_escape_string($link,$_POST['spouseLastname']),
                mysqli_real_escape_string($link,$_POST['spouseStreet']),
                mysqli_real_escape_string($link,$_POST['spouseBarangay']),
                mysqli_real_escape_string($link,$_POST['spouseCity']),
                mysqli_real_escape_string($link,$_POST['spouseProvince']),
                mysqli_real_escape_string($link,$_POST['spouseOccupation']),
                mysqli_real_escape_string($link,$_POST['spouseContact'])
            );
            $spouseOld = array(
                $spouse['firstname'],
                $spouse['middlename'],
                $spouse['lastname'],
                $spouse['street'],
                $spouse['barangay'],
                $spouse['city'],
                $spouse['province'],
                $spouse['occupation'],
                $spouse['contactno']
            );
            $spouseCategory = array(
                "Spouse Firstname",
                "Spouse Middlename",
                "Spouse Middlename",
                "Spouse ".$spouseNew[0]."'s Street",
                "Spouse ".$spouseNew[0]."'s Barangay",
                "Spouse ".$spouseNew[0]."'s City",
                "Spouse ".$spouseNew[0]."'s Province",
                "Spouse ".$spouseNew[0]."'s Occupation",
                "Spouse ".$spouseNew[0]."'s Contact"
            );
            $civilstatus = "Married";
            $spouseArrLength = count($spouseCategory);
            for($i = 0; $i < $spouseArrLength; $i++){
                if(stripslashes($spouseNew[$i]) != $spouseOld[$i]){
                    $changestr = addslashes($changed.$spouseCategory[$i].$from.$spouseOld[$i].$to.$spouseNew[$i]);
                    $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
                    mysqli_query($link,$changequery);
                }
            }
            echo $civilstatus;
        }
        else{
            $civilstatus = "Single";
            echo $civilstatus;
        }
    //END SPOUSE UPDATE

    $studentNew = array(
        mysqli_real_escape_string($link,$_POST['firstname']), 
        mysqli_real_escape_string($link,$_POST['middlename']),
        mysqli_real_escape_string($link,$_POST['lastname']),
        mysqli_real_escape_string($link,$_POST['birthDate']),
        mysqli_real_escape_string($link,$_POST['contact']),
        mysqli_real_escape_string($link,$_POST['street']),
        mysqli_real_escape_string($link,$_POST['barangay']),
        mysqli_real_escape_string($link,$_POST['city']),
        mysqli_real_escape_string($link,$_POST['province']),
        mysqli_real_escape_string($link,$_POST['boarderStreet']),
        mysqli_real_escape_string($link,$_POST['boarderBarangay']),
        mysqli_real_escape_string($link,$_POST['boarderCity']),
        mysqli_real_escape_string($link,$_POST['boarderProvince']),
        mysqli_real_escape_string($link,$_POST['studentId']),
        mysqli_real_escape_string($link,$_POST['college']),
        mysqli_real_escape_string($link,$_POST['department']),
        mysqli_real_escape_string($link,$_POST['level']),
        mysqli_real_escape_string($link,$_POST['sex']),
        mysqli_real_escape_string($link,$_POST['gender']),
        mysqli_real_escape_string($link,$_POST['height']),
        mysqli_real_escape_string($link,$_POST['weight']),
        mysqli_real_escape_string($link,$_POST['complexion']),
        mysqli_real_escape_string($link,$_POST['ethnicity']),
        mysqli_real_escape_string($link,$_POST['nationality']),
        mysqli_real_escape_string($link,$_POST['religion']),
        $civilstatus
    );

    $record = mysqli_query($link,"SELECT * FROM student WHERE id=$id");
    $student = mysqli_fetch_array($record);
    $studentOld = array(
        $student['firstname'], 
        $student['middlename'],
        $student['lastname'],
        $student['birthdate'],
        $student['contactno'],
        $student['permstreet'],
        $student['permbarangay'],
        $student['permcity'],
        $student['permprovince'],
        $student['tempstreet'],
        $student['tempbarangay'],
        $student['tempcity'],
        $student['tempprovince'],
        $student['studentid'],
        $student['college'],
        $student['department'],
        $student['level'],
        $student['sex'],
        $student['gender'],
        $student['height'],
        $student['weight'],
        $student['complexion'],
        $student['ethnicity'],
        $student['nationality'],
        $student['religion'],
        $student['civilstatus']
    );

    $studentCategory = array(
        "Firstname",
        "Middlename",
        "Lastname",
        "Birthdate",
        "Contact No.",
        "Street",
        "Barangay",
        "City",
        "Province",
        "Temp. Street",
        "Temp. Barangay",
        "Temp. City",
        "Temp. Province",
        "Student ID",
        "College",
        "Department",
        "Level",
        "Sex",
        "Gender",
        "Height",
        "Weight",
        "Complexion",
        "Ethnicity",
        "Nationality",
        "Religion",
        "Civil Status"
    );

    $arrLength = count($studentNew);
    for($i = 0; $i < $arrLength; $i++){
        if(stripslashes($studentNew[$i]) != $studentOld[$i]){
            $changestr = $changed.$studentCategory[$i].$from.addslashes($studentOld[$i]).$to.$studentNew[$i];
		    $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
		    mysqli_query($link,$changequery);
        }
    }

    //FATHER UPDATE
    $fatherNew = array(
        mysqli_real_escape_string($link,$_POST['fatherFirstname']),
        mysqli_real_escape_string($link,$_POST['fatherMiddlename']),
        mysqli_real_escape_string($link,$_POST['fatherLastname']),
        mysqli_real_escape_string($link,$_POST['fatherStreet']),
        mysqli_real_escape_string($link,$_POST['fatherBarangay']),
        mysqli_real_escape_string($link,$_POST['fatherCity']),
        mysqli_real_escape_string($link,$_POST['fatherProvince']),
        mysqli_real_escape_string($link,$_POST['fatherOccupation']),
        mysqli_real_escape_string($link,$_POST['fatherContact'])
    );

    $fatherId = mysqli_real_escape_string($link,$_POST['fatherId']);
    $record = mysqli_query($link,"SELECT * FROM parent WHERE id=$fatherId");
    $father = mysqli_fetch_array($record);
    $fatherOld = array(
        $father['firstname'],
        $father['middlename'],
        $father['lastname'],
        $father['street'],
        $father['barangay'],
        $father['city'],
        $father['province'],
        $father['occupation'],
        $father['contactno']
    );
    
    $fatherCategory = array(
        "Firstname",
        "Middlename",
        "Lastname",
        "Parent ".$fatherNew[0]."'s Street",
        "Parent ".$fatherNew[0]."'s Barangay",
        "Parent ".$fatherNew[0]."'s City",
        "Parent ".$fatherNew[0]."'s Province",
        "Parent ".$fatherNew[0]."'s Occupation",
        "Parent ".$fatherNew[0]."'s Contact No."
    );

    $fatherArrLength = count($fatherCategory);
    for($i = 0; $i < $fatherArrLength; $i++){
        if(stripslashes($fatherNew[$i]) != $fatherOld[$i]){
            $changestr = addslashes($changed.$fatherCategory[$i].$from.$fatherOld[$i].$to.$fatherNew[$i]);
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
		    mysqli_query($link,$changequery);
        }
    }
    //END FATHER UPDATE

    //MOTHER UPDATE
    $motherNew = array(
        mysqli_real_escape_string($link,$_POST['motherFirstname']),
        mysqli_real_escape_string($link,$_POST['motherMiddlename']),
        mysqli_real_escape_string($link,$_POST['motherLastname']),
        mysqli_real_escape_string($link,$_POST['motherStreet']),
        mysqli_real_escape_string($link,$_POST['motherBarangay']),
        mysqli_real_escape_string($link,$_POST['motherCity']),
        mysqli_real_escape_string($link,$_POST['motherProvince']),
        mysqli_real_escape_string($link,$_POST['motherOccupation']),
        mysqli_real_escape_string($link,$_POST['motherContact'])
    );

    $motherId = mysqli_real_escape_string($link,$_POST['motherId']);
    $record = mysqli_query($link,"SELECT * FROM parent WHERE id=$motherId");
    $mother = mysqli_fetch_array($record);
    $motherOld = array(
        $mother['firstname'],
        $mother['middlename'],
        $mother['lastname'],
        $mother['street'],
        $mother['barangay'],
        $mother['city'],
        $mother['province'],
        $mother['occupation'],
        $mother['contactno']
    );
    
    $motherCategory = array(
        "Firstname",
        "Middlename",
        "Lastname",
        "Parent ".$motherNew[0]."'s Street",
        "Parent ".$motherNew[0]."'s Barangay",
        "Parent ".$motherNew[0]."'s City",
        "Parent ".$motherNew[0]."'s Province",
        "Parent ".$motherNew[0]."'s Occupation",
        "Parent ".$motherNew[0]."'s Contact No."
    );

    $motherArrLength = count($motherCategory);
    for($i = 0; $i < $motherArrLength; $i++){
        if(stripslashes($motherNew[$i]) != $motherOld[$i]){
            $changestr = addslashes($changed.$motherCategory[$i].$from.$motherOld[$i].$to.$motherNew[$i]);
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
            mysqli_query($link,$changequery);
        }
    }
    //END MOTHER UPDATE

    //GUARDIAN UPDATE
    $guardianNew = array(
        mysqli_real_escape_string($link,$_POST['guardianFirstname']),
        mysqli_real_escape_string($link,$_POST['guardianMiddlename']),
        mysqli_real_escape_string($link,$_POST['guardianLastname']),
        mysqli_real_escape_string($link,$_POST['guardianRelationship']),
        mysqli_real_escape_string($link,$_POST['guardianStreet']),
        mysqli_real_escape_string($link,$_POST['guardianBarangay']),
        mysqli_real_escape_string($link,$_POST['guardianCity']),
        mysqli_real_escape_string($link,$_POST['guardianProvince']),
        mysqli_real_escape_string($link,$_POST['guardianOccupation']),
        mysqli_real_escape_string($link,$_POST['guardianContact'])
    );

    $guardianId = mysqli_real_escape_string($link,$_POST['guardianId']);
    $record = mysqli_query($link,"SELECT * FROM parent WHERE id=$guardianId");
    $guardian = mysqli_fetch_array($record);
    $guardianOld = array(
        $guardian['firstname'],
        $guardian['middlename'],
        $guardian['lastname'],
        $guardian['relationship'],
        $guardian['street'],
        $guardian['barangay'],
        $guardian['city'],
        $guardian['province'],
        $guardian['occupation'],
        $guardian['contactno']
    );
    
    $guardianCategory = array(
        "Firstname",
        "Middlename",
        "Lastname",
        "Guardian ".$guardianNew[0]."'s Relation",
        "Guardian ".$guardianNew[0]."'s Street",
        "Guardian ".$guardianNew[0]."'s Barangay",
        "Guardian ".$guardianNew[0]."'s City",
        "Guardian ".$guardianNew[0]."'s Province",
        "Guardian ".$guardianNew[0]."'s Occupation",
        "Guardian ".$guardianNew[0]."'s Contact No."
    );

    $guardianArrLength = count($guardianCategory);
    for($i = 0; $i < $guardianArrLength; $i++){
        if(stripslashes($guardianNew[$i]) != $guardianOld[$i]){
            $changestr = addslashes($changed.$guardianCategory[$i].$from.$guardianOld[$i].$to.$guardianNew[$i]);
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
            mysqli_query($link,$changequery);
        }
    }
    //END GUARDIAN UPDATE

    $siblingCount = mysqli_real_escape_string($link,$_POST['siblingCount']);
    if($siblingCount>-1){
        $originalSiblingCount = mysqli_real_escape_string($link,$_POST['originalSiblingCount']);
        for($i = 0; $i <= $originalSiblingCount; $i++){
            $siblingId = mysqli_real_escape_string($link,$_POST['siblingId'.$i]);
            $siblingDeleteValue = mysqli_real_escape_string($link,$_POST['siblingWillDelete'.$i]);
            if($siblingDeleteValue == "yes"){ //Delete a sibling
                echo 'To Delete';
                $toDeleteSiblingFirstname = mysqli_real_escape_string($link,$_POST['siblingFirstname'.$i]);
                $toDeleteSiblingLastname = mysqli_real_escape_string($link,$_POST['siblingLastname'.$i]);
                $changestr = addslashes("Removed Sibling ".$toDeleteSiblingFirstname." ".$toDeleteSiblingLastname);
                $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
		        mysqli_query($link,$changequery);
            }
            else{ //Update a sibling
                $siblingNew = array(
                    mysqli_real_escape_string($link,$_POST['siblingFirstname'.$i]),
                    mysqli_real_escape_string($link,$_POST['siblingMiddlename'.$i]),
                    mysqli_real_escape_string($link,$_POST['siblingLastname'.$i]),
                    mysqli_real_escape_string($link,$_POST['siblingRelation'.$i])
                );

                $record = mysqli_query($link,"SELECT * FROM sibling WHERE id=$siblingId");
                $sibling = mysqli_fetch_array($record);
                $siblingOld = array(
                    $sibling['firstname'],
                    $sibling['middlename'],
                    $sibling['lastname'],
                    $sibling['relationship']
                );

                $siblingCategory = array(
                    "Firstname",
                    "Middlename",
                    "Lastname",
                    $siblingOld[0]."'s Relation"
                );

                $siblingArrLength = count($siblingNew);
                for($k = 0; $k < $siblingArrLength; $k++){
                    if(stripslashes($siblingNew[$k]) != $siblingOld[$k]){
                        $changestr = addslashes($changed."Sibling ".$siblingCategory[$k].$from.$siblingOld[$k].$to.$siblingNew[$k]);
                        $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
                        mysqli_query($link,$changequery);
                    }
                }
            }
        }
        for($j = $originalSiblingCount + 1; $j<=$siblingCount; $j++){
            $siblingFirstname = mysqli_real_escape_string($link,$_POST['siblingFirstname'.$j]);
            $siblingLastname = mysqli_real_escape_string($link,$_POST['siblingLastname'.$j]);
            $changestr = addslashes("Added Sibling ".$siblingFirstname." ".$siblingLastname);
            $changequery = "INSERT INTO changerecord(changestr,studentid,datechanged) VALUES('$changestr','$id',NOW())";
            mysqli_query($link,$changequery);
        }
    }
    include "edit.php";
    echo "No Errors so far!";
?>