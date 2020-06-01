<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php") ?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px">

            <div style="clear:both;margin-left:40px;">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation"><a href="contract.php">新增合同</a></li>
                        <li role="presentation" style="display:none"><a href="contractAddition.php">新增补充合同</a></li>
                        <li role="presentation" style="display:none" class="active"><a href="newSQ.php">新增授权</a></li>
                    </div>
                </div>
                
                <!--<button style="float:left;margin-left:360px;position:relative;top:20px" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal2">批量上传</button>-->
                
                <?php
                    if(isset($_GET['option']) && $_GET['option']!=""){
                        $option=$_GET['option'];
                    }else{
                        $option=1;
                    }

                    if(isset($_GET['id']) && $_GET['id']!=""){
                        $id=$_GET['id'];
                    
                        $sqlstr2="select * from sq where id='$id'";
    
                        $result=mysqli_query($conn,$sqlstr2);
    
                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $no=$myrow[1];
                            $companyName=$myrow[2];
                            $storeName=$myrow[3];
                            $sqType=$myrow[4];
                            $pingTai=$myrow[5];
                            $category=$myrow[6];
                            $date1=$myrow[8];
                            $date2=$myrow[9];
                            $contractNo=$myrow[10];
                            $bzj=$myrow[11];
                            $fileName=$myrow[12];
                            $note=$myrow[17];
                        }
                    }else{
                        $id="";
                        $no="";
                        $companyName="";
                        $storeName="";
                        $sqType="";
                        $pingTai="";
                        $category="";
                        $date1="";
                        $date2="";
                        $contractNo="";
                        $bzj="";
                        $fileName="";
                        $note="";
                    }
    
                    mysqli_free_result($result);
                    mysqli_close($conn); 
                ?>
                
                <form method="POST" action="../../controller/contract/SQHandle.php?option=<?=$option?>&progress=1"  enctype="multipart/form-data">
                    <div class="form-group" style="clear: both;display:none">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                        <input type="text" class="form-control" name="id" value="<?=$id?>" placeholder="请输入授权编号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>

                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权编号</p>
                        <input type="text" class="form-control" name="no" value="<?=$no?>" placeholder="请输入授权编号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权类型</p>
                        <select class="form-control" style="width: 250px;float: left;margin-top: 15px;" name="sqType" id="sqType">
                            <?php
                                if($sqType == "生产授权"){
                                    ?>
                                        <option>销售授权</option>
                                        <option selected>生产授权</option>
                                    <?php
                                }else{
                                    ?>
                                        <option>销售授权</option>
                                        <option>生产授权</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">客户名称</p>
                        <input type="text" class="form-control" name="companyName" value="<?=$companyName?>" placeholder="请输入客户名称" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group store_name" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">店铺名称</p>
                        <input type="text" class="form-control" name="storeName" value="<?=$storeName?>" placeholder="请输入店铺名称" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    
                    <div class="form-group store_pingtai" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权平台</p>
                        <input type="text" class="form-control" name="pingtai" value="<?=$pingTai?>" placeholder="请输入授权平台" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权类目</p>
                        <input type="text" class="form-control" name="category" value="<?=$category?>" placeholder="请输入授权类目" style="width: 250px;float: left;margin-top: 15px;">
                    </div>

                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">合同编号</p>
                        <input type="text" class="form-control" name="contract_no" value="<?=$contractNo?>" placeholder="请输入合同编号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">保证金</p>
                        <input type="text" class="form-control" name="bzj" value="<?=$bzj?>" placeholder="请输入保证金" style="width: 250px;float: left;margin-top: 15px;"  oninput="value=value.replace(/[^\d.]/g,'')">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <span style="float: left;margin-top:20px;">上传保证金收据</span><input type="file" name="upfile" style="float: left;margin-left: 25px;margin-top:20px;"/><span style="position:relative;top:23px;font-size:12px;color:red">*文件名(编号_bzj.jpg)</span>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <span style="float: left;margin-top:20px;">上传授权扫描件</span><input type="file" name="upfile2" style="float: left;margin-left: 25px;margin-top:20px;"/><span style="position:relative;top:23px;font-size:12px;color:red">*文件名(编号_smj.jpg)</span>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权日期</p>
                        
                        <div style="float: left;width:180px;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time" name="input_time" size="16" type="text" value="<?=$date1?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                        <p style="float: left;position:relative;top:20px;margin-left:5px;"> 到 </p>

                        <div style="float: left;margin-left:10px;width:180px;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time2" name="input_time2" size="16" type="text" value="<?=$date2?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group store_pingtai" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">备注</p>
                        <input type="text" class="form-control" name="note" value="<?=$note?>" placeholder="请输入备注信息" style="width: 250px;float: left;margin-top: 15px;">
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
                                        批量上传授信
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

    $("#sqType").change(function(){
        sq_type=$(this).val();

        if(sq_type=="销售授权"){
            $(".store_name").css("display","")
            $(".store_pingtai").css("display","")
        }else{
            $(".store_name").css("display","none")
            $(".store_pingtai").css("display","none")
        }
    })
</script>