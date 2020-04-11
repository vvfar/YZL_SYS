<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
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

        <div class="zhangmu_container">

            <?php
                error_reporting(E_ALL || ~E_NOTICE);
                if(!isset($_GET["date1"]) && !isset($_GET["date1"]) && !isset($_GET["companyName"])  ){
                    $date1="";
                    $date2="";
                    $companyName="";
                }else{
                    $date1=$_GET["date1"];
                    $date2=$_GET["date2"];
                    $companyName=$_GET["companyName"];
                }
            
            ?>
            <?php
                include_once("conn/conn.php");
                
                $username=$_SESSION["username"];

                $sqlstr1="select department,level from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $level=$myrow[1];
                }

                $sqlstr2="select fileName from files where note='授信欠据模板'";

                $result=mysqli_query($conn,$sqlstr2);

                if($result){
                    while($myrow=mysqli_fetch_row($result)){
                        $path1=$myrow[0];
                    }
                }
                

                $sqlstr3="select fileName from files where note='产品抵标费模板'";

                $result=mysqli_query($conn,$sqlstr3);
                
                if($result){
                    while($myrow=mysqli_fetch_row($result)){
                        $path2=$myrow[0];
                    }
                }

            ?>
            <div class="form-group date_form">
                <p class="djrq">最晚回款期限</p>
                <p style="width: 20px;font-size: 14px;float: left;margin-top:5px;margin-left:20px;">从</p>
                <div style="width: 180px;font-size: 14px;float: left;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="date1" size="16" type="text" value="<?=$date1?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <p style="width: 20px;font-size: 14px;float: left;margin-top:5px;margin-left:20px;">到</p>
                <div style="width: 180px;font-size: 14px;float: left;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="date2" size="16" type="text" value="<?=$date2?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <div style="font-size: 14px;float: left;margin-left:20px;">
                    <input class="form-control" id="companyName" placeholder="请输入公司名称" style="width:250px;" value="<?=$companyName?>"/>
                </div>
                <div style="float:left;margin-left:20px;margin-top:2px;">
                    <button class="btn btn-success btn-sm" onclick="search()">搜索</button>
                    <button class="btn btn-warning btn-sm" onclick="excel()">导出Excel</button>
                    <?php
                        if($department=="数据中心"){
                            ?>
                                <button class="btn btn-info btn-sm" onclick="upload()" data-toggle="modal" data-target="#myModal2">批量导入</button>
                            <?php
                        }
                    ?>
                </div>

                <!-- Excel导入模态框 -->
                <form method="POST" action="formHandle/uploadSXHandle.php" enctype="multipart/form-data">
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        批量上传授信
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
            </div>

            <div style="clear:both;float:left;margin-left:60px;">
                <p>注：该系统不支持授信单据的修改，如果填错，请联系数据中心管理部。</p>
            </div>

            <?php
                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;

                $sqlstr3="select count(*) as total from sx_form a,hk_form b where a.sqid=b.sqid and a.status='已作废' ";
                
                if($date1 !="" && $date2 !=""){
                    $sqlstr3= $sqlstr3." and a.date3>='$date1' and a.date3<= '$date2'";
                }

                if($companyName !=""){
                    $sqlstr3= $sqlstr3." and a.companyName like '%$companyName%'";
                }

                if($department !="数据中心" and $department !="财务" and $level !="总经理"){
                    $sqlstr3=$sqlstr3." and (a.department='$department' or a.gxDepartment like '%$department%')";
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
            
            <div style="clear:both">
                <h4>
                    <span class="label label-info" style="margin-left:60px;">共<?=$total?>条</span>
                    <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                    <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                </h4>
            <div>
            
            <div style="clear:both;position: relative;top: 10px;margin-left: 60px;">
                <table class="table table-responsive table-bordered table-hover" style="width: 1300px;margin-bottom:10px;">
                    <tr>
                        <th style="width: 150px;">授信编号</th>
                        <th>公司名称</th>
                        <th>事业部</th>
                        <th>业务员</th>
                        <th>授信金额</th>
                        <th>剩余应还</th>
                        <th>剩余额度</th>
                        <th>状态</th>
                        <th style="width:100px;">登记日期</th>
                    </tr>

                    <?php
                        
                        $sqlstr2="select distinct a.id,a.date1,a.sqid,a.companyName,a.department,a.ywy,a.sqmoney,". 
                        "b.dhkje,a.status2,a.status,c.newMoney ".
                        "from sx_form a,hk_form b,use_sx c where a.sqid=b.sqid and a.sqid=c.sqid and a.status='已作废' ";

                        if($date1 !="" and $date2 !=""){
                            $sqlstr2=$sqlstr2." and a.date3 >= '$date1' and a.date3 <= '$date2'";
                        }

                        if($companyName !=""){
                            $sqlstr2=$sqlstr2." and a.companyName like '%$companyName%'";
                        }
                        
                        if($department !="数据中心" and $department !="财务" and $level !="总经理"){
                            $sqlstr2=$sqlstr2." and (a.department='$department' or a.gxDepartment like '%$department%')";
                        }

                        $sqlstr2=$sqlstr2." order by a.date1 desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            $arr_shr=explode(",",$myrow[9]);
                            $shr=array_pop($arr_shr);
                        ?>
                            <tr>
                                <td class="td1"><p style="margin:0 auto"><a href="sx_line.php?id=<?=$myrow[0]?>" style="width: 50px;"><?=$myrow[2]?></a></p></td>
                                <td class="td2"><p style="margin:0 auto"><?=$myrow[3]?></p></td>
                                <td><?=$myrow[4]?></td>
                                <td><?=$myrow[5]?></td>
                                <td><?=$myrow[6]?></td>
                                <td><?=$myrow[7]?></td>
                                <?php
                                    if($myrow[10]==NULL){
                                ?>
                                    <td>0</td>
                                <?php
                                    }else{
                                ?>
                                    <td><?=$myrow[10]?></td>
                                <?php
                                    }
                                ?>
                                
                                <td><?=$myrow[9]?></td>
                                <td><?=$myrow[1]?></td>
                            </tr>
                        <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>    
                </table>
            </div>
            
            <div style="margin-left: 60px;">
                <ul class="pager" style="float:left;width:150px;">
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page>1)
                            echo $page-1;
                        else
                            echo 1;  
                    ?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:830px;width:321px;">
                    <ul class="pagination" style="float:right">
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=1">&laquo;</a></li>
                        <?php
                            if($pagecount<=5){
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>"><?=$i?></a></li>
                                        <?php
                                    }else{
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>"><?=$i?></a></li>
                                        <?php
                                    }
                                }
                            }else{
                                for($i=1;$i<=$pagecount;$i++){
                                    if($i==$page){
                                        ?>
                                            <li  class="active"><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>"><?=$i?></a></li>
                                        <?php
                                    }elseif(($i>=$page-2 and $i<=$page+2 and $page>3) and $page !=$pagecount){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>"><?=$i?></a></li>
                                        <?php
                                    }elseif($i<=5){
                                        if($page<=3){
                                        ?>
                                            <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?=$i?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>"><?=$i?></a></li>
                                        <?php
                                        }
                                    }
                                }
                            }
                            
                        ?>
                        
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>&date1=<?=$date1?>&date2=<?=$date2?>&companyName=<?=$companyName?>">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>  
    </body>
