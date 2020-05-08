<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    $username=$_SESSION['username'];

    $contractID=$_GET["contractID"];
    $clientName=$_GET["clientName"];
    $status=$_GET["status"];

    
    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    if($contractID !=""){
        $sqlstrIn=" and no like '%".$contractID."%'";
    }elseif($clientName !=""){
        $sqlstrIn=" and company like '%".$clientName."%'";
    }else{
        $sqlstrIn="";
    }

    if($status !=""){
        if($status=="待审核"){
            $sqlstrIn=$sqlstrIn." and status='待归档'";
        }else{
            $sqlstrIn=$sqlstrIn." and status='已归档'";
        }
    }


    $sqlstr2="select * from contract where 1=1 ".$sqlstrIn;
                
    if($newLevel !="ADMIN" and $department !="财务部" and $department !="商业运营部"){
        if($newLevel == "KA"){
            $sqlstr2=$sqlstr2." and shr like '%$username%'"; 
        }else{
            $sqlstr2=$sqlstr2." and '$department' like concat('%',department,'%') ";
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

    $header=array('登记日期','合同编号','事业部','授权平台','授权类目','公司名称','店铺名','合同日期(开始)','合同日期(结束)','保证金','是否共享保证金','销售额(万)','是否共享销售额','服务费(万)','是否共享服务费','备注','状态','原合同编号','审核人','审核时间');

        
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

    $list2=range(1,20);

    createtable($data,'合同',$header,$list2);
    mysqli_free_result($result);
    mysqli_close($conn);
?>