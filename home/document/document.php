<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_文件下载</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px;">
            <div style="position: relative;top: 30px;margin-left: 50px;">
                <p style="margin-bottom: 20px;font-size:16px">文件下载</p>
                <table class="table table-responsive table-hover table-bordered "  style="width: 850px;">
                    <tr style="background-color:#f7f7f7">
                        <th style="width: 400px;">标题</th>
                        <th style="width: 150px;">发布者</th>
                        <th style="width: 150px;">日期</th>
                        <th style="width: 150px;">下载链接</th>
                    </tr>
                    <?php
                        

                        //分页代码
                        if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                            $page=1;
                        }else{
                            $page=intval($_GET["page"]);
                        }

                        $pagesize=10;

                        if(isset($_GET['learning'])){
                            $sqlstr1="select count(*) as total from files where note='培训文档'";
                        }else{
                            $sqlstr1="select count(*) as total from files";
                        }

                        
                        
                        $result=mysqli_query($conn,$sqlstr1);
                        $info=mysqli_fetch_array($result);
                        $total=$info['total'];

                        if($total%$pagesize==0){
                            $pagecount=intval($total/$pagesize);
                        }else{
                            $pagecount=ceil($total/$pagesize);
                        }

                        if(isset($_GET['learning'])){
                            $sqlstr2="select * from files where note='培训文档'";
                        }else{
                            $sqlstr2="select * from files";
                        }

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            
                        ?>
                    <tr>
                        <td><?=$myrow[1]?></td>
                        <td><?=$myrow[3]?></td>
                        <td><?=$myrow[4]?></td>
                        <td><a href="../../common/file/myfile/<?=$myrow[2]?>">点击下载</a></td>
                    </tr>
                        <?php
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
        </div>
    </body>
</html>