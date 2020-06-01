<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_登陆网站</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css\login.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
    </head>
    <body style="width: 100%;height: 100%;position: fixed;">
        <?php
            session_start();
            session_unset();
            session_destroy();
        ?>

        <div class="login_content">
            <img src="..\..\public\img\timg.jpg">

            <form style="border:1px solid #cccccc;padding: 20px;padding-bottom: 40px;border-radius: 5px;" method="post" action="../../controller/account/loginHandle.php">
                <h4 style="font-weight: bold;">账号登陆</h4>
                <hr>
                <div class="form-group">
                    <p>用户名</p>
                    <input type="text" placeholder="请输入用户名" class="form-control" name="username"/>
                </div>
                <div class="form-group group1">
                    <p>密码</p>
                    <input type="password" placeholder="请输入密码" class="form-control" name="password"/>
                </div>
                <div class="form-group group2">
                    <button class="btn btn-default" type="submit">点击登陆</button>
                    <button class="btn btn-default reset" type="button">忘记密码</button>
                </div>
            </form>
        </div>
    </body>
</html>

<script>
    window.onload=function(){
        if(screen.width<600){
            window.location.href="../../home/mobile/login.php";
        }
    }

    $(".reset").click(function(){
        alert("请联系数据中心！")
    })
</script>