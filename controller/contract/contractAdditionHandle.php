<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    $date=date('Y-m-d', time());

    $username=$_SESSION['username'];

    $progress=$_GET["progress"];

    if($progress ==1){

        $id=$_POST["id"];

        $no=$_POST["no"];
        $company=$_POST["company"];
        $store=$_POST["store"];
        $pingtai=$_POST["pingtai"];
        $category=$_POST["category"];
        $money=$_POST["money"];
        $ismoney=$_POST["ismoney"];
        $sales=$_POST["sales"];
        $issales=$_POST["issales"];
        $service=$_POST["service"];
        $isservice=$_POST["isservice"];
        $content=$_POST["content"];
        $input_time=$_POST["input_time"];
        $input_time2=$_POST["input_time2"];

        $fileName="";

        if(!empty($_FILES['upfile']['name'])){
    
            $fileinfo=$_FILES['upfile'];
            if($fileinfo['size']<20971520 && $fileinfo['size']>0){
                //echo $fileName;
    
                $path="../../common/file/contractAdd_file/".$_FILES["upfile"]["name"];
                move_uploaded_file($fileinfo['tmp_name'],$path);
                
                $fileName=$_FILES['upfile']['name'];   
            }else{
                echo "<script>alert('照片过大无法上传！');window.location.href='../../home/contract/contractAddition.php'</script>";
            }
        }

        $sqlstr="select max(id) from contract_add";
        $result=mysqli_query($conn,$sqlstr);
    
        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }
        
        if($id == ""){
            $sqlstr2="insert into contract_add values('$maxID'+1,'$no','$content','待归档','$username','$date','$fileName','$pingtai','$category','$company','$store','$input_time','$input_time2','$money','$ismoney','$sales','$issales','$service','$isservice')";
        }else{
            $sqlstr2="update contract_add set content='$content',status='待归档',file='$fileName',pingtai='$pingtai',category='$category',company='$company',store='$store',input_time='$input_time',input_time2='$input_time2',money='$money',ismoney='$ismoney',".
                    "sales='$sales',issales='$issales',service='$service',isservice='$isservice' where id='$id'";
        }
        

        $result=mysqli_query($conn,$sqlstr2);
    
        if($result){
            ?>
            <script>
                alert("提交成功！")
                window.location.href="../../home/contract/w_contractAdd.php"
            </script>
    
        <?php
        }else{
            ?>
            <script>
                alert("提交失败！")
                window.location.href="../../home/contract/contractAddition.php?id=<?=$id?>"
            </script>
            <?php
        }
    }else{
        $id=$_GET["id"];
        $option=$_GET["option"];
        
        if($option ==1){
            $sqlstr2="update contract_add set status ='已归档' where id='$id'";
        }else{
            $sqlstr2="update contract_add set status ='审核拒绝' where id='$id'";
        }
        
        $result=mysqli_query($conn,$sqlstr2);

        if($result){
            ?>
            <script>
                alert("提交成功！")
                window.location.href="../../home/contract/contract_AddList.php"
            </script>
    
        <?php
        }else{
            ?>
            <script>
                alert("提交失败！")
                window.location.href="../../home/contract/contractAddition.php?id=<?=$id?>"
            </script>
            <?php
        }
    }
?>
