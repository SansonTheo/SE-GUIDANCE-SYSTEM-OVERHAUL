<?php
    include "server.php";
    $type="";
    if(isset($_SESSION['type'])){
        $type = $_SESSION['type'];
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM student WHERE id=$id";
        $student = mysqli_fetch_array(mysqli_query($link,$sql));
        if(isset($student)){
            $_SESSION['name'] = $student['firstname'];
        }
        header('Student-Page-View.php?id='.$_SESSION['userid']);
    }
    if($type != 'Student'){
        echo "	<script type='text/javascript'>
                    alert('You do not have permission to view this page');
                    window.location='logout.php';
                </script>";
    }
?>