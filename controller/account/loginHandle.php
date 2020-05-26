<?php

    header("content-type:text/html;charset=utf-8"); 
    include_once("../../common/conn/conn.php");

    $username=$_POST["username"];
    $password=$_POST["password"];

    if($username=="root"){
        ?>
        <script>
            alert("用户名或密码错误，请重新登陆!");
            window.location.href="../../admin/login/login.php";
        </script>
    <?php
    }


    $result=mysqli_query($conn,"select * from user_form where username= '$username'");

    $status=false;
        
    while($myrow=mysqli_fetch_array($result)){
        if($myrow['password'] === $password){
            
            session_start();
            $_SESSION["username"]=$username;
            $_SESSION["password"]=$myrow['password'];

            $status=true;

        }
    }

    if($status){
        echo "<script>if(screen.width<600){window.location.href='../../home/mobile/index.php';}else{window.location.href='../../index.php';}</script>";
        
    }else{
        ?>
            <script>
                alert("用户名或密码错误！")
                window.location.href="../../admin/login/login.php";
            </script>
        <?php
    }
    
?>