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

        $dateMonth=date('Y-m', strtotime("$date"));
        $dateMonth2=date('Y-m', strtotime("$date -1 month"));
        $dateMonth3=date('Y-m', strtotime("$date -1 year"));

        $dateYear=date('Y', strtotime("$date -1 year"));
        $dateYear2=date('Y', strtotime("$date -1 year"));
        $dateYear3=date('Y', strtotime("$date -1 year"));
    }

    //销售额&回款
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(salesMoney) from store_data_sales  where storeID= any(select storeID from store where 1=1 ";
    }else if($chooseOne == "回款"){
        $sqlstr1="select sum(backMoney) from store_data_hk where storeID= any(select storeID from store  where 1=1 ";
    }

    //事业部
    if($chooseTwo != "全部"){
        $sqlstr1=$sqlstr1." and department ='$department' ";
    }

    //平台
    if($chooseThree != "全部"){
        $sqlstr1=$sqlstr1."and pingtai='$chooseThree' ";
    }

    //类目
    if($chooseFour != "全部"){
        $sqlstr1=$sqlstr1."and category='$chooseFour' ";
    }

    //店铺
    if($chooseFive != "全部"){
        $sqlstr1=$sqlstr1."and storeName='$chooseFive' ";
    }

    //业务员
    if($chooseSix != "全部"){
        $sqlstr1=$sqlstr1."and staff='$chooseSix' ";
    }

    $sqlstr1=$sqlstr1.") ";

    if($chooseSeven != "月" and $chooseSeven != "年"){
        $chooseSeven = "日";
    }
    
    //时间段
    if($chooseSeven == "日"){
        $sqlstr_sj=$sqlstr1."and date='$date1' ";  //当期
        $sqlstr_sjhb=$sqlstr1."and date='$date2' ";  //环比
        $sqlstr__sjtb=$sqlstr1."and date='$date3' ";   //同比
    }elseif($chooseSeven == "月"){
        $sqlstr_sj=$sqlstr1."and date like '%$dateMonth%' "; //当期
        $sqlstr_sjhb=$sqlstr1."and date like '%$dateMonth2%' ";  //环比
        $sqlstr__sjtb=$sqlstr1."and date like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "年"){
        $sqlstr_sj=$sqlstr1."and date like '%$dateYear%' ";  //当期
        $sqlstr_sjhb=$sqlstr1."and date like '%$dateYear2%' ";  //环比
        $sqlstr__sjtb=$sqlstr1."and date like '%$dateYear3%' ";  //同比
    }

    $result=mysqli_query($conn,$sqlstr_sj);
    
    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }


    //销售额目标&回款目标
    if($chooseOne == "销售额"){
        $sqlstr2="select sum(storeTarget) from store_target where 1=1 ";
    }else if($chooseOne == "回款"){
        $sqlstr2="select sum(hkTarget) from store_target where 1=1 ";
    }

    //事业部
    if($chooseTwo != "全部"){
        $sqlstr2=$sqlstr2."and a.department='$chooseTwo' ";
    }

    //平台
    if($chooseThree != "全部"){
        $sqlstr2=$sqlstr2."and a.pingtai='$chooseThree' ";
    }

    //类目
    if($chooseFour != "全部"){
        $sqlstr2=$sqlstr2."and a.category='$chooseThree' ";
    }

    //店铺
    if($chooseFive != "全部"){
        $sqlstr2=$sqlstr2."and a.storeName='$chooseFive' ";
    }

    //业务员
    if($chooseSix != "全部"){
        $sqlstr2=$sqlstr2."and a.staff='$chooseFour' ";
    }

    if($chooseSeven != "月" and $chooseSeven != "年"){
        $chooseSeven = "日";
    }
    

   //时间段
    if($chooseSeven == "日"){
        $sqlstr=$sqlstr2."and dateMonth like '%$dateMonth%' ";  //当期
        $sqlstr2_=$sqlstr2."and dateMonth like '%$dateMonth2%' ";  //环比
        $sqlstr3_=$sqlstr2."and dateMonth like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "月"){
        $sqlstr=$sqlstr2."and dateMonth like '%$dateMonth%' "; //当期
        $sqlstr2_=$sqlstr2."and dateMonth like '%$dateMonth2%' ";  //环比
        $sqlstr3_=$sqlstr2."and dateMonth like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "年"){
        $sqlstr=$sqlstr2."and dateMonth like '%$dateYear%' ";  //当期
        $sqlstr2_=$sqlstr2."and dateMonth like '%$dateYear2%' ";  //环比
        $sqlstr3_=$sqlstr2."and dateMonth like '%$dateYear3%' ";  //同比
    }
   

    //当期
    $result=mysqli_query($conn,$sqlstr);

    $num_t=0;

    while($myrow=mysqli_fetch_row($result)){
        if($chooseSeven == "日"){
            $num_t=$myrow[0]/30;
        }elseif($chooseSeven == "月"){
            $num_t=$myrow[0];
        }elseif($chooseSeven == "年"){
            $num_t=$myrow[0];
        }
    }

    if($num_t !=0){
        $percent=number_format($num/$num_t, 2);
    }else{
        $percent="100";
    }




    //环比
    $result=mysqli_query($conn,$sqlstr_sjhb);
    
    $num=0;

    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    $result=mysqli_query($conn,$sqlstr2_);
    
    $num_t2=0;

    while($myrow=mysqli_fetch_row($result)){
        $num_t2=$myrow[0];
    }

    if($num_t2 !=0){
        $percent2=number_format($num/$num_t2, 2);
    }else{
        $percent2="100";
    }

    //同比
    $result=mysqli_query($conn,$sqlstr_sjtb);
    
    $num=0;

    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }

    $result=mysqli_query($conn,$sqlstr3_);

    $num_t3=0;

    while($myrow=mysqli_fetch_row($result)){
        $num_t3=$myrow[0];
    }

    if($num_t3 !=0){
        $percent3=number_format($num/$num_t3, 2);
    }else{
        $percent3="100";
    }
    

    $tb=number_format(($percent-$percent3)/$percent3*100,2);
    $hb=number_format(($percent-$percent2)/$percent2*100,2);

    $data='[
        {"name":"title","value":"完成比"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.$percent.'%"},
        {"name":"tb","value":"'.$tb.'"},
        {"name":"hb","value":"'.$hb.'"},
        {"name":"hb","value":"'.$date2.'"}
        
    ]';

    echo $data;
?>
