<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    session_start();
    $username=$_SESSION["username"];

    $title=$_POST["title"];
    $dateTime=$_POST["dateTime"];
    $startTime=$_POST["startTime"];
    $endTime=$_POST["endTime"];
    $chooseRoom=$_POST["chooseRoom"];
    $roomResource=$_POST["roomResource"];
    $apply=$_POST["apply"];
    $department=$_POST["department"];
    $people=$_POST["people"];

    $roomResource=implode(',',$roomResource);

    $sqlstr1="select max(id) from meeting";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    $sqlstr2="insert into meeting values('$maxID'+1,'$title','$department','$dateTime','$startTime','$endTime','$chooseRoom','$roomResource','$apply','已审核','$people')";

    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
            <script>
                alert("会议申请提交成功！")
                window.location.href="../../home/meeting/viewMeeting.php"
            </script>
        <?php
    }else{
        ?>
            <script>
                alert("会议申请提交失败！")
                window.location.href="../../home/meeting/apcMeeting.php"
            </script>
        <?php
    }

?>