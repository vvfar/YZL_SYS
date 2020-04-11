<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php")
            ?>
            
            <form action="formHandle/addFL.php" method="POST" style="margin-left: 50px;">
                <h4 style="margin-top:20px;">添加辅料</h4>
                <input type="text" placeholder="请输入辅料名称" class="form-control" name="fl_name" style="width: 300px;">
                <button type="submit" class="btn btn-success btn-md" style="margin-top: 10px;">确认</button>
            </form>
        </div>
    </body>
</html>