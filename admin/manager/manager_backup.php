<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
    <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../../home/base/header.php' ?>
        <?php include '../../home/base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("../../home/base/manager_header.php")
            ?>

            <div class="nav nav-pills" style="float:left;margin-left:40px;">
                <li role="presentation"><a href="manager_log.php">系统日志</a></li>
                <li role="presentation" class="active"><a href="#">数据备份</a></li>
                <button id="del_backup" class="btn btn-success" style="float:left;margin-left:445px;margin-top:0px;"  data-toggle="modal" data-target="#myModal">清除备份</button>
            </div>

            <div style="clear: both;margin-left:40px;">
                <div class="form-group" style="position: relative;top:20px">
                    <button class="btn btn-info" style="float:left" id="backup">备份数据</button>
                    <?php
                        date_default_timezone_set("Asia/Shanghai");
                        $date1=date('Ymd', time());  //签署日期

                        $name=$date1.".sql";
                    ?>

                    <input type="text" value="<?=$name?>" id="backup_input" class="form-control" style="width:250px;float:left;margin-left:20px;" readOnly/>
                </div>
                <div class="form-group" style="clear:both;position: relative;top:40px">
                    <button class="btn btn-warning" style="float:left" id="reback">恢复备份</button>
                    <select class="form-control" id="reback_input" style="float:left;width:250px;margin-left:20px;">
                        <option></option>
                        <?php

                            function show_file(){
                                $folder_name="../../common/backup";
                                $d_open=opendir($folder_name);
                                $num=0;
                                while($file=readdir($d_open)){
                                    $filename[$num]=$file;
                                    $num++;
                                }
                                closedir($d_open);
                                return $filename;
                            }

                            $filename=show_file();

                            for($i=2;$i<sizeof($filename);$i++){
                                ?>
                                    <option><?=$filename[$i]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div style="clear: both;position: relative;top:60px;margin-left:40px;">
                <!--<p>备份物理地址：D:\phpstudy\PHPTutorial\WWW\test\backup</p>-->
                <p>备份物理地址：D:\phpstudy_pro\WWW\common\backup</p>
            </div> 
        </div>
    </body>
</html>

<script>
    $("#del_backup").click(function(){
        window.location.href="../../controller/backData/backsql.php?name=&option=2";
    })

    $("#backup").click(function(){
        backup_input=$("#backup_input").val();

        window.location.href="../../controller/backData/backsql.php?name=" + backup_input + "&option=0";
    })

    $("#reback").click(function(){
        reback_input=$("#reback_input").val();

        window.location.href="../../controller/backData/backsql.php?name=" + reback_input + "&option=1";
    })
    

</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>