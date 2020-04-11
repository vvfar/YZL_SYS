<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../conn/conn.php");

    $date=$_GET["date"];

    $sqlstr="select max(id) from data_can_change";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    if($maxID==0){
        $sqlstr2="insert into data_can_change values('$maxID'+1,'$date')";
    }else{
        $sqlstr2="update data_can_change set date='$date' where id=1";
    }
    
    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../managerData.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        window.location.href="../../managerData.php"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);

?>

