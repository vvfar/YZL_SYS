<?php

    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    session_start();   
    $username=$_SESSION["username"];
    
    date_default_timezone_set("Asia/Shanghai");
    
    $date=date('Y-m-d', time());

    $date_arr=explode("-",$date);

    $year=$date_arr[0];
    $month=$date_arr[1];
    $day=$date_arr[2];

    $sqlstr0="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    if($month != 12){
        $dateStart=$year."-".$month."-01";
        $dateEnd=$year."-".($month+1)."-01";
    }else{
        $dateStart=$year."-12-01";
        $dateEnd=($year+1)."-".$month."-01";
    }


    $sqlstr1="select sum(salesMoney) from store_data_sales where staff='$username' and date >= '$dateStart' and date < '$dateEnd'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $num1=$myrow[0];
    }



    $sqlstr2="select sum(storeTarget)  from store where staff='$username'";

    $result=mysqli_query($conn,$sqlstr2);

    while($myrow=mysqli_fetch_row($result)){
        $num2=$myrow[0];
    }

    $sqlstr3="select sum(a.salesMoney) from store_data_sales a,store b where '$department' like concat('%',b.department,'%') and a.date >= '$dateStart' and a.date < '$dateEnd' and  a.storeID=b.storeID";

    $result=mysqli_query($conn,$sqlstr3);

    while($myrow=mysqli_fetch_row($result)){
        $num3=$myrow[0];
    }

    $sqlstr4="select sum(storeTarget)  from store where '$department' like concat('%',department,'%')";

    $result=mysqli_query($conn,$sqlstr4);

    while($myrow=mysqli_fetch_row($result)){
        $num4=$myrow[0];
    }

    $sqlstr5="select sum(backMoney) from store_data_hk where staff='$username' and date >= '$dateStart' and date < '$dateEnd'";

    $result=mysqli_query($conn,$sqlstr5);

    while($myrow=mysqli_fetch_row($result)){
        $num5=$myrow[0];
    }

    $sqlstr6="select sum(hkTarget)  from store where staff='$username'";

    $result=mysqli_query($conn,$sqlstr6);

    while($myrow=mysqli_fetch_row($result)){
        $num6=$myrow[0];
    }

    $sqlstr7="select sum(a.backMoney) from store_data_hk a,store b where '$department' like concat('%',b.department,'%') and a.date >= '$dateStart' and a.date < '$dateEnd' and  a.storeID=b.storeID";

    $result=mysqli_query($conn,$sqlstr7);

    while($myrow=mysqli_fetch_row($result)){
        $num7=$myrow[0];
    }

    $sqlstr8="select sum(hkTarget)  from store where '$department' like concat('%',department,'%')";

    $result=mysqli_query($conn,$sqlstr8);

    while($myrow=mysqli_fetch_row($result)){
        $num8=$myrow[0];
    }

    $num1=($num1=="")?0:$num1;
    $num2=($num2=="")?0:$num2;
    $num3=($num3=="")?0:$num3;
    $num4=($num4=="")?0:$num4;
    $num5=($num5=="")?0:$num5;
    $num6=($num6=="")?0:$num6;
    $num7=($num7=="")?0:$num7;
    $num8=($num8=="")?0:$num8;

    $data='[
                {"name":"个人销售数据","number":"'.$num1.'"},
                {"name":"个人销售数据目标","number":"'.$num2.'"},
                {"name":"部门销售数据","number":"'.$num3.'"},
                {"name":"部门销售数据目标","number":"'.$num4.'"},
                {"name":"个人回款数据","number":"'.$num5.'"},
                {"name":"个人回款数据目标","number":"'.$num6.'"},
                {"name":"部门回款数据","number":"'.$num7.'"},
                {"name":"部门回款数据目标","number":"'.$num8.'"}
            ]';

    echo $data;

?>