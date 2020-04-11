<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_新闻公告</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">

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
                        $time=$myrow[2];
                        $person=$myrow[3];
                        $content=$myrow[4];
                    }
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                
            ?>
            
            <div style="margin-top: 30px;margin-left:55px;">
                <h3 style="float: left;"><?=$title?></h3>
                <a style="float: left;margin-left: 920px;margin-top: 20px;" href="allNews.php">返回</a>

                <div style="clear: both">
                    <div style="border:1px solid #cccccc;border-radius: 5px;width: 1000px;padding: 10px;position: relative;top:25px;">
                        <p><?=$content?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>