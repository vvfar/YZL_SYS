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


    //计算待审核合同
    $sqlstr3="select shr,status from contract";

    $result3=mysqli_query($conn,$sqlstr3);

    $count_contract=0;
    $link_contract="../../home/contract/w_contract.php";

    while($myrow=mysqli_fetch_row($result3)){
        
        $shr=$myrow[0];
        $status=$myrow[1];

        if($shr == $ywy and $status == "审核拒绝" and $newLevel == "KA"){
            $count_contract=$count_contract+1;
        }elseif($department == "商务运营部" and  $status == "待归档"){
            $count_contract=$count_contract+1;
        }
    }

    //计算待审核授权
    $sqlstr4="select shr,status from sq";

    $result4=mysqli_query($conn,$sqlstr4);

    $count_sq=0;
    $link_sq="../../home/contract/w_sq.php";

    while($myrow=mysqli_fetch_row($result4)){
        
        $shr=$myrow[0];
        $status=$myrow[1];

        if($shr == $ywy and $status == "审核拒绝" and $newLevel == "KA"){
            $count_sq=$count_sq+1;
        }elseif($department == "商务运营部" and  $status == "待归档"){
            $count_sq=$count_sq+1;

        }
    }

    //计算待审核回款
    $sqlstr5="select status from hk_form2 where status='待财务审批'";

    $sqlstr5=mysqli_query($conn,$sqlstr5);

    $count_hk=0;
    $link_hk="../../home/sx/sx_cw.php";

    while($myrow=mysqli_fetch_row($sqlstr5)){
        
        $shr=$myrow[0];
        $status=$myrow[1];

        if($department == "财务部" ){
            $count_hk=$count_hk+1;
        }
    }

    //计算待处理问题
    $sqlstr6="select username from user_form where department  like concat('%', (select department from store where storeID = (select storeID from store_qs where status='待处理')),'%') and newLevel='M'";

    $sqlstr6=mysqli_query($conn,$sqlstr6);

    $count_qs=0;
    $link_qs="../../home/store/storeQS.php";

    while($myrow=mysqli_fetch_row($sqlstr6)){

        $shr2=$myrow[0];

        
        
        if($username == $shr2 ){

            
            $count_qs=$count_qs+1;
            
        }
    }

    $data='[
            {"name_dbsx":"待审辅料","number_dbsx":"'.$count_fl.'","link_dbsx":"'.$link_fl.'"},
            {"name_dbsx":"待审授信","number_dbsx":"'.$count_sx.'","link_dbsx":"'.$link_sx.'"},
            {"name_dbsx":"待审合同","number_dbsx":"'.$count_contract.'","link_dbsx":"'.$link_contract.'"},
            {"name_dbsx":"待审授权","number_dbsx":"'.$count_sq.'","link_dbsx":"'.$link_sq.'"},
            {"name_dbsx":"待审回款","number_dbsx":"'.$count_hk.'","link_dbsx":"'.$link_hk.'"},
            {"name_dbsx":"店铺问题","number_dbsx":"'.$count_qs.'","link_dbsx":"'.$link_qs.'"}
        ]';
    
    echo $data;
?>