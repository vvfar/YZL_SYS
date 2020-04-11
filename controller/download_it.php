<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    $username=$_SESSION['username'];

    $sqlstr2="select * from it";

    $result=mysqli_query($conn,$sqlstr2);

    $data=array();

    while($myrow=mysqli_fetch_row($result)){
        $data[]=str_replace("\t",'',$myrow);
    }

    
    foreach($data as $key=>$value){
        foreach($value as $keys=>$values){

        }
    }

    $header=array('类别','用户','部门','归属部门','以太网MAC','无线网MAC','类型','品牌','型号','购买年份','操作系统','CPU','内存','硬盘','序列号','位置','鼠标','电源','包','备注');

        
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

    $list2=range(1,22);

    createtable($data,'员工电脑设备',$header,$list2);
    mysqli_free_result($result);
    mysqli_close($conn);
?>