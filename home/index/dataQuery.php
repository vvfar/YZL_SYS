<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_我的工作</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css\leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css\header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\echarts\dist\echarts.min.js"></script>
        <script src="..\..\public\js\dataQuery.js?v=1"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:60px">
            <div class="chooseInfo" style="margin-left:30px;margin-top:30px;">
                <p>筛选条件</p>
                <select id ="chooseOne" onchange="initData()">
                    <option>销售额</option>
                    <option>回款</option>
                </select>
                <p>部门</p>
                <select id ="chooseTwo"  onchange="initData($(this).val(),1)"></select>
                <p>平台</p>
                <select id ="chooseThree" onchange="initData($(this).val(),2)"></select>
                <p>类目</p>
                <select id ="chooseFour" onchange="initData($(this).val(),3)"></select>
                <p>店铺</p>
                <select id ="chooseFive" onchange="initData($(this).val(),4)"></select>
                <p>业务员</p>
                <select id ="chooseSix" onchange="initData($(this).val(),5)"></select>
                <p>时间段</p>
                <select style="width:40px;" id ="chooseSeven" onchange="initData($(this).val(),6)"></select>
                <select style="width:113px;" id="chooseEight" onchange="initData($(this).val(),7)"></select>
            </div>
            <div style="margin-left:20px;clear:both">
                <div class="data_div">
                    
                    <p class="title" id="title"></p>
                    <button id="mytime" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                    
                    <div style="clear:both">
                        <hr style="margin-top:30px">
                    </div>

                    <div style="margin-top:20px">
                        <h1 id="num"></h1>
                    </div>

                    <div style="margin-top:20px">
                        <p class="title">同比:<span id="tb"></span>%</p>
                        <p class="title" style="margin-left:10px;">环比:<span id="hb"></span>%</p>
                    </div>
                </div>

                <div class="data_div">
                    <p class="title" id="title2">完成比</p>
                    <button id="mytime2" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                    
                    <div style="clear:both">
                        <hr style="margin-top:30px">
                    </div>

                    <div style="margin-top:20px">
                        <h1 id="num2"></h1>
                    </div>

                    <div style="margin-top:20px">
                        <p class="title">同比:<span id="tb2"></span>%</p>
                        <p class="title" style="margin-left:10px;">环比:<span id="hb2"></span>%</p>
                    </div>
                </div>

                <div class="data_div">
                    <p class="title" id="title3"></p>
                    <button id="mytime3" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                    
                    <div style="clear:both">
                        <hr style="margin-top:30px">
                    </div>

                    <ul id="rank" style="float:left;margin-top:-5px;">
                        
                    </ul>

                    <ul id="number" style="float:left;margin-left:20px;margin-top:-5px;">
                        
                    </ul>
                </div>
            </div>
            
            <div style="clear:both;margin-left:20px;">
                <div class="data_div_large">
                    <p class="title" id="title4"></p>
                    <button id="btn04" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                    
                    <div style="clear:both">
                        <hr style="margin-top:30px">
                    </div>

                    <div id="data_body" style="clear:both;width:100%;height:320px;top:-10px;margin-left:-5px;">
                    
                    </div>

                </div>

                <div style="width:280px;float:left">
                    <div class="data_div">
                        <p class="title" id="title5"></p>
                        <button id="mytime5" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                        
                        <div style="clear:both">
                            <hr style="margin-top:30px">
                        </div>

                        <div style="margin-top:20px">
                            <h1 id="num5"></h1>
                        </div>

                        <div style="margin-top:20px">
                            <p class="title">同比:<span id="tb5"></span>%</p>
                            <p class="title" style="margin-left:10px;">环比:<span id="hb5"></span>%</p>
                        </div>
                    </div>
                    <div class="data_div">
                        <p class="title" id="title6"></p>
                        <button id="mytime6" class="layui-btn layui-btn-normal  layui-btn-xs" style="float:right;padding:0px 6px 0px 6px;height:20px" disabled></button>
                        
                        <div style="clear:both">
                            <hr style="margin-top:30px">
                        </div>

                        <div style="margin-top:20px">
                            <h1 id="num6"></h1>
                        </div>

                        <div style="margin-top:20px">
                            <p class="title">同比:<span id="tb6"></span>%</p>
                            <p class="title" style="margin-left:10px;">环比:<span id="hb6"></span>%</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</html>
    
<style>
    .chooseInfo p{
        float:left;
        margin-left:10px;
        position:relative;
        top:3px;
    }

    .chooseInfo select{
        float:left;
        margin-left:10px;
        height:24px;
        width:77px;
    }

    .data_div{width: 323px;height:160px;border:1px solid #d9d9d9;float:left;margin-left:20px;border-radius: 5px;margin-top:20px;padding-left:10px;padding:10px;}
    .data_div_large{width: 666px;height:340px;border:1px solid #d9d9d9;float:left;margin-left:20px;border-radius: 5px;margin-top:20px;padding:10px;}
    .title{color: #9b9b9b;float:left}

    ul li{
        margin-top:2px
    }

    
</style>

