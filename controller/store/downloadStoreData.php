<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    date_default_timezone_set("Asia/Shanghai");
    $date=date('Y-m-d', time());  //签署日期

    $option=$_GET["option"];

    $username=$_SESSION['username'];

    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    if($option == 1){
        $sqlstr2="select a.storeID,a.client,a.storeName,a.staff,b.salesMoney,b.salesNum,a.storeTarget,a.status,c.sumMoney,b.date from store_data_sales b,store a join (select storeID,sum(salesMoney) as sumMoney from store_data_sales where date >= '2020-01-01' group by storeID) c on a.storeID=c.storeID where a.storeID=b.storeID ";
    }else{
        $sqlstr2="select a.storeID,a.client,a.storeName,a.staff,b.backMoney,a.hkTarget,a.status,c.backMoney,b.date from store_data_hk b,store a join (select storeID,sum(backMoney) as backMoney from store_data_hk where date >= '2020-01-01' group by storeID) c on a.storeID=c.storeID where a.storeID=b.storeID ";
    }

    if($newLevel !="ADMIN" and $department != "商务运营部"){
        if($newLevel == "KA"){
            $sqlstr2=$sqlstr2." and a.staff like '%$username%'"; 
        }else{
            $sqlstr2=$sqlstr2." and '$department' like concat('%',a.department,'%') ";
        }
    }

    $result=mysqli_query($conn,$sqlstr2);

    $data=array();

    while($myrow=mysqli_fetch_row($result)){
        $data[]=str_replace("\t",'',$myrow);
        //$data[]=$myrow;
        //echo var_dump($data);
    }

    
    foreach($data as $key=>$value){
        foreach($value as $keys=>$values){

        }
    }

    if($option == 1){
        $header=array('店铺编号','公司名称','店铺名称','负责人','销售额','销售单量','销售目标','店铺状态','累计销售额','日期');
    }else{
        $header=array('店铺编号','公司名称','店铺名称','负责人','回款金额','回款目标','店铺状态','累计回款额','日期');
    }
    
    function createtable($list,$filename,$header=array(),$index = array()){ 
        header("Content-type:application/vnd.ms-excel"); 
        header("Content-Disposition:filename=".$filename.".xls"); 
        $teble_header = implode("\t",$header); 
        $strexport = $teble_header."\r"; 
        foreach ($list as $row){ 
            foreach($index as $val){ 
                $strexport.=$row[$val]."\t";  
                } 
                $strexport.="\r"; 
                
                } 
            $strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport); 
            exit($strexport);  
    }

    if($option == 1){
        $list2=range(0,9);
        createtable($data,'销售数据汇总',$header,$list2);
    }else{
        $list2=range(0,8);
        createtable($data,'回款数据汇总',$header,$list2);
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>