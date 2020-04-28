<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_我的工作</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\css\myWork.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\echarts\dist\echarts.min.js"></script>
        <script src="..\..\public\js\myWork.js"></script>
    </head>
    <body>
        <?php 
            include_once("../../common/conn/conn.php");
            include '../base/header.php';
            include '../base/leftBar.php';
        ?>

        <div class="container1">
            <div class="willDo">
                <p class="title">代办事项</p>
                <div id="willDo_ajax">
                    
                </div>
            </div>

            <div class="fastDo">
                <p class="title">快捷方式</p>
                <div>
                    <a href="../../home/fl/flsq.php" target="_blank">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填辅料</p>
                    </a>
                </div>
                <div>
                    <a href="../../home/sx/writeSX.php" target="_blank">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填授信</p>
                    </a>
                </div>
                <div>
                    <a href="../../home/contract/contract.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填合同</p>
                    </a>
                </div>
                <div>
                    <a href="../../home/contract/newSQ.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">填授权</p>
                    </a>
                </div>
                <div>
                    <a href="../../home/center/center.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">改密码</p>
                    </a>
                </div>
                <div>
                    <a href="../../home/meeting/viewMeeting.php">
                        <i class="layui-icon layui-icon-form"></i>
                        <p style="text-align: center;">订会议</p>
                    </a>
                </div>
            </div>

            <div class="template">
                <p class="title">操作模板</p>
                <div>
                    <a href="#">
                        <i class="layui-icon layui-icon-form" style="font-size:30px;margin-left:13px;"></i>
                        <p style="text-align: center;">合同</p>
                    </a>
                </div>
            </div>

            <div class="data_line">
                <p class="title">数据图表（销售）</p>
                <div id="data_body" style="width:100%;height:350px;margin-top:-5px;margin-left:-5px;">
                    
                </div>
            </div>

            <div class="sales">
                <p class="title">销售数据</p>
                <div>
                    <p class="title" style="margin-top:20px;font-size:18px;float:left" id="sales_one">0%</p>
                    <p class="title" style="margin-top:20px;font-size:12px;float:right">个人销售目标</p>
                </div>
                
                <div id="data_sales" style="width:100%;height:20px;clear:both">
                    <div class="layui-progress" style="margin-top:45px;">
                        <div id="sales_one_bar" class="layui-progress-bar" lay-percent="0%"></div>
                    </div>
                </div>
                <div>
                    <p class="title" style="font-size:18px;float:left" id="sales_two">0%</p>
                    <p class="title" style="font-size:12px;float:right">部门销售目标</p>
                </div>
                <div id="data_sales" style="width:100%;height:20px;clear:both">
                    <div class="layui-progress" style="margin-top:25px;">
                        <div id="sales_two_bar" class="layui-progress-bar" lay-percent="0%"></div>
                    </div>
                </div>
            </div>

            <div class="backMoney">
                <p class="title">回款数据</p>
                <div>
                    <p class="title" style="margin-top:20px;font-size:18px;float:left" id="sales_three">0%</p>
                    <p class="title" style="margin-top:20px;font-size:12px;float:right">个人回款目标</p>
                </div>
                <div id="data_sales" style="width:100%;height:20px;clear:both">
                    <div class="layui-progress" style="margin-top:45px;">
                        <div id="sales_three_bar" class="layui-progress-bar" lay-percent="0%"></div>
                    </div>
                </div>
                <div>
                    <p class="title" style="font-size:18px;float:left" id="sales_four">0%</p>
                    <p class="title" style="font-size:12px;float:right">部门回款目标</p>
                </div>
                <div id="data_sales" style="width:100%;height:20px;clear:both">
                    <div class="layui-progress" style="margin-top:25px;">
                        <div id="sales_four_bar" class="layui-progress-bar" lay-percent="0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>