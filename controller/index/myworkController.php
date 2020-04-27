<?php

    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    session_start();   
    $username=$_SESSION["username"];

    $sqlstr0="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }



    //计算待审核辅料
    $sqlstr="select shr from flsqd where not status like '%已归档%' and shr like '%$username%'";

    $result=mysqli_query($conn,$sqlstr);
    
    $count_fl=0;
    $link_fl="../../home/fl/flList.php";

    while($myrow=mysqli_fetch_row($result)){
        
        $shr=$myrow[0];
        $shr_arr=explode(",",$shr);
        $my_shr=array_pop($shr_arr);

        if($username == $my_shr and $newLevel == "KA"){
            $count_fl=$count_fl+1;
            $link_fl="../../home/fl/saveFL.php";
        }elseif($username == $my_shr){
            $count_fl=$count_fl+1;
        }
    }

    //计算待审核授信
    $sqlstr2="select ywy,status from sx_form";

    $result2=mysqli_query($conn,$sqlstr2);

    $count_sx=0;
    $link_sx="../../home/sx/zhangmu.php";

    while($myrow=mysqli_fetch_row($result2)){
        
        $ywy=$myrow[0];
        $status=$myrow[1];

        if($username == $ywy and $status == "待生效"){
            $count_sx=$count_sx+1;
            $link_sx='../../home/sx/djLoad.php';
        }elseif($username == $ywy and $status == "已拒绝"){
            $count_sx=$count_sx+1;
            $link_sx='../../home/sx/zhangmu.php';
        }elseif($department == "商务运营部" and  $status == "待归档"){
            $count_sx=$count_sx+1;
        }
    }


    $data='[
            {"name_dbsx":"待审辅料","number_dbsx":"'.$count_fl.'","link_dbsx":"'.$link_fl.'"},
            {"name_dbsx":"待审授信","number_dbsx":"'.$count_sx.'","link_dbsx":"'.$link_sx.'"},
            {"name_dbsx":"待审合同","number_dbsx":"0","link_dbsx":"../../home/contract/w_contract.php"},
            {"name_dbsx":"待审授权","number_dbsx":"0","link_dbsx":"../../home/contract/w_sq.php"},
            {"name_dbsx":"待审回款","number_dbsx":"0","link_dbsx":"../../home/sx/sx_cw.php"},
            {"name_dbsx":"店铺问题","number_dbsx":"0","link_dbsx":"../../home/fl/flList.php"}
        ]';
    
    echo $data;
?>