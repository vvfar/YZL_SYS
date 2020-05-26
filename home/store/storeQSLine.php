<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_用户管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px;">

            <ul class="breadcrumb" style="padding-left:30px;">
                <li><a href="dataStore.php">店铺信息</a></li>
                <li>每日数据</li>
            </ul>

            <?php
                
                $username=$_SESSION["username"];

                $sqlstr1="select department,newLevel from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $my_department=$myrow[0];
                    $newLevel=$myrow[1];
                }
                
                $id=$_GET['id'];
            
                $sqlstr="select a.storeID,a.client,a.storeName,b.question,b.status,b.answer from store a,store_qs b where b.id='$id'";
                $result=mysqli_query($conn,$sqlstr);
            
                while($myrow=mysqli_fetch_row($result)){
                    $storeID=$myrow[0];
                    $client=$myrow[1];
                    $storeName=$myrow[2];
                    $question=$myrow[3];
                    $status=$myrow[4];
                    $answer=$myrow[5];
                }
            ?>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-top:0px;margin-left:30px;">
                    <li role="presentation" class="active"><a href="#">店铺问题</a></li>
                </div>
            </div>

            <div style="padding-top: 10px;margin-left:30px;clear: both;">                
                
                <div class="form-group" style="clear: both;margin-bottom:0px;display:none">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺编号</p>
                    <input type="text" class="form-control" name="storeID" value="<?=$storeID?>" readOnly style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">公司名称</p>
                    <input type="text" class="form-control" name="client" value="<?=$client?>" readOnly  style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺名称</p>
                    <input type="text" class="form-control" name="storeName" value="<?=$storeName?>" readOnly style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺问题</p>
                    <p style="width: 200px;float: left;margin-top: 20px;"><?=$question?></p>
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">问题回复</p>
                    <p style="width: 200px;float: left;margin-top: 20px;"><?=$answer?></p>
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">问题状态</p>
                    <p style="width: 200px;float: left;margin-top: 20px;"><?=$status?></p>
                </div>

                <?php
                    if($newLevel == "M"){
                        ?>
                            <div class="form-group" style="clear: both;margin-bottom:0px;">
                                <button class="btn btn-sm btn-info" style="margin-top: 20px;"  data-toggle="modal" data-target="#myModal">记录问题</button>
                            </div>
                        <?php
                    }
                ?>
                
            </div>
        </div>

        <!-- Excel导入模态框 -->
        <form method="POST" action="../../controller/store/storeAnswer.php" enctype="multipart/form-data">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                处理店铺问题
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 270px;">
                            <input style="display:none" type="text" name="id" value="<?=$id?>"/>
                            <p>店铺问题</p>
                            <p style="margin-top:10px;"><?=$question?>
                            <p style="margin-top:10px;">解决方案</p>
                            <textarea class="form-control" cols="5" rows="5" name="answer" style="margin-top:10px;"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">提交</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<style>
    
</style>

<script>
    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        autoclose: true,
        todayBtn: true,
        startView: 2,  
        minView: 2, 
        forceParse: false,
        language:'cn',
        pickerPosition: "bottom-left"
    });
</script>