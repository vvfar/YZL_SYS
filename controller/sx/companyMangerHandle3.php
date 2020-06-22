<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $progress=$_GET["progress"];

    if($progress == "1"){
        $sqid=$_POST["sqid"];

        if(!empty($_FILES['upfile']['name'])){
            $fileinfo=$_FILES['upfile'];
            if($fileinfo['size']<209715200 && $fileinfo['size']>0){
                $path="../../common/file/sx_file/".$_FILES["upfile"]["name"];
                move_uploaded_file($fileinfo['tmp_name'],$path);
            }else{
                ?>
                <script>alert("授权证书大小上传失败！")</script>
                <?php
            }
    
            $fileName=$_FILES['upfile']['name'];
    
            $sqlstr3="update sx_form set file_name='$fileName',status='待归档',status2='纸质附件已上传' where id='$sqid'";
            
            $result3=mysqli_query($conn,$sqlstr3);

            if($result3){
                echo "<script>alert('提交成功!');window.location.href='../../home/sx/zhangmu.php'</script>";
            }else{
                echo "<script>alert('提交失败!');window.location.href='../../home/sx/sx_line.php?id=<?=$sqid?>'</script>";
            }
        }else{
            ?>
                <script>alert("授信附件不能为空！")</script>
            <?php
            echo "<script>alert('提交失败!');window.location.href='../../home/sx/sx_line.php?id=$sqid'</script>";
        }

        
    }else if($progress == "2"){

        $sqid=$_GET["id"];
        $option=$_GET["option"];

        if($option == "1"){
            $sqlstr3="update sx_form set status='已生效' where id='$sqid'";

        }else{
            $sqlstr3="update sx_form set status='已拒绝' where id='$sqid'";
        }

        $result3=mysqli_query($conn,$sqlstr3);

        if($result3){
            echo "<script>alert('提交成功!');window.location.href='../../home/sx/zhangmu2.php?id=<?=$sqid?>'</script>";
        }else{
            echo "<script>alert('提交失败!');window.location.href='../../home/sx/sx_line.php?id=<?=$sqid?>'</script>";
        }
    }

    
?>