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
        <?php include_once("..\..\common\conn/conn.php");?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;">

            <?php
            
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


                $sqlstr3="select count(*) as total from store where status='关闭'";

                if($department !="商务运营部" and $newLevel !="ADMIN"){
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
                    <div class="nav nav-pills" style="float:left;margin-top:15px;margin-left:30px;">
                        <li role="presentation"><a href="manStore.php">合作店铺</a></li>
                        <li role="presentation" class="active"><a href="#">不合作店铺</a></li>
                    </div>
                </div>
            <?php
                
            ?>
            
            <div style="clear:both;">
                <div style="position:relative;top:15px;width:1000px;">
                    <h4 style="float:left">
                        <span class="label label-info" style="margin-left:30px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                    </h4>
                    <!--<button class="btn btn-sm btn-success" style="float:right" id="newStore">新增店铺</button>-->
                </div>
            </div>
            
            <div style="clear:both">
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:45px;margin-left:30px;">
                    <tr>
                        <th>序号</th>
                        <th>公司名称</th>
                        <th>店铺名称</th>
                        <th>事业部</th>
                        <th>负责人</th>
                        <th>业绩目标</th>
                        <th>创建日期</th>
                        <th>操作</th>
                    </tr>
                
                    <?php    
                        

                        $sqlstr2="select * from store where 1=1";
                        
                        if($department !="商务运营部" and $newLevel !="ADMIN"){
                            $sqlstr2=$sqlstr2." and department='$department'";
                        }

                        $sqlstr2=$sqlstr2."  and status='关闭' order by id desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        $count=0;

                        while($myrow=mysqli_fetch_row($result)){
                            $count=$count+1;

                            ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><p><?=$myrow[2]?></p></td>

                                <?php
                                    if($myrow[12] ==""){
                                        ?>
                                            <td><p><?=$myrow[3]?></p></td>
                                        <?php
                                    }else{
                                        ?>
                                            <td><p><a href="<?=$myrow[12]?>" target="_blank"><?=$myrow[3]?></a></p></td>
                                        <?php
                                    }
                                ?>
                                <td><p><?=$myrow[6]?></p></td>
                                <td><?=$myrow[7]?></td>
                                <td><?=$myrow[8]?></td>

                                <td><?=$myrow[10]?></td>
                                <td>
                                    <a href="/newStore.php?id=<?=$myrow[0]?>" class="btn btn-info btn-xs" style="margin-right:3px;">管理</a>
                                </td>
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
                    ?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:830px;width:321px;">
                    <ul class="pagination" style="float:right;margin-top:0px;">
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
                                    }elseif(($i>=$page-2 and $i<=$page+2 and $page>3) and $page !=$pagecount){
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

    table p{
        width: 170px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
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

    $("#newStore").click(function(){
        window.location.href="newStore.php"
    })
</script>