<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

    date_default_timezone_set("Asia/Shanghai");
    $time=date('Y-m-d  H:i:s', time());
    $date=date('Y-m-d', time());

    session_start();

    $username=$_SESSION["username"];

    $sqlstr0="select department from user_form where username='$username'";
    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    $progress=$_GET['progress'];

    

    if($progress==1){

        $id=$_POST['id'];
        $no=$_POST['no'];
        $companyName=$_POST['companyName'];
        $storeName=$_POST['storeName'];
        $sqType=$_POST['sqType'];
        $pingtai=$_POST['pingtai'];
        $category=$_POST['category'];
        $contract_no=$_POST['contract_no'];
        $bzj=$_POST['bzj'];
        $input_time=$_POST['input_time'];
        $input_time2=$_POST['input_time2'];
        $re_date=date('Y-m-d', time());
        
    
        $fileName="";
        $fileName2="";
    
        $fileStatus=TRUE;
    
        if($bzj != '0'){
            if(!empty($_FILES['upfile']['name'])){
    
                $fileinfo=$_FILES['upfile'];
                if($fileinfo['size']<2097152 && $fileinfo['size']>0){
                    //echo $fileName;
        
                    $path="../../common/file/sq_file/bzj/".$_FILES["upfile"]["name"];
                    move_uploaded_file($fileinfo['tmp_name'],$path);
                    
                    $fileName=$_FILES['upfile']['name'];   
                }else{
                    echo "<script>alert('照片过大无法上传！');window.location.href='../../home/contract/newSQ.php'</script>";
                    $fileStatus=FALSE;
                }
            }else{
                if($id == ""){
                    echo "<script>alert('保证金不为0必须上传收据！');window.location.href='../../home/contract/newSQ.php'</script>";
                    $fileStatus=FALSE;
                }
                
            }
        }
        
        
    
        if(!empty($_FILES['upfile2']['name'])){
            $fileinfo=$_FILES['upfile2'];
            if($fileinfo['size']<2097152 && $fileinfo['size']>0){
                $path="../../common/file/sq_file/sq_file/".$_FILES["upfile2"]["name"];
                move_uploaded_file($fileinfo['tmp_name'],$path);
                
                $fileName2=$_FILES['upfile2']['name'];
    
            }else{
                echo "<script>alert('照片过大无法上传！');window.location.href='../../home/contract/newSQ.php'</script>";
                $fileStatus=FALSE;
            }
        }else{
            if($id == ""){
                echo "<script>alert('授信扫描件需上传！');window.location.href='../../home/contract/newSQ.php'</script>";
                $fileStatus=FALSE;
            }
        }
    
        
        $sqlstr="select max(id) from sq";
        $result=mysqli_query($conn,$sqlstr);
    
        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }
    
        if($fileName !="" or $fileName2 !=""){
            $fileAll=$fileName.",".$fileName2;
        }else{
            $fileAll="";
        }
        
        if($fileStatus==TRUE){
            
            if($id==""){
                $sqlstr1="insert into sq values('$maxID'+1,'$no','$companyName','$storeName','$sqType','$pingtai','$category','$department','$input_time','$input_time2','$contract_no','$bzj','$fileAll','$re_date','待归档','$username','$time')";
            }else{
                if($fileAll != ""){
                    $sqlstr1="update sq set no='$no',companyName='$companyName',storeName='$storeName',sqType='$sqType',pingTai='$pingtai',category='$category',date1='$input_time',date2='$input_time2',contractNo='$contract_no',bzj='$bzj',fileName='$fileAll',status='待归档',shr='$username',shTime='$time' where id='$id'";
                }else{
                    $sqlstr1="update sq set no='$no',companyName='$companyName',storeName='$storeName',sqType='$sqType',pingTai='$pingtai',category='$category',date1='$input_time',date2='$input_time2',contractNo='$contract_no',bzj='$bzj',status='待归档',shr='$username',shTime='$time' where id='$id'";
                }    
            }
        }

        $result=mysqli_query($conn,$sqlstr1);

        if($result){
                ?>
                <script>
                    alert("提交成功！")
                    window.location.href="../../home/contract/w_sq.php"
                </script>

        <?php
        }else{
            ?>
            <script>
                alert("提交失败！")
                window.location.href="../../home/contract/newSQ.php"
            </script>
            <?php
        }
        
    }else{
        if($progress == 4){
            $id=$_GET['id'];

            //授权归档后新增店铺
            $sqlstr3="select companyName,storeName,pingTai,category,department,contractNo,status,shr from sq where id=$id";

            $result=mysqli_query($conn,$sqlstr3);

            while($myrow=mysqli_fetch_row($result)){
                $companyName=$myrow[0];
                $storeName=$myrow[1];
                $pingTai=$myrow[2];
                $category=$myrow[3];
                $department=$myrow[4];
                $contractNo=$myrow[5];
                $status=$myrow[6];
                $shr=$myrow[7];
            }

            $shr_arr=explode(",",$shr);
            $staff=$shr_arr[0];

            $sqlstr4="select count(*) from contract where no='$contractNo' and store='$storeName' and company='$companyName'";

            $result=mysqli_query($conn,$sqlstr4);

            while($myrow=mysqli_fetch_row($result)){
                $contract_count=$myrow[0];
            }

            //查询店铺
            
            //如果存在店铺
            $sqlstr6="select count(*) from store where storeName='$storeName' and client='$companyName'";
                                
            $result=mysqli_query($conn,$sqlstr6);

            while($myrow=mysqli_fetch_row($result)){
                $store_count=$myrow[0];
            }

            if($store_count == 0){

                $sqlstr="select max(id) from store";
                
                $result=mysqli_query($conn,$sqlstr);

                while($myrow=mysqli_fetch_row($result)){
                    $maxID=$myrow[0];
                }

                if($maxID==""){
                    $maxID=0;
                }

                $sqlstr8="select no from store_no where id=1";
                
                $result=mysqli_query($conn,$sqlstr8);

                while($myrow=mysqli_fetch_row($result)){
                    $storeID_sql=$myrow[0];
                }

                $storeID_sql=$storeID_sql+1;

                if($storeID_sql<10){
                    $storeID="YZL-000".$storeID_sql;
                }elseif($storeID_sql>=10 and $storeID_sql < 100){
                    $storeID="YZL-00".$storeID_sql;
                }elseif($storeID_sql>=100 and $storeID_sql < 1000){
                    $storeID="YZL-0".$storeID_sql;
                }else{
                    $storeID="YZL-".$storeID_sql;
                }

                if($contract_count >0){
                    $sqlstr5="select status from contract where no='$contractNo' and store='$storeName' and company='$companyName'";
                
                    while($myrow=mysqli_fetch_row($result)){
                        $status2=$myrow[0];
                    }

                    if($status2=="已归档"){
                        
                        $sqlstr7="insert into store values('$maxID'+1,'$storeID','$companyName','$storeName','$pingTai','$category','$department','$staff','','','正常','$date','','','$date','合同授权已提交')";
                    
                        $result=mysqli_query($conn,$sqlstr7);

                        $sqlstr8="update store_no set no='$storeID_sql' where id=1";
                        
                        $result=mysqli_query($conn,$sqlstr8);
                    }else{
                        $sqlstr7="insert into store values('$maxID'+1,'$storeID','$companyName','$storeName','$pingTai','$category','$department','$staff','','','正常','$date','','','$date','合同进行中授权已提交')";
                    
                        $result=mysqli_query($conn,$sqlstr7);

                        $sqlstr8="update store_no set no='$storeID_sql' where id=1";
                        
                        $result=mysqli_query($conn,$sqlstr8);
                    }

                }else{
                    $sqlstr7="insert into store values('$maxID'+1,'$storeID','$companyName','$storeName','$pingTai','$category','$department','$staff','','','正常','$date','','','$date','合同未提交授权已提交')";
                    
                    $result=mysqli_query($conn,$sqlstr7);

                    $sqlstr8="update store_no set no='$storeID_sql' where id=1";
                        
                    $result=mysqli_query($conn,$sqlstr8);
                }
            }
            
            $sqlstr1="update sq set status = '已归档' where id='$id'";


        }elseif($progress == 5){
            //审核拒绝

            $sqlstr1="update sq set status = '审核拒绝' where id='$id'";
        
        }elseif($progress == 6){
            $sqlstr1="delete from sq where id='$id'";
        }

        $result=mysqli_query($conn,$sqlstr1);

        if($result){
                ?>
                <script>
                    alert("提交成功！")
                    window.location.href="../../home/contract/sqList.php"
                </script>

        <?php
        }else{
            ?>
            <script>
                alert("提交失败！")
                window.location.href="../../home/contract/newSQ.php"
            </script>
            <?php
        }
    }
    
    
    
    //mysqli_free_result($result);
    mysqli_close($conn);
?>