<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    session_start();

    $username=$_SESSION['username'];

    $option=$_GET["option"];

    if($option == 1){
        //修改基本信息

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
            echo "<script>alert('提交成功！');window.location.href='../../home/center/center.php'</script>";
        }else{
            echo "<script>alert('提交失败！');window.location.href='../../home/center/center.php'</script>";
        }

    }elseif($option ==2){
        //修改密码

        $new_pwd1=$_POST["newPwd1"];
        
        $sqlstr1="update user_form set password='$new_pwd1' where username='$username'";
        
        $result=mysqli_query($conn,$sqlstr1);

        if($result){
            echo "<script>alert('提交成功！');window.location.href='../../controller/account/logoutHandle.php'</script>";
        }else{
            echo "<script>alert('提交失败！');";
        }
    
    
    }elseif($option ==3){
        //上传头像

        if(!empty($_FILES['upfile']['name'])){
            $fileinfo=$_FILES['upfile'];
            if($fileinfo['size']<2097152 && $fileinfo['size']>0){
                $path="../../common/file/user_icon/".$_FILES["upfile"]["name"];
                move_uploaded_file($fileinfo['tmp_name'],$path);
                
                $fileName=$_FILES['upfile']['name'];

                $sqlstr1="update user_form set headImg='$fileName' where username='$username'";
    
                $result=mysqli_query($conn,$sqlstr1);
    
                if($result){
                    ?> 
                    <script>
                        alert("提交成功！");
                        window.location.href="../../home/center/center.php";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert("提交失败！");
                        window.location.href="../../home/center/center.php";
                    </script>
                    <?php
                }
            }else{
                ?>
                <script>alert("头像太大上传失败！")</script>
                <?php
            }
        }
    }

    

    mysqli_free_result($result);
    mysqli_close($conn);
?>
