<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $fl_name=$_POST['fl_name'];
    $sqlstr1="insert into fl values('$fl_name')";

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?>
        <script>
            alert("添加成功！")
            window.location.href="../managerFL.php";
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("添加失败！")
            window.location.href="../managerFL.php";
        </script>
        <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn); 
?>