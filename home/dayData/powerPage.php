<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据统计</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <!-- [if lt IE 9]>
            <script src="flotr2/excanvas.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="margin-left: 240px;">

            <div class="nav nav-pills" style="float:left;margin-left:30px;position:relative;top:20px;">
                <li role="presentation"><a href="data.php?month=">当月实时数据图表</a></li>
                <li role="presentation"><a href="form.php">日数据报表</a></li>
                <li role="presentation"><a href="sumDayData.php">合计数据报表</a></li>
                <li role="presentation" class="active"><a href="#">BI数据可视化报表</a></li>
            </div>
            
            <div style="clear: both;position: relative;top:50px;left: 40px;">
                <iframe width="1200" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiZGQ5ODBkMDYtNDE3Mi00MDc1LThmNWItOTIxZDk2NTJkNWJiIiwidCI6IjhhMzg3OTFhLTZhZjktNGQwYS05ZDIyLTZkNjg0NTQ1MmE2YyIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
            </div>
            

        </div>
    </body>
</html>
