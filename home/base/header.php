<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <script src="/../public/js/header.js"></script>
    </head>

    <body>
        <?php         
            session_start();
            
            if(isset($_SESSION['username'])){
                $username=$_SESSION['username'];
                $sqlstr1="select headImg from user_form where username='$username'";
                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $headerImg=$myrow[0];
                }
            }else{
                ?>
                    <script>
                        var path = window.location.pathname;

                        if (path != "/login.php"){
                            window.location.href="/admin/login/login.php";
                        } 
                    </script>
                <?php    
            }        
        ?>
        <div class="header_bar">
            <div class="logo" style="position: fixed">
                <p>俞兆林数据平台</p>
            </div>

            <div style="float:left;height:40px">
                <a href="/index.php" target="_blank" title="主页" style="text-decoration: none;"><i class="layui-icon layui-icon-home" style="margin-left:220px;line-height:40px;vertical-align: middle;"></i></a>

                <a href="http://www.yzl.com.cn" target="_blank" title="官网" style="text-decoration: none;"><i class="layui-icon layui-icon-website" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
                <a href="" layadmin-event="refresh" title="刷新" style="text-decoration: none;"><i class="layui-icon layui-icon-refresh-3" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
                <a href="../../controller/account/logoutHandle.php" target="_blank" title="退出" style="text-decoration: none;"><i class="layui-icon layui-icon-logout" style="margin-left:20px;line-height:40px;vertical-align: middle;"></i></a>
            </div>

            <div class="headerBar">
                <div class="headerImg"><img src="/common/file/user_icon/<?=$headerImg?>" width="100%" height="100%" style="border-radius:100%; overflow:hidden;"/></div>
                
                <div class="userInfo">
                    <p><span id="time"></span><?=$_SESSION['username']?></p>
                </div>
            </div>
        </div>
    </body>
</html>