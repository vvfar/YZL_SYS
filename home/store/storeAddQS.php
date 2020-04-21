<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_用户管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;">

            <ul class="breadcrumb" style="padding-left:30px;">
                <li><a href="dataStore.php">店铺信息</a></li>
                <li>每日数据</li>
            </ul>

            <?php
                
                $username=$_SESSION["username"];

                $sqlstr1="select department,newLevel from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $my_department=$myrow[0];
                    $newLevel=$myrow[1];
                }
                
                $id=$_GET['id'];
            
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
                    $createDate=$myrow[11];
                    $link=$myrow[13];
                    $staff_time=$myrow[14];
                    $htsq=$myrow[15];
                }
            ?>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-top:0px;margin-left:30px;">
                    <?php
                        if($newLevel == "M"){
                            ?>
                                <li role="presentation"><a href="newStore.php?id=<?=$id?>">店铺管理</a></li>
                            <?php
                        }else{
                            ?>
                                <li role="presentation"><a href="uploadStore.php">每日数据</a></li>
                                <li role="presentation" class="active"><a href="#">店铺问题</a></li>
                            <?php
                        }
                    ?> 
                </div>
            </div>

            <form action="../../controller/store/addStoreDataQS.php" method="POST" style="padding-top: 10px;margin-left:30px;clear: both;">                
                
                <div class="form-group" style="clear: both;margin-bottom:0px;display:none">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺编号</p>
                    <input type="text" class="form-control" name="storeID" value="<?=$storeID?>" readOnly style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">公司名称</p>
                    <input type="text" class="form-control" name="client" value="<?=$client?>" readOnly  style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺名称</p>
                    <input type="text" class="form-control" name="storeName" value="<?=$storeName?>" readOnly style="width: 200px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 100px;font-size: 14px;float: left;margin-top: 20px;">店铺问题</p>
                    <textarea class="form-control" rows="3" name="question" style="width: 500px;float: left;margin-top: 15px;"></textarea>
                </div>
                <div style="clear: both">
                    <button type="submit" class="btn btn-success btn-sm" style="margin-top: 20px;">提交数据</button>
                </div>
            </form>
        </div>
    </body>
</html>

<style>
    
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
</script>