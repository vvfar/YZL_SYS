<?php
    include_once("../../common/conn/conn.php");

    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    session_start();
    $username=$_SESSION["username"];

    date_default_timezone_set("Asia/Shanghai");
    $time=date('Y-m-d  H:i:s', time());
    $date=date('Y-m-d', time());

    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $my_department=$myrow[0];
    }


    $id=$_POST["id"];
    $storeID=$_POST["storeID"];
    $client=$_POST["client"];
    $storeName=$_POST["storeName"];
    $question=$_POST["question"];
    

    $sqlstr1="select max(id) from store_qs";
    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    $sqlstr2="insert into store_qs values('$maxID'+1,'$storeID','$question','','待处理','$date')";
        
    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/store/storeQS.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        window.location.href="../../home/store/storeAddQS.php"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);

    
?>

