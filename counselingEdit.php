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

    $studentCount = mysqli_real_escape_string($link,$_POST['studentCount']);
    $teacherCount = mysqli_real_escape_string($link,$_POST['teacherCount']);
    $parentCount = mysqli_real_escape_string($link,$_POST['parentCount']);

    if($studentCount>-1){
        $originalStudentCount = mysqli_real_escape_string($link,$_POST['originalStudentCount']);
        for($i = 0; $i <= $originalStudentCount; $i++){
            $studentDeleteValue = mysqli_real_escape_string($link,$_POST['studentWillDelete'.$i]);
            if($studentDeleteValue == "yes"){ //Delete a student
                $studentId = mysqli_real_escape_string($link,$_POST['studentId'.$i]);
                $deleteStudentQuery = "DELETE FROM sessionrecord WHERE type='Student' AND involvedid='$studentId'";
                mysqli_query($link,$deleteStudentQuery);
            }
        }
        for($j = $originalStudentCount + 1; $j<=$studentCount; $j++){
            $studentId = mysqli_real_escape_string($link,$_POST['studentId'.$j]);
            $sqlStudentRecord = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Student',$studentId,$sessionid)";
            mysqli_query($link,$sqlStudentRecord);
        }
    }

    if($teacherCount>-1){
        $originalTeacherCount = mysqli_real_escape_string($link,$_POST['originalTeacherCount']);
        for($i = 0; $i <= $originalTeacherCount; $i++){
            $teacherDeleteValue = mysqli_real_escape_string($link,$_POST['teacherWillDelete'.$i]);
            if($teacherDeleteValue == "yes"){ //Delete a teacher
                $teacherId = mysqli_real_escape_string($link,$_POST['teacherId'.$i]);
                $deleteTeacherQuery = "DELETE FROM sessionrecord WHERE type='Teacher' AND involvedid='$teacherId'";
                mysqli_query($link,$deleteTeacherQuery);
            }
        }
        for($j = $originalTeacherCount + 1; $j<=$teacherCount; $j++){
            $teacherId = mysqli_real_escape_string($link,$_POST['teacherId'.$j]);
            $sqlTeacherRecord = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Teacher',$teacherId,$sessionid)";
            mysqli_query($link,$sqlTeacherRecord);
        }
    }

    if($parentCount>-1){
        $originalParentCount = mysqli_real_escape_string($link,$_POST['originalParentCount']);
        for($i = 0; $i <= $originalParentCount; $i++){
            $parentDeleteValue = mysqli_real_escape_string($link,$_POST['parentWillDelete'.$i]);
            if($parentDeleteValue == "yes"){ //Delete a parent
                $parentId = mysqli_real_escape_string($link,$_POST['parentId'.$i]);
                $deleteParentQuery = "DELETE FROM sessionrecord WHERE type='Parent' AND involvedid='$parentId'";
                mysqli_query($link,$deleteParentQuery);
            }
        }
        for($j = $originalParentCount + 1; $j<=$parentCount; $j++){
            $parentId = mysqli_real_escape_string($link,$_POST['parentId'.$j]);
            $sqlParentRecord = "INSERT INTO sessionrecord(type,involvedid,sessionid) VALUES('Parent',$parentId,$sessionid)";
            mysqli_query($link,$sqlParentRecord);
        }
    }

    /* $message = "Session Edited!";
    echo "	<script type='text/javascript'>
                alert('$message');
                window.location='PageGuidance-View.php?id=$sessionid';
			</script>"; */

?>