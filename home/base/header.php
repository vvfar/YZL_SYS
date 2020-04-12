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

            <div class="headerBar">
                <div class="headerImg"><img src="/common/file/user_icon/<?=$headerImg?>" width="100%" height="100%" style="border-radius:100%; overflow:hidden;"/></div>
                
                <div class="userInfo">
                    <p><span id="time"></span><?=$_SESSION['username']?></p>
                </div>
            </div>
        </div>
    </body>
</html>