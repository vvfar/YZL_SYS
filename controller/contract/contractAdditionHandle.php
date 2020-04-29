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
        $no=$_POST["no"];
        $id=$_GET["id"];

        $content=$_POST["content"];

        $sqlstr="select max(id) from contract_add";
        $result=mysqli_query($conn,$sqlstr);
    
        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }
        
        if($id == ""){
            $sqlstr2="insert into contract_add values('$maxID'+1,'$no','$content','待归档','$username','$date')";
        }else{
            $sqlstr2="update contract_add set content='$content',status='待归档' where id='$id'";
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
        $no=$_GET["no"];
        $option=$_GET["option"];
        
        if($option ==1){
            $sqlstr2="update contract_add set status ='已归档' where no='$no'";
        }else{
            $sqlstr2="update contract_add set status ='审核拒绝' where no='$no'";
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
