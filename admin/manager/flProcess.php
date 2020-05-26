<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_后台管理</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../../home/base/header.php' ?>
        <?php include '../../home/base/leftBar.php' ?>

        <div style="margin-left: 180px;">
            <?php
                include("../../home/base/manager_header.php");
            ?>

            <div class="nav nav-pills" style="float:left;margin-left:40px;">
                <li role="presentation" class="active"><a href="#">辅料流程</a></li>
            </div>
            
            <button class="btn btn-success" style="float:left;margin-left:800px;margin-top:0px;"  data-toggle="modal" data-target="#myModal">添加节点</button>
            
            <div style="clear:both">
                <?php
                    $id=$_GET["id"];
                    $department2=$_GET["department"];
                    $sqlstr1="select distinct department,flprogress_id from flprogress where flprogress_id=$id";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                    ?>
                
                <?php
                    }

                    $flprogress_id=$id;
                ?>

                <p style="position:relative;top:35px;margin-left:45px;">部门：<?=$department2?></p>
                
                
                <canvas id="myCanvas" width="1000px" height="200" style="clear:both;margin-left:40px;margin-top:0px;border:1px solid #cccccc;">
                    您的浏览器不支持 HTML5 canvas 标签。
                </canvas>
            </div>
            
            <table class="table table-responsive table-bordered table-hover" style="clear:both;position:relative;top: 20px;width: 1000px;margin-left: 40px;">
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>审核人</th>
                    <th>抄送人</th>
                    <th>操作</th>
                </tr>
                <?php
                    

                    $sqlstr1="select * from flprogress where flprogress_id=$id order by number";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        ?>
                            <tr>
                                <td><?=$myrow[1]?></td>
                                <td><?=$myrow[2]?></td>
                                <td><?=$myrow[3]?></td>
                                <td><?=$myrow[4]?></td>
                                <td><a href="updateFLProcess.php?id=<?=$myrow[0]?>">修改</a> | <a href="formHandle/delFLProcess.php?id=<?=$myrow[0]?>&number=<?=$myrow[1]?>&flprogress_id=<?=$myrow[6]?>&department=<?=$department2?>">删除</a></td>
                            </tr>
                        <?php
                    }


                ?>
                
            </table>
        </div>

         <!-- Excel导入模态框 -->
         <form method="POST" action="formHandle/addFLProcess.php" enctype="multipart/form-data">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                添加节点
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 320px;">
                        
                            <input type="text" class="form-control" name="flprogress_id" value="<?=$flprogress_id?>"   style="width:250px;display: none;"/>
                            <input type="text" class="form-control" name="department" value="<?=$department2?>"   style="width:250px;display: none;"/>
                            <input type="text" class="form-control" name="id" value="<?=$id?>"  style="width:250px;display: none;"/>

                            <p style="font-weight: bold;">序号(如在中间插入，之后的流程后移)：</p><input type="text" class="form-control" name="number" placeholder="请输入序号" style="width:250px;"/>
                            <p style="font-weight: bold;margin-top:10px;">名称：</p><input type="text" name="name" class="form-control" placeholder="请输入名称" style="width:250px;"/>
                            <p style="font-weight: bold;margin-top:10px;">审核人：</p><input type="text" name="sp" class="form-control" placeholder="请输入审核人" style="width:250px;"/>
                            <p style="font-weight: bold;margin-top:10px;">抄送人：</p><input type="text" name="cs" class="form-control" placeholder="请输入抄送人" style="width:250px;"/>
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
    var arr=[
    
    <?php
        $str="";

        $sqlstr1="select name from flprogress where flprogress_id=$id order by number";

        $result=mysqli_query($conn,$sqlstr1);

        while($myrow=mysqli_fetch_row($result)){
            $str=$str."'".$myrow[0]."'".",";   
        }

        $str=substr($str,0,-1);

        echo $str;

        mysqli_free_result($result);
        mysqli_close($conn);
    ?>

    ]

    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    
    ctx.beginPath();
    
    for(i=0;i<arr.length;i++){

        //画框1
        ctx.fillStyle = "purple";
        ctx.moveTo(5+145*i,50);
        ctx.lineTo(100+145*i,50);
        ctx.lineTo(100+145*i,70);
        ctx.lineTo(5+145*i,70);
        ctx.lineTo(5+145*i,50);

        ctx.font="11px Arial";
        ctx.fillText("序号" + (i+1).toString() ,13+145*i,65);


        //画框2
        ctx.moveTo(5+145*i,70);
        ctx.lineTo(100+145*i,70);
        ctx.lineTo(100+145*i,130);
        ctx.lineTo(5+145*i,130);
        ctx.lineTo(5+145*i,70);

        if(i<arr.length-1){

            ctx.moveTo(100+145*i,90);
            ctx.lineTo(150+145*i,90);
            ctx.moveTo(140+145*i,85);
            ctx.lineTo(150+145*i,90);
            ctx.moveTo(140+145*i,95);
            ctx.lineTo(150+145*i,90);

        }

  
        ctx.font="12px Arial";
        ctx.fillText(arr[i],13+145*i,105);
    }

    ctx.stroke();

</script>

<style>
    th{
        background-color: #f5f2f2;
    }
</style>