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
        <link href="..\..\public\css\leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css\header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php");?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:15px;">
            <div class="nav nav-pills" style="float: left;margin-top: 15px;margin-left:30px;">
                <?php
                    
                    $username=$_SESSION["username"];

                    $sqlstr1="select department,level,newLevel from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $my_department=$myrow[0];
                        $level=$myrow[1];
                        $newLevel=$myrow[2];
                    }

                    if(isset($_GET['id']) and $_GET['option'] == "授权"){
                        $id=$_GET["id"];
                        $sqlstr2="select * from sq where id='$id'";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $no=$myrow[1];
                            $companyName=$myrow[2];
                            $storeName=$myrow[3];
                            $sqType=$myrow[4];
                            $pingTai=$myrow[5];
                            $category=$myrow[6];
                            $department=$myrow[7];
                            $date1=$myrow[8];
                            $date2=$myrow[9];
                            $contractNo=$myrow[10];
                            $bzj=$myrow[11];
                            $fileName=$myrow[12];
                            $re_date=$myrow[13];
                            $status=$myrow[14];
                            $shr=$myrow[15];
                            $shTime=$myrow[16];
                            $note=$myrow[17];
                        }
                    }
                    
                    
                ?>
            </div>

            <div> 
                <?php

                    if($status !="已归档"){
                    ?>
                        <button class="btn btn-sm btn-warning" style="float:left">待归档</button>
                    <?php
                    }else{
                    ?>
                        <button class="btn btn-sm btn-success" style="float:left">已归档</button>
                    <?php
                    }
                ?>
                <p style="font-size: 16px;float:left;margin-top:5px;margin-left:10px;width:644px">授权编号：<?=$no?></p>
                <p style="font-size: 16px;float:left;">授权期限：从 <?=$date1?> 到 <?=$date2?></p>
            </div>

            <div style="clear:both;margin-left:30px;position:relative;top:15px;">
                <div>
                    <p style="border-bottom:1px solid #ddd;padding:5px;float:left">登记日期：<?=$re_date?></p>
                    
                    <?php
                        if($my_department=="商业运营部" or $newLevel=="ADMIN"){
                            ?>
                                <button class="btn btn-sm btn-info" style="float:left;margin-left:698px;" onclick="changeSQ()">修改授权</button>
                                <button class="btn btn-sm btn-danger" style="float:left;margin-left:10px" onclick="delSQ()">删除授权</button>
                            <?php
                        }
                    ?>
                </div>

                <div style="clear:both">
                    <p style="float:left;margin-top:20px;">基本信息：</p>
                
                    <?php
                        $contractID="";

                        $sqlstr1="select id from contract where no='$contractNo' and company='$companyName' and store='$storeName'";

                        $result=mysqli_query($conn,$sqlstr1);

                        while($myrow=mysqli_fetch_row($result)){
                            $contractID=$myrow[0];
                        }
                        
                        if($contractID !=""){
                            ?>
                                <a href="contract_line.php?id=<?=$contractID?>&option=合同" style="float:left;margin-left:845px;margin-top:20px;" target="_blank">查看店铺合同</a>
                            <?php
                        }else{
                            ?>
                                <a href="#" style="float:left;margin-left:860px;margin-top:20px;">无店铺合同</a>
                            <?php
                        }
                    ?>
                </div>
                <table class="table table-responsive table-bordered table-hover"  style="width:1000px;margin-top:50px">
                    <tr>
                        <th>公司名称</th>
                        <td colspan="7"><?=$companyName?></td>
                    </tr>
                    <tr>
                        <th>店铺名称</th>
                        <td colspan="7"><?=$storeName?></td>
                    </tr>
                    <tr>
                        <th>授权平台</th>
                        <td colspan="2"><?=$pingTai?></td>
                        <th>授权类目</th>
                        <td colspan="3"><?=$category?></td>
                    </tr>
                    <tr>
                        <th>保证金</th>
                        <td colspan="2"><?=$bzj?></td>
                        <th>销售额</th>
                        <td>/万</td>
                        <th>服务费</th>
                        <td>/万</td>
                    </tr>
                </table>
                
                <p style="margin-bottom:10px;">备注信息：<?=$note?></p>

                <?php

                    if($my_department == "商业运营部" and $status == "待归档"){
                        ?>

                        <div style="width:1000px;">
                            <button class="btn btn-sm btn-danger" style="float:right" id="no">拒绝</button>
                            <button class="btn btn-sm btn-success" style="float:right;margin-right:10px;" id="yes">同意</button>
                        </div>

                        <?php
                    }

                    if(($status=="审核拒绝" or $status == "待归档") and $username == $shr){
                        ?>
                            <div style="width:1000px;">
                                <button class="btn btn-sm btn-info" style="float:right" id="edit">重新编辑</button>
                            </div>
                        <?php
                    }

                    $file_arr=explode(",",$fileName);
                    if($file_arr[0] !=""){
                        ?>
                            <a class="btn btn-info btn-sm" href="../../common/file/sq_file/bzj/<?=$file_arr[0]?>" target="_blank">保证金收据</a>
                        <?php
                    }

                    if($file_arr[1] !=""){
                        ?>
                            <a class="btn btn-success btn-sm" href="../../common/file/sq_file/sq_file/<?=$file_arr[1]?>"  target="_blank">授权扫描件</a>
                        <?php
                    }

                ?>
            </div>
        </div>
    </body>
</html>

<style>
    th{
        text-align: center;
    }

    td{
        text-align: center;
        width:100px;
        height:40px;
        line-height:40px;
        vertical-align: middle;
    }

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }

    ul{
        list-style: none;
        margin:0;
        padding:0;
    }

    .notice ul li{
        float: left;
        width:250px;
    }
</style>

<script>
    $("#yes").click(function(){

        <?php
            if($username == "崔立德"){
                ?>
                    window.location.href="../../controller/contract/SQHandle.php?id=<?=$id?>&progress=3"
                <?php
            }elseif($newLevel == "M"){
                ?>
                    window.location.href="../../controller/contract/SQHandle.php?id=<?=$id?>&progress=2"
                <?php
            }elseif($my_department == "商业运营部"){
                ?>
                    window.location.href="../../controller/contract/SQHandle.php?id=<?=$id?>&progress=4"
                <?php
            }
        ?>
    })

    $("#no").click(function(){
        window.location.href="../../controller/contract/SQHandle.php?id=<?=$id?>&progress=5"
    })

    $("#edit").click(function(){
        window.location.href="newSQ.php?id=<?=$id?>"
    })

    var changeSQ=function(){
        window.location.href="newSQ.php?id=<?=$id?>"
    }

    var delSQ=function(){
        window.location.href="../../controller/contract/SQHandle.php?id=<?=$id?>&progress=6"
    }
</script>
