<?php include "server.php";
    $counselorid = mysqli_real_escape_string($link,$_POST['counselor-id']);
    $timeStart = mysqli_real_escape_string($link,$_POST['sessionTimeStart']);
    $timeEnd = mysqli_real_escape_string($link,$_POST['sessionTimeEnd']);
    $date = mysqli_real_escape_string($link,$_POST['sessionDate']);
    $desc = mysqli_real_escape_string($link,$_POST['sessionInfo']);
    $action = mysqli_real_escape_string($link,$_POST['courseOfAction']);
    session_start();
    $setterid = $_SESSION['userid'];
    $sessionAddQuery = "INSERT INTO session(sessiondesc,action,counselorid,date,time,endtime,dateset,setter,status) VALUES('$desc','$action','$counselorid','$date','$timeStart','$timeEnd',NOW(),'$setterid','Upcoming')";
    mysqli_query($link,$sessionAddQuery);
    $sessionid = $link->insert_id;

    $studentCount = mysqli_real_escape_string($link,$_POST['studentCount']);
    $parentCount = mysqli_real_escape_string($link,$_POST['parentCount']);
    $teacherCount = mysqli_real_escape_string($link,$_POST['teacherCount']);

    if($studentCount>-1){
        for($i=0; $i<=$studentCount; $i++){
            if(isset($_POST['studentId'.$i])){
                $studentId = mysqli_real_escape_string($link,$_POST['studentId'.$i]);
                $addStudentQuery = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Student',$studentId,$sessionid)";
                if(mysqli_query($link,$addStudentQuery)){
                    echo 'Entry Successful!';
                }
            }
        }
    }

    if($parentCount>-1){
        for($i=0; $i<=$parentCount; $i++){
            if(isset($_POST['parentId'.$i])){
                $parentId = mysqli_real_escape_string($link,$_POST['parentId'.$i]);
                $addParentQuery = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Parent', $parentId, $sessionid)";
                if(mysqli_query($link,$addParentQuery)){
                    echo 'Entry Successful!';
                }
            }
        }
    }

    if($teacherCount>-1){
        for($i=0; $i<=$teacherCount; $i++){
            if(isset($_POST['teacherId'.$i])){
                $teacherId = mysqli_real_escape_string($link,$_POST['teacherId'.$i]);
                $addTeacherQuery = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Teacher', $teacherId, $sessionid)";
                if(mysqli_query($link,$addTeacherQuery)){
                    echo 'Entry Successful!';
                }
            }
        }
    }

    /* $message = "Session Added!";
    echo "	<script type='text/javascript'>
                alert('$message');
                window.location='PageGuidance-View.php?id=$sessionid';
			</script>";*/
?>