<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $option=$_GET['option'];

    if($option == "add"){
        $fl_name=$_POST['fl_name'];
        $fl_price=$_POST['fl_price'];

        $sqlstr="select max(id) from fl";
        $result=mysqli_query($conn,$sqlstr);
    
        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }
    
        if($maxID==""){
            $maxID=0;
        }
    
    
        $sqlstr1="insert into fl values('$maxID'+1,'$fl_name','$fl_price')";
    
        $result=mysqli_query($conn,$sqlstr1);
    
        if($result){
            ?>
            <script>
                alert("添加成功！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("添加失败！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }
    
        mysqli_free_result($result);
        mysqli_close($conn); 
    }elseif($option == "delete"){
        $id=$_GET["id"];

        $sqlstr1="delete from fl where id='$id'";
    
        $result=mysqli_query($conn,$sqlstr1);

        if($result){
            ?>
            <script>
                alert("添加成功！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("添加失败！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }
    }elseif($option =="edit"){
        $id=$_POST["id"];
        $fl_name=$_POST['fl_name'];
        $fl_price=$_POST['fl_price'];

        $sqlstr1="update fl set fl_name='$fl_name',fl_price='$fl_price' where id='$id'";
    
        $result=mysqli_query($conn,$sqlstr1);

        if($result){
            ?>
            <script>
                alert("添加成功！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("添加失败！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }
    }
?>