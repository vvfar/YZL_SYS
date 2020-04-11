<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $name=$_POST["name"];
    $department=$_POST["department"];
    $no=$_POST["no"];


    $sqlstr="select max(id) from sxprogress_all";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    $sqlstr2="insert into sxprogress_all values('$maxID'+1,'$name','$department',2)";
    
    $result=mysqli_query($conn,$sqlstr2);

    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../../sxProcess.php?id=<?=$maxID+1?>&department=<?=$department?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../manager_process_sx.php";
    </script> 
    <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>