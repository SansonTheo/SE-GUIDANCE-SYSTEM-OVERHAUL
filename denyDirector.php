<?php include "server.php";
    session_start();
	$id = mysqli_real_escape_string($link,$_POST['referral-id']);
    $actiontaken = mysqli_real_escape_string($link,$_POST['actiontaken']);
    $contactedparents = mysqli_real_escape_string($link,$_POST['contactedparents']);
    $contactedparentsdate = mysqli_real_escape_string($link,$_POST['contactedparentsdate']);
    $contactedparentsoutcome = mysqli_real_escape_string($link,$_POST['contactedparentsoutcome']);
    $referralhistory = mysqli_real_escape_string($link,$_POST['referralhistory']).", ".$_SESSION['name'];
    $currentlevel = mysqli_real_escape_string($link,$_POST['currentlevel']);
    $resolvedby = mysqli_real_escape_string($link,$_POST['resolvedby']);


    $record = mysqli_query($link,"SELECT * FROM referral WHERE id=$id");
    $referral = mysqli_fetch_array($record);
    $actiontaken = $referral['actiontaken']."--Referal Denied. Reason: ".$actiontaken;
    $referralEditQuery = "UPDATE referral SET actiontaken='$actiontaken',contactedparents='$contactedparents',contactedparentsdate='$contactedparentsdate',contactedparentsoutcome='$contactedparentsoutcome',levelresolved='$currentlevel',referralhistory='$referralhistory',status='Denied',
    datetimeresolved=NOW(),resolvedby='$resolvedby' WHERE id='$id'";
    mysqli_query($link,$referralEditQuery);
    echo "	<script type='text/javascript'>
                window.location='Page-Director-ReferralList.php';
			</script>";