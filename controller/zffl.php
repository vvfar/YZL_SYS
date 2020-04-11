<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $id=$_POST["id"];
    $zf_note=$_POST["zf_note"];

    $sqlstr="select note from flsqd where id=$id";

    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $note=$myrow[0];
    }

    $note=$note."/辅料单作废，备注：".$zf_note;

    $sqlstr1="update flsqd set note='$note',status='作废' where id=$id";

    $result=mysqli_query($conn,$sqlstr1);
    
    if($result){
    ?>
        <script>
            alert("提交成功！")
            window.location.href="../flLine.php?id=<?=$id?>"
        </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！");
        window.location.href="../flLine.php?id=<?=$id?>"
    </script> 
    <?php
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
?>