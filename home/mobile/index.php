<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_登陆网站</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="../lib\bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="../lib\bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <div data-role="header" data-theme="b" data-position="fixed">
            <a href="#" data-role="button" id="logout">退出</a>
            <h1>手机版——首页</h1>
            <?php
                include_once("../conn/conn.php");
                session_start();
                if(isset($_SESSION["username"])){
                    $username=$_SESSION["username"];
    
                    $sqlstr1="select department,level from user_form where username='$username'";
        
                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                        $level=$myrow[1];
                    }
                }else{
                    echo("<script>alert('请先登录！');window.location.href='../login.php'</script>");
                }
            ?>
            
            <a href="#"><?=$username?></a>
        </div>

        <div data-role="content">
            <img src="../img/timg.jpg" style="width:100%;margin-bottom:20px;">

            <div class="ui-grid-b">
                <div class="ui-block-a"><a href="flsq/flList.php" data-role="button" data-icon="home" data-iconpos="top">辅料申请</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-icon="grid" data-iconpos="top">公司授信</a></div>
                <div class="ui-block-c"><a href="#" data-role="button" data-icon="star" data-iconpos="top">店铺合同</a></div>
                <div class="ui-block-a"><a href="#" data-role="button" data-icon="info" data-iconpos="top">电脑设备</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-icon="search" data-iconpos="top">数据统计</a></div>
                <div class="ui-block-c"><a href="#" data-role="button" data-icon="gear" data-iconpos="top">订会议室</a></div>
                <div class="ui-block-a"><a href="#" data-role="button" data-icon="check" data-iconpos="top">个人中心</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-icon="alert" data-iconpos="top">文件下载</a></div>
                <div class="ui-block-c"><a href="#" data-role="button" data-icon="plus" data-iconpos="top">我的消息</a></div>
            </div>
        </div>

        <div data-role="footer" data-theme="b" data-position="fixed">
            <h1>俞兆林数据中心</h1>
        </div>
    </body>
</html>

<script>

    $(".reset").click(function(){
        alert("请联系数据中心！")
    })

    $("#logout").click(function(){
        window.location.href="../formHandle/account/logoutHandle.php"; 
    })
</script>

<style>
    .ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head+body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head+body .ui-btn.ui-btn-a:visited{
        text-shadow: none;
    }

</style>