<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../conn/conn.php");

    $id=$_GET['id'];
    $sqlstr="delete from news where id='$id'";
    $result=mysqli_query($conn,$sqlstr);

    if($result){
        ?>
        <script>
            alert("删除成功！")
            window.location.href="../../managerNews.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("删除失败！")
        window.location.href="../../managerNews.php"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>
