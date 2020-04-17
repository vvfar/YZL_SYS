<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $title=$_POST['title'];
    $note=$_POST['note'];

    if(!empty($_FILES['upfile']['name'])){
        $fileinfo=$_FILES['upfile'];
        if($fileinfo['size']<10240000 && $fileinfo['size']>0){

            //iconv防止出现上传中文名乱码
            $path=iconv('utf-8','gb2312',"../../common/file/myfile/".$_FILES["upfile"]["name"]);

            if(file_exists($path)){
                ?>
                <script>
                    alert("文件已存在！")
                    window.location.href="../../admin/manager/managerFile.php"
                </script>
                
                <?php
            }else{
                move_uploaded_file($fileinfo['tmp_name'],$path);

                session_start();
                $username=$_SESSION["username"];
                $fileName=$_FILES['upfile']['name'];
                $time=date('Y-m-d');

                $sqlstr="select max(id) from files";
                $result=mysqli_query($conn,$sqlstr);
        
                while($myrow=mysqli_fetch_row($result)){
                    $maxID=$myrow[0];
                }
        
                if($maxID==""){
                    $maxID=0;
                }

                if($note=="授信欠据模板"){
                    $sqlstr1="insert into files values('$maxID'+1,'$title','$fileName','$username','$time','授信欠据模板')";
                }elseif($note=="产品抵标费模板"){
                    $sqlstr1="insert into files values('$maxID'+1,'$title','$fileName','$username','$time','产品抵标费模板')";
                }elseif($note=="培训文档"){
                    $sqlstr1="insert into files values('$maxID'+1,'$title','$fileName','$username','$time','培训文档')";
                }else{
                    $sqlstr1="insert into files values('$maxID'+1,'$title','$fileName','$username','$time','')";
                }
                
                $result=mysqli_query($conn,$sqlstr1);

                if($result){
                    ?>
                    <script>
                        alert("上传成功！")
                        window.location.href="../../admin/manager/managerFile.php"
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert("上传失败！")
                        window.location.href="../../admin/manager/managerFile.php"
                    </script>
                    <?php
                }
            }

        }else{
            ?>
            <script>alert("文件太大上传失败！")</script>
            <?php
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>