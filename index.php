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
                <p class="jrrw">今日任务111</p>
                <div class="myrw">
                    <p class="myrw1">我的今日任务</p>
                    <p class="myrw2">完成60%</p>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                    aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% 完成</span>
                    </div>
                </div>
                        

                <div class="bd">
                    <p style="margin-top: 20px;margin-left:20px;">我的消息</p>

                    <div class="chart1">
                        <canvas id="chartjs-4" class=""></canvas>
                    </div>
                    <script>
                        new Chart(document.getElementById("chartjs-4"),{
                            "type":"doughnut",
                            "data":{
                                "labels":["未读消息","已读消息"],
                                "datasets":[{
                                    "label":"My First Dataset",
                                    "data":[10,50],
                                    "backgroundColor":["rgb(255, 205, 86)","rgb(54, 162, 235)"]
                                    }]
                                }
                            });
                    </script>

                </div>

                <div class="bd">
                    <p style="margin-top: 20px;margin-left:20px;">应收帐目提醒</p>
                    <div class="chart2">
                        <canvas id="chartjs-1" class="chartjs" width="250px" height="200px"></canvas>
                        <script>new Chart(document.getElementById("chartjs-1"),{
                            "type":"bar","data":{
                                "labels":["本月","今日","逾期"],
                                "datasets":[{
                                    "label":"本月应收账款",
                                    "data":[1000,30,200],
                                    "fill":false,
                                    "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)"],
                                    "borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)"],"borderWidth":1}]},
                                    "options":{
                                        "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
                                        }
                                    });
                        </script>
                    </div>
                
                </div>

                <div class="bd">
                    <p style="margin-top: 20px;margin-left:20px;">辅料申请处理概况</p>
                    <div class="chart3">
                        <canvas id="chartjs-5" class=""></canvas>
                    </div>
                    <script>
                        new Chart(document.getElementById("chartjs-5"),{
                            "type":"pie",
                            "data":{
                                "labels":["审批","发货","完成"],
                                "datasets":[{
                                    "label":"My First Dataset",
                                    "data":[10,50,80],
                                    "backgroundColor":["rgb(255, 99, 132)","rgb(255, 205, 86)","rgb(54, 162, 235)"]
                                    }]
                                }
                            });
                    </script>
                </div>

                <div class="bd">
                    <p class="todaydata">今日数据提交</p>
                    <div class="wc">
                        <p>日常数据提交完成比：<span class="span1">80%</span></p>
                        <p>日常数据提交：<span class="span2">50</span></p>
                        <p>公司授信提交：<span class="span3">50</span></p>
                        <p>辅料申请提交：<span class="span4">50</span></p>
                    </div>
                </div>
            </div>

            <div class="index_content_next">
                <div  class="bd ggl">
                    <div class="ggl_title">
                        <p class="p1">公共文档</p>
                        <p class="p2"><a href="document.php">更多>></a></p>
                    </div>
                    
                    <div class="ggl_content">
                        <table class="table table-striped table-hover">
                            <tr class="tr_head" style="background-color:royalblue;">
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
