<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time());  //签署日期

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

    //销售额&回款
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(b.salesMoney) from store a,store_data_sales b where a.storeID=b.storeID ";
    }else if($chooseOne == "回款"){

    }

    //事业部
    if($chooseTwo != "全部"){
        $sqlstr1=$sqlstr1."and a.department='$chooseTwo' ";
    }

    //平台
    if($chooseThree != "全部"){
        $sqlstr1=$sqlstr1."and a.pingtai='$chooseThree' ";
    }

    //类目
    if($chooseFour != "全部"){
        $sqlstr1=$sqlstr1."and a.category='$chooseThree' ";
    }

    //店铺
    if($chooseFive != "全部"){
        $sqlstr1=$sqlstr1."and a.storeName='$chooseFive' ";
    }

    //业务员
    if($chooseSix != "全部"){
        $sqlstr1=$sqlstr1."and a.staff='$chooseFour' ";
    }

    //时间段
    if($chooseSeven == "日"){
        $sqlstr1=$sqlstr1."and b.date='$date1' ";
    }elseif($chooseSeven == "周"){

    }elseif($chooseSeven == "月"){
        
    }elseif($chooseSeven == "年"){
        
    }

    $result=mysqli_query($conn,$sqlstr1);
    
    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    $tb=0;
    $hb=0;



    $data='[
        {"name":"title","value":"'.$chooseOne.'"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.number_format($num, 2).'"},
        {"name":"tb","value":"'.$tb.'"},
        {"name":"hb","value":"'.$hb.'"}  
    ]';

    echo $data;
?>