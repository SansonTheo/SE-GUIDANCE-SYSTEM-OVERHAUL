<?php
    include "server.php";
    $sessionid = $_REQUEST['id'];
    $sessionQuery = "UPDATE session SET status='Finished',finishedtime=NOW() WHERE id=$sessionid";
    
    if(mysqli_query($link,$sessionQuery)){
        echo "Success!";
    }
    session_start();
    $userid = $_SESSION["trueid"];
    $sessionid=$_REQUEST['id'];
    $record = mysqli_query($link,"SELECT * FROM session WHERE id=$sessionid");
    $session = mysqli_fetch_array($record);
    $referralid = $session['referralid'];
    if($referralid != ""){
        $record = mysqli_query($link,"SELECT * FROM referral WHERE id=$referralid");
        $referral = mysqli_fetch_array($record);
        $action = $referral['actiontaken']." Marked Resolved by Director.";
        $referralQuery = "UPDATE referral SET actiontaken='$action',resolvedby='$userid',datetimeresolved=NOW(),status='Resolved',levelresolved='4' WHERE id=$referralid";
        if(mysqli_query($link,$referralQuery)){
            echo "Referral Success";
        };
    }

    echo "	<script type='text/javascript'>
                window.location='Page-Director-ViewSession.php?id=$sessionid';
			</script>";
?>