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
        <script src="lib\flotr2\flotr2.min.js"></script>
        <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
        <!-- [if lt IE 9]>
            <script src="flotr2/excanvas.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php")
            ?>

            <?php
                include_once("conn/conn.php");

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


            <form method="post" action="formHandle/adminHandle/addContent.php" style="margin-left: 50px;margin-right: 50px;">
                <h4>新增公告</h4>

                <input type="text" name="title" value="<?=$title?>" class="form-control" style="width:300px;"/>
                <input type="text" name="id" value="<?=$id?>" class="form-control hidden" style="width:300px;"/>

                <div style="position: relative;top:30px;width: 900px;">
                    <textarea name="description" id="description" cols="10"/><?=$content?></textarea>
                </div>
                <button style="position: relative;top:60px;" class="btn btn-default">提交</button>
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