<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>

        <?php include_once("..\..\common\conn\conn.php") ?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div class="zhangmu_container" style="margin-top:50px;">

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
            
                
                
                $username=$_SESSION["username"];

                $sqlstr1="select department,newLevel from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $newLevel=$myrow[1];
                }

            ?>

            <div style="margin-left:30px;margin-top:15px;">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#" style="width:120px;float:left">即将到期授信</a></li>
                    <li style="width:90px;float:left"><a href="expireSX.php">逾期授信</a></li>
                </ul>
            </div>

            <div>
                <button class="btn btn-success btn-sm" style="float:left;margin-left:955px;" onclick="downloadDQ()">下载到期单据</button>
            </div>

            <?php
                $date2="";

                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;

                $sqlstr3="select count(*) as total from sx_form a,hk_form b where a.sqid=b.sqid and a.status='已生效'";

                if($date1 !="" && $date2 !=""){
                    $sqlstr3= $sqlstr3." and a.date3>='$date1' and a.date3<= '$date2'";
                }

                if($companyName !=""){
                    $sqlstr3= $sqlstr3." and a.companyName like '%$companyName%'";
                }

                if($newLevel !="ADMIN"){
                    $sqlstr3=$sqlstr3." and (a.department='$department' or a.gxDepartment like '%$department%')";
                }
                
                $result=mysqli_query($conn,$sqlstr3);
                $info=mysqli_fetch_array($result);
                
            ?>

            
            <div style="clear:both;position: relative;top: 10px;margin-left: 30px;">
                <table class="table table-responsive table-bordered table-hover sx_form" style="width: 1020px;margin-bottom:10px;margin-top:25px;">
                    <tr>
                        <th>序号</th>
                        <th style="width: 150px;">授信编号</th>
                        <th>公司名称</th>
                        <th>事业部</th>
                        <th>业务员</th>
                        <th>授信金额</th>
                        <th>期数</th>
                        <th>应收</th>
                        <th>已收</th>
                        <th>未收</th>
                        <th>到期时间</th>
                        <th>剩余天数</th>
                    </tr>

                    <?php
                        
                        $sqlstr2="select distinct a.id,a.date1,a.sqid,a.companyName,a.department,a.ywy,a.sqmoney,". 
                        "b.dhkje,a.status2,a.status,c.newMoney,a.dateTime,a.hkje,b.date2,b.sjhkje,a.date3,a.wyfl ".
                        "from sx_form a,hk_form b,use_sx c where a.sqid=b.sqid and a.sqid=c.sqid and a.status='已生效'";

                        if($date1 !="" and $date2 !=""){
                            $sqlstr2=$sqlstr2." and a.date3 >= '$date1' and a.date3 <= '$date2'";
                        }

                        if($companyName !=""){
                            $sqlstr2=$sqlstr2." and a.companyName like '%$companyName%'";
                        }
                        
                        if($newLevel !="ADMIN" and $department !="财务部"){
                            $sqlstr2=$sqlstr2." and (a.department='$department' or a.gxDepartment like '%$department%')";
                        }

                        $sqlstr2=$sqlstr2." order by a.date1 desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        $myTotal=1;

                        while($myrow=mysqli_fetch_row($result)){
                            $arr_shr=explode(",",$myrow[9]);
                            $shr=array_pop($arr_shr);
                            

                            //计划回款期数，金额
                            $arr_qs=explode(",",$myrow[11]);
                            $arr_hkje=explode(",",$myrow[12]);
                            $arr_wyfl=explode(",",$myrow[16]);

                            //实际回款期数，金额
                            $arr_qs2=explode(",",$myrow[13]);
                            $arr_hkje2=explode(",",$myrow[14]);

                            //合同期限
                            $lastDate=$myrow[15];

                            $qs=0;
                            $all_jhhk=0;

                            //到期时间
                            $expireDate="";
                            $yqsj="";

                            date_default_timezone_set("Asia/Shanghai");
                            //$date1=date('Y-m-d', time());

                            $date1=date('Y-m-d', time());
                            $date2=date("Y-m-d",strtotime("+1week",strtotime(date('Y-m-d', time()))));


                            for($count=0;$count<sizeof($arr_qs);$count++){
                                if($arr_qs[$count] != ""){
                                    $qs=$qs+1;

                                    if($arr_qs[$count] <= $date2){
                                        $all_jhhk=$all_jhhk+$arr_hkje[$count]*(1+$arr_wyfl[$count]/100);
                                        $expireDate=$arr_qs[$count];
                                    }
                                }
                            }
                            
                                
                            if($qs==0){
                                $expireDate=$lastDate;
                                $all_jhhk=$myrow[6];
                            }

                            $qs2=0;
                            $all_sjhk=0;


                            for($count=0;$count<sizeof($arr_qs2);$count++){
                                if($arr_qs2[$count] != ""){
                                    $qs2=$qs2+1;

                                    if($arr_qs[$count] <= $date2){
                                        $all_sjhk=$all_sjhk+$arr_hkje2[$count];
                                    }
                                } 
                            }
                            
                            if($qs2==0){
                                $all_sjhk=$myrow[6]-$myrow[7];
                            }

                            if($all_jhhk > $all_sjhk){
                                //逾期天数
                                $yqsj=floor((strtotime($expireDate)-strtotime($date1))/86400);

                                if($yqsj<=7 and $yqsj >= 0){
                                    $yqsj=$yqsj."天到期";
                                }else{
                                    $yqsj="";
                                }
                            }else{
                                $expireDate="";
                            }

                            if($expireDate > $date2 or $expireDate < $date1){
                                $expireDate="";
                            }
                            
                            if($yqsj != ""  and $yqsj >= 0){
                                if($myTotal <= $page * $pagesize and $myTotal > ($page-1) * $pagesize){
                                    ?>
                                        <tr>
                                            <td><?=$myTotal?></td>
                                            <td class="td1"><p style="margin:0 auto"><a href="sx_line.php?id=<?=$myrow[0]?>" style="width: 50px;"><?=$myrow[2]?></a></p></td>
                                            <td class="td2"><p style="margin:0 auto"><?=$myrow[3]?></p></td>
                                            <td><p style="margin:0 auto"><?=$myrow[4]?></p></td>
                                            <td><?=$myrow[5]?></td>
                                            <td><?=$myrow[6]?></td>
                                            <td><?=$qs?></td>
                                            <td><?=$all_jhhk?></td>
                                            <td><?=$all_sjhk?></td>
                                            <td><?php echo $all_jhhk-$all_sjhk?></td>
                                            <td><?=$expireDate?></td>
                                            <td><?=$yqsj?></td>
                                        </tr>
                                    <?php
                                    $myTotal=$myTotal+1;
                                }
                            }
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);

                        $total=$myTotal-1;

                        if($total%$pagesize==0){
                            $pagecount=intval($total/$pagesize);
                        }else{
                            $pagecount=ceil($total/$pagesize);
                        }
                        
                    ?>    
                </table>

                            
                <div style="clear:both">
                    <h4>
                        <span class="label label-info">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                    </h4>
                <div>
            </div>

            <div>
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

                <div style="float:left;margin-left:550px;width:321px">
                    <ul class="pagination" style="float:right;margin:0">
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

    th{background-color:lavender}
    th,td{text-align: center;margin: 0;overflow: hidden}
    .to-scroll{overflow-x: scroll;overflow-x: scroll;height: 550px;clear:both}
    .zhangmu_container{margin-left: 180px;}
    .nav_div{float:left;margin-top: 20px;margin-left:40px;}
    .date_form{clear: both;float:left;margin-top:30px;margin-left:60px}
    .djrq{float:left;margin-top:5px}
    .template{float:left;margin-left:400px;margin-top:2px;}

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }

    .sx_form p{
        width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
    }
</style>

<script type="text/javascript">  
    var downloadDQ=function(){
        window.location.href="../../controller/sx/downloadSX_DQ.php"
    }
</script>