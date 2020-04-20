<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_用户管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php

                $id=$_GET['id'];
                $title="店铺关店";

                if($id != ""){
                    $sqlstr="select * from store where id='$id'";
                    $result=mysqli_query($conn,$sqlstr);
                
                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $storeID=$myrow[1];
                        $client=$myrow[2];
                        $storeName=$myrow[3];
                        $pingtai=$myrow[4];
                        $category=$myrow[5];
                        $department=$myrow[6];
                        $staff=$myrow[7];
                        $storeTarget=$myrow[8];
                    }
                }else{
                    $id="";
                    $storeID="";
                    $client="";
                    $storeName="";
                    $pingtai="";
                    $category=""; 
                    $department="";
                    $staff="";
                    $storeTarget="";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                
            ?>

            <ul class="breadcrumb" style="padding-left:50px;">
                <li><a href="/dataStore.php">店铺信息</a></li>
                <li><a href="/manStore.php">店铺管理</a></li>
                <li active><?=$title?></li>
            </ul>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-top:0px;margin-left:50px;">
                    <li role="presentation" class="active"><a href="#"><?=$title?></a></li>
                </div>
            </div>


            <form action="../../controller/store/closeStoreHandle.php" method="POST" style="padding-top: 10px;margin-left:55px;clear: both;">                
                
                <div class="form-group" style="clear: both;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="margin-top:10px;">
                    <p style="margin-top:5px;">店铺编号：<?=$storeID?></p>
                    <p style="margin-top:5px;">客户名称：<?=$client?></p>
                    <p style="margin-top:5px;">店铺名称：<?=$storeName?></p>
                    <p style="margin-top:5px;">平台:<?=$pingtai?></p>
                    <p style="margin-top:5px;">类目:<?=$category?></p>
                </div>
                <div class="form-group">
                    <p>关店原因（最多输入100个字）</p>
                    <textarea style="width:370px;height:100px;margin-top:5px;" name="reason"></textarea>
                </div>
                <div style="clear: both">
                    <button type="submit" class="btn btn-success btn-md">关闭店铺</button>
                </div>
            </form>
        </div>
    </body>
</html>

<style>
    .breadcrumb a{
        color:#333;
    }

    .breadcrumb a:hover{
        color:#333;
        text-decoration: underline;
    }
</style>