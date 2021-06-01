<?php include "server.php";
    $sessionid = mysqli_real_escape_string($link,$_POST['session-id']);
    $counselorid= mysqli_real_escape_string($link,$_POST['counselor-id']);
    $time = mysqli_real_escape_string($link,$_POST['sessionTimeStart']);
    $endtime = mysqli_real_escape_string($link,$_POST['sessionTimeEnd']);
    $date = mysqli_real_escape_string($link,$_POST['sessionDate']);
    $desc = mysqli_real_escape_string($link,$_POST['sessionInfo']);
    $action = mysqli_real_escape_string($link,$_POST['courseOfAction']);

    $sessionQuery = "UPDATE session SET sessiondesc='$desc', action='$action', counselorid='$counselorid', date='$date', time='$time' WHERE id=$sessionid";
    if(mysqli_query($link,$sessionQuery)){
        echo 'Successful!';
    }
    echo "	<script type='text/javascript'>
                window.location='Page-Director-ViewSession.php?id=$sessionid';
			</script>";
?>