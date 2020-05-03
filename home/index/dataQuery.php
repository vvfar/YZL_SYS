<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_我的工作</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css\leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css\header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <div class="chooseInfo" style="margin-left:30px;margin-top:30px;">
                <p>筛选条件</p>
                <select>
                    <option>销售额</option>
                    <option>回款</option>
                </select>
                <p>部门</p>
                <select>
                    <option>全部</option>
                    <option>内衣（京东）事业管理部</option>
                </select>
                <p>类目</p>
                <select>
                    <option>全部</option>
                    <option>内衣</option>
                </select>
                <p>业务员</p>
                <select>
                    <option>全部</option>
                    <option>欧阳雅香</option>
                </select>
                <p>店铺</p>
                <select>
                    <option>全部</option>
                    <option>test01</option>
                </select>
                <p>时间段</p>
                <select>
                    <option>全部</option>
                    <option>日</option>
                    <option>周</option>
                    <option>月</option>
                    <option>年</option>
                </select>
                <p>同环比</p>
                <select>
                    <option>默认</option>
                    <option>同比</option>
                    <option>环比</option>
                </select>
                <button style="margin-left:10px;font-size:12px;padding:2px;">导出数据</button>
            </div>
            <div style="margin-left:20px;">
                <div class="data_div">
                    <p class="title">销售额</p>
                </div>

                <div class="data_div">
                    <p class="title">完成比</p>
                </div>

                <div class="data_div">
                    <p class="title">业绩排名</p>
                </div>
            </div>
            
            <div style="clear:both;margin-left:20px;">
                <div class="data_div_large">
                    <p class="title">图表</p>
                </div>
                <div class="data_div">
                    <p class="title">新开拓店铺</p>
                </div>
                <div class="data_div">
                    <p class="title">终止合作店铺</p>
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
    }

    .data_div{width: 323px;height:160px;border:1px solid #d9d9d9;float:left;margin-left:20px;border-radius: 5px;margin-top:20px;padding-left:10px;padding-top:10px;}
    .data_div_large{width: 666px;height:340px;border:1px solid #d9d9d9;float:left;margin-left:20px;border-radius: 5px;margin-top:20px;padding-left:10px;padding-top:10px;}