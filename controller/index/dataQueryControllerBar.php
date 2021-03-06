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
    $username=$_POST['username'];

    $sqlstr0="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $my_department=$myrow[0];
        $newLevel=$myrow[1];
    }


    //事业部控件
    $department_list="[";

    $sqlstr1="select distinct department from store where 1=1 ";

    if(($newLevel !="" and $newLevel !="ADMIN") and strpos($my_department,'/') != true){
        $sqlstr1=$sqlstr1."and department='$my_department'";
    }


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

    $sqlstr2="select distinct pingtai from store where 1=1 ";

    if($chooseTwo !="全部"){
        $sqlstr2=$sqlstr2."and department='$chooseTwo' ";
    }

    if(($newLevel !="" and $newLevel !="ADMIN") and strpos($my_department,'/') != true){
        if($newLevel =="M"){
            $sqlstr2=$sqlstr2."and department='$my_department' ";
        }else{
            $sqlstr2=$sqlstr2."and staff='$username' ";
        }
        
    }
    
    $result2=mysqli_query($conn,$sqlstr2);

    while($myrow=mysqli_fetch_row($result2)){
        $pingtai_list=$pingtai_list.'"'.$myrow[0].'",';  
    }

    $pingtai_list = substr($pingtai_list,0,strlen($pingtai_list)-1);

    $pingtai_list=$pingtai_list."]";

    //类目控件
    $category_list="[";

    $sqlstr3="select distinct category from store where 1=1 ";

    if($chooseTwo !="全部"){
        $sqlstr3=$sqlstr3."and department='$chooseTwo'";
    }

    if(($newLevel !="" and $newLevel !="ADMIN") and strpos($my_department,'/') != true){
        if($newLevel =="M"){
            $sqlstr3=$sqlstr3."and department='$my_department' ";
        }else{
            $sqlstr3=$sqlstr3."and staff='$username' ";
        }
        
    }

    $result=mysqli_query($conn,$sqlstr3);

    while($myrow=mysqli_fetch_row($result)){
        $category_list=$category_list.'"'.$myrow[0].'",';  
    }

    $category_list = substr($category_list,0,strlen($category_list)-1);

    $category_list=$category_list."]";

    //店铺控件
    $store_list="[";

    $sqlstr4="select distinct storeName from store where 1=1 ";

    if($chooseTwo !="全部"){
        $sqlstr4=$sqlstr4." and department='$chooseTwo' ";
    }

    if(($newLevel !="" and $newLevel !="ADMIN") and strpos($my_department,'/') != true){
        if($newLevel =="M"){
            $sqlstr4=$sqlstr4."and department='$my_department' ";
        }else{
            $sqlstr4=$sqlstr4."and staff='$username' ";
        }
        
    }
    

    $result=mysqli_query($conn,$sqlstr4);

    while($myrow=mysqli_fetch_row($result)){
        $store_list=$store_list.'"'.$myrow[0].'",';  
    }

    $store_list = substr($store_list,0,strlen($store_list)-1);

    $store_list=$store_list."]";

    //业务员控件
    $ywy_list="[";

    $sqlstr5="select distinct username from user_form where (newLevel = 'KA' or newLevel = 'M') ";

    if($chooseTwo !="全部"){
        $sqlstr5=$sqlstr5." and department='$chooseTwo' ";
    }

    if(($newLevel !="" and $newLevel !="ADMIN") and strpos($my_department,'/') != true){
        if($newLevel =="M"){
            $sqlstr5=$sqlstr5."and department='$my_department' ";
        }else{
            $sqlstr5=$sqlstr5."and username='$username' ";
        }
        
    }

    $result=mysqli_query($conn,$sqlstr5);

    while($myrow=mysqli_fetch_row($result)){
        $ywy_list=$ywy_list.'"'.$myrow[0].'",';  
    }

    $ywy_list = substr($ywy_list,0,strlen($ywy_list)-1);

    $ywy_list=$ywy_list."]";

    //日期控件
    $date_list_1="[";

    if($chooseOne == "销售额"){
        if($chooseSeven == "日" or $chooseSeven == "全部"){
            $sqlstr6="select distinct date from store_data_sales ";
        }elseif($chooseSeven == "月"){
            $sqlstr6="select distinct left(date,7) from store_data_sales ";
        }elseif($chooseSeven == "年"){
            $sqlstr6="select distinct left(date,4) from store_data_sales ";
        }
        
    }else{
        if($chooseSeven == "日" or $chooseSeven == "全部"){
            $sqlstr6="select distinct date from store_data_hk ";
        }elseif($chooseSeven == "月"){
            $sqlstr6="select distinct left(date,7) from store_data_hk ";
        }elseif($chooseSeven == "年"){
            $sqlstr6="select distinct left(date,4) from store_data_sales ";
        }
    }


    if($chooseTwo !="全部"){
        $sqlstr6=$sqlstr6." where staff= any( select staff from store where department='$chooseTwo')";
    }

    $result=mysqli_query($conn,$sqlstr6);

    while($myrow=mysqli_fetch_row($result)){
        $date_list=$date_list.'"'.$myrow[0].'",';  
    }

    $date_list = substr($date_list,0,strlen($date_list)-1);

    $date_list=$date_list_1.$date_list."]";



    $data='[
        {"name":"department","value":'.$department_list.'},
        {"name":"pingtai","value":'.$pingtai_list.'},
        {"name":"category","value":'.$category_list.'},
        {"name":"storeName","value":'.$store_list.'},
        {"name":"ywy","value":'.$ywy_list.'},
        {"name":"time","value":["日","月","年"]},
        {"name":"date","value":'.$date_list.'},
        {"name":"sql","value":"'.$sqlstr6.'"}
   ]';

    echo $data;
    
?>
    