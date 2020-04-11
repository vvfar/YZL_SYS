<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $sxid=trim(isset($_GET['sxid'])?$_GET['sxid']:"");

    session_start();
    $username=$_SESSION["username"];
    $sqlstr="select newMoney from use_sx where sqid='$sxid'";

    $result=mysqli_query($conn,$sqlstr);

    $newMoney="";

    if($result){
        while($myrow=mysqli_fetch_row($result)){
            $newMoney=$myrow[0];
        }

        if($newMoney==""){
            echo 0;
        }else{
            echo $newMoney;
        }
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>