<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    c_log();
    
    function c_log(){
        $fileName="../log.txt";
        if(file_exists($fileName)){
            unlink($fileName);
            echo "<script>alert('删除成功！');history.go(-1);</script>";
        }else{
            echo "<script>alert('暂无系统日志！');history.go(-1);</script>";
        }
    }

?>