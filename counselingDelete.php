<?php
    include "server.php";
    $id = $_REQUEST['id'];
    $sqlDelete = "DELETE FROM session WHERE id=$id";
    if(mysqli_query($link,$sqlDelete)){
        echo "	<script type='text/javascript'>
                    window.location='Page-Director-SessionList.php';
			    </script>";
    }
?>