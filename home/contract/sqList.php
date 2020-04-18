<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
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
        <?  include_once("..\..\common\conn\conn.php");?>
        <?php include '..\base/header.php' ?>
        <?php include '..\base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <div class="nav nav-pills" style="float: left;margin-left:30px;">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation"><a href="contractList.php">合同审批</a></li>
                        <li role="presentation" class="active"><a href="#">授权审批</a></li>
                    </div>
                </div>


                <?php

                    $username=$_SESSION["username"];

                    $sqlstr1="select department,newLevel from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                        $newLevel=$myrow[1];
                    }

                    if(isset($_GET['sqID'])){
                        $sqID=$_GET['sqID'];
                    }else{
                        $sqID="";
                    }

                    if(isset($_GET['clientName'])){
                        $clientName=$_GET['clientName'];
                    }else{
                        $clientName="";
                    }

                    if(isset($_GET['status'])){
                        $status=$_GET['status'];
                    }else{
                        $status="";
                    }
                ?>
            </div>
            
            <div style="clear:both;margin-left:30px;position:relative;top:15px;">
                <p style="font-size:14px;float:left;margin-top:5px;">授权查询</p>

                <select class="form-control" style="float: left;width:110px;margin-left:20px;" id="status">
                    <?php
                        if($sqID !=""){
                            ?>
                                <option selected>授权编号</option>
                                <option>公司名称</option>
                            <?php
                        }elseif($clientName !=""){
                            ?>
                                <option>授权编号</option>
                                <option selected>公司名称</option>
                            <?php
                        }else{
                            ?>
                                <option>授权编号</option>
                                <option>公司名称</option>
                            <?php
                        }
                    ?>
                </select>
                
                <?php
                    if($sqID !=""){
                        ?>
                            <input type="text" class="form-control" id="sqID" placeholder="请输入授权编号" style="width:200px;float: left;margin-left: 10px;" value="<?=$sqID?>">
                            <input type="text" class="form-control" id="clientName" placeholder="请输入公司名称" style="width:200px;float: left;margin-left: 10px;display:none" value="">
                        <?php
                    }elseif($clientName !=""){
                        ?>
                            <input type="text" class="form-control" id="sqID" placeholder="请输入授权编号" style="width:200px;float: left;margin-left: 10px;display:none" value="">
                            <input type="text" class="form-control" id="clientName" placeholder="请输入公司名称" style="width:200px;float: left;margin-left: 10px;" value="<?=$clientName?>">
                        <?php
                    }else{
                        ?>
                            <input type="text" class="form-control" id="sqID" placeholder="请输入授权编号" style="width:200px;float: left;margin-left: 10px;" value="">
                            <input type="text" class="form-control" id="clientName" placeholder="请输入公司名称" style="width:200px;float: left;margin-left: 10px;display:none" value="">
                        <?php
                    }
                ?>
                <input type="hidden" value="1" id="optionID"/>

                <button class="btn btn-warning btn-sm" id="query_contract" style="float: left;margin-left:10px;">查询</button>
                <button class="btn btn-success btn-sm" id="download_contract" style="float: left;margin-left:10px;">下载</button>
            </div>

            <?php

                //分页代码
                if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                    $page=1;
                }else{
                    $page=intval($_GET["page"]);
                }

                $pagesize=15;


                $sqlstr3="select count(*) as total from sq where status like '%已归档%'";

                if($newLevel !="ADMIN" and $department !="财务部" and $department !="商务运营部"){
                    $sqlstr3=$sqlstr3." and department = '$department'";  
                }

                if($clientName !=""){
                    $sqlstr3=$sqlstr3." and companyName like '%$clientName%'";
                }elseif($sqID !=""){
                    $sqlstr3=$sqlstr3." and no like '%$sqID%'";
                }

                $result=mysqli_query($conn,$sqlstr3);
                $info=mysqli_fetch_array($result);
                $total=$info['total'];

                if($total%$pagesize==0){
                    $pagecount=intval($total/$pagesize);
                }else{
                    $pagecount=ceil($total/$pagesize);
                }


                $sqlstr2="select id,no,companyName,pingtai,category,department,bzj,'/','/',re_date,'授权',status,shr,shTime from sq where status like '%已归档%'";
                
                if($newLevel !="ADMIN" and $department !="财务部" and $department !="商务运营部"){
                    $sqlstr2=$sqlstr2." and department = '$department' ";  
                }

                if($clientName !=""){
                    $sqlstr2=$sqlstr2." and companyName like '%$clientName%'";
                }elseif($sqID !=""){
                    $sqlstr2=$sqlstr2." and no like '%$sqID%'";
                }
                
                $sqlstr2=$sqlstr2." limit ".($page-1)*$pagesize.",$pagesize";

                $result=mysqli_query($conn,$sqlstr2);

                $i=1;
            ?>
            
            <div style="clear:both;">
                <h4 style="margin-top:30px">
                    <span class="label label-info" style="margin-left:30px;position:relative;top:30px;">共<?=$total?>条</span>
                    <span class="label label-warning" style="margin-left:5px;position:relative;top:30px;">共<?=$pagecount?>页</span>
                    <span class="label label-success" style="margin-left:5px;position:relative;top:30px;">第<?=$page?>页</span>
                </h4>
            
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:50px;margin-left:30px;margin-bottom:0px;">
                    <tr>
                        <th>序号</th>
                        <th>授权编号</th>
                        <th>公司名称</th>
                        <th>授权平台</th>
                        <th>授权类目</th>
                        <th>事业部</th>
                        <th>流程状态</th>
                        <th>登记日期</th>
                    </tr>
                
                    <?php

                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $isContract=$myrow[10];
                            $contractID=$myrow[1];
                            $companyName=$myrow[2];
                            $pingTai=$myrow[3];
                            $category=$myrow[4];
                            $department=$myrow[5];
                            $status=$myrow[11];
                            $re_date=$myrow[9];

                            $arr_status=explode(",",$status);
                            $status=array_pop($arr_status);

                            ?>
                            <tr>
                                <td><?=$i+($page-1)*$pagesize?></td>

                                <?php
                                    if($isContract=="合同"){
                                ?>
                                    <td><a href="contract_line.php?id=<?=$id?>&option=合同"><?=$contractID?></a></td>
                                <?php
                                    }elseif($isContract=="授权"){
                                ?>
                                    <td><a href="sq_line.php?id=<?=$id?>&option=授权"><?=$contractID?></a></td>
                                <?php
                                    }
                                ?>
                                
                                <td><?=$companyName?></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$pingTai?></p></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$category?></p></td>
                                <td style="width:190px"><?=$department?></td>
                                <td><?=$status?></td>
                                <td><?=$re_date?></td>
                            </tr>
                            <?php
                            $i=$i+1;
                        }

                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>

                <div style="margin-left: 30px;">
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

                    <div style="float:left;margin-left:530px;width:321px;">
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
        </div>

    </body>
