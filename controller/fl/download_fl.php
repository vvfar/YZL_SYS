<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    $username=$_SESSION['username'];

    $status=$_GET['status'];
    $time=$_GET['time'];
    $input_time=$_GET['input_time'];
    $input_time2=$_GET['input_time2'];
    $clientName=$_GET['clientName'];

    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    $sqlstr2="select * from flsqd where 1=1 ";
    
    if($newLevel != "ADMIN"){
        $sqlstr2=$sqlstr2." and department like '%$department%'";
    }

    if($clientName !=""){
        $sqlstr2=$sqlstr2." and company like '%$clientName%'";
    }

    if($status=="已完成"){
        $sqlstr2=$sqlstr2." and status like '%已归档单据%' ";
    }elseif($status=="未完成"){
        $sqlstr2=$sqlstr2." and not status like '%已归档单据%' ";
    }

    if($input_time != ""){
        $input_time_full=$input_time." 00:00:00";

        if($time=="流程开始时间"){
            $sqlstr2=$sqlstr2." and date >='$input_time_full' ";
        }elseif($time=="流程结束时间"){
            $sqlstr2=$sqlstr2." and date2 >='$input_time_full' ";
        }
    }

    if($input_time2 != ""){
        $input_time2_full=$input_time2." 23:59:59";

        if($time=="流程开始时间"){
            $sqlstr2=$sqlstr2." and date <='$input_time2_full' ";
        }elseif($time=="流程结束时间"){
            $sqlstr2=$sqlstr2." and date2 <='$input_time2_full' ";
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

            if($keys>=11 and $keys<=21){

                //$str_hksj=explode(",",$data[$key][$keys]);
                $str_hksj=explode(",",str_replace("\t",'',trim($data[$key][$keys])));

                //echo sizeof($str_hksj);

                for($i=0;$i<sizeof($str_hksj);$i++){
                    $j=26+$keys+$i*11;
                    $data[$key][$j]=$str_hksj[$i];                    
                }            
            }
        }
    }

    $header=array('申请单编号','申请单位','申请人','申请部门','申请日期','收货地址','联系人','联系电话','运输方式','是否含税包装价格');

    array_push($header,'品类all','货号all','品名all','申请数量all','包装价格all','费率/单价all','服务费小计all','辅料名称all','单价all','辅料数量all','辅料小计all');
    
    array_push($header,'税点','结款方式','物流方式','物流单号','物流费用','备注','申请数量合计','服务费合计','辅料数量','辅料费小计含税','服务费辅料费总计',
    '条数','业务员','流程状态','结束日期');

    for($i=1;$i<=20;$i++){
        array_push($header,'品类'.$i,'货号'.$i,'品名'.$i,'申请数量'.$i,'包装价格'.$i,'费率/单价'.$i,'服务费小计'.$i,'辅料名称'.$i,'单价'.$i,'辅料数量'.$i,'辅料小计'.$i);
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

    $list2=range(1,267);

    createtable($data,'flsqd',$header,$list2);
    mysqli_free_result($result);
    mysqli_close($conn);
?>