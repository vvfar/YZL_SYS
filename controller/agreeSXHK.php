<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    $id=$_GET["id"];
    $option=$_GET["option"];

    //同意授信，form=form2，拒绝，form2=form

    if($option==1){
        $sqlstr2="select * from hk_form2 where id=$id";

        $result=mysqli_query($conn,$sqlstr2);
    
        while($myrow=mysqli_fetch_row($result)){
            $companyName=$myrow[1];
            $department=$myrow[2];
            $ywy=$myrow[3];
            $sqid=$myrow[4];
            $date1=$myrow[5];
            $date2=$myrow[6];
            $sjhkje=$myrow[7];
            $hkfs=$myrow[8];
            $hkfs2=$myrow[9];
            $syjehkfs=$myrow[10];
            $dhkje=$myrow[11];
            $status=$myrow[12];
        }
    
        $sqlstr3="update hk_form set companyName='$companyName',department='$department',ywy='$ywy',
                    sqid='$sqid',date1='$date1',date2='$date2',sjhkje='$sjhkje',
                    hkfs='$hkfs',hkfs2='$hkfs2',syjehkfs='$syjehkfs',dhkje='$dhkje' where id=$id";
    
        $result2=mysqli_query($conn,$sqlstr3);
    
        $sqlstr3="select id from sx_form where sqid='$sqid'";
    
        $result=mysqli_query($conn,$sqlstr3);
    
        while($myrow=mysqli_fetch_row($result)){
            $my_id=$myrow[0];
        }
    
        if($dhkje==0){
            $sqlstr4="update sx_form set status='已完成' where id=$my_id";
        }
    
        $result=mysqli_query($conn,$sqlstr4);
    
        $sqlstr5="update hk_form2 set status='已审核' where id=$id";
        $result=mysqli_query($conn,$sqlstr5);
    }else{
        $sqlstr2="select * from hk_form where id=$id";

        $result=mysqli_query($conn,$sqlstr2);
    
        while($myrow=mysqli_fetch_row($result)){
            $companyName=$myrow[1];
            $department=$myrow[2];
            $ywy=$myrow[3];
            $sqid=$myrow[4];
            $date1=$myrow[5];
            $date2=$myrow[6];
            $sjhkje=$myrow[7];
            $hkfs=$myrow[8];
            $hkfs2=$myrow[9];
            $syjehkfs=$myrow[10];
            $dhkje=$myrow[11];
            $status=$myrow[12];
        }
    
        $sqlstr3="update hk_form2 set companyName='$companyName',department='$department',ywy='$ywy',
                    sqid='$sqid',date1='$date1',date2='$date2',sjhkje='$sjhkje',
                    hkfs='$hkfs',hkfs2='$hkfs2',syjehkfs='$syjehkfs',dhkje='$dhkje' where id=$id";
    
        $result2=mysqli_query($conn,$sqlstr3);
    
        $sqlstr3="select id from sx_form where sqid='$sqid'";
    
        $result=mysqli_query($conn,$sqlstr3);
    
        while($myrow=mysqli_fetch_row($result)){
            $my_id=$myrow[0];
        }
    
        if($dhkje==0){
            $sqlstr4="update sx_form set status='已完成' where id=$my_id";
        }
    
        $result=mysqli_query($conn,$sqlstr4);
    
        $sqlstr5="update hk_form2 set status='' where id=$id";
        $result=mysqli_query($conn,$sqlstr5);
    }
    

    if($result2){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../sx_line.php?id=<?=$my_id?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../sx_line2.php?id=<?=$my_id?>";
    </script> 
    <?php
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
?>