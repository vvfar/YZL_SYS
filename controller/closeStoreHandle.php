<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    
    $id=$_POST["id"];
    $reason=$_POST["reason"];

    $sqlstr1="update store set reason='$reason',status='关闭' where id='$id'";

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?> 
        <script>
            alert("提交成功！");
            window.location.href="../manStore2.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("提交失败！");
            window.location.href="../closeStore.php";
        </script>
        <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>