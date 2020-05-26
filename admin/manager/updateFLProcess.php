<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php");?>
        <?php include '..\..\home\base\header.php' ?>
        <?php include '..\..\home\base\leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("..\..\home\base\manager_header.php");

                $id=$_GET["id"];

                $sqlstr1="select * from flprogress where id=$id";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $id=$myrow[0];
                    $number=$myrow[1];
                    $name=$myrow[2];
                    $sp=$myrow[3];
                    $cs=$myrow[4];
                    $department=$myrow[5];
                    $flprocess_id=$myrow[6];
                }

                mysqli_free_result($result);
                mysqli_close($conn);
            ?>
            
            <div class="nav nav-pills" style="float:left;margin-left:40px;">
                <li role="presentation" class="active"><a href="#">辅料流程</a></li>
            </div>
            
            <div style="clear: both;margin-left:40px;position: relative;top:20px;">
                <form method="POST" action="../../controller/adminHandle/alterFLProcess.php" enctype="multipart/form-data">

                    <input type="text" class="form-control" name="department" value="<?=$department?>"   style="width:250px;display: none;"/>
                    <input type="text" class="form-control" name="id" value="<?=$id?>"  style="width:250px;display: none;"/>
                    <input type="text" class="form-control" name="flprocess_id" value="<?=$flprocess_id?>"  style="width:250px;display: none;"/>
                    
                    <p style="font-weight: bold;">序号：</p><input type="text" value="<?=$number?>" class="form-control" name="number" placeholder="请输入序号" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">名称：</p><input type="text"   value="<?=$name?>" name="name" class="form-control" placeholder="请输入名称" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">审核人：</p><input type="text"  value="<?=$sp?>" name="sp" class="form-control" placeholder="请输入审核人" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">抄送人：</p><input type="text"  value="<?=$cs?>" name="cs" class="form-control" placeholder="请输入抄送人" style="width:250px;"/>

                    <div style="position: relative;top: 20px;">
                        <button type="submit" class="btn btn-success btn-sm">提交</button>    
                    </div>
                    
                </form>
            </div>
        </div>
    </body>
</html>