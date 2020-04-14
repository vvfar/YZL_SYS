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
        <link href="..\..\public\css\leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css\header.css" rel="stylesheet"/>
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
            
            <div style="margin-top:20px;margin-left:50px;">
                <div>
                    <h4 style="float:left">会议室概况</h4>
                    
                    <?php
                        if(!isset($_GET["date"])){
                            date_default_timezone_set("Asia/Shanghai");
                            $date=date('Y-m-d', time());
                        }else{
                            $date=$_GET["date"];
                        }
                    ?>

                    <div style="float:left;margin-left:650px">
                        <p style="float: left;position:relative;top:7px;">选择日期</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-left:20px" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="dateTime" name="dateTime" size="16" type="text" value="<?=$date?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>


                <div style="clear:both">

                    <?php

                        for($i=0;$i<5;$i++){
                    ?>
                    
                    <div style="width:305px;height:250px;float:left;margin-right:30px;margin-top:20px" class="meetingBorder">
                        <span class="label label-success" style="position:relative;top:10px;left:10px;padding-top:5px;">会议室<?=chr($i+65)?></span>
             
             
             
                        <p style="float:right;margin-top:10px;margin-right:10px;">当前状态：空闲</p>
                        
                        <div style="clear:both">
                            <p style="float:right;margin-right:10px;margin-top:5px;">更多>></p>
                        </div>

                        <div style="margin-top:15px;" class="meetingUL">
                            <div style="height:160px;">
                                <table class="table" style="width:275px;margin-left:20px;margin-top:30px;">
                                    <tr>
                                        <th style="width:100px">时间</th>
                                        <th style="width:100px">主题</th>
                                        <th style="width:100px">申请人</th>
                                    <tr>

                                    <?php
                                        
                                        

                                                    
                                        $sqlstr1="select * from meeting where room='$i'+1 and date='$date' and status='已审核' limit 0,5";
                                            
                                        $result=mysqli_query($conn,$sqlstr1);
                            

                                        while($myrow=mysqli_fetch_row($result)){
                                            
                                            ?>
                                                <tr>
                                                    <td><p><?=$myrow[4]?>-<?=$myrow[5]?></p></td>
                                                    <td><p><a href="viewMeetingDetail.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></p></td>
                                                    <td><p><?=$myrow[10]?></p></td>
                                                <tr>
                                            <?php
                                        }
                                         
                                    ?>
                                </table>
                            </div>

                            <a href="/apcMeeting.php?room=<?=$i+1?>" style="float:right;margin-right:10px;color:brown;margin-bottom:20px">新增会议</a>
                        </div>
                    </div>

                    <?php
                        }
                    ?>

                </div>
                
            </div>
        </div>
    </body>
</html>

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

    $(".date").change(function(){
        date=$("#dateTime").val();

        window.location.href="/viewMeeting.php?date="+date;
    })
</script>

<style>
    .meetingBorder{
        border:1px solid #cccccc;
    }

    .meetingBorder:hover{
        border:1px solid orange;
    }

    .meetingUL ul li a{
        color:#000000;
    }

    .meetingUL ul li a:hover{
        color:blue;
    }

    a{
        color:#000;
    }

    .meetingUL p{
        padding:0;
        margin:0;
        width: 90px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
    }
</style>