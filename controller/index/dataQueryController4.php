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

    $object=$chooseTwo;


    if($chooseEight=="默认"){
        if($chooseSeven=="日" or $chooseSeven=="全部"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),date from store_data_sales where  staff= any(select staff from store where 1=1 ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),date from store_data_hk where staff= any(select staff from store where 1=1  ";
            }
    
        }elseif($chooseSeven=="月"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),left(date,7) as month from store_data_sales where staff= any(select staff from store where 1=1  ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),left(date,7) as month from store_data_hk where staff= any(select staff from store where 1=1  ";
            }
        }elseif($chooseSeven=="年"){
            if($chooseOne=="销售额"){
                $sqlstr1="select sum(salesMoney),left(date,4) as year from store_data_sales where staff= any(select staff from store where 1=1  ";
            }else if($chooseOne == "回款"){
                $sqlstr1="select sum(backMoney),left(date,4) as year from store_data_hk where staff= any(select staff from store where 1=1  ";
            }
        }
    }else{
        $sqlstr1="select sum(salesMoney),date from store_data_sales where  staff= any(select staff from store where 1=1 ";
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
        $sqlstr1=$sqlstr1."and staff='$chooseFour' ";
    }

    $sqlstr1=$sqlstr1.") ";

    if($chooseEight=="默认"){
        if($chooseSeven=="日" or $chooseSeven=="全部"){
            $sqlstr1=$sqlstr1." and date_sub(curdate(), INTERVAL 30 DAY) <= date  group by date limit 0,30";
        }elseif($chooseSeven=="月"){
            $sqlstr1=$sqlstr1." group by month limit 0,12";
        }elseif($chooseSeven=="年"){
            $sqlstr1=$sqlstr1." group by year limit 0,10";
        }
    }else{
        $sqlstr1=$sqlstr1."and date like '%$chooseEight%' group by date";
    }

    $result=mysqli_query($conn,$sqlstr1);


    while($myrow=mysqli_fetch_row($result)){

        $str='{"dateTime_xssj":"'.$myrow[1].'","number_xssj":"'.$myrow[0].'","object_xssj":"'.$object.'"}';

        array_push($data,$str);
        
    }

    
    if(sizeof($data)==0){
        $str='{"dateTime_xssj":"暂无数据","number_xssj":"0","object_xssj":"'.$object.'","sqlstr1":"'.$sqlstr1.'"}';

        array_push($data,$str);
    }


    echo "[".implode(",",$data)."]";
?>