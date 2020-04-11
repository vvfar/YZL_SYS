<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php");
                include_once("conn/conn.php");
            ?>

            <?php
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
                <form method="POST" action="formHandle/adminHandle/alterFLProcess.php" enctype="multipart/form-data">

                    <input type="text" class="form-control" name="department" value="<?=$department?>"   style="width:250px;display: none;"/>
                    <input type="text" class="form-control" name="id" value="<?=$id?>"  style="width:250px;display: none;"/>
                    <input type="text" class="form-control" name="flprocess_id" value="<?=$flprocess_id?>"  style="width:250px;display: none;"/>
                    
                    <p style="font-weight: bold;">序号：</p><input type="text" value="<?=$number?>" class="form-control" name="number" placeholder="请输入序号" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">名称：</p><input type="text"   value="<?=$name?>" name="name" class="form-control" placeholder="请输入名称" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">审核人：</p><input type="text"  value="<?=$sp?>" name="sp" class="form-control" placeholder="请输入审核人" style="width:250px;"/>
                    <p style="font-weight: bold;margin-top:10px;">抄送人：</p><input type="text"  value="<?=$cs?>" name="cs" class="form-control" placeholder="请输入抄送人" style="width:250px;"/>

                    <div style="position: relative;top: 20px;">
                        <button type="submit" class="btn btn-primary">提交</button>    
                    </div>
                    
                </form>
            </div>
        </div>
    </body>
</html>

<script>
   

</script>

<style>

</style>