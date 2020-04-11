<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据统计</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <div class="nav nav-pills" style="float:left;margin-left:30px;position:relative;top:20px;">
                <li role="presentation"><a href="data.php?month=">当月实时数据图表</a></li>
                <li role="presentation"><a href="form.php">日数据报表</a></li>
                <li role="presentation"><a href="sumDayData.php">合计数据报表</a></li>
                <li role="presentation"><a href="#">BI数据可视化报表</a></li>
            </div>
            <?php
                include_once("conn/conn.php");

                if(isset($_GET['id']) && $_GET['id']!=""){
                    $id=$_GET['id'];
                
                    $sqlstr2="select * from day_data where id='$id'";

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $storeID=$myrow[1];
                        $clientName=$myrow[2];
                        $storeName=$myrow[3];
                        $pingtai=$myrow[4];
                        $category=$myrow[5];
                        $department=$myrow[6];
                        $ywy=$myrow[7];
                        $salesMoney=$myrow[8];
                        $salesNum=$myrow[9];
                        $lbts=$myrow[10];
                        $fwf=$myrow[11];
                        $fwfhk=$myrow[12];
                        $fwfsx=$myrow[13];
                        $flf=$myrow[14];
                        $flfhk=$myrow[15];
                        $flfsx=$myrow[16];
                        $date=$myrow[17];             
                    }
                }else{
                    $id="";
                    $storeID="";
                    $clientName="";
                    $storeName="";
                    $pingtai="";
                    $category="";
                    $department="";
                    $ywy="";
                    $salesMoney="";
                    $salesNum="";
                    $lbts="";
                    $fwf="";
                    $fwfhk="";
                    $fwfsx="";
                    $flf="";
                    $flfhk="";
                    $flfsx="";
                    $date=""; 
                }

                mysqli_free_result($result);
                mysqli_close($conn);
            ?>

            <form method="POST" action="formHandle/dayDataHandle.php" style="clear:both;position:relative;top:30px;margin-left:50px;">
                <div class="form-group hidden" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">店铺编号</p>
                    <input type="text" class="form-control" name="storeID" value="<?=$storeID?>" placeholder="请输入店铺编号" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">客户名称</p>
                    <input type="text" class="form-control" name="clientName" value="<?=$clientName?>" placeholder="请输入客户名称" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">店铺名称</p>
                    <input type="text" class="form-control" name="storeName" value="<?=$storeName?>" placeholder="请输入客户名称" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">平台</p>
                    <input type="text" class="form-control" name="pingtai" value="<?=$pingtai?>" placeholder="请输入平台" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权类目</p>
                    <input type="text" class="form-control" name="category" value="<?=$category?>" placeholder="请输入授权类目" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">事业部</p>
                    <input type="text" class="form-control" name="department" value="<?=$department?>" placeholder="请输入事业部" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">业务员</p>
                    <input type="text" class="form-control" name="ywy" value="<?=$ywy?>" placeholder="请输入业务员" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">销售额</p>
                    <input type="text" class="form-control" name="salesMoney" value="<?=$salesMoney?>" placeholder="请输入销售额" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">销量</p>
                    <input type="text" class="form-control" name="salesNum" value="<?=$salesNum?>" placeholder="请输入销量" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">领标套数</p>
                    <input type="text" class="form-control" name="lbts" value="<?=$lbts?>" placeholder="请输入领标套数" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">服务费</p>
                    <input type="text" class="form-control" name="fwf" value="<?=$fwf?>" placeholder="请输入服务费" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">服务费回款</p>
                    <input type="text" class="form-control" name="fwfhk" value="<?=$fwfhk?>" placeholder="请输入服务费回款" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">服务费授信</p>
                    <input type="text" class="form-control" name="fwfsx" value="<?=$fwfsx?>" placeholder="请输入服务费授信" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">辅料费</p>
                    <input type="text" class="form-control" name="flf" value="<?=$flf?>" placeholder="请输入辅料费" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">辅料费回款</p>
                    <input type="text" class="form-control" name="flfhk" value="<?=$flfhk?>" placeholder="请输入辅料费回款" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">辅料费授信</p>
                    <input type="text" class="form-control" name="flfsx" value="<?=$flfsx?>" placeholder="请输入辅料费授信" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">日期</p>
                    <div style="width: 250px;font-size: 14px;float: left;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" name="date" size="16" type="text" value="<?=$date?>" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>

                <div style="clear: both;position: relative;top:10px;right:10px;margin-bottom: 50px;">
                    <button type="submit" class="btn btn-success btn-md">提交</button>
                    <button type="button" class="btn btn-danger btn-md" id="btn_delete"data-toggle="modal" data-target="#myModal">删除</button>
                </div>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:370px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    操作提示
                                </h4>
                            </div>
                            
                                <div class="modal-body" style="height: 85px;">
                                    <p>确认要删除选择的数据吗？</p>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-success" id="del_comfirm" data-dismiss="modal">确定</button>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

<style>
    th{
        background-color:#f5eded;
        text-align: center;
    }

</style>

<script>
    var addText=function(){
        window.location.href="addDayData.php";
    }

    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        autoclose: true,
        todayBtn: true,
        startView: 2,  
        minView: 2, 
        forceParse: false,
        language:'cn',
        pickerPosition: "bottom-left"
    });

   $("#del_comfirm").click(function(){
        window.location.href="formHandle/delDayData.php?id=<?=$id?>";
   })
</script>