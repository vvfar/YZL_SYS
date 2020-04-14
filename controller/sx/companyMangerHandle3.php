<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $sqid=$_POST["sqid"];

    if(!empty($_FILES['upfile']['name'])){
        $fileinfo=$_FILES['upfile'];
        if($fileinfo['size']<2097152 && $fileinfo['size']>0){
            $path="../../common/file/sx_file/".$_FILES["upfile"]["name"];
            move_uploaded_file($fileinfo['tmp_name'],$path);
        }else{
            ?>
            <script>alert("授权证书大小上传失败！")</script>
            <?php
        }

        $fileName=$_FILES['upfile']['name'];

        $sqlstr3="update sx_form set file_name='$fileName',status='已生效',status2='纸质附件已上传' where id='$sqid'";
        
        $result3=mysqli_query($conn,$sqlstr3);

        ?>
            <script>
                alert("提交成功!");
                window.location.href="../../home/sx/sx_line.php?id=<?=$sqid?>";
            </script>
        <?php
    
    }else{
        ?>
            <script>
                alert("提交失败!");
                window.location.href="../../home/sx/sx_line.php?id=<?=$sqid?>";
            </script>
        <?php
    }
?>