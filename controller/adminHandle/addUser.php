<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_POST["id"];
    $username=$_POST["username"];
    $department=$_POST["department"];
    $newLevel=$_POST["newLevel"];
    $level=$_POST["level"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $nickname=$_POST["nickname"];

    $sqlstr="select max(id) from user_form";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    if($id==""){
        $sqlstr2="insert into user_form values('$maxID'+1,'$username','123456','$department','$level','$phone','$email','$nickname','default_icon.jpg','$newLevel')";
    }else{
        $sqlstr2="update user_form set username='$username',department='$department',level='$level',newLevel='$newLevel',phone='$phone',email='$email',nickname='$nickname' where id='$id'";
    }
    
    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../admin/manager/manager_index.php"
        </script> 
    <?php
    }else{

    ?>

    <script>
        alert("提交失败！")
        window.location.href="../../admin/manager/manager_index.php"
    </script> 
    <?php
    
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>

