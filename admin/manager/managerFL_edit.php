<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\js\manager_header.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '..\..\home\base/header.php' ?>
        <?php include '..\..\home\base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("..\..\home\base\manager_header.php");

                $id=$_GET["id"];

                $sqlstr="select * from fl where id='$id'";

                $result=mysqli_query($conn,$sqlstr);

                while($myrow=mysqli_fetch_row($result)){
                    $id=$myrow[0];
                    $fl_name=$myrow[1];
                    $fl_price=$myrow[2];
                }

                
            ?>

            <form action="../../controller/adminHandle/addFL.php?option=edit" method="POST" style="margin-left: 50px;">
                <h3>修改辅料</h3>
                
                <input type="hidden" value="<?=$id?>" class="form-control" name="id">

                <div style="margin-top:10px;">
                    <p>辅料名称：</p>
                    <input type="text" value="<?=$fl_name?>" placeholder="请输入辅料名称" class="form-control" name="fl_name" style="width: 300px;margin-top:10px;" readOnly>
                </div>

                <div style="margin-top:10px;">
                    <p>辅料价格：</p>
                    <input type="text" value="<?=$fl_price?>" placeholder="请输入辅料价格" class="form-control" name="fl_price" style="width: 300px;margin-top:10px;">
                </div>
                                 
                <button type="submit" class="btn btn-success" style="margin-top:10px;">提交</button>                     
            </form>


            
        </div>
    </body>
</html>

