<?php
    header("content-type:text/html;charset=utf-8"); 
    include_once("../../common/conn/conn.php"); 
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    
    $username=$_SESSION["username"]; 
    
    $id=$_GET["id"]; 
    $option=$_GET["option"]; 

    $sqlstr0="select department from flsqd where id='$id'";
    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $department=$myrow[0];
    }

    $sqlstr0="select newLevel from user_form where username='$username'";

    $result=mysqli_query($conn,$sqlstr0);

    while($myrow=mysqli_fetch_row($result)){
        $newLevel=$myrow[0]; 
    }

    if($option==1){

        //找出当前流程序号（同意状态）
        if($newLevel=="M"){
            $sqlstr1="select number from flprogress where name='M级审批单据' and no=1";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $number=$myrow[0];  
            }

            //获取当前辅料单的状态，审核人，时间
            $sqlstr2="select status,shr,allTime from flsqd where id='$id'";

            $result=mysqli_query($conn,$sqlstr2);

            while($myrow=mysqli_fetch_row($result)){
                $qqstatus=$myrow[0];
                $qqshr=$myrow[1];
                $allTime=$myrow[2];
            }

            //找出下个流程的状态，审核人，时间
            $sqlstr2="select name,sp from flprogress where number='$number'+1  and no=1";
        
            $result=mysqli_query($conn,$sqlstr2);

            while($myrow=mysqli_fetch_row($result)){
                $name=$myrow[0];
                $sp=$myrow[1];
            }

            $sp=$qqshr.",".$sp;
            $name2=$qqstatus.",".$name;

            $time=date('Y-m-d H:i:s', time());
            $allTime=$allTime.",".$time;

            //获取结款方式
            $sqlstr4="select jkfs from flsqd where id='$id'";
            $result=mysqli_query($conn,$sqlstr4);

            while($myrow=mysqli_fetch_row($result)){
                $jkfs=$myrow[0];
            }

            $sqlstr4="select process from fl_jkfs where jkfs='$jkfs'";
            $result=mysqli_query($conn,$sqlstr4);

            while($myrow=mysqli_fetch_row($result)){
                $jkfs_process=$myrow[0];
            }


            if($jkfs_process="商务运营"){

                if($name=="财务审批单据"){
    
                    //找出下个流程信息,财务审批跳过授信登记
                    $sqlstr2="select name,sp from flprogress where number='$number'+2  and no=1";
            
                    $result=mysqli_query($conn,$sqlstr2);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $name=$myrow[0];
                        $sp=$myrow[1];
                    }
    
                    $sp=$qqshr.",".$sp;
                    $name2=$qqstatus.",".$name;
                }
                
            }

            $sqlstr3="update flsqd set status='$name2',shr='$sp',csr='',allTime='$allTime' where id='$id'";
            $result=mysqli_query($conn,$sqlstr3);

        }else{
            //获取当前辅料单的状态，审核人，时间
            $sqlstr1="select status,shr,allTime from flsqd where id='$id'";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $qqstatus=$myrow[0];
                $qqshr=$myrow[1];
                $allTime=$myrow[2];
            }


            $qqstatus_arr=explode(",",$qqstatus);
            $status_last=array_pop($qqstatus_arr);

            if($status_last=="商务运营归档单据"){
                $sqlstr2="select number from flprogress where name='$status_last'";
            }else{
                $sqlstr2="select number from flprogress where name='商务运营审批授信'";
            }
            

            $result=mysqli_query($conn,$sqlstr2);

            while($myrow=mysqli_fetch_row($result)){
                $number=$myrow[0];  
            }

             //找出下个流程的状态，审核人，时间
             $sqlstr3="select name,sp from flprogress where number='$number'+1  and no=1";
        
             $result=mysqli_query($conn,$sqlstr3);
 
             while($myrow=mysqli_fetch_row($result)){
                 $name=$myrow[0];
                 $sp=$myrow[1];
             }
 
             $sp=$qqshr.",".$sp;
             $name2=$qqstatus.",".$name;
 
             $time=date('Y-m-d H:i:s', time());
             $allTime=$allTime.",".$time;

             //获取结款方式
            $sqlstr4="select jkfs from flsqd where id='$id'";
            $result=mysqli_query($conn,$sqlstr4);

            while($myrow=mysqli_fetch_row($result)){
                $jkfs=$myrow[0];
            }

            if($jkfs=="全现金"){

                if($name=="商务运营审批授信"){
    
                    //找出下个流程信息,财务审批跳过授信登记
                    $sqlstr2="select name,sp from flprogress where number='$number'+2  and no=1";
            
                    $result=mysqli_query($conn,$sqlstr2);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $name=$myrow[0];
                        $sp=$myrow[1];
                    }
    
                    $sp=$qqshr.",".$sp;
                    $name2=$qqstatus.",".$name;
                }
            }

            if($name=="已归档单据"){
                $sqlstr3="update flsqd set status='$name2',shr='$sp',csr='',allTime='$allTime',date2='$time' where id='$id'";
            }else{
                $sqlstr3="update flsqd set status='$name2',shr='$sp',csr='',allTime='$allTime' where id='$id'";
            }
            
            $result=mysqli_query($conn,$sqlstr3);

        }
    
    }elseif($option==3){
        //义务审批单据走此逻辑

        $wlfs=$_GET["wlfs"];
        $wlno=$_GET["wlno"];
        $wlprice=$_GET["wlprice"];
        $note=$_GET["note"];

        $sqlstr0="select department from flsqd where id='$id'";
        $result=mysqli_query($conn,$sqlstr0);

        while($myrow=mysqli_fetch_row($result)){
            $department=$myrow[0];
        }

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

        $time=date('Y-m-d H:i:s', time());
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

            echo "<script>alert(1);window.location.href='../../home/fl/flsq.php?id=$id'</script>";
            
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

    }

    if($result){
        ?>
        <script>
            if(screen.width<600){
                alert("提交成功！")
                window.location.href="../mobile/flsq/flList.php"
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
                window.location.href="../mobile/flsq/flList.php"
            }else{
                alert("提交失败！")
                window.location.href="../../home/fl/flList.php"
            }
        </script>
        <?php
    }


    mysqli_free_result($result);
    mysqli_close($conn);

?>