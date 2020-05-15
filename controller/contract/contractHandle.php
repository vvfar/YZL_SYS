<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");
    error_reporting(E_ALL || ~E_NOTICE);

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
        $contractType=$_POST['contractType'];
        $re_date=date('Y-m-d', time());
    
        if($contractType=="供应商合同"){
            $store=$company;
            $pingtai="工厂";
        }


        $sqlstr="select max(id) from contract";
        $result=mysqli_query($conn,$sqlstr);

        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }

        if($maxID==""){
            $maxID=0;
        }

        if($id==""){
            $sqlstr1="insert into contract values('$maxID'+1,'$re_date','$no','$department','$pingtai','$category','$company','$store','$input_time','$input_time2','$money','$ismoney','$sales','$issales','$service','$isservice','$note','待归档','$oldNo','$username','$time','$contractType')";
        }else{
            $sqlstr1="update contract set no='$no',company='$company',store='$store',pingtai='$pingtai',category='$category',money='$money',ismoney='$ismoney',sales='$sales',issales='$issales',service='$isservice',note='$note',oldNo='$oldNo',status='待归档',shr='$username',shTime='$time',contractType='$contractType' where id='$id'";
        }
        
    
        $result=mysqli_query($conn,$sqlstr1);
    }elseif($progress == 4){
        $id=$_GET["id"];

        $sqlstr1="update contract set status = '已归档' where id='$id'"; 
        $result=mysqli_query($conn,$sqlstr1);

    }elseif($progress == 5){
        //审核拒绝
        $id=$_GET["id"];

        $sqlstr1="update contract set status = '审核拒绝' where id='$id'"; 
        $result=mysqli_query($conn,$sqlstr1);
    }elseif($progress == 6){
        $id=$_GET["id"];

        $sqlstr1="delete from contract where id='$id'";
        
        $result=mysqli_query($conn,$sqlstr1);
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