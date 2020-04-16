<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_订会议室</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>
            
        <div style="margin-left: 180px;">
            
            <div style="margin-top:20px;margin-left:30px;">
                <?php
                    if(isset($_GET["room"])){
                        $room=$_GET["room"];
                    }else{
                        $room="";
                    }
                ?>

                <form method="POST" action="../../controller/meeting/meetingHandle.php">
                    <div id="app">
                        <h4>填写会议申请</h4>
                        <hr>

                        <div style="margin-top: 15px;">
                            <div class="form-group">
                                <p style="float:left">会议标题</p><input class="form-control" name="title" style="width:600px;padding-left:5px;float:left;margin-left:35px;"/>
                            </div>
                            <div class="form-group" style="clear:both;position:relative;top:20px">
                                <p style="float:left;">会议日期</p>
                                
                                <div style="float:left;width:200px;padding-left:5px;margin-left:30px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" id="dateTime" name="dateTime" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                
                                <p style="float:left;margin-left:30px;">开始时间</p>
                                
                                <select class="form-control" style="float:left;width:97px;margin-left:20px;padding-left:5px;" name="startTime">
                                    <option></option>
                                    <?php
                                        for($i=8;$i<=23;$i++){
                                            ?>
                                                <option><?=$i?>:00</option>
                                                <option><?=$i?>:30</option>
                                            <?php

                                        }
                                    ?>
                                </select>

                                <p style="float:left;margin-left:30px;">结束时间</p>
                                <select class="form-control" style="float:left;width:97px;margin-left:20px;padding-left:5px;" name="endTime">
                                    <option></option>
                                    <?php
                                        for($i=8;$i<=23;$i++){
                                            ?>
                                                <option><?=$i?>:00</option>
                                                <option><?=$i?>:30</option>
                                            <?php

                                        }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group" style="clear:both;position:relative;top:40px">
                                <?php
                                    if($room !=""){
                                        ?>
                                            <p style="float:left;">会议室编号</p><input class="form-control" name="chooseRoom" style="float:left;width:50px;margin-left:20px;padding-left:5px;text-align:center" value='<?=$room?>' readonly/>
                                        <?php
                                    }else{
                                        ?>
                                            <p style="float:left;">会议室编号</p>
                                            
                                            <select class="form-control"  name="chooseRoom" style="float:left;width:50px;margin-left:20px;padding-left:5px;text-align:center" >
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="form-group" style="clear:both;position:relative;top:60px">
                                <p style="float: left;">会议室资源</p>

                                <div style="float: left;margin-left: 20px;">
                                    <input type="checkbox" name="roomResource[]" id="computer" value="电脑" style="position: relative;top:2px;margin-left: 0px;"/><label for="computer" style="margin-left: 5px;">笔记本电脑</label>
                                    <input type="checkbox" name="roomResource[]" id="pancel" value="激光笔" style="position: relative;top:2px;margin-left: 20px;"/><label for="pancel" style="margin-left: 5px;">激光笔</label>
                                </div>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;top:80px;">
                                <p style="float: left;">特殊需求</p>
                                <textarea name="apply" class="form-control" style="float: left;margin-left:33px;width:600px;height:150px;"></textarea>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;top:100px;">
                                <p style="float: left;">申请部门</p>
                                
                                <input class="form-control" name="department" style="width:250px;padding-left:5px;float:left;margin-left:30px;"/>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;top:120px;">
                                <p style="float: left;">申请人</p>
                                
                                <input class="form-control" name="people" style="width:150px;padding-left:5px;float:left;margin-left:45px;"/>
                            </div>

                            <div  class="form-group" style="clear: both;position:relative;top:140px;">
                                <button class="btn btn-success">提交申请</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>       
        </div>
    </body>
</html>


<style>
    p{
        position:relative;
        top:5px;
    }

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