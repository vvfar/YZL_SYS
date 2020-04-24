<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL^E_NOTICE);

    session_start();
    $username=$_SESSION["username"];

    $sx_id_id=$_POST['sx_id_id']; //授信编号对应表单的id
    $sqid=$_POST['sqid'];   //授信编号
    $companyName=$_POST['companyName'];  //公司名称
    $sqmoney=$_POST['sqmoney'];  //授信额度
    $sxf=$_POST['sxf'];  //手续费
    $note=$_POST['note'];  //备注
    $isgx=$_POST['isgx'];  //是否共享
    $qs=$_POST['qs'];  //回款期数
    $gxCount_val=$_POST['gxCount_val'];  //共享事业部数

    $gxDepartment="";//共享事业部
    if((int)$gxCount_val>0){
        for($i=1;$i<=(int)$gxCount_val;$i++){
            if($i<(int)$gxCount_val){
                $gxDepartment=$gxDepartment.$_POST['gxDepartment'.$i].",";
            }else{
                $gxDepartment=$gxDepartment.$_POST['gxDepartment'.$i];
            }
        }
    }
    
    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time());  //签署日期
    $date2=$_POST['date2'];  //授信期限开始
    $date3=$_POST['date3'];  //授信期限结束

    for($i=1;$i<=12;$i++){
        if($i<=(int)$qs){
            $dateTime[]=$_POST['dateTime'.$i];
            $hkje[]=$_POST['hkje'.$i];
            $hkfs[]=$_POST['hkfs'.$i];
            $hkjhbz[]=$_POST['hkjhbz'.$i];
            $wyfl[]=$_POST['wyfl'.$i];
        }else{
            $dateTime[]="";
            $hkje[]="";
            $hkfs[]="";
            $hkjhbz[]="";
            $wyfl[]="";
        }
    }

    $dateTime=implode(",",$dateTime);
    $hkje=implode(",",$hkje);
    $hkfs=implode(",",$hkfs);
    $hkjhbz=implode(",",$hkjhbz);
    $wyfl=implode(",",$wyfl);



    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    $sqlstr6="select max(id) from sx_form";
    $result6=mysqli_query($conn,$sqlstr6);

    while($myrow=mysqli_fetch_row($result6)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    //防止授信单号重复
    $dup="false";

    $sqlstr10="select name from sx_id";
    $result10=mysqli_query($conn,$sqlstr10);

    while($myrow=mysqli_fetch_row($result10)){
        if($sqid==$myrow[0]){
            $sqid_no=(int)substr($sqid,6,9)+1;

            if($sqid_no<10){
                $sqid=substr($sqid,0,6)."00".$sqid_no;
            }elseif($sqid_no<100){
                $sqid=substr($sqid,0,6)."0".$sqid_no;
            }else{
                $sqid=substr($sqid,0,6).$sqid_no;
            }

            $dup="true";
        }
    }


    if($sx_id_id!=""){
        $sqlstr3="update sx_form set companyName='$companyName',ywy='$username',department='$department',date1='$date1',sqid='$sqid',sqmoney='$sqmoney',sxf='$sxf',dateTime='$dateTime',".
        "hkje='$hkje',wyfl='$wyfl',hkfs='$hkfs',hkfsbz='$hkjhbz',note='$note',date2='$date2',date3='$date3',isgx='$isgx',gxCount_val='$gxCount_val',gxDepartment='$gxDepartment',status ='待生效' where sqid='$sqid'";
    
    }else{
        $sqlstr3="insert into sx_form values('$maxID'+1,'$companyName','$username','$department','$date1','$sqid','$sqmoney','$sxf','$dateTime',".
        "'$hkje','$wyfl','$hkfs','$hkjhbz','$note','','','$date2','$date3','待生效','待上传纸质附件','','','$isgx','$gxCount_val','$gxDepartment') ";
    }

    $result=mysqli_query($conn,$sqlstr3);

    if($result){

        $sqlstr7="select max(id) from hk_form";
        $result7=mysqli_query($conn,$sqlstr7);
    
        while($myrow=mysqli_fetch_row($result7)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }

        if($sx_id_id!=""){
            $sqlstr4="update hk_form set companyName='$companyName',department='$department',ywy='$ywy',sqid='$sqid',dhkje='$sqmoney' where sqid='$sqid'";
            $sqlstr10="update hk_form2 set companyName='$companyName',department='$department',ywy='$ywy',sqid='$sqid',dhkje='$sqmoney' where sqid='$sqid'";
        }else{
            $sqlstr4="insert into  hk_form values('$maxID'+1,'$companyName','$department','$ywy','$sqid',null,',,,,,,,,,,,',',,,,,,,,,,,',',,,,,,,,,,,',null,null,'$sqmoney')";
            $sqlstr10="insert into  hk_form2 values('$maxID'+1,'$companyName','$department','$ywy','$sqid',null,',,,,,,,,,,,',',,,,,,,,,,,',',,,,,,,,,,,',null,null,'$sqmoney',null)";
        }

        $result4=mysqli_query($conn,$sqlstr4);
        $result10=mysqli_query($conn,$sqlstr10);

        $sqlstr5="update sx_id set name='$sqid' where id=1";
        $result5=mysqli_query($conn,$sqlstr5);

        $sqlstr8="select max(id) from use_sx";
        $result8=mysqli_query($conn,$sqlstr8);
    
        while($myrow=mysqli_fetch_row($result8)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }

        if($sx_id_id!=""){
            $sqlstr9="update use_sx set sqid='$sqid',sqmoney='$sqmoney',remainMoney='$sqmoney',useDepartment='$department',date='$date1',newMoney='$sqmoney' where sqid='$sqid'";
        }else{
            $sqlstr9="insert into use_sx values('$maxID'+1,'$sqid','$sqmoney',0,0,'$sqmoney','','$department','$date1','新增授信','$sqmoney')";
        }
        $result9=mysqli_query($conn,$sqlstr9);

    ?>

    <script>
        if(<?=$dup?>=="true"){
            alert("授信编号重复，已改为<?=$sqid?>")
        }
        
        alert("提交成功!");
        window.location.href="../../home/sx/djLoad.php";
    </script>
        
    <?php

    }else{
    ?>
        <script>
            alert("提交失败!");
            window.location.href="../../home/sx/writeSX.php";
        </script>
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>
