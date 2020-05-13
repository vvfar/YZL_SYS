<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据中心平台（手机版）</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="../../../public/lib/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="../../../public/lib/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <div data-role="header" data-theme="b" data-position="fixed">
            <h1>手机版——用户登录</h1>
        </div>

        <div data-role="content">
            <img src="../../../public/img/timg.jpg" style="width:100%;margin-bottom:20px;">

            <form style="border:1px solid #cccccc;padding: 20px;padding-bottom: 40px;border-radius: 5px;" method="post" action="../../../controller/account/loginHandle.php" data-ajax="false">
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
                    <button class="btn btn-default" type="submit" style="width:45%;float:left">点击登陆</button>
                    <button class="btn btn-default reset" type="button" style="width:45%;float:right">忘记密码</button>
                </div>
                <div style="clear:both">
                </div>
            </form>
        </div>

        <div data-role="footer" data-theme="b" data-position="fixed">
            <h1>俞兆林数据中心</h1>
        </div>
    </body>
</html>

<script>

    $(".reset").click(function(){
        alert("请联系数据中心！")
    })
</script>