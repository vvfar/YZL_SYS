<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../conn/conn.php");

    $id=$_GET['id'];
    $fileName=$_GET['fileName'];

    $sqlstr="delete from files where id='$id'";
    $result=mysqli_query($conn,$sqlstr);

    if($result){
        $path=iconv('utf-8','gb2312',"../../file/".$fileName);
        unlink($path);

        ?>
        <script>
            alert("删除成功！")
            window.location.href="../../managerFile.php"
        </script> 
    <?php
    }else{
        ?>
        <script>
            alert("删除失败！")
            window.location.href="../../managerFile.php"
        </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>
