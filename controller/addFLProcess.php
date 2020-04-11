<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $id=$_POST["id"];
    $number=$_POST["number"];
    $name=$_POST["name"];
    $sp=$_POST["sp"];
    $cs=$_POST["cs"];
    $department=$_POST["department"];
    $flprogress_id=$_POST["flprogress_id"];

    $sqlstr="select max(id) from flprogress";
    $sqlstr1="select max(number) from flprogress where flprogress_id='$flprogress_id'";

    $result=mysqli_query($conn,$sqlstr);
    $result1=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    while($myrow=mysqli_fetch_row($result1)){
        $maxNumber=$myrow[0];
    }
    

    if($maxID==""){
        $maxID=0;
    }

    if($number <= $maxNumber){

        $sqlstr3="update flprogress set number=number+1 where number>=$number and flprogress_id='$flprogress_id' and no=1";
        
        $result=mysqli_query($conn,$sqlstr3);  
    }
    
    $sqlstr2="insert into flprogress values('$maxID'+1,'$number','$name','$sp','$cs','$department','$flprogress_id',1)";

    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！");
            window.location.href="../../flProcess.php?id=<?=$flprogress_id?>&department=<?=$department?>";
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../flProcess.php?id=<?=$flprogress_id?>&department=<?=$department?>";
    </script> 
    <?php
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
?>