<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $id=$_GET["id"];

    $sqlstr1="delete from day_data where id='$id'";

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?>
        <script>
            alert("删除成功！")
            window.location.href="../form.php"
        </script>

        <?php
    }else{
        ?>
        <script>
            alert("删除失败！")
            window.location.href="../form.php"
        </script>
        <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>