<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    //error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    $username=$_SESSION['username'];

    $sqID=$_GET["sqID"];
    $clientName=$_GET["clientName"];
    $status=$_GET["status"];

    if($sqID !=""){
        $sqlstrIn=" and no like '%".$sqID."%'";
    }elseif($clientName !=""){
        $sqlstrIn=" and company like '%".$clientName."%'";
    }else{
        $sqlstrIn="";
    }

    if($status !=""){
        if($status=="待审核"){
            $sqlstrIn=$sqlstrIn." and not status like '%数据中心已归档%'";
        }else{
            $sqlstrIn=$sqlstrIn." and status like '%数据中心已归档%'";
        }
    }

    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    if($department !="财务部" and $department !="品牌部" and $department !="数据中心" and $department !="义乌" and strstr($department, '/')==false){
        $sqlstr2="select * from sq where department='$department' ".$sqlstrIn;
    }elseif(strstr($department, '/')){
        $sqlstr2="select * from sq where (";
        
        $department_arr=explode('/',$department);

        for($i=0;$i<sizeof($department_arr);$i++){
            if($i != sizeof($department_arr)-1){
                $sqlstr2=$sqlstr2."department='$department_arr[$i]' or ";
            }else{
                $sqlstr2=$sqlstr2."department='$department_arr[$i]') ".$sqlstrIn;
            }
            
        }
        
    }else{
        $sqlstr2="select * from sq where 1=1 ".$sqlstrIn;
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

    $header=array('授权编号','公司名称','店铺名','授权类型','授权平台','授权类目','事业部','授权日期(开始)','授权日期(结束)','合同编号','保证金','文件名','登记日期','状态','审核人','审核时间');

        
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

    $list2=range(1,16);

    createtable($data,'授权',$header,$list2);
    mysqli_free_result($result);
    mysqli_close($conn);
?>