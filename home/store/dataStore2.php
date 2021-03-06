<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺信息</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php");?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px;">

            <?php

                $username=$_SESSION["username"];

                $sqlstr1="select department,newLevel from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);
        
                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $newLevel=$myrow[1];
                }

                date_default_timezone_set("Asia/Shanghai");
                $dateMonth=date('Y-m', time());
                
                if(!isset($_GET["date"])){
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


                $sqlstr3="select count(*) as total from store a,store_data_hk b where a.storeID=b.storeID and b.date='$date' and a.status='正常' ";

                if($newLevel !="ADMIN" and $department != "商业运营部"){
                    if($newLevel == "KA"){
                        $sqlstr3=$sqlstr3." and a.staff like '%$username%'"; 
                    }else{
                        $sqlstr3=$sqlstr3." and '$department' like concat('%',a.department,'%') ";
                    }
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

            <div style="clear: both;border-radius: 6px;width:1030px;">
                <div class="nav nav-pills" style="float:left;margin-top:15px;margin-left:30px;">
                    <li role="presentation"><a href="dataStore.php">销售额</a></li>
                    <li role="presentation" class="active"><a href="#">回款</a></li>
                </div>

                <div style="float:right;margin-top:20px;">
                    <p style="float:left;margin-left:10px;position:relative;top:5px;">下载</p>
                    <button class="btn btn-sm btn-info" style="float:left;margin-left:10px;"  id="downloadAll_xj">现金回款</button>  
                    <button class="btn btn-sm btn-warning" style="float:left;margin-left:10px;"  id="downloadAll_sx">授信回款</button>  
                </div>
            </div>
            
            <div style="clear:both;width:1100px;">
                <div style="position:relative;top:10px;">
                    <h4 style="float:left;margin-top:15px;">
                        <span class="label label-info" style="margin-left:30px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                    </h4>

                    <div style="float:right;margin-right:70px;">
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
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:55px;margin-left:30px;">
                    <tr>
                        <th>序号</th>
                        <th>店铺编号</th>
                        <th>店铺名</th>
                        <th>负责人</th>
                        <th>回款</th>
                        <th>回款目标</th>
                        <th>现完成额</th>
                        <th>完成比</th>
                        <th>店铺状态</th>
                    </tr>
                
                    <?php    
                        $year=substr($date,0,4);

                        $sqlstr2="select a.storeID,a.client,a.storeName,a.staff,b.backMoney,d.hkTarget,a.status,c.backMoney from store_data_hk b,store a join (select storeID,sum(backMoney) as backMoney from store_data_hk where date like '%$dateMonth%' group by storeID) c on a.storeID=c.storeID left join store_target d on a.storeID=d.storeID and d.dateMonth='$dateMonth'  where a.storeID=b.storeID and b.date='$date' and a.status='正常' ";

                        if($newLevel !="ADMIN" and $department != "商业运营部"){
                            if($newLevel == "KA"){
                                $sqlstr2=$sqlstr2." and a.staff like '%$username%'"; 
                            }else{
                                $sqlstr2=$sqlstr2." and '$department' like concat('%',a.department,'%') ";
                            }
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
                                <td><?=$myrow[3]?></td>
                                <td><?=$myrow[4]?></td>
                                <td>￥<?=$myrow[5]?></td>
                                <td>￥<?=$myrow[7]?></td>
                                <?php
                                    if($myrow[5] != ""){
                                        ?>
                                            <td><?php echo $myrow[7]/$myrow[5] *100?>%</td>
                                        <?php
                                    }else{
                                        ?>
                                            <td></td>
                                        <?php
                                    }
                                ?>
                                
                                <td><?=$myrow[6]?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>
            </div>

            <div style="margin-left: 30px;">
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

                <div style="float:left;margin-left:530px;width:321px;">
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

        window.location.href="dataStore2.php?date="+date;
    })

    $("#downloadAll_xj").click(function(){
        window.location.href="../../controller/store/downloadStoreData.php?option=2"
    })

    $("#downloadAll_sx").click(function(){
        window.location.href="../../controller/sx/downloadSXHK_list.php"
    })
</script>