</html>

<style>
    th{
        background-color:lightsalmon;
        text-align: center;
    }

    td{
        text-align: center;
    } 

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }

    .category p{
        width: 130px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow:ellipsis;
    }
</style>

<script>
    $("#status").click(function(){
        if($("#status").val()=="合同编号"){
            $("#sqid").css("display","inline");
            $("#clientName").css("display","none");
            $("#optionID").attr("value","1");
        }else if($("#status").val()=="公司名称"){
            $("#sqID").css("display","none");
            $("#clientName").css("display","inline");
            $("#optionID").attr("value","2");
        }
    })

    $("#query_contract").click(function(){
        if($("#optionID").val()=="1"){
            sqID=$("#sqID").val();
            window.location.href="sqList.php?sqID=" +sqID + "&clientName=" + "&status=待审核";
        }else if($("#optionID").val()=="2"){
            clientName=$("#clientName").val();
            window.location.href="sqList.php?sqID=" + "&clientName=" + clientName + "&status=待审核";
        }
    })

    $("#download_contract").click(function(){
        if($("#optionID").val()=="1"){
            sqID=$("#sqID").val();
            window.location.href="formHandle/sq_download.php?sqID=" +sqID + "&clientName=" + "&status=已审核";
        }else if($("#optionID").val()=="2"){
            sqID=$("#sqID").val();
            window.location.href="formHandle/sq_download.php?sqID=" + "&clientName=" + clientName + "&status=已审核";
        }
    })
</script>