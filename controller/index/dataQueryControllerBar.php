<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time()); 

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


    //事业部控件
    $department_list="[";

    $sqlstr1="select distinct department from user_form";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        if(strpos($myrow[0],'/') != true and strpos($myrow[0],'事业管理部') == true){
            $department_list=$department_list.'"'.$myrow[0].'",';  
        }  
    }

    $department_list = substr($department_list,0,strlen($department_list)-1);

    $department_list=$department_list."]";

    //平台控件
    $pingtai_list="[";

    $sqlstr1="select distinct pingtai from store";

    if($chooseTwo !="全部"){
        $sqlstr1=$sqlstr1." where department='$chooseTwo'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $pingtai_list=$pingtai_list.'"'.$myrow[0].'",';  
    }

    $pingtai_list = substr($pingtai_list,0,strlen($pingtai_list)-1);

    $pingtai_list=$pingtai_list."]";

    //类目控件
    $category_list="[";

    $sqlstr1="select distinct category from store";

    if($chooseTwo !="全部"){
        $sqlstr1=$sqlstr1." where department='$chooseTwo'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $category_list=$category_list.'"'.$myrow[0].'",';  
    }

    $category_list = substr($category_list,0,strlen($category_list)-1);

    $category_list=$category_list."]";

    //店铺控件
    $store_list="[";

    $sqlstr1="select distinct storeName from store where 1=1";

    if($chooseTwo !="全部"){
        $sqlstr1=$sqlstr1." and department='$chooseTwo'";
    }
    

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $store_list=$store_list.'"'.$myrow[0].'",';  
    }

    $store_list = substr($store_list,0,strlen($store_list)-1);

    $store_list=$store_list."]";

    //业务员控件
    $ywy_list="[";

    $sqlstr1="select distinct username from user_form";

    if($chooseTwo !="全部"){
        $sqlstr1=$sqlstr1." where department='$chooseTwo'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $ywy_list=$ywy_list.'"'.$myrow[0].'",';  
    }

    $ywy_list = substr($ywy_list,0,strlen($ywy_list)-1);

    $ywy_list=$ywy_list."]";

    //日期控件
    $date_list="[";

    if($chooseOne == "销售额"){
        if($chooseSeven == "日" or $chooseSeven == "全部"){
            $sqlstr1="select distinct date from store_data_sales ";
        }elseif($chooseSeven == "月"){
            $sqlstr1="select distinct left(date,7) from store_data_sales ";
        }elseif($chooseSeven == "年"){
            $sqlstr1="select distinct left(date,4) from store_data_sales ";
        }
        
    }else{
        if($chooseSeven == "日" or $chooseSeven == "全部"){
            $sqlstr1="select distinct date from store_data_hk ";
        }elseif($chooseSeven == "月"){
            $sqlstr1="select distinct left(date,7) from store_data_hk ";
        }elseif($chooseSeven == "年"){
            $sqlstr1="select distinct left(date,4) from store_data_sales ";
        }
    }


    if($chooseTwo !="全部"){
        $sqlstr1=$sqlstr1." where department='$chooseTwo'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $date_list=$date_list.'"'.$myrow[0].'",';  
    }

    $date_list = substr($date_list,0,strlen($date_list)-1);

    $date_list=$date_list."]";


    $data='[
        {"name":"department","value":'.$department_list.'},
        {"name":"pingtai","value":'.$pingtai_list.'},
        {"name":"category","value":'.$category_list.'},
        {"name":"storeName","value":'.$store_list.'},
        {"name":"ywy","value":'.$ywy_list.'},
        {"name":"time","value":["日","月","年"]},
        {"name":"date","value":'.$date_list.'}
   ]';

    echo $data;
    
?>
    