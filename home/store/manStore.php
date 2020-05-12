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
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php");?>
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


                $sqlstr3="select count(*) as total from store where status='正常'";

                if($newLevel !="ADMIN" and $department != "商业运营部"){
                    if($newLevel == "KA"){
                        $sqlstr3=$sqlstr3." and staff like '%$username%'"; 
                    }else{
                        $sqlstr3=$sqlstr3." and '$department' like concat('%',department,'%') ";
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
                    <li role="presentation" class="active"><a href="#">合作店铺</a></li>
                    <li role="presentation"><a href="manStore2.php">不合作店铺</a></li>
                </div>

                <div style="float:right;margin-top:20px;">
                    <?php
                        if($newLevel == "M"){
                            ?>
                                <button class="btn btn-sm btn-info" style="float:right;margin-left:10px;" id="download">下载模板</button>
                                <button class="btn btn-sm btn-warning" style="float:right;margin-left:10px;"  id="upload" data-toggle="modal" data-target="#myModal">上传数据</button>  
                            <?php
                        }
                    ?>
                </div>
            </div>
            
            <div style="clear:both;">
                <div style="position:relative;top:15px;width:1000px;">
                    <h4 style="float:left">
                        <span class="label label-info" style="margin-left:30px;">共<?=$total?>条</span>
                        <span class="label label-warning" style="margin-left:5px;">共<?=$pagecount?>页</span>
                        <span class="label label-success" style="margin-left:5px;">第<?=$page?>页</span>
                    </h4>
                </div>
            </div>
            
            <div style="clear:both">
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:45px;margin-left:30px;">
                    <tr>
                        <th>序号</th>
                        <th>店铺编号</th>
                        <th>公司名称</th>
                        <th>店铺名称</th>
                        <th>事业部</th>
                        <th>负责人</th>
                        <th>创建日期</th>
                        <th>操作</th>
                    </tr>
                
                    <?php    
                        
                        $sqlstr2="select id,storeID,client,storeName,department,staff,createDate,htsq,link from store where 1=1";
                        
                        if($newLevel !="ADMIN" and $department != "商业运营部"){
                            if($newLevel == "KA"){
                                $sqlstr2=$sqlstr2." and staff like '%$username%'"; 
                            }else{
                                $sqlstr2=$sqlstr2." and '$department' like concat('%',department,'%') ";
                            }
                        }

                        $sqlstr2=$sqlstr2."  and status='正常' order by id desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        $count=0;

                        while($myrow=mysqli_fetch_row($result)){
                            $count=$count+1;
                            $storeID=$myrow[0];
                            $storeNO=$myrow[1];
                            $companyName=$myrow[2];
                            $storeName=$myrow[3];
                            $department=$myrow[4];
                            $staff=$myrow[5];
                            $createDate=$myrow[6];
                            $htsq=$myrow[7];
                            $link=$myrow[8];

                            ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><?=$storeNO?></td>
                                <td>
                                    <p><?=$companyName?></p>
                                </td>

                                <?php
                                    if($link ==""){
                                        ?>
                                            <td><p><?=$storeName?></p></td>
                                        <?php
                                    }else{
                                        ?>
                                            <td><p><a href="<?=$link?>" target="_blank"><?=$storeName?></a></p></td>
                                        <?php
                                    }
                                ?>

                                <td><p><?=$department?></p></td>
                                <td><?=$staff?></td>
                                <td><?=$createDate?></td>
                                <td>
                                    <?php
                                        if($newLevel == "M"){
                                            ?>
                                                <a href="newStore.php?id=<?=$storeID?>" class="btn btn-info btn-xs" style="margin-right:3px;">管理</a>
                                            <?php
                                        }else{
                                            ?>
                                                <a href="uploadStore.php?id=<?=$storeID?>" class="btn btn-info btn-xs" style="margin-right:3px;">管理</a>
                                            <?php
                                        }

                                    ?>
                                    
                                </td>
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
                    ?>">上一页</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>">下一页</a></li>
                </ul>

                <div style="float:left;margin-left:530px;width:321px;">
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

            <!-- Excel导入模态框 -->
            <form method="POST" action="../../controller/store/uploadStoreTarget.php" enctype="multipart/form-data">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">
                                    上传店铺目标
                                </h4>
                            </div>
                            
                            <div class="modal-body" style="height: 200px;">
                                <div class="form-group" style="clear: both;">
                                    <span style="margin-top:20px;">上传店铺数据文件</span>
                                    <input type="file" name="excel" style="margin-top:20px;"/>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">上传</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
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



    $("#newStore").click(function(){
        window.location.href="newStore.php"
    })

    $("#download").click(function(){
        window.location.href="../../controller/store/downloadStoreYJMB.php"
    })

    $("#downloadAll").click(function(){
        window.location.href="../../controller/store/downloadStoreData.php?option=1"
    })
</script>