</html>

<style>
    @media screen and (min-width:1300px){
        th{background-color:lavender}
        th,td{text-align: center;margin: 0;overflow: hidden}
        .to-scroll{overflow-x: scroll;overflow-x: scroll;height: 550px;clear:both}
        .zhangmu_container{width: 1660px;height:880px;margin-left: 240px;}
        .nav_div{float:left;margin-top: 20px;margin-left:40px;}
        .date_form{clear: both;float:left;margin-top:30px;margin-left:60px}
        .djrq{float:left;margin-top:5px}
        .template{float:left;margin-left:400px;margin-top:2px;}
    }

    @media screen and (min-width:1024px) and (max-width:1299px){
        th{background-color:lavender}
        th,td{text-align: center;margin: 0;overflow: hidden}
        .to-scroll{overflow-x: scroll;overflow-x: scroll;height: 550px;clear:both}
        .zhangmu_container{width: 1320px;height:880px;margin-left: 150px;}
        .nav_div{clear:both;float:left;margin-top: 20px;margin-left:60px;}
        .date_form{clear: both;float:left;margin-top:30px;margin-left:60px}
        .djrq{float:left;margin-top:5px}
        .template{float:left;margin-left:350px;margin-top:2px;}
    }

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }

    .td1 p{
        text-align:center;
        width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
    }

    .td2 p{
        width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
    }
</style>

<script type="text/javascript">  
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

    var excel=function(){
        date1=$("#date1").val()
        date2=$("#date2").val()
        companyName=$("#companyName").val()

        window.location.href='formHandle/sc_form.php?date1=' + date1 + '&date2=' + date2 +"&companyName=" + companyName + "&option=2"
    }

    var search=function(){
        date1=$("#date1").val()
        date2=$("#date2").val()
        companyName=$("#companyName").val()

        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?date1=" +date1 + "&date2=" + date2 +"&companyName=" + companyName

    }
</script>