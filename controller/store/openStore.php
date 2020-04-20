<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    
    $id=$_GET["id"];

    $sqlstr1="update store set status='正常' where id='$id'";

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?> 
        <script>
            alert("提交成功！");
            window.location.href="../../home/store/manStore.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("提交失败！");
            window.location.href="../../home/store/newStore.php?id=$id" ;
        </script>
        <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);


?>