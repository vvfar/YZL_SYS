<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    session_start();

    $id=$_GET["id"];
    $option=$_GET["option"];

    $username=$_SESSION["username"];

    if($option==1){



        $sqlstr0="select department from sx_form where id='$id'";
        $result=mysqli_query($conn,$sqlstr0);

        while($myrow=mysqli_fetch_row($result)){
            $department=$myrow[0];
        }

        //同意
        //找出当前流程序号
        $sqlstr1="select number from sxprogress where department='$department' and sp='$username' and no=2";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            $number=$myrow[0];
        }

        $sqlstr4="select status2,shr,allTime,csr from sx_form where id='$id'";

        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $qqstatus=$myrow[0];
            $qqshr=$myrow[1];
            $allTime=$myrow[2];
            $qqcsr=$myrow[3];
        }
        

        $number=$number+1;

        //找出下个流程信息
        $sqlstr2="select name,sp,cs from sxprogress where department='$department' and number=$number  and no=2";

        $result=mysqli_query($conn,$sqlstr2);

        while($myrow=mysqli_fetch_row($result)){
            $name=$myrow[0];
            $sp=$myrow[1];
            $cs=$myrow[2];
        }

        if($name=="审核完成"){
            $sp=$qqshr.",".$sp;
            $cs=$qqcsr.",".$cs;
            $name2=$qqstatus.",".$name;
    
            date_default_timezone_set("Asia/Shanghai");
            $time=date('Y-m-d H:i:s', time());
            $allTime=$allTime.",".$time;
    
            $sqlstr3="update sx_form set status2='$name2',shr='$sp',csr='$cs',allTime='$allTime' where id='$id'";
            
            $result=mysqli_query($conn,$sqlstr3);

            $sqlstr4="update sx_form set status='已生效'";
            
            $result=mysqli_query($conn,$sqlstr4);
        }else{
            $sp=$qqshr.",".$sp;
            $cs=$qqcsr.",".$cs;
            $name2=$qqstatus.",".$name;
    
            date_default_timezone_set("Asia/Shanghai");
            $time=date('Y-m-d H:i:s', time());
            $allTime=$allTime.",".$time;
    
            $sqlstr3="update sx_form set status2='$name2',shr='$sp',csr='$cs',allTime='$allTime' where id='$id'";
            
            $result=mysqli_query($conn,$sqlstr3);
        }
        

    }elseif($option==3){

        date_default_timezone_set("Asia/Shanghai");
        $time=date('Y-m-d H:i:s', time());
        $note=$_POST["note"];

        $sqlstr4="select note from sx_form where id='$id'";

        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $sql_note=$myrow[0];
        }

        $note=$sql_note."/作废理由：".$note."/作废人：".$username;

        $sqlstr3="update sx_form set status='已作废',note='$note' where id='$id'";
        
        $result=mysqli_query($conn,$sqlstr3);


    }else{
        //拒绝，待业务员审核
        $sqlstr4="select status2,shr,allTime from flsqd where id='$id' and no=2";

        $result=mysqli_query($conn,$sqlstr4);

        while($myrow=mysqli_fetch_row($result)){
            $qqstatus=$myrow[0];
            $qqshr=$myrow[1];
            $allTime=$myrow[2];
        }

        $arr_shr=explode(",",$qqshr);
        $shr=array_shift($arr_shr);

        $sqlstr3="update sx_form set status='待业务员审核',shr='$shr',csr='',allTime='' where id=$id";

        $result=mysqli_query($conn,$sqlstr3);

    }

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../zhangmu.php"
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("提交失败！")
            window.location.href="../zhangmu.php"
        </script>
        <?php
    }


    //mysqli_free_result($result);
    mysqli_close($conn);

?>