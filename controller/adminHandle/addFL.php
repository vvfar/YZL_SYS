<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $option=$_GET['option'];

    if($option == "add"){
        $fl_name=trim($_POST['fl_name']);
        $fl_price=$_POST['fl_price'];

        $sqlstr1="select count(*) from fl where fl_name='$fl_name'";
        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            $fl_dup=$myrow[0];
        }

        if($fl_dup==0){
            $sqlstr2="select max(id) from fl";
            $result=mysqli_query($conn,$sqlstr2);
        
            while($myrow=mysqli_fetch_row($result)){
                $maxID=$myrow[0];
            }
        
            if($maxID==""){
                $maxID=0;
            }
        
        
            $sqlstr3="insert into fl values('$maxID'+1,'$fl_name','$fl_price')";
            $result=mysqli_query($conn,$sqlstr3);

            $fl_name=$fl_name."(赠)";

            $sqlstr4="insert into fl values('$maxID'+2,'$fl_name','$fl_price')";
            $result=mysqli_query($conn,$sqlstr4);
        
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
        }else{
            ?>
            <script>
                alert("辅料编号重复！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }
    }elseif($option == "delete"){
        $id=$_GET["id"];

        $sqlstr1="select fl_name from fl where id='$id'";
        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            $fl_name=$myrow[0];
        }

        $fl_name=$fl_name."(赠)";

        $sqlstr2="delete from fl where fl_name='$fl_name'";    
        $result=mysqli_query($conn,$sqlstr2);

        $sqlstr3="delete from fl where id='$id'";    
        $result=mysqli_query($conn,$sqlstr3);

        if($result){
            ?>
            <script>
                alert("删除成功！")
                window.location.href="../../admin/manager/managerFL.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("删除失败！")
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