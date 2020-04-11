<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <script src="/../public/js/header.js"></script>
    </head>

    <body>
        <div class="header_bar">
            <div class="logo" style="position: fixed">
                <p>俞兆林数据平台</p>
            </div>

            <div class="headerBar">
                <?php
                
                    session_start();
                    if(isset($_SESSION['username'])){
                        $username=$_SESSION['username'];
                        $sqlstr1="select headImg from user_form where username='$username'";
                        $result=mysqli_query($conn,$sqlstr1);

                        while($myrow=mysqli_fetch_row($result)){
                            $headerImg=$myrow[0];
                        }
                                
                    ?>

                    <div class="headerImg"><img src="/common/file/user_icon/<?=$headerImg?>" width="100%" height="100%" style="border-radius:100%; overflow:hidden;"/></div>
                    <div class="userInfo">
                        <p style="font-size: 1.2em;"><span id="time"></span><?=$_SESSION['username']?></p>
                    </div>
                    
                    <?php
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
            </div>

            <div class="rightIcon">
                <img src="/public/img/index_icon1.png"/>
                <span>|</span>
                <img src="/public/img/index_icon2.png"/>
                <span>|</span>
                <img src="/public/img/index_icon3.png"/>
                <span>|</span>
                <img src="/public/img/index_icon4.png"/>
            </div>
        </div>
    </body>
</html>