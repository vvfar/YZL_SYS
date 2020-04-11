<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_辅料申请</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-theme.css" rel="stylesheet" media="screen"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div class="flList_div">
            <div style="clear: both;padding-bottom:20px;border-radius: 6px;position:relative;top:30px;">
                <div class="nav nav-pills" style="float: left;margin-top: 30px;margin-left:50px;">
                    <?php
                        include_once("conn/conn.php");

                        $username=$_SESSION["username"];
                        $status2=$_GET['status'];
                        $time=$_GET['time'];
                        $input_time=$_GET['input_time'];
                        $input_time2=$_GET['input_time2'];
                        $clientName=$_GET['clientName'];

                        $sqlstr1="select department,level from user_form where username='$username'";

                        $result=mysqli_query($conn,$sqlstr1);
                
                        while($myrow=mysqli_fetch_row($result)){
                            $department=$myrow[0];
                            $level=$myrow[1];
                        }
                    ?>
                </div>
                
                <p style="font-size:14px;float:left;margin-top:5px;">辅料单查询</p>

                <select class="form-control" style="float: left;width:100px;margin-left:20px;" id="status">
                    <?php
                        if($status2=="全部"){
                        ?>
                            <option selected="selected">全部</option>
                            <option>已完成</option>
                            <option>未完成</option>
                        <?php
                        }elseif($status2=="已完成"){
                        ?>
                            <option>全部</option>
                            <option selected="selected">已完成</option>
                            <option>未完成</option>
                        <?php
                        }else{
                        ?>
                            <option>全部</option>
                            <option>已完成</option>
                            <option selected="selected">未完成</option>
                        <?php
                        }
                    ?>
                </select>

                <select class="form-control" style="float: left;width:135px;margin-left:10px;" id="time1">
                    <?php
                        if($time=="流程开始时间"){
                        ?>
                            <option selected="selected">流程开始时间</option>
                            <option>流程结束时间</option>
                        <?php
                        }else{
                        ?>
                            <option>流程开始时间</option>
                            <option selected="selected">流程结束时间</option>
                        <?php
                        }
                    ?>
                </select>

                <div style="float: left;margin-left:10px;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="input_time" size="16" type="text" value="<?=$input_time?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>

                <p style="float: left;position:relative;top:6px;margin-left:5px;"> 到 </p>

                <div style="float: left;margin-left:10px;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="input_time2" size="16" type="text" value="<?=$input_time2?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>

                <input type="text" class="form-control" id="clientName" placeholder="请输入公司名称" style="width:200px;float: left;margin-left: 10px;" value="<?=$clientName?>">
                <button class="btn btn-warning btn-sm" id="query_fl" style="float: left;margin-left:10px;">查询</button>
                <button class="btn btn-success btn-sm" id="download_fl" style="float: left;margin-left:10px;">下载全部数据</button>
            </div>
            <div style="clear:both;">
            <?php
                $strq="";

                if($input_time != ""){
                    $input_time_full=$input_time." 00:00:00";

                    if($time=="流程开始时间"){
                        $strq=$strq." and date >='$input_time_full' ";
                    }elseif($time=="流程结束时间"){
                        $strq=$strq." and date2 >='$input_time_full' ";
                    }
                }

                if($input_time2 != ""){
                    $input_time2_full=$input_time2." 23:59:59";

                    if($time=="流程开始时间"){
                        $strq=$strq." and date <='$input_time2_full' ";
                    }elseif($time=="流程结束时间"){
                        $strq=$strq." and date2 <='$input_time2_full' ";
                    }
                }

                if($clientName != ""){
                    $strq=$strq." and company like '%$clientName%' ";
                }

                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;

                if($status2 == "全部"){
                    $sqlstr3="select count(*) as total from oldflsqd where 1=1  ".$strq." order by id desc";
                }elseif($status2 == "已完成"){
                    $sqlstr3="select count(*) as total from oldflsqd where  status like '%品牌部归档%' ".$strq." order by id desc";
                }else{
                    $sqlstr3="select count(*) as total from oldflsqd where not status like '%品牌部归档%' ".$strq." order by id desc";
                } 

                $result=mysqli_query($conn,$sqlstr3);
                $info=mysqli_fetch_array($result);
                $total=$info['total'];

                if($total%$pagesize==0){
                    $pagecount=intval($total/$pagesize);
                }else{
                    $pagecount=ceil($total/$pagesize);
                }

                if($status2 == "全部"){
                    $sqlstr2="select id,no,company,people,date,date2,status,shr from oldflsqd where  1=1 ".$strq." order by id desc limit ".($page-1)*$pagesize.",$pagesize";
                }elseif($status2 == "已完成"){
                    $sqlstr2="select id,no,company,people,date,date2,status,shr from oldflsqd where status like '%品牌部归档%' ".$strq." order by id desc limit ".($page-1)*$pagesize.",$pagesize";
                }else{
                    $sqlstr2="select id,no,company,people,date,date2,status,shr from oldflsqd where not status like '%品牌部归档%' ".$strq." order by id desc limit ".($page-1)*$pagesize.",$pagesize";
                }

            ?>

            <h4>
                <span class="label label-info" style="margin-left:50px;position:relative;top:40px;">共<?=$total?>条</span>
                <span class="label label-warning" style="margin-left:5px;position:relative;top:40px;">共<?=$pagecount?>页</span>
                <span class="label label-success" style="margin-left:5px;position:relative;top:40px;">第<?=$page?>页</span>
            </h4>

            <table class="table table-responsive table-bordered table-hover td1" style="margin-bottom:0px;">
                <tr>
                    <th>编号</th>
                    <th>公司</th>
                    <th>申请人</th>
                    <th>流程开始日期</th>
                    <th>流程结束日期</th>
                    <th>状态</th>
                </tr>
            
                <?php

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        ?>

                        <tr>
                            <?php
                                $arr_status=explode(",",$myrow[6]);
                                $status=array_pop($arr_status);

                                $arr_shr=explode(",",$myrow[7]);
                                $shr=array_pop($arr_shr);

                                ?>
                                <td><a href="oldflLine.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                                <?php
                            ?>
                            
                            <td><?=$myrow[2]?></td>
                            <td><?=$myrow[3]?></td>
                            <td><?=$myrow[4]?></td>
                            <td><?=$myrow[5]?></td>
                            <td><?=$status?></td>
                        </tr>
                        <?php
                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>
            </table>

            <div style="margin-left: 50px;position:relative;top:45px;">
                <ul class="pager" style="float:left;width:150px;">
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page>1)
                            echo $page-1;
                        else
                            echo 1;  
                    ?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:830px;width:321px;">
                        <ul class="pagination" style="float:right">
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=1&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>">&laquo;</a></li>
                            <?php
                                if($pagecount<=5){
                                    for($i=1;$i<=$pagecount;$i++){
                                        if($i==$page){
                                            ?>
                                                <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                        }else{
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                        }
                                    }
                                }else{
                                    for($i=1;$i<=$pagecount;$i++){
                                        if($i==$page){
                                            ?>
                                                <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                        }elseif(($i>=$page-2 and $i<=$page+2 and $page>3) and $page !=$pagecount){
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                        }elseif($i<=5){
                                            if($page<=3){
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                            }
                                        }
                                    }
                                }
                                
                            ?>
                            
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>">&raquo;</a></li>
                        </ul>
                    </div>
                
            </div>
        </div>
    </body>
</html>

<style>

    th{background-color:lemonchiffon;text-align: center;}
    td{text-align: center;}
    .flList_div{width: 1660px;height:890px;margin-left: 240px;}
    .m1{float: left;margin-left:162px;margin-top: 35px;}
    .m2{float: left;margin-left:262px;margin-top: 35px;}
    .m3{float: left;margin-left:392px;margin-top: 35px;}
    .td1{width: 1300px;position:relative;top:45px;margin-left:50px;}

</style>

<script>
    $("#download_fl").click(function(){
        
        window.location.href="fl_file/旧OA历史数据汇总.xlsx"

    })

    $("#query_fl").click(function(){
        status=$("#status").val()
        time1=$("#time1").val()
        input_time=$("#input_time").val()
        input_time2=$("#input_time2").val()
        clientName=$("#clientName").val()

        if(input_time==""){
            alert("请选择日期！")
        }else{
            window.location.href="oldflListQuery.php?status=" + status + "&time=" + time1 + "&input_time=" + input_time + "&input_time2=" + input_time2 + "&clientName=" +clientName
        }
    })

    $("#query_all").click(function(){
        window.location.href="flList.php"
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
</script>


