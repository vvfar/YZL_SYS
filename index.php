<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_我的门户</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="public\css\index.css" rel="stylesheet"/>
        <link href="public\lib\bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="public\lib\bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <?php 
            include_once("common/conn/conn.php");
            include 'home/base/header.php';
            include 'home/base/leftBar.php'; 
        ?>

        <div class="container1">
            <div class="dongtai">
                <p class="title">公司动态</p> 
                <table class="table table-hover ggl_tb" style="width:250px;margin:0;margin-top:10px">
                    <?php

                        $sqlstr="select * from news where newsType='公司动态' order by id desc limit 4";
                        $result=mysqli_query($conn,$sqlstr);
                    
                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $title=$myrow[1];
                            $time=$myrow[2];
                            ?>

                            <tr>
                                <td><a href="/home/news/news.php?id=<?=$id?>"><?=$title?></a></td>
                                <td style="color:#cccccc;font-size:12px;text-align:right"><?=$time?></td>
                            </tr>
                        <?php
                        }
                    ?>
                </table>
            </div>

            <div class="weather">
                <div id="weather-view-he"></div>
                    <script>
                        WIDGET = {ID: 'mAYG2Y9l10'};
                    </script>
                    <script type="text/javascript" src="https://apip.weatherdt.com/view/static/js/r.js?v=1111"></script>
                </div>
            </div>

            <div class="myfavor">
                <p class="title">我的收藏</p>
                <div>
                    <a href="/home/fl/flsq.php" target="_blank">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填辅料</p>
                    </a>
                </div>
                <div>
                    <a href="/home/sx/writeSX.php" target="_blank">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填授信</p>
                    </a>
                </div>
                <div>
                    <a href="/home/contract/contract.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填合同</p>
                    </a>
                </div>
                <div>
                    <a href="/home/contract/newSQ.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填授权</p>
                    </a>
                </div>
                <div>
                    <a href="/home/center/center.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">改密码</p>
                    </a>
                </div>
                <div>
                    <a href="/home/meeting/viewMeeting.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">订会议</p>
                    </a>
                </div>
            </div>

            <div  class="bd">
                <div class="ggl_title">
                    <p class="title">公共文档</p>
                </div>
            
                <table class="table table-hover ggl_tb" style="width:670px">
                    <tr>
                        <th>文档标题</th>
                        <th>下载链接</th>
                        <th>发布人</th>
                        <th>发布时间</th>
                    </tr>
                    <?php

                        $sqlstr="select * from files order by id desc limit 8";
                        $result=mysqli_query($conn,$sqlstr);
                    
                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $title=$myrow[1];
                            $fileName=$myrow[2];
                            $createUser=$myrow[3];
                            $time=$myrow[4];
                            ?>

                            <tr>
                                <td><?=$title?></td>
                                <td><a href="../../common/file/myfile/<?=$fileName?>">点击下载</a></td>
                                <td><?=$createUser?></td>
                                <td><?=$time?></td>
                            </tr>
                        <?php
                        }
                    ?>
                </table>
            </div>

            <div class="ggl2">
                <div class="ggl2_title">
                    <p class="title">公告栏</p>
                </div>

                <table class="table table-hover">
                    <?php
                        $sqlstr="select * from news where newsType='公司公告' order by id desc limit 10";
                        $result=mysqli_query($conn,$sqlstr);
                    
                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $title=$myrow[1];
                            $time=$myrow[2];
                            $person=$myrow[3];
                            $content=$myrow[4];
                            ?>
                            <tr>
                                <td><a href="home/news/news.php?id=<?=$id?>" style="color:#000000"><?=$title?></a></td>
                                <td style="color:#cccccc;font-size:12px;text-align:right"><?=$time?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>

                </table>
            </div>
        </div>
    </body>
</html>

