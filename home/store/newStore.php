<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_用户管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <!-- [if lt IE 9]>
            <script src="flotr2/excanvas.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include_once("conn/conn.php");

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $title="店铺修改";
                }else{
                    $id="";
                    $title="新增店铺";
                }

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
                        $createDate=$myrow[10];
                        $link=$myrow[12];
                        $staff_time=$myrow[13];
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
                    $createDate="";
                    $link="";
                    $staff_time="";
                }


                
            ?>

            <ul class="breadcrumb" style="padding-left:50px;">
                <li><a href="/dataStore.php">店铺信息</a></li>
                <li><a href="/manStore.php">店铺管理</a></li>
                <li active><?=$title?></li>
            </ul>

            <div style="clear: both;border-radius: 6px;">
                <div class="nav nav-pills" style="float:left;margin-top:0px;margin-left:50px;">
                    <li role="presentation"><a href="/uploadStore.php?id=<?=$id?>">每日数据</a></li>
                    <li role="presentation" class="active"><a href="#"><?=$title?></a></li>
                </div>
            </div>


            <form action="formHandle/addStore.php" method="POST" style="padding-top: 10px;margin-left:55px;clear: both;">                
                <div>
                    <h4 style="float: left">店铺信息</h4>
                    <p style="float: left;margin-left: 270px;margin-top: 10px;"><a href="managerStaff.php">返回</a></p>
                </div>
                
                <div class="form-group" style="clear: both;margin-bottom:0px;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺编号</p>
                    <input type="text" class="form-control" name="storeID" value="<?=$storeID?>" placeholder="请输入店铺编号" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">客户名称</p>
                    <input type="text" class="form-control" name="client" value="<?=$client?>" placeholder="请输入客户名称" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺名称</p>
                    <input type="text" class="form-control" name="storeName" value="<?=$storeName?>" placeholder="请输入店铺名称" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">平台</p>
                    <input type="text" class="form-control" name="pingtai" value="<?=$pingtai?>" placeholder="请输入平台" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">类目</p>
                    <input type="text" class="form-control" name="category" value="<?=$category?>" placeholder="请输入类目" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺链接</p>
                    <input type="text" class="form-control" name="link" value="<?=$link?>" placeholder="请输入店铺链接" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺成立时间</p>
                    <input type="text" class="form-control" name="createDate" value="<?=$createDate?>" style="width: 250px;float: left;margin-top: 15px;" readOnly>
                    <p style="font-size:12px;float: left;margin-top: 25px;margin-left:20px;color:red">*新店6个月不能调拨</p>
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺归属时间</p>
                    <input type="text" class="form-control" name="staff_time" value="<?=$staff_time?>" style="width: 250px;float: left;margin-top: 15px;" readOnly>
                    <p style="font-size:12px;float: left;margin-top: 25px;margin-left:20px;color:red">*老店3个月不能调拨</p>
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">店铺归属人</p>
                    <select class="form-control" style="width:250px;position:relative;top: 15px;" name="staff">
                        <?php
                            $sqlstr1="select username from user_form where department='$department'";

                            $result=mysqli_query($conn,$sqlstr1);
                    
                            while($myrow=mysqli_fetch_row($result)){
                                if($staff==$myrow[0]){
                                    ?>
                                        <option selected><?=$myrow[0]?></option>
                                    <?php
                                }else{
                                    ?>
                                        <option><?=$myrow[0]?></option>
                                    <?php
                                }
                                
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);
                        ?>
                    </select>
                </div>
                <input type="hidden" name="oldStaff" value="<?=$staff?>"/>

                
                <div style="clear: both">
                    <button type="submit" class="btn btn-success btn-md" style="margin-top: 20px;position:relative;left:250px;">提交</button>
                    <a type="button" href="/closeStore.php?id=<?=$id?>" class="btn btn-danger btn-md" style="margin-top: 20px;position:relative;left:260px;">关店</a>
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