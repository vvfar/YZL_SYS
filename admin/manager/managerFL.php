<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\js\manager_header.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '..\..\home\base/header.php' ?>
        <?php include '..\..\home\base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("..\..\home\base\manager_header.php")
            ?>

            <div style="width:1040px">
                <button class="btn btn-sm btn-success" style="float:right" id="createFL" data-toggle="modal" data-target="#myModal">添加辅料</button>
            </div>

            <table class="table table-responsive table-bordered table-hover" style="width: 1000px;margin-left: 40px;margin-top:70px;">
                <tr>
                    <th>序号</th>
                    <th>辅料名称</th>
                    <th>辅料单价</th>
                    <th>操作</th>
                </tr>
                <?php
                    $count=0;

                    //分页代码
                    if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                        $page=1;
                    }else{
                        $page=intval($_GET["page"]);
                    }

                    $pagesize=10;

                    $sqlstr1="select count(*) as total from fl";
                    
                    $result=mysqli_query($conn,$sqlstr1);
                    $info=mysqli_fetch_array($result);
                    $total=$info['total'];

                    if($total%$pagesize==0){
                        $pagecount=intval($total/$pagesize);
                    }else{
                        $pagecount=ceil($total/$pagesize);
                    }

                    $sqlstr2="select * from fl limit ".($page-1)*$pagesize.",$pagesize";
                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        $countF=($page-1)*$pagesize;
                        $count=$count +1;
                    ?>
                    <tr>
                        <td style="width:100px;"><?=$count+$countF?></td>
                        <td><?=$myrow[1]?></td>
                        <td><?=$myrow[2]?></td>
                        <td style="width:150px;">
                            <a href="managerFL_edit.php?id=<?=$myrow[0]?>">修改</a>
                            <span> | </span>
                            <a href="../../controller/adminHandle/addFL.php?option=delete&id=<?=$myrow[0]?>">删除</a>
                        </td>
                    </tr>
                    <?php
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

        <!-- Excel导入模态框 -->
        <form action="../../controller/adminHandle/addFL.php?option='add'" method="POST" style="margin-left: 50px;">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width:400px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                添加辅料
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 200px;">
                            <div>
                                <p>辅料名称：</p>
                                <input type="text" placeholder="请输入辅料名称" class="form-control" name="fl_name" style="width: 300px;margin-top:10px;">
                            </div>

                            <div style="margin-top:10px;">
                                <p>辅料价格：</p>
                                <input type="text" placeholder="请输入辅料价格" class="form-control" name="fl_price" style="width: 300px;margin-top:15px;">
                            </div>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">新增辅料</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>

