<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $id=$_POST["id"];
    $number=$_POST["number"];
    $name=$_POST["name"];
    $sp=$_POST["sp"];
    $cs=$_POST["cs"];
    $department=$_POST["department"];
    $flprocess_id=$_POST["flprocess_id"];

    $sqlstr2="update flprogress set number='$number',name='$name',sp='$sp',cs='$cs' where id=$id";

    $result=mysqli_query($conn,$sqlstr2);

    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../../admin/manager/flProcess.php?id=<?=$flprocess_id?>&department=<?=$department?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../admin/manager/flProcess.php?id=<?=$flprocess_id?>&department=<?=$department?>";
    </script> 
    <?php
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
?>