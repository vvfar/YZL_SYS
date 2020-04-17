<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\js\manager_header.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '..\..\home\base/header.php' ?>
        <?php include '..\..\home\base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("..\..\home\base\manager_header.php")
            ?>
            
            <form action="../../controller/adminHandle/addFL.php" method="POST" style="margin-left: 50px;">
                <h4 style="margin-top:20px;">添加辅料</h4>
                <input type="text" placeholder="请输入辅料名称" class="form-control" name="fl_name" style="width: 300px;margin-top:20px;">
                <button type="submit" class="btn btn-success btn-md" style="margin-top: 10px;">确认</button>
            </form>
        </div>
    </body>
</html>