<?php
    include "server.php";
    $type="";
    if(isset($_SESSION['type'])){
        $type = $_SESSION['type'];
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM counselor WHERE id=$id";
        $counselor = mysqli_fetch_array(mysqli_query($link,$sql));
        $_SESSION['name'] = $counselor['firstname']." ".$counselor['lastname'];
    }
    if($type != 'Director'){
        echo "	<script type='text/javascript'>
                    alert('You do not have permission to view this page');
                    window.location='Page-Logout.php';
                </script>";
    }
?>