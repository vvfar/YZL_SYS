<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time());
    $date2=date("Y-m-d", strtotime("-1 month"));
    $date3=date("Y-m-d", strtotime("-1 year"));

    $dateMonth=date('Y-m', time());
    $dateMonth2=date('Y-m', strtotime("-1 month"));
    $dateMonth3=date('Y-m', strtotime("-1 year"));

    $dateYear=date('Y', time());
    $dateYear2=date('Y', strtotime("-1 year"));
    $dateYear3=date('Y', strtotime("-1 year"));

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

    $sqlstr1="select count(*) from store where status='关闭' ";


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
        $sqlstr=$sqlstr1."and createDate='$date1' ";  //当期
        $sqlstr2=$sqlstr1."and createDate='$date2' ";  //环比
        $sqlstr3=$sqlstr1."and createDate='$date3' ";   //同比
    }elseif($chooseSeven == "月"){
        $sqlstr=$sqlstr1."and createDate like '%$dateMonth%' "; //当期
        $sqlstr2=$sqlstr1."and createDate like '%$dateMonth2%' ";  //环比
        $sqlstr3=$sqlstr1."and createDate like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "年"){
        $sqlstr=$sqlstr1."and createDate like '%$dateYear%' ";  //当期
        $sqlstr2=$sqlstr1."and createDate like '%$dateYear2%' ";  //环比
        $sqlstr3=$sqlstr1."and createDate like '%$dateYear3%' ";  //同比
    }

    //当期

    $result=mysqli_query($conn,$sqlstr);
    
    $num=0;

    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    //环比
    $result=mysqli_query($conn,$sqlstr2);
    
    $num2=0;

    while($myrow=mysqli_fetch_row($result)){
        $num2=$myrow[0];
    }

    //同比
    $result=mysqli_query($conn,$sqlstr3);
    
    $num3=0;

    while($myrow=mysqli_fetch_row($result)){
        $num3=$myrow[0];
    }


    if($num3 !="" and $num !=""){
        $tb=($num-$num3)/$num3*100;
    }else{
        $tb=0;
    }

    if($num2 !="" and $num !=""){
        $hb=($num-$num2)/$num2*100;
    }else{
        $hb=0;
    }
    

    $data='[
        {"name":"title","value":"不合作店铺"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.$num.'"},
        {"name":"tb","value":"'.number_format($tb, 2).'"},
        {"name":"hb","value":"'.number_format($hb, 2).'"}  
    ]';

    echo $data;
?>