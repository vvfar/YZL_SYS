<?php

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

    $chooseOne=$_POST['chooseOne'];
    $chooseTwo=$_POST['chooseTwo'];
    $chooseThree=$_POST['chooseThree'];
    $chooseFour=$_POST['chooseFour'];
    $chooseFive=$_POST['chooseFive'];
    $chooseSix=$_POST['chooseSix'];
    $chooseSeven=$_POST['chooseSeven'];
    $chooseEight=$_POST['chooseEight'];

    if($chooseEight=="默认"){
        date_default_timezone_set("Asia/Shanghai");
        $date=time();
    }else{
        $date=$chooseEight;
    }

    if($chooseEight=="默认"){
        $date1=date('Y-m-d');
        $date2=date('Y-m-d', strtotime("-1 month"));
        $date3=date('Y-m-d', strtotime("-1 year"));

        $dateMonth=date('Y-m');
        $dateMonth2=date('Y-m', strtotime("-1 month"));
        $dateMonth3=date('Y-m', strtotime("-1 year"));

        $dateYear=date('Y');
        $dateYear2=date('Y', strtotime("-1 year"));
        $dateYear3=date('Y', strtotime("-1 year"));
    }else{
        $date1=date('Y-m-d', strtotime("$date"));
        $date2=date('Y-m-d', strtotime("$date -1 month"));
        $date3=date('Y-m-d', strtotime("$date -1 year"));

        $dateMonth=$date;
        $dateMonth2=date('Y-m', strtotime("$date -1 month"));
        $dateMonth3=date('Y-m', strtotime("$date -1 year"));

        $dateYear=date('Y', strtotime("$date -1 year"));
        $dateYear2=date('Y', strtotime("$date -1 year"));
        $dateYear3=date('Y', strtotime("$date -1 year"));
    }


    //销售额&回款
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(salesMoney) from store_data_sales where staff= any(select staff from store where 1=1 ";
    }else if($chooseOne == "回款"){
        $sqlstr1="select sum(backMoney) from store_data_hk where  staff= any(select staff from store where 1=1 ";
    }

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
    
    $sqlstr1=$sqlstr1.") ";

    //时间段

    if($chooseSeven == "日"){
        $sqlstr=$sqlstr1."and date='$date1' ";  //当期
        $sqlstr2=$sqlstr1."and date='$date2' ";  //环比
        $sqlstr3=$sqlstr1."and date='$date3' ";   //同比
    }elseif($chooseSeven == "月"){
        $sqlstr=$sqlstr1."and date like '%$dateMonth%' "; //当期
        $sqlstr2=$sqlstr1."and date like '%$dateMonth2%' ";  //环比
        $sqlstr3=$sqlstr1."and date like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "年"){
        $sqlstr=$sqlstr1."and date like '%$dateYear%' ";  //当期
        $sqlstr2=$sqlstr1."and date like '%$dateYear2%' ";  //环比
        $sqlstr3=$sqlstr1."and date like '%$dateYear3%' ";  //同比
    }

    

    $result=mysqli_query($conn,$sqlstr);
    
    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    $result=mysqli_query($conn,$sqlstr2);
    
    while($myrow=mysqli_fetch_row($result)){
        $num2=$myrow[0];
    }

    $result=mysqli_query($conn,$sqlstr3);
    
    while($myrow=mysqli_fetch_row($result)){
        $num3=$myrow[0];
    }

    
    if($num3 !="" and $num !=""){
        $tb=($num-$num3)/$num3*100;
    }else{
        $tb=0;
    }

    if($num2 !="" and $num !=""){
        $hb=($num-$num2)/$num3*100;
    }else{
        $hb=0;
    }
    
    

    $data='[
        {"name":"title","value":"'.$chooseOne.'"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.number_format($num, 2).'"},
        {"name":"tb","value":"'.number_format($tb, 2).'"},
        {"name":"hb","value":"'.number_format($hb, 2).'"},
        {"name":"现销售额","value":"'.$sqlstr.'"},
        {"name":"环比销售额","value":"'.$sqlstr2.'"},
        {"name":"同比销售额","value":"'.$sqlstr3.'"}
    ]';

    echo $data;
?>