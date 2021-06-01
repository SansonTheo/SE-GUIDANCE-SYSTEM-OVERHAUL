<?php
    include "server.php";
    $id = $_REQUEST['id'];
    $sqlDelete = "DELETE FROM student WHERE id=$id";
    mysqli_query($link,$sqlDelete);
    $message = "Student Deleted!";
    echo "	<script type='text/javascript'>
                alert('$message');
                window.location='Page-Profiling-StudentList.php';
			</script>";
?>