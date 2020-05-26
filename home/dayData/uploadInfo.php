<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据统计</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="css/header.css?v=2" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <!-- [if lt IE 9]>
            <script src="flotr2/excanvas.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?> 

        <div style="background-color: rgb(243, 243, 243);width: 1660px;height:890px;margin-left: 240px;">

            <div class="nav nav-pills" style="float:left;margin-left:30px;position:relative;top:20px;">
                <li role="presentation"><a href="data.php">当月数据图表</a></li>
                <li role="presentation"><a href="form.php">查看详细数据</a></li>
                <li role="presentation" class="active"><a href="uploadInfo.php">提交日常数据</a></li>
            </div>
            <div class="table" style="clear:both;width: 1300px;float:left;margin-left:30px;">

                <div style="float: right;margin-bottom: 10px;">
                    <span><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Excel导入</button></span>
                    <span><button type="button" class="btn btn-default"  onclick="addText()">添加行</button></span>
                    <span><button type="submit" class="btn btn-default">提交</button></span>
                </div>

                <!-- Excel导入模态框 -->
                <form method="POST" action="formHandle/uploadInfoHandle.php" enctype="multipart/form-data">
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        上传Excel文件
                                    </h4>
                                </div>
                                
                                    <div class="modal-body" style="height: 150px;">
                                        <input type="file" name="excel"/>
                                        <div style="clear: both;position: relative;top:20px;width:300px;">
                                            <p>温馨提示：文件必须为EXCEL格式，请按模板文件格式进行上传，文件大小需小于2M</p>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="submit" class="btn btn-primary">导入表格</button>
                                    </div>
                                
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>
                </form>
                <table class="table table-striped table-hover" style="clear: both;margin-top:20px;border-collapse:unset" id="data_tr">
                    <tr>
                        <th>店铺编号</th>
                        <th>销售额</th>
                        <th>销量</th>
                        <th>领标套数</th>
                        <th>服务费</th>
                        <th>服务费回款</th>
                        <th>服务费授信</th>
                        <th>辅料费</th>
                        <th>辅料费回款</th>
                        <th>辅料费授信</th>
                    </tr>

                </table>
            </div>
        </div>
    </body>
</html>

<script>
    function addText(){
        var element=document.getElementsByTagName('table')[0]
        element.innerHTML=element.innerHTML + "<tr style='border-top:0px'><td><input type='text' name='a' style='width: 70px;'/>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td>" +
            "</td><td><input type='text' name='a' style='width: 70px;'/></td></tr>"
    }


</script>