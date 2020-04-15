<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php")?>
        <?php include '..\base/header.php' ?>
        <?php include '..\base/leftBar.php' ?>

        <div style="margin-left: 180px;">

            <?php

                if(isset($_GET['id']) && $_GET['id']!=""){
                    $id=$_GET['id'];
                
                    $sqlstr2="select * from contract where id='$id'";

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        $re_date=$myrow[1];
                        $no=$myrow[2];
                        $department=$myrow[3];
                        $pingtai=$myrow[4];
                        $category=$myrow[5];
                        $company=$myrow[6];
                        $store=$myrow[7];
                        $input_time=$myrow[8];
                        $input_time2=$myrow[9];
                        $money=$myrow[10];
                        $ismoney=$myrow[11];
                        $sales=$myrow[12];
                        $issales=$myrow[13];
                        $service=$myrow[14];
                        $isservice=$myrow[15];
                        $note=$myrow[16];
                        $oldNo=$myrow[18];
                    }
                }else{
                    $id="";
                    $re_date="";
                    $no="";
                    $department="";
                    $pingtai="";
                    $category="";
                    $company="";
                    $store="";
                    $input_time="";
                    $input_time2="";
                    $money="";
                    $ismoney="";
                    $sales="";
                    $issales="";
                    $service="";
                    $isservice="";
                    $note="";
                    $oldNo="";
                }

                mysqli_free_result($result);
                mysqli_close($conn); 
            ?>

            <div style="clear:both;margin-left:40px;">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation" class="active"><a href="#">新增合同</a></li>
                        <li role="presentation"><a href="newSQ.php">新增授权</a></li>
                    </div>
                </div>
                
                <!--<button style="float:left;margin-left:360px;position:relative;top:20px" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal2">批量上传</button>-->
                
                <?php
                    if(isset($_GET['option']) && $_GET['option']!=""){
                        $option=$_GET['option'];
                    }else{
                        $option=1;
                    }
                ?>
                
                <form method="POST" action="formHandle/contractHandle.php?option=<?=$option?>&progress=1">
                    <div class="form-group hidden" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                        <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">合同编号</p>
                        <input type="text" class="form-control" name="no" value="<?=$no?>" placeholder="请输入合同编号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">公司名称</p>
                        <input type="text" class="form-control" name="company" value="<?=$company?>" placeholder="请输入公司名称" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">店铺名</p>
                        <input type="text" class="form-control" name="store" value="<?=$store?>" placeholder="请输入店铺名" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权平台</p>
                        <input type="text" class="form-control" name="pingtai" value="<?=$pingtai?>" placeholder="请输入授权平台" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权类目</p>
                        <input type="text" class="form-control" name="category" value="<?=$category?>" placeholder="请输入授权类目" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">保证金</p>
                        <input type="text" class="form-control" name="money" value="<?=$money?>" placeholder="请输入保证金" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">是否共享保证金</p>
                        <select class="form-control" style="width: 250px;float: left;margin-top: 15px;" name="ismoney">
                            <?php
                                if($ismoney=="是"){
                                    ?>
                                        <option selected>是</option>
                                        <option>否</option>
                                    <?php
                                }else{
                                    ?>
                                        <option>是</option>
                                        <option selected>否</option>
                                    <?php
                                }  
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">销售额（万）</p>
                        <input type="text" class="form-control" name="sales" value="<?=$sales?>" placeholder="请输入销售额" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">是否共享销售额</p>
                        <select class="form-control" style="width: 250px;float: left;margin-top: 15px;" name="issales">
                            <?php
                                if($issales=="是"){
                                    ?>
                                        <option selected>是</option>
                                        <option>否</option>
                                    <?php
                                }else{
                                    ?>
                                        <option>是</option>
                                        <option selected>否</option>
                                    <?php
                                }  
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">服务费（万）</p>
                        <input type="text" class="form-control" name="service" value="<?=$service?>" placeholder="请输入服务费" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">是否共享服务费</p>
                        <select class="form-control" style="width: 250px;float: left;margin-top: 15px;" name="isservice">
                            <?php
                                if($isservice=="是"){
                                    ?>
                                        <option selected>是</option>
                                        <option>否</option>
                                    <?php
                                }else{
                                    ?>
                                        <option>是</option>
                                        <option selected>否</option>
                                    <?php
                                }  
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">关联原合同</p>
                        <input type="text" class="form-control" name="oldNo" value="<?=$oldNo?>" placeholder="请输入原合同编号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">备注</p>
                        <input type="text" class="form-control" name="note" value="<?=$note?>" placeholder="请输入备注" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">合同日期</p>
                        
                        <div style="float: left;width:180px;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time" name="input_time" size="16" type="text" value="<?=$input_time?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                        <p style="float: left;position:relative;top:20px;margin-left:5px;"> 到 </p>

                        <div style="float: left;margin-left:10px;width:180px;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time2" name="input_time2" size="16" type="text" value="<?=$input_time2?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>

                    <div style="clear: both;position:relative;top:10px;">
                        <button type="submit" class="btn btn-success btn-md">提交信息</button>
                    </div>
                </form>

                <!-- Excel导入模态框 -->
                <form method="POST" action="formHandle/uploadContractHandle.php" enctype="multipart/form-data">
                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        批量上传合同
                                    </h4>
                                </div>
                                
                                <div class="modal-body" style="height: 150px;">
                                    <input type="file" name="excel"/>
                                    <div style="clear: both;position: relative;top:20px;width:300px;">
                                        <p>温馨提示：文件必须为EXCEL格式，请按模板文件格式进行上传，文件大小需小于2M</p>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="submit" class="btn btn-primary">导入表格</button>
                                </div> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
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
</script>