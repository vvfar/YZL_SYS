<?php
    header("content-type:text/html;charset=utf-8"); 
    include_once("../../common/conn/conn.php"); 
    session_start();
    date_default_timezone_set("Asia/Shanghai");

    $time=date('Y-m-d H:i:s', time());
    
    $username=$_SESSION["username"]; 
    
    $id=$_GET["id"]; 
    $option=$_GET["option"]; 

    $sqlstr0="select department,jkfs,status,shr,allTime from flsqd where id='$id'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
        $jkfs=$myrow[1];
        $status=$myrow[2];
        $shr=$myrow[3];
        $shTime=$myrow[4];
    }

    $sqlstr1="select department,newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        $my_department=$myrow[0];
        $newLevel=$myrow[1]; 
    }

    if($option==1){
        //同意流程
        
        $status_arr=explode(",",$status);
        $status_now=array_pop($status_arr);
        
        $sqlstr3="select number from flprogress where name='$status_now' ";
        $result=mysqli_query($conn,$sqlstr3);

        while($myrow=mysqli_fetch_row($result)){
            $number=$myrow[0];
        }

        $number_forward=$number+1;

        $sqlstr4="select name,sp from flprogress where number='$number_forward' ";
        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $status_forward=$myrow[0];
            $sp_forward=$myrow[1];
        }

        if(($jkfs=="全现金" and $status_forward == "商业运营审批授信") or (($jkfs=="全授信" or $jkfs=="标费补贴") and $status_forward == "财务审批单据")){

            $sqlstr5="select number from flprogress where name='$status_forward' ";

            $result=mysqli_query($conn,$sqlstr5);

            while($myrow=mysqli_fetch_row($result)){
                $number=$myrow[0];
            }

            $number=$number+1;

            $sqlstr6="select name,sp from flprogress where number='$number' ";

            $result=mysqli_query($conn,$sqlstr6);

            while($myrow=mysqli_fetch_row($result)){
                $status_forward=$myrow[0];
                $sp_forward=$myrow[1];
            }      
        }

        $status_new=$status.",".$status_forward;
        $sp_new=$shr.",".$sp_forward;
        $shTime_new=$shTime.",".$time;

        if($status_forward=="已归档单据"){
            $sqlstr_fl="update flsqd set status='$status_new',shr='$sp_new',allTime='$shTime_new',date2='$time' where id='$id'";
        }else{
            $sqlstr_fl="update flsqd set status='$status_new',shr='$sp_new',allTime='$shTime_new' where id='$id'";
        }

        $result=mysqli_query($conn,$sqlstr_fl);

        //财务，商业运营加入key
        if($my_department=="财务部" or ($my_department=="商业运营部" and $status !="已归档单据")){

            //获取辅料申请单最大ID
            $sqlstr="select max(id) from fl_key";
            $result=mysqli_query($conn,$sqlstr);

            while($myrow=mysqli_fetch_row($result)){
                $maxID=$myrow[0];
            }

            if($maxID==""){
                $maxID=0;
            }

            $sqlstr_k="insert into fl_key values('$maxID'+1,'$id',1,'$time')";
            $result=mysqli_query($conn,$sqlstr_k);
        }

    
    }elseif($option==3){
        //义务审批单据走此逻辑

        $wlfs=$_GET["wlfs"];
        $wlno=$_GET["wlno"];
        $wlprice=$_GET["wlprice"];
        $note=$_GET["note"];

        //找出当前流程序号（同意状态）
        $sqlstr1="select number from flprogress where sp='$username' and no=1";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            $number=$myrow[0];
        }

        $sqlstr4="select status,shr,allTime from flsqd where id='$id'";

        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $qqstatus=$myrow[0];
            $qqshr=$myrow[1];
            $allTime=$myrow[2];
        }

        //找出下个流程信息
        $sqlstr2="select name,sp,cs from flprogress where number='$number'+1 and no=1";

        $result=mysqli_query($conn,$sqlstr2);

        if($result){
            while($myrow=mysqli_fetch_row($result)){
                $name=$myrow[0];
                $sp=$myrow[1];
            }
        }
        
        $sp=$qqshr.",".$sp;
        $name=$qqstatus.",".$name;

        $allTime=$allTime.",".$time;

        //将下个流程信息放入
        $sqlstr3="update flsqd set status='$name',shr='$sp',csr='',allTime='$allTime',wlfs='$wlfs',wlno='$wlno',wlprice='$wlprice',note='$note',allTime='$allTime' where id='$id'";

        $result=mysqli_query($conn,$sqlstr3);

    }elseif($option==6){
        //业务员重新编辑

        //重新编辑需要返还授信金额
        $sqlstr4="select count(*) from use_sx where fl_no = (select no from flsqd where id=$id)";
        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $count=$myrow[0];
        }

        if($count > 0){
            $sqlstr5="select nowUseMoney,sqid from use_sx where  fl_no = (select no from flsqd where id=$id)";
            $result=mysqli_query($conn,$sqlstr5);
            
            while($myrow=mysqli_fetch_row($result)){
                $nowUseMoney=$myrow[0];
                $sqid=$myrow[1];
            }

            $sqlstr6="update use_sx set newMoney= $nowUseMoney + newMoney where sqid='$sqid'";
            $result=mysqli_query($conn,$sqlstr6);

            $sqlstr8="delete from use_sx where fl_no = (select no from flsqd where id=$id)";
            $result=mysqli_query($conn,$sqlstr8);

            echo "<script>window.location.href='../../home/fl/flsq.php?id=$id'</script>";
            
        }else{
            echo "<script>window.location.href='../../home/fl/flsq.php?id=$id'</script>";
        }
    }elseif($option==7){
        //KA删除单据

        $sqlstr7="delete from flsqd where id='$id'";
    
        $result=mysqli_query($conn,$sqlstr7);
    
        echo "<script>alert('删除成功');window.location.href='../../home/fl/saveFL.php</script>";
    }elseif($option==8){

        //义乌修改单据
        $wlfs=$_GET["wlfs"];
        $wlno=$_GET["wlno"];
        $wlprice=$_GET["wlprice"];
        $note=$_GET["note"];

        $sqlstr7="update flsqd set wlfs='$wlfs',wlno='$wlno',wlprice='$wlprice',note='$note' where id='$id'";
    
        $result=mysqli_query($conn,$sqlstr7);
    
        echo "<script>alert('修改成功');window.location.href='../../home/fl/saveFL.php</script>";
    }else{
        //拒绝，待业务员审核
        $sqlstr4="select status,shr,allTime from flsqd where id='$id'";

        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $qqstatus=$myrow[0];
            $qqshr=$myrow[1];
            $allTime=$myrow[2];
        }

        $arr_shr=explode(",",$qqshr);
        $shr=array_shift($arr_shr);

        $sp=$qqshr.",".$shr;
        $name=$qqstatus.",待KA审核单据";
        $time=date('Y-m-d H:i:s', time());
        $allTime=$allTime.",".$time;

        $sqlstr3="update flsqd set status='$name',shr='$sp',csr='',allTime='$allTime' where id=$id";

        $result=mysqli_query($conn,$sqlstr3);

        //财务，商业运营拒绝删除key
        $sqlstr4="select count(*) from fl_key where name='$id'";
        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $count_key=$myrow[0];
        }

        if($count_key>0){
            $sqlstr5="delete from fl_key where name='$id'";
            $result=mysqli_query($conn,$sqlstr5);
        }
    }

    if($result){
        ?>
        <script>
            if(screen.width<600){
                alert("提交成功！")
                window.location.href="../../home/mobile/flsq/flList.php"
            }else{
                alert("提交成功！")
                window.location.href="../../home/fl/flList.php"
            }
        </script>
        <?php
    }else{
        ?>
        <script>
            if(screen.width<600){
                alert("提交失败！")
                window.location.href="../../home/mobile/flsq/flList.php"
            }else{
                alert("提交失败！")
                window.location.href="../../home/fl/flList.php"
            }
        </script>
        <?php
    }

    mysqli_close($conn);

?>