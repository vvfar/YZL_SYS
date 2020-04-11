<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    session_start();

    $username=$_SESSION['username'];

    if(!empty($_FILES['upfile']['name'])){
        $fileinfo=$_FILES['upfile'];
        if($fileinfo['size']<2097152 && $fileinfo['size']>0){
            $path="../user_icon/".$_FILES["upfile"]["name"];
            move_uploaded_file($fileinfo['tmp_name'],$path);
            
            $fileName=$_FILES['upfile']['name'];

            echo $fileName;
            $sqlstr1="update user_form set headImg='$fileName' where username='$username'";

            echo $sqlstr1;

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
        }else{
            ?>
            <script>alert("头像太大上传失败！")</script>
            <?php
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>