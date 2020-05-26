<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="css/header.css?v=2" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php");
                include_once("conn/conn.php");
            ?>

            <div class="nav nav-pills" style="float:left;margin-left:40px;">
                <li role="presentation"><a href="manager_process.php">辅料流程</a></li>
                <li role="presentation" class="active"><a href="#">授信流程</a></li>
                <button class="btn btn-success" style="float:left;margin-left:445px;margin-top:0px;"  data-toggle="modal" data-target="#myModal">添加流程</button>
            </div>

            <table class="table table-responsive table-bordered table-hover" style="clear:both;position:relative;top: 20px;width: 700px;margin-left: 40px;">
                <tr>
                    <th>标题</th>
                    <th>操作</th>
                </tr>
                <?php
                    $sqlstr1="select * from sxprogress_all";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        ?>
                            <tr>
                                <td><a href="sxProcess.php?id=<?=$myrow[0]?>&department=<?=$myrow[2]?>"><?=$myrow[1]?></a></td>
                                <td><a href="formHandle/adminHandle/delSXProcessTotal.php?id=<?=$myrow[0]?>">删除</a></td>
                            </tr>
                        <?php
                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>

            </table>
            
        </div>
        <!-- Excel导入模态框 -->
        <form method="POST" action="formHandle/adminHandle/addSXProcessTotal.php" enctype="multipart/form-data">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                添加流程
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 180px;">
                            <input type="text" name="no" value="2" class="form-control" style="width:250px;display:none"/>
                            <p style="font-weight: bold;">标题：</p><input type="text" class="form-control" name="name" placeholder="请输入标题" style="width:250px;"/>
                            <p style="font-weight: bold;margin-top:10px;">部门：</p><input type="text" name="department" class="form-control" placeholder="请输入部门" style="width:250px;"/>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>

<script>

</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>