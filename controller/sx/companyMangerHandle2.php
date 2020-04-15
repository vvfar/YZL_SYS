<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);


    $sxbh=$_POST['sxbh'];

    date_default_timezone_set("Asia/Shanghai");
    $date1=date('Y-m-d', time());  //签署日期

    $hkqs=$_POST['hkqs'];
    $date2=$_POST['date2'];
    $sjhkje=$_POST['sjhkje'];
    $hkfs=$_POST['hkfs'];
    $hkfs2=$_POST['hkfs2'];
    $syjehkfs=$_POST['syjehkfs'];

    $sqlstr1="select date2,sjhkje,hkfs,hkfs2,dhkje from hk_form where sqid='$sxbh'";   

    $result=mysqli_query($conn,$sqlstr1);
    
    while($myrow=mysqli_fetch_row($result)){
        $sql_date2=$myrow[0];
        $sql_sjhkje=$myrow[1];
        $sql_hkfs=$myrow[2];
        $sql_hkfs2=$myrow[3];
        $sql_dhkje=$myrow[4];
    }


    $sql_dhkje=(float)$sql_dhkje - (float)$sjhkje;

    $sql_date2_arr=explode(",",$sql_date2);
    $sql_sjhkje_arr=explode(",",$sql_sjhkje);
    $sql_hkfs_arr=explode(",",$sql_hkfs);
    $sql_hkfs2_arr=explode(",",$sql_hkfs2);
    
    for($i=1;$i<13;$i++){
        $str="第".$i."期";

        if($hkqs==$str){
            $sql_date2_arr[$i-1]=$date2;
            $sql_sjhkje_arr[$i-1]=$sjhkje;
            $sql_hkfs_arr[$i-1]=$hkfs;
            $sql_hkfs2_arr[$i-1]=$hkfs2;
        }
    }

    
    $sql_date2=implode(",",$sql_date2_arr);
    $sql_sjhkje=implode(",",$sql_sjhkje_arr);
    $sql_hkfs=implode(",",$sql_hkfs_arr);
    $sql_hkfs2=implode(",",$sql_hkfs2_arr);


    if((int)$sql_dhkje==0){
        
        $sqlstr3="update hk_form2 set date1='$date1',date2='$sql_date2',sjhkje='$sql_sjhkje',".
        "hkfs='$sql_hkfs',hkfs2='$hkfs2',syjehkfs='$syjehkfs',dhkje='$sql_dhkje',status='待财务审批' ".
        "where sqid='$sxbh'";
        
    }else{

        $sqlstr3="update hk_form2 set date1='$date1',date2='$sql_date2',sjhkje='$sql_sjhkje',".
        "hkfs='$sql_hkfs',hkfs2='$hkfs2',syjehkfs='$syjehkfs',dhkje='$sql_dhkje',status='待财务审批' ".
        "where sqid='$sxbh'";
        
    }

    $result3=mysqli_query($conn,$sqlstr3);

    $sqlstr4="select id from sx_form where sqid='$sxbh'";   

    $result4=mysqli_query($conn,$sqlstr4);
    
    while($myrow=mysqli_fetch_row($result4)){
        $id=$myrow[0];
    }


    if($result3){
    ?>
        <script>
            alert("提交成功!");
            window.location.href="../../home/sx/sx_cw.php";
        </script>
    
    <?php
    }else{
    ?>
        <script>
            alert("提交失败!");
            window.location.href="../../home/sx/companyManger2.php";
        </script>
    <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);

?>