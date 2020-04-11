<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $id=$_GET["id"];
    $number=$_GET["number"];
    $sxprogress_id=$_GET["sxprogress_id"];
    $department=$_GET["department"];

    $sqlstr2="delete from sxprogress where id=$id";

    $result=mysqli_query($conn,$sqlstr2);

    $sqlstr="select max(number) from sxprogress";

    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxNumber=$myrow[0];
    }

    if($number < $maxNumber){
        $sqlstr3="update sxprogress set number=number-1 where number>=$number and sxprogress_id='$sxprogress_id'";
        
        $result=mysqli_query($conn,$sqlstr3);  
    }


    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../sxProcess.php?id=<?=$sxprogress_id?>&department=<?=$department?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../sxProcess.php?id=<?=$sxprogress_id?>&department=<?=$department?>";
    </script> 
    <?php
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
?>