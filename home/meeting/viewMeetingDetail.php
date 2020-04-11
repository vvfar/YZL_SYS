<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_订会议室</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>
            
        <div style="width: 1660px;height:890px;margin-left: 240px;">
            
            <div style="margin-top:50px;margin-left:60px;">
                <?php
                    $id=$_GET["id"];

                    include_once("conn/conn.php");

                    $sqlstr1="select * from meeting where id='$id'";
                                            
                    $result=mysqli_query($conn,$sqlstr1);
                
                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $title=$myrow[1];
                        $department2=$myrow[2];
                        $dateTime=$myrow[3]." ".$myrow[4]."-".$myrow[5];
                        $room=$myrow[6];
                        $roomResource=$myrow[7];
                        $apply=$myrow[8];
                        $status=$myrow[9];
                        $people=$myrow[10];
                    }
                ?>


                <div id="app">
                    <h4 style="float:left">会议详情</h4>
                    <button class="btn btn-sm btn-danger" style="float:left;margin-left:200px;margin-top:5px;" id="delete">删除会议</button>

                    <div style="clear:both">
                        <hr>

                        <div style="margin-top: 30px;">
                            <div class="form-group">
                                <p style="float:left">会议标题：<?=$title?></p>
                            </div>
                            <div class="form-group" style="clear:both;position:relative;">
                                <p style="float:left;">会议日期：<?=$dateTime?></p>
                            </div>
                            <div class="form-group" style="clear:both;position:relative;">
                                <p style="float:left;">会议室编号：<?=$room?></p>

                            </div>
                            <div class="form-group" style="clear:both;position:relative;">
                                <p style="float: left;">会议室资源：<?=$roomResource?></p>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;">
                                <p style="float: left;">特殊需求：</p>
                                <p><?=$apply?></p>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;">
                                <p style="float: left;">申请人：<?=$people?></p>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;">
                                <p style="float: left;">申请部门：<?=$department2?></p>
                            </div>
                            <div class="form-group" style="clear: both;position:relative;">
                                <p style="float: left;">申请状态：<?=$status?></p>
                            </div>
                        </div>
                    </div>
                </div>
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

    $("#delete").click(function(){
        window.location.href="formHandle/delMeeting.php?id=<?=$id?>"
    })
</script>