<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css\leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '..\..\home\base\header.php' ?>
        <?php include '..\..\home\base\leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("..\..\home\base\manager_header.php")
            ?>

            <div>
                <form action="../../controller/adminHandle/addFile.php" method="POST" style="margin-left: 50px;" enctype="multipart/form-data">
                    <h4 style="margin-top:20px;">上传文件</h4>
                    <hr>
                    <p style="margin-top: 7px;">标题<p>
                    <input type="text" placeholder="请输入标题名称" class="form-control" name="title" style="width: 300px;margin-top:10px;">
                    <p style="margin-top: 7px;">备注信息<p>
                    <select class="form-control" name="note" style="width: 300px;margin-top:10px;">
                        <option>选择备注信息</option>
                        <option>授信欠据模板</option>
                        <option>产品抵标费模板</option>
                        <option>培训文档</option>
                        <option>/</option>
                    </select>

                    <div class="form-group" style="clear: both;position:relative;">
                        <p style="margin-top: 7px;">附件<p>
                        <input type="file" name="upfile" style="margin-top:10px;"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-md" style="margin-top: 5px;">确认</button>
                </form>
            </div>
        </div>
    </body>
</html>