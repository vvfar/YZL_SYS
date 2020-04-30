<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $fl=trim(isset($_GET['fl'])?$_GET['fl']:"");

  
    $sqlstr="select fl_price from fl where fl_name='$fl'";
        
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $fl=$myrow[0];
    }

    if($result){
        echo $fl;
    }else{
        echo "";
    }

    //mysqli_free_result($result);
    mysqli_close($conn);
    
?>