<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_登陆网站</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="../../../public/lib/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="../../../public/lib/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
        <?php
            include_once("../../../common/conn/conn.php");
            
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


        <div data-role="header" data-theme="b" data-position="fixed">
            <a href="#" data-role="button" data-icon="back" data-rel="back">后退</a>
            <h1>俞兆林__辅料单查询</h1>
            
            <a href="#"><?=$username?></a>
        </div>

        <form class="ui-filterable">
            <input id="myFilter3" data-type="search" placeholder="根据公司名称搜索..">
        </form>

        <div data-role="content">
            <ul data-role="listview" data-filter="true" data-input="#myFilter3" data-theme="g">

            <?php
                $sqlstr="select company,count(company) from flsqd group by company union all select company,count(company) from oldflsqd group by company";

                $result=mysqli_query($conn,$sqlstr);

                while($myrow=mysqli_fetch_row($result)){
                    
                    $company=$myrow[0];
                    $count=$myrow[1];
                    
                    ?>
                        <li><a href="companyDetails.php?companyName=<?=$company?>"  data-ajax="false"><?=$company?></a><span class="ui-li-count" style="padding-right: 6px;right: 40px;"><?=$count?></span></li>
                    <?php

                }
            ?>
            
            
            
            
            </ul>
        </div>

        <div data-role="footer" data-theme="b" data-position="fixed">
            <nav data-role="navbar">
                <ul>
                    <li><a href="#" onclick="alert('暂未开放，请在PC端填写单据！')">新增辅料单</a></li>
                    <li><a href="flList.php">未完成辅料</a></li>
                    <li><a href="../index.php">主菜单</a></li>
                    <li><a href="flDone.php">已完成辅料</a></li>
                    <li><a href="#" class="ui-btn-active">辅料单查询</a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>

<style>
    .ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head+body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head+body .ui-btn.ui-btn-a:visited{
        text-shadow: none;
    }

</style>