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
    $chooseEight=$_POST['chooseEight'];

    //销售额&回款
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(b.salesMoney),a.staff from store a,store_data_sales b where a.storeID=b.storeID ";
    }else if($chooseOne == "回款"){
        $sqlstr1="select sum(b.backMoney),a.staff from store a,store_data_hk b where a.storeID=b.storeID ";
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

    if($chooseSeven != "月" and $chooseSeven != "年"){
        $chooseSeven = "日";
    }

    //时间段
    if($chooseEight=="默认"){
        if($chooseSeven == "日"){
            $sqlstr1=$sqlstr1."and b.date='$date1' ";
        }elseif($chooseSeven == "月"){
            $sqlstr1=$sqlstr1."and b.date like '%$dateMonth%' ";
        }elseif($chooseSeven == "年"){
            $sqlstr1=$sqlstr1."and b.date like '%$dateYear%' ";
        }
    }else{
        $sqlstr1=$sqlstr1."and b.date like '%$chooseEight%' "; //当期
    }

    $sqlstr1=$sqlstr1." group by a.staff order by ";
    
    if($chooseOne == "销售额"){
        $sqlstr1=$sqlstr1." sum(b.salesMoney) ";
    }else if($chooseOne == "回款"){
        $sqlstr1=$sqlstr1." sum(b.backMoney) ";
    }
    
    $sqlstr1=$sqlstr1." desc limit 0,5";

    $result=mysqli_query($conn,$sqlstr1);
    
    $staff_list1='[';
    $staff_list_str="";

    $number_list1='[';
    $number_list_str="";

    while($myrow=mysqli_fetch_row($result)){
        $number_list_str=$number_list_str.'"'.$chooseOne.'：￥'.number_format($myrow[0],2).'",';
        $staff_list_str=$staff_list_str.'"'.$myrow[1].'",';
    }

    $staff_list_str = substr($staff_list_str,0,strlen($staff_list_str)-1);
    $number_list_str = substr($number_list_str,0,strlen($number_list_str)-1);

    $staff_list=$staff_list1.$staff_list_str.']';
    $number_list=$number_list1.$number_list_str.']';

    $tb=0;
    $hb=0;

    $data='[
        {"name":"title","value":"业绩排名"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"rank","value":'.$staff_list.'},
        {"name":"number","value":'.$number_list.'}
    ]';

    echo $data;
?>