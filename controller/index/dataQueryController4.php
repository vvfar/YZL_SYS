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
    $chooseEight=$_POST['chooseEight'];

    if($chooseEight=="默认"){
        if($chooseSeven=="日"){
            $chooseEight=$date1;
        }elseif($chooseSeven=="月"){
            $chooseEight=$dateMonth;
        }else{
            $chooseEight=$dateYear;
        }
    }
    

    $object=$chooseTwo;


    if($chooseEight=="默认"){
        if($chooseSeven=="日" or $chooseSeven=="全部"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),date from store_data_sales where  storeID= any(select storeID from store where 1=1 ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),date from store_data_hk where storeID= any(select storeID from store where 1=1  ";
            }
    
        }elseif($chooseSeven=="月"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),left(date,7) as month from store_data_sales where storeID= any(select storeID from store where 1=1  ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),left(date,7) as month from store_data_hk where storeID= any(select storeID from store where 1=1  ";
            }
        }elseif($chooseSeven=="年"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),left(date,7) as month from store_data_sales where storeID= any(select storeID from store where 1=1  ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),left(date,7) as month from store_data_hk where storeID= any(select storeID from store where 1=1  ";
            }
        }
    }else{
        if($chooseSeven=="日" or $chooseSeven=="月"){
            $sqlstr1="select sum(salesMoney),date from store_data_sales where  storeID= any(select storeID from store where 1=1 ";
        }else{
            $sqlstr1="select sum(salesMoney),left(date,7) as month from store_data_sales where storeID= any(select storeID from store where 1=1  ";
        }
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


    if($chooseSeven=="日" or $chooseSeven=="全部"){
        $sqlstr1=$sqlstr1." and date_sub('".$chooseEight."', INTERVAL 30 DAY) < date  group by date limit 0,30";
    }elseif($chooseSeven=="月"){
        $sqlstr1=$sqlstr1." and date like '%".$chooseEight."%' group by date";
    }elseif($chooseSeven=="年"){
        $sqlstr1=$sqlstr1." and left(date,7) like '%".$chooseEight."%' group by left(date,7)";
    }
    

    $result=mysqli_query($conn,$sqlstr1);


    while($myrow=mysqli_fetch_row($result)){

        $str='{"line":"'.$chooseOne.'","dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.round($myrow[0]/10000,2).'","object_xssj":"'.$object.'"}';

        array_push($data,$str);
        
    }

    
    if(sizeof($data)==0){
        $str='{"line":"'.$chooseOne.'","dateTime_xssj":"暂无数据","number_xssj":"0","object_xssj":"'.$object.'","sqlstr1":"'.$sqlstr1.'"}';

        array_push($data,$str);
    }


    echo "[".implode(",",$data)."]";
?>