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

    $month=$_GET['month'];
    $storeID=$_GET['storeID'];
    $storeName=$_GET['storeName'];

    session_start();
    $username=$_SESSION["username"];
    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    $sqlstr2="select id,storeID,clientName,storeName,pingtai,category,department,ywy,ROUND(sum(salesMoney),2) as t_salesMoney,
                CEILING(sum(salesNum)) as t_salesNum,CEILING(sum(lbts)) as t_lbts,ROUND(sum(fwf),2) as t_fwf,
                ROUND(sum(fwfhk),2) as t_fwfhk,ROUND(sum(fwfsx),2) as t_fwfsx,ROUND(sum(flf),2) as t_flf,
                ROUND(sum(flfhk),2) as t_flfhk,ROUND(sum(flfsx),2) as t_flfsx from day_data where 1=1";

    if($department !="数据中心"){
        $sqlstr2=$sqlstr2." and department='$department'";
    }

    $sqlstr2=$sqlstr2." and date like '%$month%'";

    if($storeID !=""){
        $sqlstr2=$sqlstr2." and storeID='$storeID'";
    }

    if($storeName !=""){
        $sqlstr2=$sqlstr2." and storeName like '%$storeName%'";
    }

    $sqlstr2=$sqlstr2." group by storeID order by storeID asc";

    $result=mysqli_query($conn,$sqlstr2);

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
                    "服务费授信","辅料费","辅料费回款","辅料费授信");
    
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

    createtable($data,$month.'统计表',$header,$list2);
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>