<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=0.5">
        <title>俞兆林_辅料申请</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="../../public/css\leftbar.css" rel="stylesheet"/>
        <link href="../../public/css\header.css" rel="stylesheet"/>
        <link href="../../public/css\flList.css" rel="stylesheet"/>
        <script src="../../public/lib\flotr2\flotr2.min.js"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="../../public/js\flList.js"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../../home/base/header.php' ?>
        <?php include '../../home/base/leftBar.php' ?>

        <?php
            //获取url参数
            if(isset($_GET['status'])){
                $status2=$_GET['status'];
            }else{
                $status2="";
            }

            if(isset($_GET['time'])){
                $time=$_GET['time'];
            }else{
                $time="";
            }

            if(isset($_GET['input_time'])){
                $input_time=$_GET['input_time'];
            }else{
                $input_time="";
            }

            if(isset($_GET['input_time2'])){
                $input_time2=$_GET['input_time2'];
            }else{
                $input_time2="";
            }

            if(isset($_GET['clientName'])){
                $clientName=$_GET['clientName'];
            }else{
                $clientName="";
            }


            //获取部门和层级
            $username=$_SESSION["username"];

            $sqlstr1="select department,newLevel from user_form where username='$username'";

            $result=mysqli_query($conn,$sqlstr1);
    
            while($myrow=mysqli_fetch_row($result)){
                $department=$myrow[0];
                $newLevel=$myrow[1];
            }

            //分页代码
            if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                $page=1;
            }else{
                $page=intval($_GET["page"]);
            }

            $pagesize=15;

            $sqlstr3="select count(*) as total from flsqd where (not status like '%已归档单据%' and not status like '%品牌部归档%') and not status like '%作废%' and (not status='KA级提交单据' and not shr='$username')";

            if($newLevel !="ADMIN"){
                $sqlstr3=$sqlstr3." and (shr like '%$username%' or ywy like '%$username%')";
            }

            if($input_time !=""){
                $input_time_full=$input_time." 00:00:00";

                $sqlstr3=$sqlstr3." and date >='$input_time_full' ";
            }

            if($input_time2 != ""){
                $input_time2_full=$input_time2." 23:59:59";

                $sqlstr3=$sqlstr3." and date <='$input_time2_full' ";
            }

            if($clientName != ""){
                $sqlstr3=$sqlstr3." and company like '%$clientName%' ";
            }


            $result=mysqli_query($conn,$sqlstr3);

            $info=mysqli_fetch_array($result);
            
            $total=$info['total'];

            if($total%$pagesize==0){
                $pagecount=intval($total/$pagesize);
            }else{
                $pagecount=ceil($total/$pagesize);
            }

            $count=0;
        ?>

        <div class="flList_div" style="margin-top:50px;">
            <div class="search_bar">
                <p class="search_bar_p1">辅料单查询</p>

                <select class="form-control search_bar_s1" id="status">
                    <option>未完成</option>
                </select>

                <select class="form-control search_bar_s2" id="time1">
                    <option>流程开始时间</option>
                </select>

                <div class="input-group date form_datetime search_bar_t" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="input_time" size="16" type="text" value="<?=$input_time?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                
                <p class="search_bar_p2"> 到 </p>

                <div class="search_bar_t input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="input_time2" size="16" type="text" value="<?=$input_time2?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>

                <input type="text" class="form-control company_name" id="clientName" placeholder="请输入公司名称" value="<?=$clientName?>">
                
                <button class="btn btn-warning btn-sm search_bar_btn" id="query_fl">查询</button>
                <button class="btn btn-success btn-sm search_bar_btn" id="download_fl">下载</button>
            </div>
            
            
            <div class="clearfix">
                <div class="fy_span clearfix">
                    <h4>
                        <span class="label label-info">共<?=$total?>条</span>
                        <span class="label label-warning">共<?=$pagecount?>页</span>
                        <span class="label label-success">第<?=$page?>页</span>
                    </h4>
                </div>

                <table class="table table-responsive table-bordered table-hover td1">
                    <tr>
                        <th>序号</th>
                        <th>编号</th>
                        <th>公司</th>
                        <th>申请人</th>
                        <th>流程开始日期</th>
                        <th>状态</th>
                        <th>审核人</th>
                    </tr>
                
                    <?php

                        $sqlstr2="select id,no,company,people,date,date2,status,shr from flsqd where (not status like '%已归档单据%' and not status like '%品牌部归档%') and not status like '%作废%'  and (not status='KA级提交单据' and not shr='$username')";

                        if($newLevel !="ADMIN"){
                            $sqlstr2=$sqlstr2." and (shr like '%$username%' or ywy like '%$username%')";
                        }

                        if($input_time !=""){
                            $input_time_full=$input_time." 00:00:00";
            
                            $sqlstr2=$sqlstr2." and date >='$input_time_full' ";
                        }
            
                        if($input_time2 != ""){
                            $input_time2_full=$input_time2." 23:59:59";
            
                            $sqlstr2=$sqlstr2." and date <='$input_time2_full' ";
                        }
            
                        if($clientName != ""){
                            $sqlstr2=$sqlstr2." and company like '%$clientName%' ";
                        }

                        $sqlstr2=$sqlstr2." order by id desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            $countF=($page-1)*$pagesize;
                            $count=$count+1;

                            ?>

                            <tr>
                                <td><?=$count+$countF?></td>

                                <?php
                                    $no=$myrow[2];
                                    $company=$myrow[3];
                                    $people=$myrow[4];

                                    $arr_status=explode(",",$myrow[6]);
                                    $status=array_pop($arr_status);

                                    $arr_shr=explode(",",$myrow[7]);
                                    $shr=array_pop($arr_shr);

                                    //如果用户名是当前审核人
                                    if($username == $shr){
                                        ?>
                                        <td><a href="flLine.php?id=<?=$myrow[0]?>" style="color:red" target="_blank"><?=$myrow[1]?></a></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td><a href="flLine.php?id=<?=$myrow[0]?>" style="color:green" target="_blank"><?=$myrow[1]?></a></td>
                                        <?php
                                    }
                                ?>

                                <td><?=$no?></td>
                                <td><?=$company?></td>
                                <td><?=$people?></td>
                                <td><?=$status?></td>
                                <td><?=$shr?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>
                
                <div style="margin-left: 20px;">
                    <ul class="pager" style="float:left;width:150px;margin-top:0px">
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

                    <div style="float:left;margin-left:580px;width:321px;">
                        <ul class="pagination" style="float:right;margin-top:0px">
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
                                        }elseif(($i>=$page-2 or $i<=$page+2) and $page !=$pagecount){
                                            ?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>"><?=$i?></a></li>
                                            <?php
                                        }
                                    }
                                }
                                
                            ?>

                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>&status=<?=$status2?>&time=<?=$time?>&input_time=<?=$input_time?>&input_time2=<?=$input_time2?>&clientName=<?=$clientName?>">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>