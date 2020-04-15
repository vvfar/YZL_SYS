<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    
    $new_pwd1=$_POST["newPwd1"];
    $new_pwd2=$_POST["newPwd2"];

    if($new_pwd1 =="" || $new_pwd2 == ""){
        ?>
        <script>
            alert("密码信息未填写！")
            windows.location.href="../center.php";
        </script>
        
        <?php
    }elseif(strlen($new_pwd1)<6 || strlen($new_pwd1) > 18){
        ?>
        <script>
            alert("密码长度填写不符合要求！")
            windows.location.href="../center.php";
        </script>
        
        <?php
    }elseif($new_pwd1 != $new_pwd2){
        ?>
        <script>
            alert("密码与确认密码输入不一致！")
            windows.location.href="../center.php";
        </script>
        
        <?php
    }else{
        session_start();

        $username=$_SESSION['username'];

        $sqlstr1="update user_form set password='$new_pwd1' where username='$username'";


        $result=mysqli_query($conn,$sqlstr1);

        if($result){
            ?> 
            <script>
                alert("密码已修改，请重新登陆！");
                window.location.href="account/logoutHandle.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("提交失败！");
                window.location.href="../center.php";
            </script>
            <?php
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);

?>