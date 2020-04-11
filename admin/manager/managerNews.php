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
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php")
            ?>

            <button class="btn btn-sm btn-success" style="margin-left: 670px;" id="createUser">新增公告</button>
            
            <table class="table table-responsive table-bordered table-hover" style="margin-top: 20px;width: 700px;margin-left: 40px;">
                <tr>
                    <th style="width:300px;">标题</th>
                    <th>发布者</th>
                    <th>发布时间</th>
                    <th style="width:150px;">操作</th>
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

                    $sqlstr2="select * from news  limit ".($page-1)*$pagesize.",$pagesize";
                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        
                    ?>
                    
                    <tr>
                        <td><?=$myrow[1]?></td>
                        <td><?=$myrow[3]?></td>
                        <td><?=$myrow[2]?></td>
                        <td>
                            <a href="news.php?id=<?=$myrow[0]?>">查看</a> |
                            <a href="managerAddContent.php?id=<?=$myrow[0]?>">修改</a> |
                            <a href="formHandle/adminHandle/delContent.php?id=<?=$myrow[0]?>">删除</a>
                        </td>
                    </tr>
                <?
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>
                
            </table>

            <div style="margin-left:40px;">
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

<script>
    $("#createUser").click(function(){
        window.location.href="managerAddContent.php"
    })
</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>