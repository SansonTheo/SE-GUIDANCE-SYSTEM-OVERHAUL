<?php
	include "server.php";
	$id = mysqli_real_escape_string($link,$_POST['id']);
	$firstname = mysqli_real_escape_string($link,$_POST['firstname']);
	$middlename = mysqli_real_escape_string($link,$_POST['middlename']);
	$lastname = mysqli_real_escape_string($link,$_POST['lastname']);
	$birthDate = mysqli_real_escape_string($link,$_POST['birthDate']);
	$contact = strval(mysqli_real_escape_string($link,$_POST['contact']));
	$street = mysqli_real_escape_string($link,$_POST['street']);
	$barangay = mysqli_real_escape_string($link,$_POST['barangay']);
	$city = mysqli_real_escape_string($link,$_POST['city']);
	$province = mysqli_real_escape_string($link,$_POST['province']);
	$boarderStreet = mysqli_real_escape_string($link,$_POST['boarderStreet']);
	$boarderBarangay = mysqli_real_escape_string($link,$_POST['boarderBarangay']);
	$boarderCity = mysqli_real_escape_string($link,$_POST['boarderCity']);
	$boarderProvince = mysqli_real_escape_string($link,$_POST['boarderProvince']);
	$studentId = mysqli_real_escape_string($link,$_POST['studentId']);
	$college = mysqli_real_escape_string($link,$_POST['college']);
	$department = mysqli_real_escape_string($link,$_POST['department']);
	$level = mysqli_real_escape_string($link,$_POST['level']);
	$sex = mysqli_real_escape_string($link,$_POST['sex']);
	$gender = mysqli_real_escape_string($link,$_POST['gender']);
    $height = mysqli_real_escape_string($link,$_POST['height']);
	$weight = mysqli_real_escape_string($link,$_POST['weight']);
	$complexion = mysqli_real_escape_string($link,$_POST['complexion']);
	$ethnicity = mysqli_real_escape_string($link,$_POST['ethnicity']);
	$nationality = mysqli_real_escape_string($link,$_POST['nationality']);
	$religion = mysqli_real_escape_string($link,$_POST['religion']);
    

    //Father's Info
	$fatherId = mysqli_real_escape_string($link,$_POST['fatherId']);
	$fatherFirstname = mysqli_real_escape_string($link,$_POST['fatherFirstname']);
	$fatherMiddlename = mysqli_real_escape_string($link,$_POST['fatherMiddlename']);
	$fatherLastname = mysqli_real_escape_string($link,$_POST['fatherLastname']);
	$fatherStreet = mysqli_real_escape_string($link,$_POST['fatherStreet']);
	$fatherBarangay =  mysqli_real_escape_string($link,$_POST['fatherBarangay']);
	$fatherCity = mysqli_real_escape_string($link,$_POST['fatherCity']);
	$fatherProvince = mysqli_real_escape_string($link,$_POST['fatherProvince']);
	$fatherOccupation = mysqli_real_escape_string($link,$_POST['fatherOccupation']);
	$fatherContact = strval(mysqli_real_escape_string($link,$_POST['fatherContact']));

    //Mother's Info
	$motherId = mysqli_real_escape_string($link,$_POST['motherId']);
	$motherFirstname = mysqli_real_escape_string($link,$_POST['motherFirstname']);
	$motherMiddlename = mysqli_real_escape_string($link,$_POST['motherMiddlename']);
	$motherLastname = mysqli_real_escape_string($link,$_POST['motherLastname']);
	$motherStreet = mysqli_real_escape_string($link,$_POST['motherStreet']);
	$motherBarangay =  mysqli_real_escape_string($link,$_POST['motherBarangay']);
	$motherCity = mysqli_real_escape_string($link,$_POST['motherCity']);
	$motherProvince = mysqli_real_escape_string($link,$_POST['motherProvince']);
	$motherOccupation = mysqli_real_escape_string($link,$_POST['motherOccupation']);
	$motherContact = strval(mysqli_real_escape_string($link,$_POST['motherContact']));

    //Guardian's Info
	$guardianId = mysqli_real_escape_string($link,$_POST['guardianId']);
	$guardianFirstname = mysqli_real_escape_string($link,$_POST['guardianFirstname']);
	$guardianMiddlename = mysqli_real_escape_string($link,$_POST['guardianMiddlename']);
	$guardianLastname = mysqli_real_escape_string($link,$_POST['guardianLastname']);
	$guardianRelationship = mysqli_real_escape_string($link,$_POST['guardianRelationship']);
	$guardianStreet = mysqli_real_escape_string($link,$_POST['guardianStreet']);
	$guardianBarangay =  mysqli_real_escape_string($link,$_POST['guardianBarangay']);
	$guardianCity = mysqli_real_escape_string($link,$_POST['guardianCity']);
	$guardianProvince = mysqli_real_escape_string($link,$_POST['guardianProvince']);
	$guardianOccupation = mysqli_real_escape_string($link,$_POST['guardianOccupation']);
	$guardianContact = strval(mysqli_real_escape_string($link,$_POST['guardianContact']));

    //Spouse's Info
	$spouseId = mysqli_real_escape_string($link,$_POST['spouseId']);
    if($spouseId == ""){
        $civilstatus = "Single";
    }
    else{
        $civilstatus = "Married";
    }
	$spouseFirstname = mysqli_real_escape_string($link,$_POST['spouseFirstname']);
	$spouseMiddlename = mysqli_real_escape_string($link,$_POST['spouseMiddlename']);
	$spouseLastname = mysqli_real_escape_string($link,$_POST['spouseLastname']);
	$spouseStreet = mysqli_real_escape_string($link,$_POST['spouseStreet']);
	$spouseBarangay =  mysqli_real_escape_string($link,$_POST['spouseBarangay']);
	$spouseCity = mysqli_real_escape_string($link,$_POST['spouseCity']);
	$spouseProvince = mysqli_real_escape_string($link,$_POST['spouseProvince']);
	$spouseOccupation = mysqli_real_escape_string($link,$_POST['spouseOccupation']);
	$spouseContact = strval(mysqli_real_escape_string($link,$_POST['spouseContact']));

    $sqlFather="UPDATE parent SET firstname='$fatherFirstname',middlename='$fatherMiddlename',lastname='$fatherLastname',street='$fatherStreet',barangay='$fatherBarangay',city='$fatherCity',province='$fatherProvince',occupation='$fatherOccupation',contactno='$fatherContact' WHERE id='$fatherId'";
	$sqlMother="UPDATE parent SET firstname='$motherFirstname',middlename='$motherMiddlename',lastname='$motherLastname',street='$motherStreet',barangay='$motherBarangay',city='$motherCity',province='$motherProvince',occupation='$motherOccupation',contactno='$motherContact' WHERE id='$motherId'";
    $sqlGuardian="UPDATE parent SET firstname='$guardianFirstname',middlename='$guardianMiddlename',lastname='$guardianLastname',relationship='$guardianRelationship',street='$guardianStreet',barangay='$guardianBarangay',city='$guardianCity',province='$guardianProvince',occupation='$guardianOccupation',contactno='$guardianContact' WHERE id=$guardianId";		
	$sql="UPDATE student SET firstname='$firstname',middlename='$middlename',lastname='$lastname',birthdate='$birthDate',contactno='$contact',permstreet='$street',permbarangay='$barangay',permcity='$city',permprovince='$province',tempstreet='$boarderStreet',tempbarangay='$boarderBarangay',tempcity='$boarderCity',tempprovince='$boarderProvince',studentid='$studentId',college='$college',department='$department',level='$level',sex='$sex',gender='$gender',height='$height',weight='$weight',complexion='$complexion',ethnicity='$ethnicity',nationality='$nationality',religion='$religion',civilstatus='$civilstatus' 
	WHERE id='$id'"; 					            

    if(mysqli_query($link,$sql))
    {
        mysqli_query($link,$sqlFather);
        mysqli_query($link,$sqlMother);
        mysqli_query($link,$sqlGuardian);
        if($civilstatus == "Single" && $spouseFirstname != "" && $spouseLastname != ""){ //Adds Spouse (Newly Married)
            $sql="UPDATE student SET civilstatus='Married' WHERE id='$id'";
            mysqli_query($link,$sql);
            $sqlSpouse="INSERT INTO spouse(firstname,middlename,lastname,street,barangay,city,province,occupation,contactno,spouseid) VALUES('$spouseFirstname','$spouseMiddlename','$spouseLastname','$spouseStreet','$spouseBarangay','$spouseCity','$spouseProvince','$spouseOccupation','$spouseContact',$id)";
			mysqli_query($link,$sqlSpouse);
        }
        else if($civilstatus == "Married" && $spouseFirstname == "" && $spouseLastname == ""){ //Removes Spouse (Newly Separated) :(
            $sql="UPDATE student SET civilstatus='Single' WHERE id='$id'";
            mysqli_query($link,$sql);
            $sqlSpouse="DELETE FROM spouse WHERE spouseid='$id'";
            mysqli_query($link,$sqlSpouse);
        }
        else if($civilstatus == "Married" && $spouseFirstname != "" && $spouseLastname != ""){ //Updates Spouse Already Married
            $sqlSpouse="UPDATE spouse SET firstname='$spouseFirstname',middlename='$spouseMiddlename',lastname='$spouseLastname',street='$spouseStreet',barangay='$spouseBarangay',city='$spouseCity',province='$spouseProvince',occupation='$spouseOccupation',contactno='$spouseContact' WHERE spouseid=$id";
            mysqli_query($link,$sqlSpouse);
        }
        
	    $siblingCount = mysqli_real_escape_string($link,$_POST['siblingCount']);
        $originalSiblingCount = mysqli_real_escape_string($link,$_POST['originalSiblingCount']);

        if($siblingCount>-1){
            $originalSiblingCount = mysqli_real_escape_string($link,$_POST['originalSiblingCount']);
            for($i = 0; $i <= $originalSiblingCount; $i++){
                $siblingId = mysqli_real_escape_string($link,$_POST['siblingId'.$i]);
                $siblingFirstname= mysqli_real_escape_string($link,$_POST['siblingFirstname'.$i]);
                $siblingMiddlename= mysqli_real_escape_string($link,$_POST['siblingMiddlename'.$i]);
                $siblingLastname= mysqli_real_escape_string($link,$_POST['siblingLastname'.$i]);
                $siblingRelation= mysqli_real_escape_string($link,$_POST['siblingRelation'.$i]);
                $siblingDeleteValue = mysqli_real_escape_string($link,$_POST['siblingWillDelete'.$i]);
                if($siblingDeleteValue == "yes"){ //Delete a sibling
                    $deleteSiblingQuery = "DELETE FROM sibling WHERE id='$siblingId'";
                    mysqli_query($link,$deleteSiblingQuery);
                    
                }
                else{ //Update a sibling
                    $sqlSibling = "UPDATE sibling SET firstname='$siblingFirstname',middlename='$siblingMiddlename',lastname='$siblingLastname',relationship='$siblingRelation' WHERE id='$siblingId'";
                    mysqli_query($link,$sqlSibling);
                }
            }
            for($j = $originalSiblingCount + 1; $j<=$siblingCount; $j++){
                $siblingFirstname= mysqli_real_escape_string($link,$_POST['siblingFirstname'.$j]);
                $siblingMiddlename= mysqli_real_escape_string($link,$_POST['siblingMiddlename'.$j]);
                $siblingLastname= mysqli_real_escape_string($link,$_POST['siblingLastname'.$j]);
                $siblingRelation= mysqli_real_escape_string($link,$_POST['siblingRelation'.$j]);
                $siblingArray = array($siblingFirstname,$siblingMiddlename,$siblingLastname,$siblingRelation);
                $siblingStr = implode("', '", $siblingArray);
                $sqlSibling = "INSERT INTO sibling(firstname,middlename,lastname,relationship) VALUES ('$siblingStr')";
                mysqli_query($link,$sqlSibling);
                $last_sibling_id = $link->insert_id;
                $sqlSiblingRecord = "INSERT INTO siblingrecord(siblingid,studentid) VALUES('$last_sibling_id','$id')";
                mysqli_query($link,$sqlSiblingRecord);
            }
        }
        header("location:Page-Profiling-ViewStudent.php?id=$id");
    }
    else
    {
        echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
    }
    mysqli_close($link);
?>