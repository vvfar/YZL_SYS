<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    session_start();

    $username=$_SESSION['username'];

    if(isset($_POST['nickname'])){
        $nickname=$_POST['nickname'];
        $phone="";
        $email="";
    }elseif(isset($_POST['phone'])){
        $phone=$_POST['phone'];
        $email="";
        $nickname="";
    }elseif(isset($_POST['email'])){
        $email=$_POST['email'];
        $phone="";
        $nickname="";
    }

    if($nickname !=""){
        $sqlstr1="update user_form set nickname='$nickname' where username='$username'";
    }elseif($phone !=""){
        $sqlstr1="update user_form set phone='$phone' where username='$username'";
    }elseif($email !=""){
        $sqlstr1="update user_form set email='$email' where username='$username'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?> 
        <script>
            alert("提交成功！");
            window.location.href="../center.php";
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

    mysqli_free_result($result);
    mysqli_close($conn);
?>
