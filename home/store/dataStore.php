<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺信息</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-theme.css" rel="stylesheet" media="screen"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
    <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">

            <?php
                include_once("conn/conn.php");

                $username=$_SESSION["username"];

                $sqlstr1="select department,level from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);
        
                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $level=$myrow[1];
                }

                if(!isset($_GET["date"])){
                    date_default_timezone_set("Asia/Shanghai");
                    $date=date('Y-m-d', time());
                }else{
                    $date=$_GET["date"];
                }


                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;


                $sqlstr3="select count(*) as total from store a,store_data b where a.storeID=b.storeID and b.date='$date'";

                if($department !="数据中心"){
                    $sqlstr3=$sqlstr3." and department='$department'";
                }


                $result=mysqli_query($conn,$sqlstr3);
                $info=mysqli_fetch_array($result);
                $total=$info['total'];

                if($total%$pagesize==0){
                    $pagecount=intval($total/$pagesize);
                }else{
                    $pagecount=ceil($total/$pagesize);
                }

            ?>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-top:30px;margin-left:50px;">
                    <li role="presentation" class="active"><a href="#">合作店铺</a></li>
                </div>
            </div>
            
            <div style="clear:both;">
                <div style="position:relative;top:15px;width:1350px;">
                    <h4 style="float:left">
                        <span class="label label-info" style="margin-left:50px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                    </h4>
                    
                    <?php

                    ?>

                    <div style="float:right">
                        <p style="float: left;position:relative;top:7px;">选择日期</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-left:20px" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="dateTime" name="dateTime" size="16" type="text" value="<?=$date?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="clear:both">
                <table class="table table-responsive table-bordered table-hover" style="width:1300px;margin-top:65px;margin-left:50px;">
                    <tr>
                        <th>序号</th>
                        <th>店铺编号</th>
                        <th>店铺名</th>
                        <th>销售额</th>
                        <th>回款</th>
                        <th>店铺目标</th>
                        <th>现完成额</th>
                        <th>完成比</th>
                        <th>店铺状态</th>
                        <th>问题反馈</th>
                    </tr>
                
                    <?php    
                        $year=substr($date,0,4);

                        $sqlstr2="select a.storeID,a.client,a.storeName,b.salesMoney,b.backMoney,a.storeTarget,a.status,b.question,c.sumMoney from store_data b,store a join (select storeID,sum(salesMoney) as sumMoney from store_data where date <= '$date' and date >= '2020-01-01' group by storeID) c on a.storeID=c.storeID where a.storeID=b.storeID and b.date='2020-03-20' ";

                        if($department !="数据中心"){
                            $sqlstr2=$sqlstr2." and department='$department'";
                        }

                        $sqlstr2=$sqlstr2." order by b.id desc limit ".($page-1)*$pagesize.",$pagesize";


                        $result=mysqli_query($conn,$sqlstr2);

                        $count=0;

                        while($myrow=mysqli_fetch_row($result)){
                            $count=$count+1;

                            ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><a href="dataStoreDetails.php?storeID=<?=$myrow[0]?>"><?=$myrow[0]?></a></td>
                                <td><?=$myrow[2]?></td>
                                <td>￥<?=$myrow[3]?></td>
                                <td>￥<?=$myrow[4]?></td>
                                <td>￥<?=$myrow[5]?></td>
                                <td>￥<?=$myrow[8]?></td>
                                <td><?php echo $myrow[8]/$myrow[5] *100?>%</td>
                                <td><?=$myrow[6]?></td>
                                <td><?=$myrow[7]?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>
            </div>

            <div style="margin-left: 50px;">
                <ul class="pager" style="float:left;width:150px;margin-top:0px;">
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page>1)
                            echo $page-1;
                        else
                            echo 1;  
                    ?>&date=<?=$date?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>&date=<?=$date?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:830px;width:321px;">
                    <ul class="pagination" style="float:right;margin-top:0px;">
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=1&date=<?=$date?>">&laquo;</a></li>
                        <?php
                            if($pagecount<=5){
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date=<?=$date?>"><?=$i?></a></li>
                                        <?php
                                    }else{
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date=<?=$date?>"><?=$i?></a></li>
                                        <?php
                                    }
                                }
                            }else{
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date=<?=$date?>"><?=$i?></a></li>
                                        <?php
                                    }elseif(($i>=$page-2 and $i<=$page+2 and $page>3) and $page !=$pagecount){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date=<?=$date?>"><?=$i?></a></li>
                                        <?php
                                    }elseif($i<=5){
                                        if($page<=3){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date=<?=$date?>"><?=$i?></a></li>
                                        <?php
                                        }
                                    }
                                }
                            }
                            
                        ?>
                        
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>&date=<?=$date?>">&raquo;</a></li>
                    </ul>
                </div>
            
            </div>
        </div>
    </body>
</html>

<style>
    th{
        background-color:cornflowerblue;
        text-align: center;
    }

    td{
        text-align: center;
    }
</style>

<script>
    $("#download").click(function(){
        window.location.href="formHandle/download_it.php"
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

    $(".date").change(function(){
        date=$("#dateTime").val();

        window.location.href="/dataStore.php?date="+date;
    })
</script>