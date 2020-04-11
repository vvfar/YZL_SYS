<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    session_start();
    $username=$_SESSION["username"];

    $id=$_GET["id"];
    $option=$_GET["option"];

    if($option==1){
        $sqlstr1="update meeting set status='已审核' where id='$id'";
    }else{
        $sqlstr1="update meeting set status='已拒绝' where id='$id'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?>
            <script>
                alert("提交成功！")
                window.location.href="/viewMeeting.php"
            </script>
        <?php
    }else{
        ?>
            <script>
                alert("提交失败！")
                window.location.href="/viewMeeting.php"
            </script>
        <?php
    }

?>

