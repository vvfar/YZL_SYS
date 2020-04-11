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
        <script src="lib\flotr2\flotr2.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php")
            ?>

            <div>
                <form action="formHandle/adminHandle/addFile.php" method="POST" style="margin-left: 50px;" enctype="multipart/form-data">
                    <h4 style="margin-top:20px;">上传文件</h4>
                    <hr>
                    <p style="font-size: 16px;margin-top: 7px;">标题<p>
                    <input type="text" placeholder="请输入标题名称" class="form-control" name="title" style="width: 300px;">
                    <p style="font-size: 16px;margin-top: 7px;">备注信息<p>
                    <select class="form-control" name="note" style="width: 300px;">
                        <option>选择备注信息</option>
                        <option>授信欠据模板</option>
                        <option>产品抵标费模板</option>
                        <option>/</option>
                    </select>

                    <div class="form-group" style="clear: both;position:relative;">
                        <p style="font-size: 16px;margin-top: 7px;">附件<p>
                        <input type="file" name="upfile"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-md" style="margin-top: 5px;">确认</button>
                </form>
            </div>
        </div>
    </body>
</html>