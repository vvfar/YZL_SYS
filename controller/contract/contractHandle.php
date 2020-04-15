<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    date_default_timezone_set("Asia/Shanghai");
    $time=date('Y-m-d  H:i:s', time());
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
        $pingtai=$_POST['pingtai'];
        $category=$_POST['category'];
        $company=$_POST['company'];
        $store=$_POST['store'];
        $input_time=$_POST['input_time'];
        $input_time2=$_POST['input_time2'];
        $money=$_POST['money'];
        $ismoney=$_POST['ismoney'];
        $sales=$_POST['sales'];
        $issales=$_POST['issales'];
        $service=$_POST['service'];
        $isservice=$_POST['isservice'];
        $note=$_POST['note'];
        $oldNo=$_POST['oldNo'];
        $re_date=date('Y-m-d', time());
    
        $sqlstr="select max(id) from contract";
        $result=mysqli_query($conn,$sqlstr);

        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }

        if($maxID==""){
            $maxID=0;
        }

        $sqlstr0="select username from user_form where department like '%$department%' and newLevel='M'";
        
        $result=mysqli_query($conn,$sqlstr0);

        while($myrow=mysqli_fetch_row($result)){
            $usernameNext=$myrow[0];
        }

        $username=$username.",".$usernameNext;


        if($id==""){
            $sqlstr1="insert into contract values('$maxID'+1,'$re_date','$no','$department','$pingtai','$category','$company','$store','$input_time','$input_time2','$money','$ismoney','$sales','$issales','$service','$isservice','$note','KA级提交单据,M级审批单据','$oldNo','$username','$time')";
        }else{
            $sqlstr1="update contract set no='$no',company='$company',store='$store',pingtai='$pingtai',category='$category',money='$money',ismoney='$ismoney',sales='$sales',issales='$issales',service='$isservice',note='$note',oldNo='$oldNo',status='KA级提交单据,M级审批单据',shr='$username',shTime='$time' where id='$id'";
        }
        
    
        $result=mysqli_query($conn,$sqlstr1);
    }elseif($progress >=2 && $progress <=6){
        $id=$_GET['id'];

        $sqlstr2="select status,shr,shTime from contract where id='$id'";
    
        $result=mysqli_query($conn,$sqlstr2);

        while($myrow=mysqli_fetch_row($result)){
            $status=$myrow[0];
            $shr=$myrow[1];
            $shTime=$myrow[2];
        }

        if($progress == 2){
            $status=$status.",崔总审批单据";
            $shr=$shr.",崔立德";
            $shTime=$shTime.",".$time;

            $sqlstr1="update contract set status = '$status',shr='$shr',shTime='$shTime' where id='$id'"; 
            $result=mysqli_query($conn,$sqlstr1);
        }elseif($progress ==3){
            $status=$status.",商务运营归档单据";
            $shr=$shr.",楚柳辉";
            $shTime=$shTime.",".$time;

            $sqlstr1="update contract set status = '$status',shr='$shr',shTime='$shTime' where id='$id'"; 
            $result=mysqli_query($conn,$sqlstr1);
        }elseif($progress == 4){
            $sqlstr3="select no,company,store from contract where id='$id'";

            $result=mysqli_query($conn,$sqlstr3);

            while($myrow=mysqli_fetch_row($result)){
                $no=$myrow[0];
                $companyName=$myrow[1];
                $storeName=$myrow[2];
            }

            $sqlstr4="select count(*) from sq where contractNo='$no' and companyName='$companyName' and storeName='$storeName'";
            
            $result=mysqli_query($conn,$sqlstr4);

            while($myrow=mysqli_fetch_row($result)){
                $sq_count=$myrow[0];
            }
            
            if($sq_count == 0){
                echo "<script>alert('请先提交授权！');window.location.href='../../home/contract/contract_line.php?id=".$id."&option=合同'</script>";

            }else{
                $sqlstr5="select count(*) from store where client='$companyName' and storeName='$storeName'";
                $result=mysqli_query($conn,$sqlstr5);

                while($myrow=mysqli_fetch_row($result)){
                    $store_count=$myrow[0];
                }

                if($store_count == 0){
                    echo "<script>alert('请先审核授权！');window.location.href='../../home/contract/contract_line.php?id=".$id."&option=合同'</script>";
                }else{
                    $sqlstr6="update store set htsq='合同授权已提交' where id=(select id from store where client='$companyName' and storeName='$storeName')";
                
                    $status=$status.",商务运营已归档";
                    $shr=$shr.",商务运营部";
                    $shTime=$shTime.",".$time;

                    $sqlstr1="update contract set status = '$status',shr='$shr',shTime='$shTime' where id='$id'"; 
                    $result=mysqli_query($conn,$sqlstr1);
                }
            }
        }elseif($progress == 5){
            //审核拒绝
            $status=$status.",审核拒绝";
            $shr=$shr.",KA级";
            $shTime=$shTime.",".$time;

            $sqlstr1="update contract set status = '$status',shr='$shr',shTime='$shTime' where id='$id'"; 
            $result=mysqli_query($conn,$sqlstr1);
        }elseif($progress == 6){
            $sqlstr1="delete from contract where id='$id'";
            
            $result=mysqli_query($conn,$sqlstr1);
        }        
    }

    if($result){
        if(isset($_GET['option']) && $_GET['option']==0){
            ?>
            <script>
                alert("提交成功！")
                window.location.href="../../home/contract/contractList.php"
            </script>

            <?php
        }else{
            ?>
            <script>
                alert("提交成功！")
                window.location.href="../../home/contract/w_contract.php"
            </script>

            <?php
        }
    }else{
        ?>
        <script>
            alert("提交失败！")
            window.location.href="../../home/contract/contract.php"
        </script>
        <?php
    }
    
    //mysqli_free_result($result);
    mysqli_close($conn);
?>