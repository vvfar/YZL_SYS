<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_POST["id"];
    $storeID=$_POST["storeID"];
    $client=$_POST["client"];
    $storeName=$_POST["storeName"];
    $pingtai=$_POST["pingtai"];
    $category=$_POST["category"];
    $link=$_POST["link"];
    $staff=$_POST["staff"];
    $staff_time=$_POST["staff_time"];
    $createDate=$_POST["createDate"];
    $oldStaff=$_POST["oldStaff"];
    $storeTarget=$_POST["storeTarget"];
    $hkTarget=$_POST["hkTarget"];

    session_start();
    $username=$_SESSION["username"];

    $sqlstr1="select department from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    date_default_timezone_set("Asia/Shanghai");
    //$createDate=date('Y-m-d', time());  //签署日期

    $sqlstr="select max(id) from store";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    if($id==""){
        //$sqlstr2="insert into store values('$maxID'+1,'$storeID','$client','$storeName','$pingtai','$category','$department','','0','正常','$createDate','无','$link')";
    }else{
        $date=date('Y-m-d', time());
        $dateMonth=date('Y-m', time());

        //计算从店铺创立到今天的天数
        $days_store=floor((strtotime($date)-strtotime($createDate))/86400);
        $days_staff=floor((strtotime($date)-strtotime($staff_time))/86400);

        $sqlstr2="update store set storeID='$storeID',client='$client',storeName='$storeName',pingtai='$pingtai',category='$category',link='$link' where id='$id'";
        $result=mysqli_query($conn,$sqlstr2);

        $sqlstr4="select count(*) from store_target where storeID='$storeID' and dateMonth='$dateMonth'";
        $result4=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result4)){
            $storeTarget_count=$myrow[0];
        }
    
        if($storeTarget_count > 0){
            $sqlstr5="update store_target set storeTarget='$storeTarget',hkTarget='$hkTarget' where storeID='$storeID' and dateMonth='$dateMonth'";
        }else{
            $sqlstr6="select max(id) from store_target";
            $result6=mysqli_query($conn,$sqlstr6);
        
            while($myrow=mysqli_fetch_row($result6)){
                $maxID=$myrow[0];
            }
        
            if($maxID==""){
                $maxID=0;
            }


            $sqlstr5="insert into store_target values('$maxID'+1,'$storeID','$storeTarget','$hkTarget','$dateMonth') ";
        }

        $result5=mysqli_query($conn,$sqlstr5);

        if($oldStaff != $staff){

            if($days_store<=180){
                echo "<script>alert('新店<=180天无法进行转让！".$staff_time."');window.location.href='../../home/store/newStore.php?id=".$id."'</script>";
            }else{
                if($days_staff<=90){
                    echo "<script>alert('老店<=90天无法进行转让！');window.location.href='../../home/store/newStore.php?id=".$id."'</script>";
                }else{  
                    $sqlstr3="update store set staff='$staff',staff_time='$date' where id='$id'";
                    
                    $result=mysqli_query($conn,$sqlstr3); 
                }
            }
        }
    }

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/store/manStore.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        //window.location.href="../../home/store/newStore.php"
    </script> 
    <?php
    }
        
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>

