<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php")
            ?>
            <?php
                include_once("conn/conn.php");

                $sqlstr="select date from data_can_change where id=1";
                $result=mysqli_query($conn,$sqlstr);
        
                while($myrow=mysqli_fetch_row($result)){
                    $date=$myrow[0];
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                
            ?>
            <div style="margin-left: 50px;">
                <p style="font-size: 18px;">封存数据时间</p>
                <div style="width: 220px;font-size: 14px;float: left;margin-top: 10px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="date1" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <button style="float: left;margin-top:12px;margin-left:10px;" class="btn btn-success btn-sm" id="oneBtn">一键提交</button>
                
                <div style="clear: both">
                    <p style="margin-top: 65px;">上次数据封存时间：<?=$date?></p>
                    <p>注：之前的数据都将禁止修改,不包含选择的这一天</p>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $("#createUser").click(function(){
        window.location.href="manager_userLine.php"
    })

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

    $("#oneBtn").click(function(){
        date=$("#date1").val()
        
        window.location.href="formHandle/adminHandle/dataChangeDay.php?date="+date
    })
</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>