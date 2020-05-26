<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);
    session_start();

    $username=$_SESSION['username'];

    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $newLevel=$myrow[1];
    }

    $sqlstr2="select distinct a.id,a.date1,a.sqid,a.companyName,a.department,a.ywy,a.sqmoney,". 
            "b.dhkje,a.status2,a.status,c.newMoney,a.dateTime,a.hkje,b.date2,b.sjhkje,a.date3,a.wyfl ".
            "from sx_form a,hk_form b,use_sx c where a.sqid=b.sqid and a.sqid=c.sqid and a.status='已生效'";

    if($newLevel !="ADMIN" and $department !="财务部"){
        $sqlstr2=$sqlstr2." and (a.department='$department' or a.gxDepartment like '%$department%')";
    }

    $sqlstr2=$sqlstr2." order by a.date1 desc";

    $result=mysqli_query($conn,$sqlstr2);

    //sql原始数据
    $data=array();

    while($myrow=mysqli_fetch_row($result)){
        //$data[]=str_replace("\t",'',$myrow);
        //$data[]=$myrow;
        //echo var_dump($data);
        $data[]=$myrow;
    }

    //处理数据
    $data2=array();

    foreach($data as $key=>$value){
        foreach($value as $keys=>$values){
            //计划回款期数，金额
            $arr_qs=explode(",",$data[$key][11]);
            $arr_hkje=explode(",",$data[$key][12]);
            $arr_wyfl=explode(",",$data[$key][16]);

            //实际回款期数，金额
            $arr_qs2=explode(",",$data[$key][13]);
            $arr_hkje2=explode(",",$data[$key][14]);

            //合同期限
            $lastDate=$data[$key][15];

            $qs=0;
            $all_jhhk=0;

            //到期时间
            $expireDate="";
            $yqsj="";

            date_default_timezone_set("Asia/Shanghai");
            //$date1=date('Y-m-d', time());

            $date1=date('Y-m-d', time());
            $date2=date("Y-m-d",strtotime("+1week",strtotime(date('Y-m-d', time()))));


            for($count=0;$count<sizeof($arr_qs);$count++){
                if($arr_qs[$count] != ""){
                    $qs=$qs+1;

                    if($arr_qs[$count] <= $date2){
                        $all_jhhk=$all_jhhk+$arr_hkje[$count]*(1+$arr_wyfl[$count]/100);
                        $expireDate=$arr_qs[$count];
                    }
                }
            }
            
                
            if($qs==0){
                $expireDate=$lastDate;
                $all_jhhk=$data[$key][6];
            }

            $qs2=0;
            $all_sjhk=0;


            for($count=0;$count<sizeof($arr_qs2);$count++){
                if($arr_qs2[$count] != ""){
                    $qs2=$qs2+1;

                    if($arr_qs[$count] <= $date2){
                        $all_sjhk=$all_sjhk+$arr_hkje2[$count];
                    }
                } 
            }
            
            if($qs2==0){
                $all_sjhk=$data[$key][6]-$data[$key][7];
            }

            if($all_jhhk > $all_sjhk){
                //逾期天数
                $yqsj=floor((strtotime($expireDate)-strtotime($date1))/86400);

                if($yqsj<=7 and $yqsj >= 0){
                    $yqsj=$yqsj."天到期";
                }else{
                    $yqsj="";
                }
            }else{
                $expireDate="";
            }

            if($expireDate > $date2 or $expireDate < $date1){
                $expireDate="";
            }
            
            if($yqsj != ""  and $yqsj >= 0){
                $data2[$key][1]=$data[$key][2];
                $data2[$key][2]=$data[$key][3];
                $data2[$key][3]=$data[$key][4];
                $data2[$key][4]=$data[$key][5];
                $data2[$key][5]=$data[$key][6];
                $data2[$key][6]=$qs;
                $data2[$key][7]=$all_jhhk;
                $data2[$key][8]=$all_sjhk;
                $data2[$key][9]=$all_jhhk-$all_sjhk;
                $data2[$key][10]=$expireDate;
                $data2[$key][11]=$yqsj;
            }
        }
    }

    $header=array('授信编号','公司名称','事业部','业务员','授信金额','期数','应收','已收','未收','到期时间','剩余天数');
    
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

    $list2=range(1,11);

    createtable($data2,$date1.'即将到期单据',$header,$list2);
    mysqli_free_result($result);
    mysqli_close($conn);
?>