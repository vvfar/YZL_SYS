<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php") ?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;">

            <div style="clear:both;margin-left:40px;">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation"><a href="contract.php">新增合同</a></li>
                        <li role="presentation" class="active"><a href="contractAddition.php">新增补充合同</a></li>
                        <li role="presentation"><a href="newSQ.php">新增授权</a></li>
                    </div>
                </div>

                <form method="POST" action="../../controller/contract/contractAdditionHandle.php?progress=1"  enctype="multipart/form-data">
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">主合同编号</p>
                        <select class="form-control" name="no" style="width: 250px;float: left;margin-top: 15px;">
                        <?php
                            $username=$_SESSION['username'];
                        
                            $sqlstr="select no from contract where shr='$username'";

                            $result=mysqli_query($conn,$sqlstr);

                            while($myrow=mysqli_fetch_row($result)){
                                ?>
                                    <option><?=$myrow[0]?></option>
                                <?php
                            }
                        
                        ?>
                        </select>
                    </div>

                    <div class="form-group" style="clear: both;">
                        <p style="font-size: 14px;margin-top: 60px;">补充信息（200字以内）</p>
                        <textarea class="form-control" name="content" style="width:370px;height:150px;margin-top: 12px;"></textarea>
                    </div>
                    <div style="clear: both;position:relative;top:10px;">
                        <button type="submit" class="btn btn-success btn-md">提交信息</button>
                    </div>
                </form>