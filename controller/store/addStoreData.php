<?php
    include_once("../../common/conn/conn.php");

    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    session_start();
    $username=$_SESSION["username"];

    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $my_department=$myrow[0];
    }


    $id=$_POST["id"];
    $storeID=$_POST["storeID"];
    $client=$_POST["client"];
    $storeName=$_POST["storeName"];

    if($my_department =="商务运营部"){
        $salesMoney=$_POST["salesMoney"];
        $salesNum=$_POST["salesNum"];
        $backMoney="";
        $question="";
    }else{
        $backMoney=$_POST["backMoney"];
        $question=$_POST["question"];
        $salesMoney="";
        $salesNum="";
    }
    
    $dateTime=$_POST["dateTime"];

    $sqlstr1="select max(id) from store_data";
    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    $sqlstr3="select staff from store where storeID='$storeID' ";
        
    $result=mysqli_query($conn,$sqlstr3);

    while($myrow=mysqli_fetch_row($result)){
        $staff=$myrow[0];
    }


    $sqlstr3="insert into store_data values('$maxID'+1,'$storeID','$salesMoney','$salesNum','$backMoney','$question','$dateTime','$staff')";

    $result=mysqli_query($conn,$sqlstr3);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/store/dataStore.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        window.location.href="../../home/store/newStore.php"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);

    
?>

