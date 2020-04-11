<?php

    //解决中文乱码
    //header("content-type:text/html;charset=utf-8");
    /** 
         * 创建(导出)Excel数据表格 
         * @param array $list 要导出的数组格式的数据 
         * @param string $filename 导出的Excel表格数据表的文件名 
         * @param array $header Excel表格的表头 
         * @param array $index $list数组中与Excel表格表头$header中每个项目对应的字段的名字(key值) 
         * 比如: $header = array('编号','姓名','性别','年龄'); 
         *  $index = array('id','username','sex','age'); 
         *  $list = array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24)); 
         * @return [array] [数组] 
     */

    //createtable(array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24)),'test',$header = array('编号','姓名','性别','年龄'),array('id','username','sex','age'));

    include_once("../conn/conn.php");
    session_start();

    $date1=$_GET['date1'];
    $date2=$_GET['date2'];
    $storeID=$_GET['storeID'];
    $storeName=$_GET['storeName'];
    
    $username=$_SESSION["username"];
    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

        

    if($department=="数据中心"){
        $sqlstr2="select * from day_data where 1=1";
        
        if($date1 !="" && $date2 !=""){
            $sqlstr2=$sqlstr2." and date >= '$date1' and date <= '$date2'";
        }

        if($storeID !=""){
            $sqlstr2=$sqlstr2." and storeID='$storeID'";
        }

        if($storeName !=""){
            $sqlstr2=$sqlstr2." and storeName like '%$storeName%'";
        }
                    
    }else{
        $sqlstr2="select * from day_data where department='$department'";
        
        if($date1 !="" && $date2 !=""){
            $sqlstr2=$sqlstr2." and date >= '$date1' and date <= '$date2'";
        }

        if($storeID !=""){
            $sqlstr2=$sqlstr2." and storeID='$storeID'";
        }

        if($storeName !=""){
            $sqlstr2=$sqlstr2." and storeName like '%$storeName%'";
        }
        
    }


    $result=mysqli_query($conn,$sqlstr2);

    //array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24));

    $data=array();

    while($myrow=mysqli_fetch_row($result)){
        $data[]=$myrow;
    }
    
    foreach($data as $key=>$value){
        foreach($value as $keys=>$values){
            //$data[$key][$keys])
        }
    }
    
    //echo var_dump($data);

    $header=array("店铺编号","客户名称","店铺名称","平台","授权类目","事业部",
                    "业务员","销售额","销量","领标套数","服务费","服务费回款",
                    "服务费授信","辅料费","辅料费回款","辅料费授信","日期");
    
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

    $list2=range(1,17);

    createtable($data,'days_Data',$header,$list2);
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>