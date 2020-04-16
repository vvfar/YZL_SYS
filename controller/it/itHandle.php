<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $id=$_POST['id'];
    $leibie=$_POST['leibie'];
    $user=$_POST['user'];
    $department=$_POST['department'];
    $orginalDepartment=$_POST['orginalDepartment'];
    $ytMac=$_POST['ytMac'];
    $wxMac=$_POST['wxMac'];
    $leixing=$_POST['leixing'];
    $brand=$_POST['brand'];
    $xinghao=$_POST['xinghao'];
    $year=$_POST['year'];
    $system=$_POST['system'];
    $cpu=$_POST['cpu'];
    $ram=$_POST['ram'];
    $hardpan=$_POST['hardpan'];
    $barcode=$_POST['barcode'];
    $mouse=$_POST['mouse'];
    $power=$_POST['power'];
    $bag=$_POST['bag'];
    $note=$_POST['note'];
    $position=$_POST['position'];
        
    if($id==""){
        $sqlstr="select max(id) from it";
        $result=mysqli_query($conn,$sqlstr);

        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }

        if($maxID==""){
            $maxID=0;
        }

        $sqlstr1="insert into it values('$maxID'+1,'$leibie','$user','$department','$orginalDepartment','$ytMac','$wxMac','$leixing','$brand','$xinghao','$year','$system','$cpu','$ram','$hardpan','$barcode','$position','$mouse','$power','$bag','$note')";

    }else{

        $sqlstr1="update it set leibie='$leibie',department='$department',user='$user',orginalDepartment='$orginalDepartment',ytMac='$ytMac',wxMac='$wxMac',leixing='$leixing',brand='$brand',xinghao='$xinghao',year='$year',system2='$system',".
                    "cpu='$cpu',ram='$ram',hardpan='$hardpan',barcode='$barcode',position='$position',mouse='$mouse',power='$power',bag='$bag',note='$note' where id='$id'";
    }

    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../home/it/itList.php"
        </script>

        <?php
    }else{
        ?>
        <script>
            alert("提交失败！")
            window.location.href="../../home/it/it.php"
        </script>
        <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>