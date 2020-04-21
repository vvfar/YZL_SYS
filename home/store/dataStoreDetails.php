<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺信息</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-theme.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php") ?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;">

            <?php
                $storeID=$_GET["storeID"];

                $username=$_SESSION["username"];

                $sqlstr1="select department,newLevel from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);
        
                while($myrow=mysqli_fetch_row($result)){
                    $my_department=$myrow[0];
                    $newLevel=$myrow[1];
                }


                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;


                $sqlstr3="select count(*) as total from store a,store_data b where a.storeID=b.storeID and a.storeID='$storeID'";

                if($newLevel !="ADMIN" and $department != "商务运营部"){
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

            <ul class="breadcrumb" style="padding-left:30px;">
                <li><a href="dataStore.php">店铺信息</a></li>
                <li>店铺详情</li>
                <li class="active"><?=$storeID?></li>
            </ul>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-left:30px;">
                    <li role="presentation" class="active"><a href="#">数据报表</a></li>
                    <!--
                        <li role="presentation"><a href="#">图表展示</a></li>
                        <li role="presentation"><a href="#">资源活动</a></li>
                    -->
                </div>
            </div>
            
            <?php
                $sqlstr4="select storeID,client,storeName,pingtai,category,department,staff,status from store where storeID='$storeID'";
            
                $result2=mysqli_query($conn,$sqlstr4);
        
                while($myrow=mysqli_fetch_row($result2)){
                    $companyName=$myrow[1];
                    $storeName=$myrow[2];
                    $pingtai=$myrow[3];
                    $category=$myrow[4];
                    $department=$myrow[5];
                    $staff=$myrow[6];
                    $status=$myrow[7];
                }
            ?>


            <div style="clear:both;margin-left:30px">
                <ul class="basicStore">
                    <li>店铺名称：<?=$storeName?></li>
                    <li>客户名称:<?=$companyName?></li>
                    <li>平台:<?=$pingtai?></li>
                    <li>授权类目:<?=$category?></li>
                    <li>事业部:<?=$department?></li>
                    <li>业务员:<?=$staff?></li>
                    <li>店铺状态:<?=$status?></li>
                </ul>
            </div>
            
            <div style="clear:both;">
                <div style="width:1030px;">
                    <h4 style="float:left">
                        <span class="label label-info" style="margin-left:30px;position:relative;top:20px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;position:relative;top:20px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;position:relative;top:20px;">第<?=$page?>页</span>
                    </h4>
                    
                    <?php
                        if(!isset($_GET["date"])){
                            date_default_timezone_set("Asia/Shanghai");
                            $date=date('Y-m-d', time());
                        }else{
                            $date=$_GET["date"];
                        }
                    ?>

                    <div style="float:right">
                        <select style="padding-left:2px;padding-bottom:3px;margin-top:15px;">
                            <option>日</option>
                            <option>月</option>
                            <option>年</option>
                            <option>总计</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div style="clear:both">
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:50px;margin-left:30px;">
                    <tr>
                        <th>序号</th>
                        <th>店铺编号</th>
                        <th>公司名称</th>
                        <th>店铺名</th>
                        <th>平台</th>
                        <th>类目</th>
                        <th>销售额</th>
                        <th>销售单量</th>
                        <th>回款</th>
                        <th>日期</th>
                    </tr>
                
                    <?php    

                        $sqlstr2="select a.storeID,a.client,a.storeName,a.pingTai,a.category,b.salesMoney,b.salesNum,b.backMoney,b.date from store a,store_data b where a.storeID=b.storeID and a.storeID='$storeID'";
                        
                        if($newLevel !="ADMIN" and $department != "商务运营部"){
                            if($newLevel == "KA"){
                                $sqlstr2=$sqlstr2." and a.staff like '%$username%'"; 
                            }else{
                                $sqlstr2=$sqlstr2." and '$department' like concat('%',a.department,'%') ";
                            }
                        }


                        $sqlstr2=$sqlstr2." order by b.date desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        $count=1;

                        while($myrow=mysqli_fetch_row($result)){
                            $number=($page-1) * 15 + $count;
                            $count=$count+1;

                            ?>
                            <tr>
                                <td><?=$number?></td>
                                <td><?=$myrow[0]?></td>
                                <td><?=$myrow[1]?></td>
                                <td><?=$myrow[2]?></td>
                                <td><?=$myrow[3]?></td>
                                <td><?=$myrow[4]?></td>
                                <td><?=$myrow[5]?></td>
                                <td><?=$myrow[6]?></td>
                                <td><?=$myrow[7]?></td>
                                <td><?=$myrow[8]?></td>
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
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?php
                        if($page>1)
                            echo $page-1;
                        else
                            echo 1;  
                    ?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:530px;width:321px;">
                    <ul class="pagination" style="float:right;margin-top:0px;">
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=1">&laquo;</a></li>
                        <?php
                            if($pagecount<=5){
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?=$i?>"><?=$i?></a></li>
                                        <?php
                                    }else{
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?=$i?>"><?=$i?></a></li>
                                        <?php
                                    }
                                }
                            }else{
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?=$i?>"><?=$i?></a></li>
                                        <?php
                                    }elseif(($i>=$page-2 and $i<=$page+2 and $page>3) and $page !=$pagecount){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?=$i?>"><?=$i?></a></li>
                                        <?php
                                    }elseif($i<=5){
                                        if($page<=3){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?=$i?>"><?=$i?></a></li>
                                        <?php
                                        }
                                    }
                                }
                            }
                            
                        ?>
                        
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?storeID=<?=$storeID?>&page=<?php echo $pagecount; ?>">&raquo;</a></li>
                    </ul>
                </div>
            
            </div>
        </div>
    </body>
</html>

<style>
    .basicStore li{
        float:left;
        list-style:none;
        margin-right:30px;
        margin-top:20px;
    }

    th{
        background-color:cornflowerblue;
        text-align: center;
    }

    td{
        text-align: center;
    }

    .breadcrumb a{
        color:#333;
    }

    .breadcrumb a:hover{
        color:#333;
        text-decoration: underline;
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

        window.location.href="/viewMeeting.php?date="+date;
    })
</script>