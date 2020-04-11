<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $companyName=$_POST['companyName'];

    session_start();
    $username=$_SESSION["username"];
    
    $sqlstr="select max(id) from store_form";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    $sqlstr2="insert into store_form values('$maxID'+1,'','$companyName','','$department')";

    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../companyManger1.php"
        </script>

        <?php
    }else{
        ?>
        <script>
            alert("提交失败！")
            window.location.href="../companyManger1.php"
        </script>
        <?php
    }
    
    //mysqli_free_result($result);
    mysqli_close($conn);
?>
