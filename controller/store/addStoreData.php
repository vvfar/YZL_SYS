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
        $link=$_POST["link"];
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

    $sqlstr1="select staff from store where storeID='$storeID' ";
        
    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $staff=$myrow[0];
    }

    $sqlstr2="select count(*) from store_data where storeID='$storeID' and date='$dateTime'";
        
    $result=mysqli_query($conn,$sqlstr2);

    while($myrow=mysqli_fetch_row($result)){
        $store_data_count=$myrow[0];
    }

    if($store_data_count == 0){
        $sqlstr3="insert into store_data values('$maxID'+1,'$storeID','$salesMoney','$salesNum','$backMoney','','$dateTime','$staff')";
    }else{
        if($my_department =="商务运营部"){
            $sqlstr3="update store_data set salesMoney='$salesMoney',salesNum='$salesNum' where storeID='$storeID' and date='$dateTime'";
        }else{
            $sqlstr3="update store_data set backMoney='$backMoney' where storeID='$storeID' and date='$dateTime'";
        
            if($link != ""){
                $sqlstr4="update store set link='$link' where storeID='$storeID'";
                $result=mysqli_query($conn,$sqlstr4);
            }
        }
    }

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

