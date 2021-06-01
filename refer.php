<?php include "server.php";
    session_start();
	$id = mysqli_real_escape_string($link,$_POST['referral-id']);
    $actiontaken = mysqli_real_escape_string($link,$_POST['actiontaken']);
    $contactedparents = mysqli_real_escape_string($link,$_POST['contactedparents']);
    $contactedparentsdate = mysqli_real_escape_string($link,$_POST['contactedparentsdate']);
    $contactedparentsoutcome = mysqli_real_escape_string($link,$_POST['contactedparentsoutcome']);
    $referralhistory = mysqli_real_escape_string($link,$_POST['referralhistory']).", ".$_SESSION['name'];
    $currentlevel = mysqli_real_escape_string($link,$_POST['currentlevel']);
    
    $currentusertype = $_SESSION['type'];
    $currentuserlevel = "";
    if($currentusertype == "Teacher"){
        $currentuserlevel = "1";
    }
    if($currentusertype == "Coordinator"){
        $currentuserlevel = "2";
    }
    if($currentusertype == "Counselor"){
        $currentuserlevel = "3";
    }
    if($currentusertype == "Director"){
        $currentuserlevel = "4";
    }
    
    if($currentlevel < $currentuserlevel){
        $currentlevel = intval($currentuserlevel);
    }

    $referralEditQuery = "UPDATE referral SET actiontaken='$actiontaken',contactedparents='$contactedparents',contactedparentsdate='$contactedparentsdate',contactedparentsoutcome='$contactedparentsoutcome',currentlevel='$currentlevel',referralhistory='$referralhistory' WHERE id='$id'";
    mysqli_query($link,$referralEditQuery);
    echo "	<script type='text/javascript'>
                window.location='Page-Counselor-Home.php';
			</script>";
?>