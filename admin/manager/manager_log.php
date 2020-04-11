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
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php");
                include_once("conn/conn.php");
            ?>

            <div class="nav nav-pills" style="float:left;margin-left:40px;">
                <li role="presentation" class="active"><a href="#">系统日志</a></li>
                <li role="presentation"><a href="manager_backup.php">数据备份</a></li>
                <button id="del_log" class="btn btn-success" style="float:left;margin-left:445px;margin-top:0px;"  data-toggle="modal" data-target="#myModal">清除日志</button>
            </div>

            <table class="table table-responsive table-bordered table-hover" style="clear:both;position:relative;top: 20px;width: 700px;margin-left: 40px;">
                <tr>
                    <th>登录账号</th>
                    <th>登录时间</th>
                    <th>登录ip</th>
                    <th>登录操作</th>
                </tr>
                <?php

                    $fileName="log.txt";
                    
                    if(file_exists('log.txt')){
                        
                        $f_open=fopen($fileName,"r");

                        while($str=fgets($f_open,255)){

                            $chr=explode(",",$str);

                            echo "<tr>";

                            for($i=0;$i<count($chr);$i++){
                                ?>
                                    <td><?=$chr[$i]?></td>
                                <?php
                            }

                            echo "</tr>";
                        }
                        fclose($f_open);

                    }else{
                        ?>
                            <td colspan="4">还没日志文件</td>
                        <?php
                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>

            </table>
            
        </div>
    </body>
</html>

<script>
    $("#del_log").click(function(){
        window.location.href="formHandle/del_logHandle.php";
    })
</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>