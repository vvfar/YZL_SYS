<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time());
    $dateMonth=date('Y-m', time());
    $dateYear=date('Y', time());

    session_start();   
    $username=$_SESSION["username"];

    $sqlstr0="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }


    $chooseOne=$_POST['chooseOne'];
    $chooseTwo=$_POST['chooseTwo'];
    $chooseThree=$_POST['chooseThree'];
    $chooseFour=$_POST['chooseFour'];
    $chooseFive=$_POST['chooseFive'];
    $chooseSix=$_POST['chooseSix'];
    $chooseSeven=$_POST['chooseSeven'];

    $sqlstr1="select count(*) from store where status='正常' ";


    //事业部
    if($chooseTwo != "全部"){
        $sqlstr1=$sqlstr1."and department='$chooseTwo' ";
    }

    //平台
    if($chooseThree != "全部"){
        $sqlstr1=$sqlstr1."and pingtai='$chooseThree' ";
    }

    //类目
    if($chooseFour != "全部"){
        $sqlstr1=$sqlstr1."and category='$chooseThree' ";
    }

    //店铺
    if($chooseFive != "全部"){
        $sqlstr1=$sqlstr1."and storeName='$chooseFive' ";
    }

    //业务员
    if($chooseSix != "全部"){
        $sqlstr1=$sqlstr1."and staff='$chooseFour' ";
    }

    if($chooseSeven != "月" and $chooseSeven != "年"){
        $chooseSeven = "日";
    }
    

    //时间段
    if($chooseSeven == "日"){
        $sqlstr1=$sqlstr1."and createDate='$date1' ";
    }elseif($chooseSeven == "月"){
        $sqlstr1=$sqlstr1."and createDate like '%$dateMonth%' ";
    }elseif($chooseSeven == "年"){
        $sqlstr1=$sqlstr1."and createDate like '%$dateYear%' ";
    }

    $result=mysqli_query($conn,$sqlstr1);
    
    $num=0;

    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    $tb=0;
    $hb=0;

    $data='[
        {"name":"title","value":"新开拓店铺"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.$num.'"},
        {"name":"tb","value":"'.$tb.'"},
        {"name":"hb","value":"'.$hb.'"}  
    ]';

    echo $data;
?>
