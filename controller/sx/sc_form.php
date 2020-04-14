<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL^E_NOTICE);
    
    $date1=$_GET['date1'];
    $date2=$_GET['date2'];
    $option=$_GET['option'];

    session_start();
    $username=$_SESSION["username"];
    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    $sqlstr2="select a.sqid,a.date1,a.companyName,a.department,a.ywy,a.sqmoney,". 
                "a.sqmoney-b.dhkje as t,b.dhkje,b.syjehkfs,a.date2,a.date3,a.status,".
                "a.dateTime,a.hkje,a.wyfl,a.hkfs,a.hkfsbz,".
                "b.date2,b.sjhkje,b.hkfs,b.hkfs2 ".
                "from sx_form a,hk_form b where a.sqid=b.sqid";
    
    if($date1 !="" && $date2 !=""){
        $sqlstr2=$sqlstr2." and a.date3 >= '$date1' and a.date3 <= '$date2'";
    }

    if($newLevel !="数据中心" and $department !="财务部" ){
        $sqlstr2=$sqlstr2." and a.department='$department'";
    }

    if($option == 0){
        $sqlstr2=$sqlstr2." and a.status='待生效'";
    }elseif($option == 1){
        $sqlstr2=$sqlstr2." and a.status='已生效'";
    }else{
        $sqlstr2=$sqlstr2." and (a.status='已完成' or a.status='已失效')";
    }

    //echo $sqlstr2;
    $result=mysqli_query($conn,$sqlstr2);

    $data=array();

    while($myrow=mysqli_fetch_row($result)){
        $data[]=$myrow;
    }
    
    foreach($data as $key=>$value){
        foreach($value as $keys=>$values){
            if($keys>=12 and $keys<=20){
                $str_hksj=explode(",",$data[$key][$keys]);
                for($i=0;$i<12;$i++){
                    $j=$keys+$i*9;
                    $data[$key][$j]=$str_hksj[$i];
                }      
            }
        }
    }
    
    $header=array('授信编号','登记日期','公司名称','事业部','业务员','授信金额','已还款金额','待还款金额','剩余金额处理方式','合同开始时间','合同结束时间','状态');
    
    for($i=1;$i<=12;$i++){
        array_push($header,'计划第'.$i.'期回款日期','计划第'.$i.'期回款金额','违约费率','计划第'.$i.'期回款方式','计划第'.$i.'期回款方式备注','实际第'.$i.'期回款日期','实际第'.$i.'期回款金额','实际第'.$i.'期回款方式','实际第'.$i.'期回款方式备注');
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

    $list2=range(0,118);

    createtable($data,'授信汇总',$header,$list2);

    mysqli_free_result($result);
    mysqli_close($conn);
 
?>