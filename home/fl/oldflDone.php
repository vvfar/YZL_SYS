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
            <div style="clear: both;padding-bottom:20px;border-radius: 6px;">

                <div class="nav nav-pills" style="float: left;position:relative;top: 30px;left:50px;">
                    <?php
                        include_once("conn/conn.php");

                        $username=$_SESSION["username"];

                        $sqlstr1="select department,level from user_form where username='$username'";

                        $result=mysqli_query($conn,$sqlstr1);
                
                        while($myrow=mysqli_fetch_row($result)){
                            $department=$myrow[0];
                            $level=$myrow[1];
                        }
                    ?>
                
                
                    <p style="font-size:14px;float:left;margin-top:5px;">辅料单查询</p>

                    <select class="form-control" style="float: left;width:100px;margin-left:20px;" id="status">
                        <option>全部</option>
                        <option>已完成</option>
                        <option>未完成</option>
                    </select>

                    <select class="form-control" style="float: left;width:135px;margin-left:10px;" id="time1">
                        <option>流程开始时间</option>
                        <option>流程结束时间</option>
                    </select>

                    <div style="float: left;margin-left:10px;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" id="input_time" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    
                    <p style="float: left;position:relative;top:6px;margin-left:5px;"> 到 </p>

                    <div style="float: left;margin-left:10px;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" id="input_time2" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>

                    <input type="text" class="form-control" id="clientName" placeholder="请输入公司名称" style="width:190px;float: left;margin-left: 10px;">
                    <button class="btn btn-warning btn-sm" id="query_fl" style="float: left;margin-left:10px;">查询</button>
                    <button class="btn btn-success btn-sm" id="download_fl" style="float: left;margin-left:10px;">下载全部数据</button>
                    
                    <?php
                        if($department=="数据中心"){
                            ?>
                                <button class="btn btn-info btn-sm" id="upload_fl" style="float: left;margin-left:10px;" data-toggle="modal" data-target="#myModal2">上传旧单据</button>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>

            <!-- Excel导入模态框 -->
            <form method="POST" action="formHandle/uploadoldFLHandle.php" enctype="multipart/form-data">
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    批量上传旧辅料
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
                        </div>
                    </div>
                </div>
            </form>

            <div style="clear:both;">
                <?php
                    //分页代码
                    if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                        $page=1;
                    }else{
                        $page=intval($_GET["page"]);
                    }

                    $pagesize=15;

                    $sqlstr3="select count(*) as total from oldflsqd order by id desc";

                    $result=mysqli_query($conn,$sqlstr3);
                    $info=mysqli_fetch_array($result);
                    $total=$info['total'];

                    if($total%$pagesize==0){
                        $pagecount=intval($total/$pagesize);
                    }else{
                        $pagecount=ceil($total/$pagesize);
                    }
                ?>
                
                <div style="margin-top:40px">
                    <h4>
                        <span class="label label-info" style="margin-left:50px;position:relative;top:40px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;position:relative;top:40px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;position:relative;top:40px;">第<?=$page?>页</span>
                    </h4>
                </div>

                <table class="table table-responsive table-bordered table-hover td1" style="margin-bottom:0px;margin-top:55px;">
                    <tr>
                        <th>编号</th>
                        <th>公司</th>
                        <th>申请人</th>
                        <th>流程开始日期</th>
                        <th>流程结束日期</th>
                        <th>状态</th>
                    </tr>

                    <?php    
                        
                        $sqlstr2="select id,no,company,people,date,date2,status,allTime from oldflsqd order by date desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            ?>

                            <tr>
                                <?php
                                    $arr_status=explode(",",$myrow[6]);
                                    $status=array_pop($arr_status);

                                    $arr_allTime=explode(",",$myrow[7]);
                                    $allTime=array_pop($arr_allTime);

                                ?>
                                
                                <td><a href="oldflLine.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                                <td><?=$myrow[2]?></td>
                                <td><?=$myrow[3]?></td>
                                <td><?=$myrow[4]?></td>
                                <td><?=$allTime?></td>
                                <td><?=$status?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>

                <div style="margin-left: 50px;">
                    <ul class="pager" style="float:left;width:150px;">
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                            if($page>1)
                                echo $page-1;
                            else
                                echo 1;  
                        ?>">上一页</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                            if($page<$pagecount)
                                echo $page+1;
                            else
                                echo $pagecount;  
                        ?>">下一页</a></li>
                    </ul>

                    <div style="float:left;margin-left:830px;width:321px;">
                        <ul class="pagination" style="float:right">
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=1">&laquo;</a></li>
                            <?php
                                if($pagecount<=5){
                                    for($i=1;$i<=$pagecount;$i++){
                                        if($i==$page){
                                            ?>
                                                <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>"><?=$i?></a></li>
                                            <?php
                                        }else{
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>"><?=$i?></a></li>
                                            <?php
                                        }
                                    }
                                }else{
                                    for($i=1;$i<=$pagecount;$i++){
                                        if($i==$page){
                                            ?>
                                                <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>"><?=$i?></a></li>
                                            <?php
                                        }elseif($i>=$page-2 and $i<=$page+2 and $page>3){
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>"><?=$i?></a></li>
                                            <?php
                                        }elseif($i<=5){
                                            if($page<=3){
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>"><?=$i?></a></li>
                                            <?php
                                            }
                                        }
                                    }
                                }
                                
                            ?>
                            
                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    th{background-color:#409EFF;text-align: center;color:#ffffff}
    td{text-align: center;}
    .flList_div{width: 1660px;height:890px;margin-left: 240px;}
    .m1{float: left;margin-left:162px;margin-top: 35px;}
    .m2{float: left;margin-left:262px;margin-top: 35px;}
    .m3{float: left;margin-left:392px;margin-top: 35px;}
    .td1{width: 1300px;margin-top:52px;margin-left:50px;}
    .sbar{float:left;margin-top:35px;}
    .sbar2{float:left;margin-top:35px;margin-left:20px;}

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }
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