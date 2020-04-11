<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $sxid=$_GET["sxid"];

    $sqlstr1="select a.id,a.companyName,a.ywy,b.date2 from sx_form a,hk_form b where a.sqid='$sxid' and a.sqid=b.sqid";

    $result=mysqli_query($conn,$sqlstr1);

    $msg_list="";

    while($myrow=mysqli_fetch_row($result)){
        
        $msg_list=$msg_list.$myrow[0].",";
        $msg_list=$msg_list.$myrow[1].",";
        $msg_list=$msg_list.$myrow[2].",";

        $dateTime=explode(",",$myrow[3]);
        $dateTime_count=0;

        //纪录期数
        for($i=0;$i<12;$i++){
            if($dateTime[$i] !=""){
                $dateTime_count+=1;
            }
        }

        $dateTime_count+=1;

        $msg_list=$msg_list.$dateTime_count.",";
    }
    
    echo $msg_list;

?>