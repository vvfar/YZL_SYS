<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_IT设备</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-theme.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;">

            <?php
                $username=$_SESSION["username"];

                $sqlstr1="select department,level from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);
        
                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $level=$myrow[1];
                }


                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;


                $sqlstr3="select count(*) as total from it";

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
                    <div class="nav nav-pills" style="float:left;margin-top:10px;margin-left:20px;">
                        <li role="presentation" class="active"><a href="#">设备列表</a></li>
                        <li role="presentation"><a href="it.php">新增设备</a></li>
                    </div>
                </div>
            <?php
                
            ?>
            
            <div style="clear:both;">
                <div style="width:1070px;">
                    <h4 style="float:left">
                        <span class="label label-info" style="margin-left:20px;position:relative;top:15px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;position:relative;top:15px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;position:relative;top:15px;">第<?=$page?>页</span>
                    </h4>
                    <button class="btn btn-sm btn-success" style="float:right;position:relative;top:0px;" id="download">下载</button>
                </div>
            </div>
            
            <div style="clear:both">
                <table class="table table-responsive table-bordered table-hover" style="width:1050px;margin-top:45px;margin-left:20px;">
                    <tr>
                        <th>型号</th>
                        <th>使用人</th>
                        <th>事业部</th>
                        <th>品牌</th>
                        <th>系统</th>
                        <th>内存</th>
                        <th>硬盘</th>
                        <th>类型</th>
                        <th>类别</th>
                    </tr>
                
                    <?php    
                        
                        $sqlstr2="select id,barcode,user,department,brand,system2,ram,hardpan,leixing,leibie from it order by department desc,leibie asc limit ".($page-1)*$pagesize.",$pagesize";
                                                
                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            ?>
                            <tr>
                                <td><a href="it.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                                <td><?=$myrow[2]?></td>
                                <td><?=$myrow[3]?></td>
                                <td><?=$myrow[4]?></td>
                                <td><?=$myrow[5]?></td>
                                <td><?=$myrow[6]?></td>
                                <td><?=$myrow[7]?></td>
                                <td><?=$myrow[8]?></td>
                                <td><?=$myrow[9]?></td>
                            </tr>
                            <?php
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>
            </div>

            <div style="margin-left: 20px;">
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

                <div style="float:left;margin-left:580px;width:321px;">
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
</style>

<script>
    $("#download").click(function(){
        window.location.href="formHandle/download_it.php"
    })

</script>