<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_POST["id"];
    $zf_note=$_POST["zf_note"];

    $sqlstr="select note from flsqd where id=$id";

    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $note=$myrow[0];
    }

    $note=$note."/辅料单作废，备注：".$zf_note;


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
    }


    $sqlstr1="update flsqd set note='$note',status='作废' where id=$id";

    $result=mysqli_query($conn,$sqlstr1);
    
    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/fl/flLine.php?id=<?=$id?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../../home/fl/flLine.php?id=<?=$id?>"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>