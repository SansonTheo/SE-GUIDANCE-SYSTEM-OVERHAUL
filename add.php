<?php
	include "server.php";
	//Student's Info
	$firstname = mysqli_real_escape_string($link,$_POST['firstname']);
	$middlename = mysqli_real_escape_string($link,$_POST['middlename']);
	$lastname = mysqli_real_escape_string($link,$_POST['lastname']);
	$birthDate = mysqli_real_escape_string($link,$_POST['birthDate']);
	$contact = strval(mysqli_real_escape_string($link,$_POST['contact']));
	$street = mysqli_real_escape_string($link,$_POST['street']);
	$barangay = mysqli_real_escape_string($link,$_POST['barangay']);
	$city = mysqli_real_escape_string($link,$_POST['city']);
	$province = mysqli_real_escape_string($link,$_POST['province']);
	//$residencyType = mysqli_real_escape_string($link,$_POST['isBoarder']);
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
		//$civilstatus = mysqli_real_escape_string($link,$_POST['civilStatus']);

	//Father's Info
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
	$spouseFirstname = mysqli_real_escape_string($link,$_POST['spouseFirstname']);
	$spouseMiddlename = mysqli_real_escape_string($link,$_POST['spouseMiddlename']);
	$spouseLastname = mysqli_real_escape_string($link,$_POST['spouseLastname']);
	$spouseStreet = mysqli_real_escape_string($link,$_POST['spouseStreet']);
	$spouseBarangay =  mysqli_real_escape_string($link,$_POST['spouseBarangay']);
	$spouseCity = mysqli_real_escape_string($link,$_POST['spouseCity']);
	$spouseProvince = mysqli_real_escape_string($link,$_POST['spouseProvince']);
	$spouseOccupation = mysqli_real_escape_string($link,$_POST['spouseOccupation']);
	$spouseContact = strval(mysqli_real_escape_string($link,$_POST['spouseContact']));
	if($spouseFirstname != ""){
		$civilstatus = "Married";
	}
	else{
		$civilstatus = "Single";
	}
	//SiblingInfo
	$siblingCount = mysqli_real_escape_string($link,$_POST['siblingCount']);

	$sqlFather="INSERT INTO parent(firstname,middlename,lastname,relationship,street,barangay,city,province,occupation,contactno) VALUES('$fatherFirstname','$fatherMiddlename','$fatherLastname','Father','$fatherStreet','$fatherBarangay','$fatherCity','$fatherProvince','$fatherOccupation','$fatherContact')";
	$sqlMother="INSERT INTO parent(firstname,middlename,lastname,relationship,street,barangay,city,province,occupation,contactno) VALUES('$motherFirstname','$motherMiddlename','$motherLastname','Mother','$motherStreet','$motherBarangay','$motherCity','$motherProvince','$motherOccupation','$motherContact')";
	$sql="INSERT INTO student (firstname,middlename,lastname,birthdate,contactno,permstreet,permbarangay,permcity,permprovince,tempstreet,tempbarangay,tempcity,tempprovince,studentid,college,department,level,sex,gender,height,weight,complexion,ethnicity,nationality,religion,civilstatus) 
	VALUES('$firstname','$middlename','$lastname','$birthDate','$contact','$street','$barangay','$city','$province','$boarderStreet','$boarderBarangay','$boarderCity','$boarderProvince','$studentId','$college','$department','$level','$sex','$gender','$height','$weight','$complexion','$ethnicity','$nationality','$religion','$civilstatus')";	$last_student_id = $link->insert_id;
	
	if(mysqli_query($link,$sql))
	{
		$last_student_id = $link->insert_id;

		mysqli_query($link,$sqlFather);
		$last_father_id = $link->insert_id;
		$sqlParentRecord = "INSERT INTO parentrecord(parentid,studentid) VALUES('$last_father_id','$last_student_id')";
		mysqli_query($link,$sqlParentRecord);

		mysqli_query($link,$sqlMother);
		$last_mother_id = $link->insert_id;
		$sqlParentRecord = "INSERT INTO parentrecord(parentid,studentid) VALUES('$last_mother_id','$last_student_id')";		
		mysqli_query($link,$sqlParentRecord);

		if($civilstatus == "Married"){
			$sqlSpouse="INSERT INTO spouse(firstname,maidenname,lastname,street,barangay,city,province,occupation,contactno,spouseid) VALUES('$spouseFirstname','$spouseMiddlename','$spouseLastname','$spouseStreet','$spouseBarangay','$spouseCity','$spouseProvince','$spouseOccupation','$spouseContact',$last_student_id)";
			mysqli_query($link,$sqlSpouse);
		}

		if($guardianFirstname != ""){
			$sqlGuardian="INSERT INTO parent(firstname,middlename,lastname,relationship,street,barangay,city,province,occupation,contactno) VALUES('$guardianFirstname','$guardianMiddlename','$guardianLastname','$guardianRelationship','$guardianStreet','$guardianBarangay','$guardianCity','$guardianProvince','$guardianOccupation','$guardianContact')";
			mysqli_query($link,$sqlGuardian);
			$last_guardian_id = $link->insert_id;
			$sqlGuardianRecord = "INSERT INTO parentrecord(parentid,studentid) VALUES('$last_guardian_id','$last_student_id')";
			mysqli_query($link,$sqlGuardianRecord);
		}

		if($siblingCount>-1){		
			for($i = 0; $i <= $siblingCount; $i++){
				$siblingFirstname= mysqli_real_escape_string($link,$_POST['siblingFirstname'.$i]);
				$siblingMiddlename= mysqli_real_escape_string($link,$_POST['siblingMiddlename'.$i]);
				$siblingLastname= mysqli_real_escape_string($link,$_POST['siblingLastname'.$i]);
				$siblingRelation= mysqli_real_escape_string($link,$_POST['siblingRelation'.$i]);
				$siblingArray = array($siblingFirstname,$siblingMiddlename,$siblingLastname,$siblingRelation);
				$siblingStr = implode("', '", $siblingArray);
				$sqlSibling = "INSERT INTO sibling(firstname,middlename,lastname,relationship) VALUES ('$siblingStr')";
				mysqli_query($link,$sqlSibling);
				$last_sibling_id = $link->insert_id;
				$sqlSiblingRecord = "INSERT INTO siblingrecord(siblingid,studentid) VALUES('$last_sibling_id','$last_student_id')";
				mysqli_query($link,$sqlSiblingRecord);
			}
		}
		header("location:Page-Profiling-ViewStudent.php?id=$last_student_id");
		$message = "Student Added!";
	}
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
	mysqli_close($link);
?>