<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_文件下载</title>
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
            <div style="position: relative;top: 30px;margin-left: 50px;">
                <h3 style="margin-bottom: 20px;">公告栏</h3>
                <hr>
                <table class="table table-responsive table-hover"  style="width: 850px;">
                    <tr>
                        <th style="width: 400px;">标题</th>
                        <th style="width: 150px;">发布者</th>
                        <th style="width: 150px;">日期</th>
                    </tr>
                    <?php
                        include_once("conn/conn.php");

                        //分页代码
                        if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                            $page=1;
                        }else{
                            $page=intval($_GET["page"]);
                        }

                        $pagesize=10;

                        $sqlstr1="select count(*) as total from news";
                        
                        $result=mysqli_query($conn,$sqlstr1);
                        $info=mysqli_fetch_array($result);
                        $total=$info['total'];

                        if($total%$pagesize==0){
                            $pagecount=intval($total/$pagesize);
                        }else{
                            $pagecount=ceil($total/$pagesize);
                        }

                        $sqlstr2="select * from news order by id desc";
                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            
                        ?>
                    <tr>
                        <td><a href="news.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                        <td><?=$myrow[2]?></td>
                        <td><?=$myrow[3]?></td>
                    </tr>
                        <?
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>
                
            </table>

            <div>
                <a href="<?php echo $_SERVER['PHP_SELF']?>">首页</a>
                <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                    if($page>1)
                        echo $page-1;
                    else
                        echo 1;  
                ?>">上一页</a>
                <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                    if($page<$pagecount)
                        echo $page+1;
                    else
                        echo $pagecount;  
                ?>">下一页</a>
                <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>">尾页</a>


            </div>



                      
                <table>
            </div>
        </div>

    </body>
</html>

<style>

</style>