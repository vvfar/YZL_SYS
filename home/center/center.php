<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_个人中心</title>
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

        <div style="margin-left: 180px;margin-top:20px">
            <div style="margin-left: 40px;">

                <?php

                    if(isset($_SESSION['username'])){

                        $username=$_SESSION["username"];

                        $sqlstr1="select username,department,level,phone,email,nickname from user_form where username='$username'";

                        $result=mysqli_query($conn,$sqlstr1);
                
                        while($myrow=mysqli_fetch_row($result)){
                            $username=$myrow[0];
                            $department=$myrow[1];
                            $level=$myrow[2];
                            $phone=$myrow[3];
                            $email=$myrow[4];
                            $nickname=$myrow[5];
                        }

                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>

                <h3 style="float: left;margin-bottom: 20px;">我的资料</h3>

                <div style="float: left;width:150px;height:60px;border:1px solid #cccccc;margin-left:900px;padding:5px;display:none">
                    <div style="float: left">
                        <button class="btn btn-lg btn-danger">签到</button>
                    </div>
                    <div style="float: left;margin-left: 15px;">
                        <p style="margin:0">9月11日</p>
                        <p style="margin-top:5px;color:#999999">满签1天</p>
                    </div>
                </div>

                <div style="clear: both" class="my_nav">
                    <ul>
                        <li class="nav_h" style="border-bottom: 2px solid red;" id="info">基本资料</li>
                        <li id="pwd">修改密码</li>
                        <li id="head">修改头像</li>
                    </ul>
                </div>

                <div style="clear: both;position:relative;top:30px;width:950px;height:400px;font-size: 14px;border:1px solid #cccccc;padding:20px;border-radius: 5px;">
                    <div id="page1">
                        <p style="font-weight: bold;margin-bottom:15px;">个人信息</p>
                        <p>用户名：<?=$username?></p>
                        <div>
                            <p style="float:left;margin-top:5px;">昵称：<span id="nickname"><?=$nickname?></span></p>
                            <p style="cursor:pointer;color:#337ab7;float: left;margin-left:15px;font-size:14px;margin-top:5px;" id="nickname_link">点击修改</p>
                            <form action="formHandle/centerHandle.php" method="POST" class="form_nickname" style="display:none">
                                <input type="text" class="form-control" style="width:200px;float:left" name="nickname">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;margin-left:15px;margin-top:2px;">提交</button>
                                <button type="button" class="btn btn-info btn-sm" style="float:left;margin-left:15px;margin-top:2px;" id="back1">返回</button>
                            </form>
                        </div> 
                        <div style="clear: both;">    
                            <p style="margin-top:30px;">事业部：<?=$department?></p>
                            <p style="margin-top:5px;">职位：<?=$level?></p>
                        </div>
                        <div>
                            <p style="float:left;margin-top:5px;">手机号：<span id="phone"><?=$phone?></span></p>
                            <p style="cursor:pointer;float: left;margin-left:15px;font-size:14px;margin-top:5px;color:#337ab7" id="phone_link">点击修改</p>
                            <form action="formHandle/centerHandle.php" method="POST" class="form_phone" style="display:none">
                                <input type="text" class="form-control" style="width:200px;float:left" name="phone">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;margin-left:15px;margin-top:2px;">提交</button>
                                <button type="button" class="btn btn-info btn-sm" style="float:left;margin-left:15px;margin-top:2px;" id="back2">返回</button>
                            </form>
                        </div>
                        <div style="clear: both">
                            <p style="float:left">邮箱：<span id="email"><?=$email?></span></p>
                            <p style="cursor:pointer;float: left;margin-left:15px;font-size:14px;color:#337ab7" id="email_link">点击修改</p>
                            <form action="formHandle/centerHandle.php" method="POST" class="form_email" style="display:none">
                                <input type="text" class="form-control" style="width:200px;float:left" name="email">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;margin-left:15px;margin-top:2px;">提交</button>
                                <button type="button" class="btn btn-info btn-sm" style="float:left;margin-left:15px;margin-top:2px;" id="back3">返回</button>
                            </form>
                        </div>
                    </div>
                    <div id="page2" style="display: none">
                        <p style="font-weight: bold">密码修改</p>
                        <form method="POST" action="formHandle/centerHandle2.php">
                            <div class="form-group">
                                新密码：<input type="password" name="newPwd1" class="form-control" style="width:200px;"/>
                                <p style="font-size: 12px;color:red;margin-top:10px;">密码必须6-18位</p>
                                确认密码：<input type="password" name="newPwd2" class="form-control" style="width:200px;"/>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">提交</button>
                        </form>
                    </div>
                    <div id="page3" style="display: none">
                        <p style="font-weight: bold">修改头像</p>
                        <form method="POST" action="formHandle/centerHandle3.php" enctype="multipart/form-data">
                            <div class="form-group" style="font-size:14px;">
                                <p>上传头像</p>
                                <input type="file" name="upfile"/>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">提交</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    .nav_h{
        border-bottom: 2px solid red;
    }

    .table-hover{
        background-color: aqua;
    }

    .my_nav ul{
        list-style: none;
        padding: 0;
        margin-left: 0;
    }

    .my_nav ul li{
        font-size: 14px;
        float: left;
        width:150px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        vertical-align: middle;
        border-bottom: 1px  solid #cccccc;
    }

    .my_nav ul li:hover{
        border-bottom: 2px solid red;
        cursor: pointer;
    }

    #nickname_link:hover{
        text-decoration: underline;
    }

    #phone_link:hover{
        text-decoration: underline;
    }

    #email_link:hover{
        text-decoration: underline;
    }
</style>

<script>
    $("#info").click(function(){
        $(this).siblings().css("border-bottom","1px  solid #cccccc")
        $(this).css("border-bottom","2px solid red")
        $("#page1").css("display","inline")
        $("#page2").css("display","none")
        $("#page3").css("display","none")
    })

    $("#pwd").click(function(){
        $(this).siblings().css("border-bottom","1px  solid #cccccc")
        $(this).css("border-bottom","2px solid red")
        $("#page2").css("display","inline")
        $("#page1").css("display","none")
        $("#page3").css("display","none")
    })

    $("#head").click(function(){
        $(this).siblings().css("border-bottom","1px  solid #cccccc")
        $(this).css("border-bottom","2px solid red")
        $("#page3").css("display","inline")
        $("#page1").css("display","none")
        $("#page2").css("display","none")
    })

    $("#nickname_link").click(function(){
        $("#nickname").css("display","none")
        $("#nickname_link").css("display","none")
        $(".form_nickname").css("display","inline")
    })

    $("#back1").click(function(){
        $("#nickname").css("display","inline")
        $("#nickname_link").css("display","inline")
        $(".form_nickname").css("display","none")
    })

    $("#phone_link").click(function(){
        $("#phone").css("display","none")
        $("#phone_link").css("display","none")
        $(".form_phone").css("display","inline")
    })

    $("#back2").click(function(){
        $("#phone").css("display","inline")
        $("#phone_link").css("display","inline")
        $(".form_phone").css("display","none")
    })

    $("#email_link").click(function(){
        $("#email").css("display","none")
        $("#email_link").css("display","none")
        $(".form_email").css("display","inline")
    })

    $("#back3").click(function(){
        $("#email").css("display","inline")
        $("#email_link").css("display","inline")
        $(".form_email").css("display","none")
    })
</script>