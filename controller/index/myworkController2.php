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

    $data=[];

    if($newLevel == "KA"){
        $object=$username;

        $sqlstr1="select sum(salesMoney),date from store_data_sales  where staff='".$username."' group by date limit 0,30";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            

            $str='{"dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.$myrow[0].'","object_xssj":"'.$object.'"}';

            array_push($data,$str);
            
        }

    }elseif($newLevel == "M"){
        $object=$department;

        $sqlstr1="select sum(a.salesMoney),a.date from store_data_sales a,store b where a.storeID=b.storeID and '$department' like concat('%',department,'%') group by date limit 0,30";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){

            $str='{"dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.$myrow[0].'","object_xssj":"'.$object.'"}';

            array_push($data,$str);
            
        }

    }else{
        $object="全公司";

        $sqlstr1="select sum(a.salesMoney),a.date from store_data_sales a,store b where a.storeID=b.storeID group by date limit 0,30";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){

            $str='{"dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.$myrow[0].'","object_xssj":"'.$object.'"}';

            array_push($data,$str);
            
        }
    }

    echo "[".implode(",",$data)."]";
?>