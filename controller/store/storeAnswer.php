<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_POST["id"];
    $answer=$_POST["answer"];

    $sqlstr1="update store_qs set answer='$answer',status='已处理' where id='$id'";

    $result=mysqli_query($conn,$sqlstr1);


    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/store/storeQS2.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        window.location.href="../../home/store/storeQSLine.php?id=<?=$id?>"
    </script> 
    <?php
    }
        
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>