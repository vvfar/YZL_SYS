<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $id=$_GET["id"];

    $sqlstr2="delete from flprogress_all where id=$id";

    $result=mysqli_query($conn,$sqlstr2);

    $sqlstr3="delete from flprogress where flprogress_id=$id";

    $result=mysqli_query($conn,$sqlstr3);

    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../../manager_process.php"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../manager_process.php"
    </script> 
    <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>