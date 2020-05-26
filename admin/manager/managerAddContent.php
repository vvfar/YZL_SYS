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
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../../home/base/header.php' ?>
        <?php include '../../home/base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("../../home/base/manager_header.php");

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                }else{
                    $id="";
                }

                if($id != ""){
                    $sqlstr="select * from news where id='$id'";
                    $result=mysqli_query($conn,$sqlstr);
                
                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $title=$myrow[1];
                        $content=$myrow[4];
                    }
                }else{
                    $id="";
                    $title="";
                    $content="";
                }
                
                mysqli_free_result($result);
                mysqli_close($conn);
            ?>


            <form method="post" action="../../controller/adminHandle/addContent.php" style="margin-left: 50px;margin-right: 50px;">
                <h4>新增公告</h4>

                <div style="margin-top:20px;">
                    <p>标题：</p>
                    <input type="text" name="title" value="<?=$title?>" class="form-control" style="width:900px;margin-top:10px;"/>
                    <input type="text" name="id" value="<?=$id?>" class="form-control hidden" style="width:800px;"/>
                </div>

                <div style="position: relative;top:15px;width: 900px;">
                    <p style="margin-bottom:10px;">正文：</p>
                    <textarea name="description" id="description" cols="10"/><?=$content?></textarea>
                </div>

                <div style="margin-top:40px;">
                    公告类型：
                    <select class="form-control" style="width:200px;margin-top:10px" name="newsType">
                        <option>公司公告</option>
                        <option>公司动态</option>
                    </select>
                </div>
                <button style="position: relative;top:10px;" class="btn btn-default">提交</button>
            </form>
        </div>
    </body>
</html>

<script>
    window.onload = function()
    {
        CKEDITOR.replace( 'description');
    };

    $("#createUser").click(function(){
        window.location.href="manager_userLine.php"
    })
</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>