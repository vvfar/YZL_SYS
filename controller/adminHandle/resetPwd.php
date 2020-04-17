<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_GET['id'];

    $sqlstr="update user_form set password='123456' where id='$id'";
    $result=mysqli_query($conn,$sqlstr);

    if($result){
        ?>
        <script>
            alert("重置密码成功！密码：123456")
            window.location.href="../../admin/manager/manager_index.php"
        </script> 
        <?php
    }else{
        ?>
        <script>
            alert("重置密码失败！")
            window.location.href="../../admin/manager/manager_index.php"
        </script> 
        <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>

