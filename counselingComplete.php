<?php
    include "server.php";
    $sessionid = $_REQUEST['id'];
    $sessionQuery = "UPDATE session SET status='Finished' WHERE id=$sessionid";
    if(mysqli_query($link,$sessionQuery)){
        echo "	<script type='text/javascript'>
                window.location='Page-Counseling-ViewSession.php?id=$sessionid';
			</script>";
    }
?>