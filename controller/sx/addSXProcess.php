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
    $sxprogress_id=$_POST["sxprogress_id"];

    $sqlstr="select max(id) from sxprogress";
    $sqlstr1="select max(number) from sxprogress where sxprogress_id='$sxprogress_id'";

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

        $sqlstr3="update sxprogress set number=number+1 where number>=$number and sxprogress_id='$sxprogress_id' and no=2";
        
        $result=mysqli_query($conn,$sqlstr3);  
    }
    
    $sqlstr2="insert into sxprogress values('$maxID'+1,'$number','$name','$sp','$cs','$department','$sxprogress_id',2)";

    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！");
            window.location.href="../../sxProcess.php?id=<?=$sxprogress_id?>&department=<?=$department?>";
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../sxProcess.php?id=<?=$sxprogress_id?>&department=<?=$department?>";
    </script> 
    <?php
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
?>