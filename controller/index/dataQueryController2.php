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

    //销售额&回款
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(b.salesMoney) from store a,store_data_sales b where a.storeID=b.storeID ";
    }else if($chooseOne == "回款"){
        $sqlstr1="select sum(b.backMoney) from store a,store_data_hk b where a.storeID=b.storeID ";
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
     if($chooseSeven == "日"){
        $sqlstr=$sqlstr1."and b.date='$date1' ";  //当期
        $sqlstr2=$sqlstr1."and b.date='$date2' ";  //环比
        $sqlstr3=$sqlstr1."and b.date='$date3' ";   //同比
    }elseif($chooseSeven == "月"){
        $sqlstr=$sqlstr1."and b.date like '%$dateMonth%' "; //当期
        $sqlstr2=$sqlstr1."and b.date like '%$dateMonth2%' ";  //环比
        $sqlstr3=$sqlstr1."and b.date like '%$dateMonth3%' ";   //同比
    }elseif($chooseSeven == "年"){
        $sqlstr=$sqlstr1."and b.date like '%$dateYear%' ";  //当期
        $sqlstr2=$sqlstr1."and b.date like '%$dateYear2%' ";  //环比
        $sqlstr3=$sqlstr1."and b.date like '%$dateYear3%' ";  //同比
    }

    $result=mysqli_query($conn,$sqlstr1);
    
    while($myrow=mysqli_fetch_row($result)){
        $num=$myrow[0];
    }


    //销售额目标&回款目标
    if($chooseOne == "销售额"){
        $sqlstr1="select sum(storeTarget) from store_target ";
    }else if($chooseOne == "回款"){
        $sqlstr1="select sum(hkTarget) from store_target ";
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

    //当期
    $result=mysqli_query($conn,$sqlstr);

    echo $sqlstr;

    $num_t=0;

    while($myrow=mysqli_fetch_row($result)){
        $num_t=$myrow[0];
    }

    if($num_t !=0){
        $percent=number_format($num/$num_t, 2);
    }else{
        $percent="100";
    }

    //环比
    $result=mysqli_query($conn,$sqlstr2);
    
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
    $result=mysqli_query($conn,$sqlstr3);

    $num_t3=0;

    while($myrow=mysqli_fetch_row($result)){
        $num_t3=$myrow[0];
    }

    if($num_t3 !=0){
        $percent3=number_format($num/$num_t3, 2);
    }else{
        $percent3="100";
    }
    

    $tb=($percent-$percent3)/$percent3*100;
    $hb=($percent-$percent2)/$percent2*100;

    $data='[
        {"name":"title","value":"完成比"},
        {"name":"time","value":"'.$chooseSeven.'"},
        {"name":"num","value":"'.$percent.'%"},
        {"name":"tb","value":"'.$tb.'"},
        {"name":"hb","value":"'.$hb.'"}  
    ]';

    echo $data;
?>
