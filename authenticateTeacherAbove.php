<?php
    include "server.php";
    $type="";
    if(isset($_SESSION['type'])){
        $id = $_SESSION['userid'];
        $type = $_SESSION['type'];
        if($type == "Teacher"){
            $sql = "SELECT * FROM teacher WHERE id=$id";
            $teacher = mysqli_fetch_array(mysqli_query($link,$sql));
            $name = $teacher['firstname']." ".$teacher['lastname'];
        }
        else if($type == "Counselor" || $type == "Coordinator" || $type =="Director"){
            $sql = "SELECT * FROM counselor WHERE id=$id";
            $counselor = mysqli_fetch_array(mysqli_query($link,$sql));
            $name = $counselor['firstname']." ".$counselor['lastname'];
        }
        $_SESSION['name'] = $name;
    }
    if($type != 'Teacher' && $type != 'Counselor' && $type != 'Coordinator' && $type != 'Director'){
        echo "	<script type='text/javascript'>
                    alert('You do not have permission to view this page');
                    window.location='Page-Logout.php';
                </script>";
    }
?>