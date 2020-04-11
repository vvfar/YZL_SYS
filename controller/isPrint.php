<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $id=trim(isset($_GET['id'])?$_GET['id']:"");
    $department=trim(isset($_GET['department'])?$_GET['department']:"");

    if($id != ""){

        if($department=="义乌"){
            $sqlstr="update flsqd set isprint='1' where id=$id";
        }
        
        $result=mysqli_query($conn,$sqlstr);

        if($result){
            echo 0;
        }else{
            echo 1;
        }

        //mysqli_free_result($result);
        mysqli_close($conn);
    }
    

    
?>
