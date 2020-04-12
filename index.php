<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_我的门户</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="public\css\index.css" rel="stylesheet"/>
        <link href="public\css\leftbar.css" rel="stylesheet"/>
        <link href="public\css\header.css" rel="stylesheet"/>
        <link href="public\lib\bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="public\lib\bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <script src="public\lib\flotr2/flotr2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    </head>
    <body style="width: 100%">
        <?php include_once("common/conn/conn.php");?>

        <?php include 'home/base/header.php' ?>
        <?php include 'home/base/leftBar.php' ?>

        <div class=" container1">
            <div class="index_content">
                <div style="float: left;margin-right:20px;">
                    <!-- weather -->
                    <div id="weather-view-he"></div>
                        <script>
                            WIDGET = {ID: 'mAYG2Y9l10'};
                        </script>
                        <script type="text/javascript" src="https://apip.weatherdt.com/view/static/js/r.js?v=1111"></script>
                    </div>
                </div>
                <div style="width: 280px;height:200px;border:1px solid #d9d9d9;float:left;margin-right:20px;border-radius: 5px;margin-top:30px;padding:10px;margin-top:30px">
                    <p style="color: #9b9b9b;">代办事项</p>
                    <div style="width: 124px;height:70px;background-color: #f5eeee;float:left;margin-right:10px;margin-top:10px;padding:10px;">
                        <p>待审辅料</p>
                        <h3 style="margin-top:7px">10</h3>
                    </div>
                    <div style="width: 124px;height:70px;background-color: #f5eeee;float:left;margin-top:10px;padding:10px;">
                        <p>待审授信</p>
                        <h3 style="margin-top:7px">10</h3>
                    </div>
                    <div style="width: 124px;height:70px;background-color: #f5eeee;float:left;margin-right:10px;margin-top:10px;padding:10px;">
                        <p>待审合同</p>
                        <h3 style="margin-top:7px">10</h3>
                    </div>
                    <div style="width: 124px;height:70px;background-color: #f5eeee;float:left;margin-top:10px;padding:10px;">
                        <p>待审授权</p>
                        <h3 style="margin-top:7px">10</h3>
                    </div>
                </div>
                <div style="width: 280px;height:200px;border:1px solid #cccccc;float:left;margin-right:20px;border-radius: 5px;margin-top:30px;padding:10px;">
                    <p style="color: #9b9b9b;">快捷方式</p>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;margin-right:15px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px;"></i>
                            <p>填辅料</p>
                        </a>
                    </div>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;margin-right:15px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px"></i>
                            <p>填授信</p>
                        </a>
                    </div>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px"></i>
                            <p>填合同</p>
                        </a>
                    </div>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;margin-right:15px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px"></i>
                            <p>填授权</p>
                        </a>
                    </div>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;margin-right:15px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px"></i>
                            <p>改密码</p>
                        </a>
                    </div>
                    <div style="width:75px;height:70px;background-color: #f5eeee;padding: 10px;float:left;margin-top:10px;">
                        <a href="#">
                            <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:10px"></i>
                            <p>订会议</p>
                        </a>
                    </div>
                </div>

                <div class="index_content_next">
                    <div  class="bd ggl" style="margin-right: 22px;">
                        <div class="ggl_title">
                            <p class="p1">公共文档</p>
                            <p class="p2"><a href="document.php">更多>></a></p>
                        </div>
                    
                        <div class="ggl_content">
                            <table class="table table-striped table-hover">
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
                                            <td><a href="file/<?=$fileName?>" style="color:#333">点击下载</a></td>
                                            <td><?=$createUser?></td>
                                            <td><?=$time?></td>
                                        </tr>
                                    
                                    <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>

                <div  class="bd ggl2">
                    <div class="ggl2_title">
                        <p class="p3">公告栏</p>
                        <p class="p4"><a href="allNews.php">更多>></a></p>
                    </div>

                    <table class="table table-striped table-hover">
                        <?php
                            $sqlstr="select * from news order by id desc limit 10";
                            $result=mysqli_query($conn,$sqlstr);
                        
                            while($myrow=mysqli_fetch_row($result)){
                                $id=$myrow[0];
                                $title=$myrow[1];
                                $time=$myrow[2];
                                $person=$myrow[3];
                                $content=$myrow[4];
                                ?>
                                <tr>
                                    <td><a href="news.php?id=<?=$id?>" style="color:#000000"><?=$title?></a></td>
                                </tr>
                                <?php
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $(".bd").hover(function(){
        $(".bd").css("box-shadow","0px 0px 0px #cccccc");
        $(this).css("box-shadow","2px 2px 2px #cccccc");
    })
</script>
