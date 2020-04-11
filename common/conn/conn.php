<?php
    $conn=mysqli_connect("localhost","root","root","yzl_database") or die("连接数据库服务器失败！".mysqli_error());
    mysqli_query($conn,"set names utf8");
?>