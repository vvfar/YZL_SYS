<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $name=trim(isset($_GET['name'])?$_GET['name']:"");

    session_start();
    $username=$_SESSION["username"];
    $sqlstr="select no from flsqd where no='$name'";

    $result=mysqli_query($conn,$sqlstr);

    $no="";

    if($result){
        while($myrow=mysqli_fetch_row($result)){
            $no=$myrow[0];
        }

        if($no==""){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>
