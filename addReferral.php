<?php include "server.php";
    session_start();
    $studentid = mysqli_real_escape_string($link,$_POST['student-id']);
    $referredby = $_SESSION['userid'];
    $referredtype = $_SESSION['type'];
    $arrayReason = [];
	for($i = 1; $i <= 9; $i++){
		$reasonName = 'trait'.$i;
        $reasonExists = mysqli_real_escape_string($link,$_POST[$reasonName]);
		if($reasonExists != null){
			$reasonNum = mysqli_real_escape_string($link,$_POST[$reasonName]);
			array_push($arrayReason, $reasonNum);
		}
	}
    $reasons = implode(",",$arrayReason);
    $problemhistory = mysqli_real_escape_string($link,$_POST['problemhistory']);
    $actiontaken = mysqli_real_escape_string($link,$_POST['actiontaken']);
    $contactedparents = mysqli_real_escape_string($link,$_POST['contactedparents']);
    $contactedparentsdate = mysqli_real_escape_string($link,$_POST['contactedparentsdate']);
    $contactedparentsoutcome = mysqli_real_escape_string($link,$_POST['contactedparentsoutcome']);
    //$datetimesent
    ////$datetimeresolved;
    $currentuserlevel = $_SESSION['type'];
    if($currentuserlevel == "Teacher"){
        $currentlevel = "1";
    }
    if($currentuserlevel == "Coordinator"){
        $currentlevel = "2";
    }
    if($currentuserlevel == "Counselor"){
        $currentlevel = "3";
    }
    if($currentuserlevel == "Director"){
        $currentlevel = "4";
    }
    $referralhistory = $_SESSION['name'];
    ////$levelresolved;
    $referralAddQuery = "INSERT INTO referral(studentid,referredby,referredtype,reasons,problemhistory,actiontaken,contactedparents,contactedparentsdate,contactedparentsoutcome,datetimesent,currentlevel,referralhistory,status) 
    VALUES ('$studentid','$referredby','$referredtype','$reasons','$problemhistory','$actiontaken','$contactedparents','$contactedparentsdate','$contactedparentsoutcome',NOW(),'$currentlevel','$referralhistory','Pending')";
    mysqli_query($link,$referralAddQuery);
    $last_referral_id = $link->insert_id;
    echo "	<script type='text/javascript'>
                window.location='Page-Counselor-ViewOwnReferral.php?id=$last_referral_id';
			</script>";
?>