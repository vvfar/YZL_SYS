<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
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
        <?php include_once("..\..\common\conn/conn.php") ?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px">
            <div class="nav nav-pills" style="float: left;margin-left:30px;">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation"><a href="w_contract.php">合同</a></li>
                        <li role="presentation" style="display:none" class="active"><a href="#">补充合同</a></li>
                        <li role="presentation" style="display:none"><a href="w_sq.php">授权</a></li>
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

                    if(isset($_GET['contractID'])){
                        $contractID=$_GET['contractID'];
                    }else{
                        $contractID="";
                    }

                    if(isset($_GET['clientName'])){
                        $clientName=$_GET['clientName'];
                    }else{
                        $clientName="";
                    }

                    if(isset($_GET['storeName'])){
                        $storeName=$_GET['storeName'];
                    }else{
                        $storeName="";
                    }

                    if(isset($_GET['status'])){
                        $status=$_GET['status'];
                    }else{
                        $status="";
                    }
                ?>
            </div>
            
            <div style="clear:both;margin-left:30px;position:relative;top:15px;">
                <p style="font-size:14px;float:left;margin-top:5px;">合同查询</p>

                <select class="form-control" style="float: left;width:110px;margin-left:20px;" id="status">
                    <?php
                        if($contractID !=""){
                            ?>
                                <option selected>合同编号</option>
                                <option>店铺名</option>
                            <?php
                        }elseif($clientName !=""){
                            ?>
                                <option>合同编号</option>
                                <option>店铺名</option>
                            <?php
                        }elseif($storeName !=""){
                            ?>
                                <option>合同编号</option>
                                <option selected>店铺名</option>
                            <?php
                        }else{
                            ?>
                                <option>合同编号</option>
                                <option>店铺名</option>
                            <?php
                        }
                    ?>
                </select>
                
                <?php
                    if($contractID !=""){
                        ?>
                            <input type="text" class="form-control" id="contractID" placeholder="请输入合同编号" style="width:200px;float: left;margin-left: 10px;" value="<?=$contractID?>">
                            <input type="text" class="form-control" id="storeName" placeholder="请输入店铺名" style="width:200px;float: left;margin-left: 10px;display:none" value="">
                        <?php
                    }elseif($storeName !=""){
                        ?>
                            <input type="text" class="form-control" id="contractID" placeholder="请输入合同编号" style="width:200px;float: left;margin-left: 10px;display:none" value="">
                            <input type="text" class="form-control" id="storeName" placeholder="请输入店铺名" style="width:200px;float: left;margin-left: 10px;" value="<?=$storeName?>">
                        <?php
                    }else{
                        ?>
                            <input type="text" class="form-control" id="contractID" placeholder="请输入合同编号" style="width:200px;float: left;margin-left: 10px;" value="">
                            <input type="text" class="form-control" id="storeName" placeholder="请输入店铺名" style="width:200px;float: left;margin-left: 10px;display:none" value="">
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


                $sqlstr3="select count(*) as total from contract_add a where not a.status like '%已归档%'";

                if($newLevel !="ADMIN" and $department !="财务部" and $department !="商业运营部"){
                    if($newLevel == "KA"){
                        $sqlstr3=$sqlstr3." and a.shr like '%$username%'"; 
                    }else{
                        $sqlstr3=$sqlstr3." and a.shr = any( select username from user_form where '".$department."' like concat('%',department,'%'))";
                    }
                    
                }

                if($clientName !=""){
                    $sqlstr3=$sqlstr3." and b.company like '%$clientName%'";
                }elseif($contractID !=""){
                    $sqlstr3=$sqlstr3." and a.no like '%$contractID%'";
                }elseif($storeName !=""){
                    $sqlstr3=$sqlstr3." and a.store like '%$storeName%'";
                }

                

                $result=mysqli_query($conn,$sqlstr3);
                $info=mysqli_fetch_array($result);
                $total=$info['total'];

                if($total%$pagesize==0){
                    $pagecount=intval($total/$pagesize);
                }else{
                    $pagecount=ceil($total/$pagesize);
                }


                $sqlstr2="select b.id,a.no,a.company,a.store,a.status,a.date,a.shr,b.department from contract_add a,contract b where not a.status like '%已归档%' and a.no=b.no";
                
                if($newLevel !="ADMIN" and $department !="财务部" and $department !="商业运营部"){
                    if($newLevel == "KA"){
                        $sqlstr2=$sqlstr2." and a.shr like '%$username%'"; 
                    }else{
                        $sqlstr2=$sqlstr2." and a.shr = any( select username from user_form where '".$department."' like concat('%',department,'%'))";
                    }
                    
                }

                if($clientName !=""){
                    $sqlstr2=$sqlstr2." and b.company like '%$clientName%'";
                }elseif($contractID !=""){
                    $sqlstr2=$sqlstr2." and a.no like '%$contractID%'";
                }elseif($storeName !=""){
                    $sqlstr2=$sqlstr2." and a.store like '%$storeName%'";
                }

                $sqlstr2=$sqlstr2." group by a.id limit ".($page-1)*$pagesize.",$pagesize";

                $result=mysqli_query($conn,$sqlstr2);

                $i=1;

            ?>
            
            <div style="clear:both;">
                <h4 style="margin-top:20px">
                    <span class="label label-info" style="margin-left:30px;position:relative;top:30px;">共<?=$total?>条</span>
                    <span class="label label-warning" style="margin-left:5px;position:relative;top:30px;">共<?=$pagecount?>页</span>
                    <span class="label label-success" style="margin-left:5px;position:relative;top:30px;">第<?=$page?>页</span>
                </h4>
            
                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:50px;margin-left:30px;margin-bottom:0px;">
                    <tr>
                        <th>序号</th>
                        <th>合同编号</th>
                        <th>公司名称</th>
                        <th>店铺名</th>
                        <th>事业部</th>
                        <th>状态</th>
                        <th>登记日期</th>
                    </tr>
                
                    <?php

                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $no=$myrow[1];
                            $companyName=$myrow[2];
                            $storeName=$myrow[3];
                            $status=$myrow[4];
                            $re_date=$myrow[5];
                            $shr=$myrow[6];
                            $department=$myrow[7];
                    ?>
                            <tr>
                                <td><?=$i+($page-1)*$pagesize?></td>
                                
                                <?php
                                    if($status =="审核拒绝" and $shr==$username){
                                        ?>
                                            <td><a href="contract_line.php?id=<?=$id?>&option=合同" style="color:red"><?=$no?></a></td>
                                        <?php
                                    }else{
                                        ?>
                                            <td><a href="contract_line.php?id=<?=$id?>&option=合同"><?=$no?></a></td>
                                        <?php
                                    }
                                ?>
                                <td><?=$companyName?></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$storeName?></p></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$department?></p></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$status?></p></td>
                                <td class="category" style="width:130px"><p style="margin:0"><?=$re_date?></p></td>   
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
            $("#contractID").css("display","inline");
            $("#clientName").css("display","none");
            $("#storeName").css("display","none");
            $("#optionID").attr("value","1");
        }else if($("#status").val()=="公司名称"){
            $("#contractID").css("display","none");
            $("#clientName").css("display","inline");
            $("#storeName").css("display","none");
            $("#optionID").attr("value","2");
        }else if($("#status").val()=="店铺名"){
            $("#contractID").css("display","none");
            $("#clientName").css("display","none");
            $("#storeName").css("display","inline");
            $("#optionID").attr("value","3");
        }
    })

    $("#query_contract").click(function(){
        if($("#optionID").val()=="1"){
            contractID=$("#contractID").val();
            window.location.href="w_contractAdd.php?contractID=" +contractID + "&clientName=" + "&storeName=" + "&status=待审核";
        }else if($("#optionID").val()=="2"){
            clientName=$("#clientName").val();
            window.location.href="w_contractAdd.php?contractID=" + "&clientName=" + clientName + "&storeName=" +  "&status=待审核";
        }else if($("#optionID").val()=="3"){
            storeName=$("#storeName").val();
            window.location.href="w_contractAdd.php?contractID=" + "&clientName=" + "&storeName=" + storeName + "&status=待审核";
        }
    })

    $("#download_contract").click(function(){
        if($("#optionID").val()=="1"){
            contractID=$("#contractID").val();
            window.location.href="../../controller/contract/contract_download.php?contractID=" +contractID + "&clientName=" + "&status=待审核";
        }else if($("#optionID").val()=="2"){
            clientName=$("#clientName").val();
            window.location.href="../../controller/contract/contract_download.php?contractID=" + "&clientName=" + clientName + "&status=待审核";
        }
    })
</script>


