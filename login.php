<?php
	include "server.php";
	$username = mysqli_real_escape_string($link,$_POST['username']);
	$password = mysqli_real_escape_string($link,$_POST['password']);
	$record=mysqli_query($link,"SELECT * FROM user WHERE username='$username'");
	$count = mysqli_num_rows($record);
	if($count == 0){
		echo "	<script type='text/javascript'>
					alert('No Record of Given Username');
					window.location='Page-Login.php';
				</script>";
	}	
	else{
		$sql=mysqli_query($link,"SELECT * FROM user WHERE username='$username' and password='$password'");
		$count = mysqli_num_rows($sql);
		if($count == 0){
			echo "	<script type='text/javascript'>
						alert('Invalid Password!');
						window.location='Page-Login.php';
					</script>";
		}
		else{
			session_start();
			$user = mysqli_fetch_array($sql);
			$userType = $user['type'];
			$_SESSION["type"] = $userType;
			$_SESSION["trueid"] = $user['id'];
			$_SESSION["userid"] = $user['referenceid'];
			$_SESSION["user"] = $username;
			$_SESSION["pass"] = $password;
			if($userType == "Student"){
				header('Location: Page-Student-Home.php?id='.$_SESSION['userid']);
			}
			if($userType == "Teacher"){
				header('Location: Page-Teacher-Home.php');
			}
			if($userType == "Counselor" || $userType == "Coordinator"){
				header('Location: Page-Counselor-Home.php');
			}
			if($userType == "Director"){
				header('Location: Page-Director-SessionList.php');
			}
			/* if($userType == "Counselor"){
				$counselorId = $user['referenceid'];
				$counselorList = mysqli_query($link,"SELECT * FROM counselor WHERE id=$counselorId");
				$counselor = mysqli_fetch_array($counselorList);
				$_SESSION["name"] = $counselor['firstname']." ".$counselor['lastname'];
				$_SESSION['userid'] = $counselorId;
			} */
		}
	}
	//echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	mysqli_close($link);
?>