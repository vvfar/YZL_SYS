<?php
    
    header("content-type:text/html;charset=utf-8");  //格式为utf-8格式
    //error_reporting(E_ALL || ~E_NOTICE);  //不抛出异常
    include_once("../../common/conn/conn.php");  //连接数据库
    session_start();   


    $username=$_SESSION["username"];  //获取用户名
    
    //获取表中的字段
    $id=$_POST['id'];
    $no=$_POST['no'];
    $company=$_POST['company'];
    $people=$_POST['people'];
    $department=$_POST['department'];
    $date=$_POST['date'];
    $address=$_POST['address'];
    $connection=$_POST['connection'];
    $phone=$_POST['phone'];
    $driving=$_POST['driving'];
    $ishs=$_POST['ishs'];
    $sd=$_POST['sd'];
    $jkfs=$_POST['jkfs'];
    $wlfs=$_POST['wlfs'];
    $wlno=$_POST['wlno'];
    $wlprice=$_POST['wlprice'];
    $note=$_POST['note'];
    $hd_sqslhj=$_POST['hd_sqslhj'];
    $hd_fwfhj=$_POST['hd_fwfhj'];
    $hd_flsl=$_POST['hd_flsl'];
    $hd_flfhjsh=$_POST['hd_flfhjsh'];
    $hd_fwfflfzj=$_POST['hd_fwfflfzj'];
    $ywy=$people;
    $sqid=$_POST['sxid'];
    $usesqmoney=$_POST['sxmoney'];
    $option=$_POST['option'];   //判断状态，数据保存0，数据提交1

    //多行数据字段传递
    $category="";
    $productNo="";
    $productName="";
    $amount="";
    $price="";
    $fls="";
    $fwfxj="";
    $flsName="";
    $dj="";
    $sl="";
    $flfxj="";


    //表中的最大行数为20
    $hd_count=$_POST['hd_count'];

    if($hd_count>20){
        $hd_count=19;
    }

    for($i=0;$i<=(int)$hd_count;$i++){
        $category=$category.$_POST['category'.$i].",";
        $productNo=$productNo.$_POST['productNo'.$i].",";
        $productName=$productName.$_POST['productName'.$i].",";
        $amount=$amount.$_POST['amount'.$i].",";
        $price=$price.$_POST['price'.$i].",";
        $fls=$fls.$_POST['fls'.$i].",";
        $fwfxj=$fwfxj.(float)$_POST['amount'.$i]*(float)$_POST['price'.$i]*(float)$_POST['fls'.$i].",";
        $flsName=$flsName.$_POST['flsName'.$i].",";
        $dj=$dj.$_POST['dj'.$i].",";
        $sl=$sl.$_POST['sl'.$i].",";
        $flfxj=$flfxj.(float)$_POST['dj'.$i]*(float)$_POST['sl'.$i].",";
    }


    //获取辅料申请单最大ID
    $sqlstr="select max(id) from flsqd";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    //获取当前流程审批节点
    $p_no=$_GET["no"];

    //获取下个节点名称
    $sqlstr3="select name from flprogress where number='$p_no'+1";

    $result2=mysqli_query($conn,$sqlstr3);

    while($myrow=mysqli_fetch_row($result2)){
        $name=$myrow[0];
    }


    //M级审批单据
    if($name == "M级审批单据"){

        
        $sqlstr3="select username from user_form where department like '%$department%' and newLevel='M'";
            
        $result=mysqli_query($conn,$sqlstr3);
        
        while($myrow=mysqli_fetch_row($result)){
            $sp=$myrow[0];
        }
    
        $sp=$username.",".$sp;
        $name="KA级提交单据,".$name;
    
        $fileName="";
    
        //防止辅料单重号
        if($id==""){
            $sqlstr="select count(*) from flsqd where no='$no'";

            $result=mysqli_query($conn,$sqlstr);

            while($myrow=mysqli_fetch_row($result)){
                $count_no=$myrow[0];
            }

            if($count_no != '0'){
                $sqlstr2="select no from fl_no where department='$department'";

                $result=mysqli_query($conn,$sqlstr2);
    
                while($myrow=mysqli_fetch_row($result)){
                    $no_sql=$myrow[0];
                }

                $no_arr=explode("-",$no_sql);  
                $no_old=array_pop($no_arr);
                $no_new=$no_old+1;
                $no= str_replace($no_old,$no_new,$no_sql);
            }
        }



        //option=1提交单据
        if($option==1){
            //未被保存过的单据
            if($id ==""){
                $sqlstr3="update fl_no set no='$no' where department='$department'";
                
                $result=mysqli_query($conn,$sqlstr3);
        
                $sqlstr1="insert into flsqd values('$maxID'+1,'$no','$company','$people','$department','$date','$address',".
                    "'$connection','$phone','$driving','$ishs','$category','$productNo','$productName',".
                    "'$amount','$price','$fls','$fwfxj','$flsName','$dj','$sl','$flfxj','$sd','$jkfs',".
                    "'$wlfs','$wlno','$wlprice','$note','$hd_sqslhj','$hd_fwfhj','$hd_flsl','$hd_flfhjsh',".
                    "'$hd_fwfflfzj','$hd_count'+1,'$ywy','$name','','','$sp','','$date','$fileName')";
                
                    
            //已被保存或提交后拒绝的单据
            }else{
                $sqlstr1="update flsqd set no='$no',company='$company',people='$people',department='$department',date='$date',address='$address',".
                "connection='$connection',phone='$phone',driving='$driving',ishs='$ishs',category='$category',productNo='$productNo',productName='$productName',".
                "amount='$amount',price='$price',fls='$fls',fwfxj='$fwfxj',flsName='$flsName',dj='$dj',sl='$sl',flfxj='$flfxj',sd='$sd',jkfs='$jkfs',".
                "wlfs='$wlfs',wlno='$wlno',wlprice='$wlprice',note='$note',hd_sqslhj='$hd_sqslhj',hd_fwfhj='$hd_fwfhj',hd_flsl='$hd_flsl',hd_flfhjsh='$hd_flfhjsh',".
                "hd_fwfflfzj='$hd_fwfflfzj',hd_count='$hd_count'+1,ywy='$ywy',status='$name',shr='$sp',csr='',allTime='$date',file='$fileName' where id='$id'";
            
                
            }    
        }else{
            //点击一键保存的执行流程
            if($id ==""){
                $sqlstr3="update fl_no set no='$no' where department='$department'";
                
                $result=mysqli_query($conn,$sqlstr3);
        
                $sqlstr1="insert into flsqd values('$maxID'+1,'$no','$company','$people','$department','$date','$address',".
                    "'$connection','$phone','$driving','$ishs','$category','$productNo','$productName',".
                    "'$amount','$price','$fls','$fwfxj','$flsName','$dj','$sl','$flfxj','$sd','$jkfs',".
                    "'$wlfs','$wlno','$wlprice','$note','$hd_sqslhj','$hd_fwfhj','$hd_flsl','$hd_flfhjsh',".
                    "'$hd_fwfflfzj','$hd_count'+1,'$ywy','KA级提交单据','','','$username','','','$fileName')";
            }else{
                $sqlstr1="update flsqd set no='$no',company='$company',people='$people',department='$department',date='$date',address='$address',".
                "connection='$connection',phone='$phone',driving='$driving',ishs='$ishs',category='$category',productNo='$productNo',productName='$productName',".
                "amount='$amount',price='$price',fls='$fls',fwfxj='$fwfxj',flsName='$flsName',dj='$dj',sl='$sl',flfxj='$flfxj',sd='$sd',jkfs='$jkfs',".
                "wlfs='$wlfs',wlno='$wlno',wlprice='$wlprice',note='$note',hd_sqslhj='$hd_sqslhj',hd_fwfhj='$hd_fwfhj',hd_flsl='$hd_flsl',hd_flfhjsh='$hd_flfhjsh',".
                "hd_fwfflfzj='$hd_fwfflfzj',hd_count='$hd_count'+1,ywy='$ywy',status='KA级提交单据',shr='$username',csr='',allTime='',file='$fileName' where id='$id'";
            }
        }
        
        
        $result=mysqli_query($conn,$sqlstr1);
    
        //提交后扣减授信金额
        if($sqid !="" and $usesqmoney !=""){
            $sqlstr2="select max(id) from use_sx";
            $result2=mysqli_query($conn,$sqlstr2);

            while($myrow=mysqli_fetch_row($result2)){
                $maxID2=$myrow[0];
            }

            if($maxID==""){
                $maxID2=0;
            }

            $sqlstr3="select distinct sqmoney,newMoney from use_sx where sqid='$sqid'";
            
            $result3=mysqli_query($conn,$sqlstr3);
            
            while($myrow=mysqli_fetch_row($result3)){
                $sqmoney=$myrow[0];
                $newMoney=$myrow[1];
            }

            $useMoney=(int)$sqmoney-(int)$newMoney;
                        
            $remainMoney=(int)$sqmoney-(int)$useMoney-(int)$usesqmoney;
            
            $sqlstr4="insert into use_sx values('$maxID2'+1,'$sqid','$sqmoney','$useMoney','$usesqmoney','$remainMoney','$no','$department','$date','使用授信','$remainMoney')";
            $result4=mysqli_query($conn,$sqlstr4);

            $sqlstr5="update use_sx set newMoney='$remainMoney' where sqid='$sqid'";
            $result5=mysqli_query($conn,$sqlstr5);

        }
    }


    //提交后跳转页面
    if($result){
        echo "<script>alert('提交成功！')</script>";

        if($option ==1){
            if($id ==""){
                //提交后跳转maxID+1
                echo "<script>window.location.href='../../home/fl/flLine.php?id=".($maxID+1)."'</script>";
            }else{
                //提交后跳转当前ID
                echo "<script>window.location.href='../../home/fl/flLine.php?id=$id'</script>";
            }
        }else{
            if($id ==""){
                //提交后跳转maxID+1
                echo "<script>window.location.href='../../home/fl/saveFL.php?id=".($maxID+1)."'</script>";
            }else{
                //提交后跳转当前ID
                echo "<script>window.location.href='../../home/fl/saveFL.php?id=$id'</script>";
            }
        }
        
    }else{
        echo "<script>alert('提交失败！')</script>";
        echo "<script>window.location.href='../../home/fl/flsq.php'</script>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>