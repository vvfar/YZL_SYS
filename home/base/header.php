<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <link href="/../public/css/header.css?v=2" rel="stylesheet"/>
        <script src="/../public/js/header.js"></script>
    </head>

    <body>
        <?php         
            session_start();
            
            if(isset($_SESSION['username'])){
                $username=$_SESSION['username'];
                $password=$_SESSION["password"];

                $sqlstr1="select headImg from user_form where username='$username'";
                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $headerImg=$myrow[0];
                }

                ?>
                    <script>
                        var leftBar_path=window.location.pathname;

                        leftBar_path=leftBar_path.split("/");
                        leftBar_path=leftBar_path.pop()
                    
                    </script>
                <?php

                
                if($password == "123456"){
                    ?>
                        <script>

                            if(leftBar_path != "center.php"){
                                alert("密码为默认密码，请立即修改！")
                                window.location.href="../../home/center/center.php"
                            }
                        </script>
                    <?php
                }
            }else{
                ?>
                    <script>
                        var path = window.location.pathname;

                        if (path != "/login.php"){
                            window.location.href="/admin/login/login.php";
                        } 
                    </script>
                <?php    
            }        
        ?>
        <div class="header_bar" style="position:fixed;background-color:#fff;z-index:99999;width:100%;">
            <div class="logo" style="position: fixed;background-color:white;border-right: 1px solid #ccc;">
                
                <img src="/public/img/logo.png" style="width:60px;margin-left:20px;float:left;margin-top:-10px;"/>
                <p style="float:left;color:rgb(108,19,24);margin-left:10px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-weight: bold;">CRM平台</p>
            </div>

            <div style="float:left;height:40px">
                <a href="/index.php" target="_blank" title="主页" style="text-decoration: none;"><i class="layui-icon layui-icon-home" style="margin-left:220px;line-height:40px;vertical-align: middle;"></i></a>

                <a href="http://www.yzl.com.cn" target="_blank" title="官网" style="text-decoration: none;"><i class="layui-icon layui-icon-website" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
                <a href="" layadmin-event="refresh" title="刷新" style="text-decoration: none;"><i class="layui-icon layui-icon-refresh-3" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
                <a href="../../controller/account/logoutHandle.php" title="退出" style="text-decoration: none;"><i class="layui-icon layui-icon-logout" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
            </div>

            <div class="headerBar">
                <div class="headerImg"><img src="/common/file/user_icon/<?=$headerImg?>" width="100%" height="100%" style="border-radius:100%; overflow:hidden;"/></div>
                <div class="userInfo">
                    <p><span id="time"></span><span id="username"><?=$_SESSION['username']?><p></p>
                </div>
                
                
            </div>
        </div>
    </body>
</html>