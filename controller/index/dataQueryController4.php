<?php

    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    session_start();   
    $username=$_SESSION["username"];

    date_default_timezone_set("Asia/Shanghai");

    $date1=date('Y-m-d', time());
    $dateMonth=date('Y-m', time());
    $dateYear=date('Y', time());

    

    $sqlstr0="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    $data=[];

    $chooseOne=$_POST['chooseOne'];
    $chooseTwo=$_POST['chooseTwo'];
    $chooseThree=$_POST['chooseThree'];
    $chooseFour=$_POST['chooseFour'];
    $chooseFive=$_POST['chooseFive'];
    $chooseSix=$_POST['chooseSix'];
    $chooseSeven=$_POST['chooseSeven'];

    $object=$chooseTwo;


    if($chooseSeven=="日" or $chooseSeven=="全部"){
        if($chooseOne=="销售额"){
            $sqlstr1="select sum(a.salesMoney),a.date from store_data_sales a,store b where a.storeID=b.storeID ";
        }else if($chooseOne == "回款"){
            $sqlstr1="select sum(a.backMoney),a.date from store_data_hk,store b where a.storeID=b.storeID ";
        }

    }elseif($chooseSeven=="月"){
        if($chooseOne=="销售额"){
            $sqlstr1="select sum(a.salesMoney),left(a.date,7) as month from store_data_sales a,store b where a.storeID=b.storeID ";
        }else if($chooseOne == "回款"){
            $sqlstr1="select sum(a.backMoney),left(a.date,7) as month from store_data_hk,store b where a.storeID=b.storeID ";
        }
    }elseif($chooseSeven=="年"){
        if($chooseOne=="销售额"){
            $sqlstr1="select sum(a.salesMoney),left(a.date,4) as year from store_data_sales a,store b where a.storeID=b.storeID ";
        }else if($chooseOne == "回款"){
            $sqlstr1="select sum(a.backMoney),left(a.date,4) as year from store_data_hk,store b where a.storeID=b.storeID ";
        }
    }
    
    //事业部
    if($chooseTwo != "全部"){
        $sqlstr1=$sqlstr1."and b.department='$chooseTwo' ";
    }

    //平台
    if($chooseThree != "全部"){
        $sqlstr1=$sqlstr1."and b.pingtai='$chooseThree' ";
    }

    //类目
    if($chooseFour != "全部"){
        $sqlstr1=$sqlstr1."and b.category='$chooseThree' ";
    }

    //店铺
    if($chooseFive != "全部"){
        $sqlstr1=$sqlstr1."and b.storeName='$chooseFive' ";
    }

    //业务员
    if($chooseSix != "全部"){
        $sqlstr1=$sqlstr1."and b.staff='$chooseFour' ";
    }


    if($chooseSeven=="日" or $chooseSeven=="全部"){
        $sqlstr1=$sqlstr1."group by date limit 0,30";
    }elseif($chooseSeven=="月"){
        $sqlstr1=$sqlstr1."group by month limit 0,12";
    }elseif($chooseSeven=="年"){
        $sqlstr1=$sqlstr1."group by year limit 0,10";
    }

    $result=mysqli_query($conn,$sqlstr1);


    while($myrow=mysqli_fetch_row($result)){

        $str='{"dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.$myrow[0].'","object_xssj":"'.$object.'"}';

        array_push($data,$str);
        
    }

    
    if(sizeof($data)==0){
        $str='{"dateTime_xssj":"暂无数据","number_xssj":"0","object_xssj":"'.$object.'"}';

        array_push($data,$str);
    }


    echo "[".implode(",",$data)."]";
?>