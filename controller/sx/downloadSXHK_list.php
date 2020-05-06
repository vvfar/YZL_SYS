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


    $sqlstr2="select * from sxhk_form where status='已审核' ";
    

    if($newLevel !="ADMIN" and $department != "商务运营部" and $department != "财务部"){
        if($newLevel == "KA"){
            $sqlstr2=$sqlstr2." and ywy='$username'"; 
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

    $header=array('授权编号','公司名称','事业部','负责人','授信回款金额','日期');
    
    
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

        $list2=range(1,6);
        createtable($data,'授信回款数据汇总',$header,$list2);
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>