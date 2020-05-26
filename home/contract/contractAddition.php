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

        <?php
            if(isset($_GET["id"])){
                $id=$_GET["id"];
            }else{
                $id="";
            }
        ?>



        <div style="margin-left: 180px;">

            <div style="clear:both;margin-left:40px;margin-top:50px">
                <div style="clear: both;border-radius: 6px;">
                    <div class="nav nav-pills" style="float:left;margin-top:15px;position:relative;right:5px;">
                        <li role="presentation"><a href="contract.php">新增合同</a></li>
                        <li role="presentation" class="active"><a href="contractAddition.php">新增补充合同</a></li>
                        <li role="presentation"><a href="newSQ.php">新增授权</a></li>
                    </div>
                </div>

                <form method="POST" action="../../controller/contract/contractAdditionHandle.php?progress=1">
                    <div class="form-group hidden" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                        <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <?php
                            $username=$_SESSION['username'];

                            if($id !=""){
                                $sqlstr2="select * from contract_add where id='$id'";

                                $result2=mysqli_query($conn,$sqlstr2);
                                
                                while($myrow=mysqli_fetch_row($result2)){
                                    $id=$myrow[0];
                                    $no=$myrow[1];
                                    $companyName=$myrow[9];
                                    $storeName=$myrow[10];
                                    $pingtai=$myrow[7];
                                    $category=$myrow[8];
                                    $money=$myrow[13];
                                    $ismoney=$myrow[14];
                                    $sales=$myrow[15];
                                    $issales=$myrow[16];
                                    $service=$myrow[17];
                                    $isservice=$myrow[18];
                                    $content=$myrow[2];
                                    $file=$myrow[6];
                                    $input_time=$myrow[11];
                                    $input_time2=$myrow[12];
                                }
                            }else{
                                $id="";
                                $no="";
                                $companyName="";
                                $storeName="";
                                $pingtai="";
                                $category="";
                                $money="";
                                $ismoney="";
                                $sales="";
                                $issales="";
                                $service="";
                                $isservice="";
                                $content="";
                                $file="";
                                $input_time="";
                                $input_time2="";
                            }

                        ?>
                        <div class="form-group" style="clear: both;display:none">
                            <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                            <input type="text" class="form-control" name="service" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                        </div>
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">主合同编号</p>
                        <select class="form-control" name="no" style="width: 250px;float: left;margin-top: 15px;">
                        <?php
                            $sqlstr="select no from contract where department='$department'";

                            $result=mysqli_query($conn,$sqlstr);


                            while($myrow=mysqli_fetch_row($result)){

                                if($no==$myrow[0]){
                                    ?>
                                        <option selected><?=$myrow[0]?></option>
                                    <?php
                                }else{
                                    ?>
                                        <option><?=$myrow[0]?></option>
                                    <?php
                                }
                            }
                            
                        ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">公司名称</p>
                        <input type="text" class="form-control" name="company" value="<?=$companyName?>" placeholder="请输入公司名称" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group store_name" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">店铺名</p>
                        <input type="text" class="form-control" name="store" value="<?=$storeName?>" placeholder="请输入店铺名" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group store_pingtai" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权平台</p>
                        <input type="text" class="form-control" name="pingtai" value="<?=$pingtai?>" placeholder="请输入授权平台" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">授权类目</p>
                        <input type="text" class="form-control" name="category" value="<?=$category?>" placeholder="请输入授权类目" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">保证金</p>
                        <input type="text" class="form-control" name="money" value="<?=$money?>" placeholder="请输入保证金" style="width: 250px;float: left;margin-top: 15px;"  oninput="value=value.replace(/[^\d.]/g,'')">
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
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">销售额指标（万）</p>
                        <input type="text" class="form-control" name="sales" value="<?=$sales?>" placeholder="请输入销售额" style="width: 250px;float: left;margin-top: 15px;" oninput="value=value.replace(/[^\d.]/g,'')">
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
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">服务费指标（万）</p>
                        <input type="text" class="form-control" name="service" value="<?=$service?>" placeholder="请输入服务费" style="width: 250px;float: left;margin-top: 15px;"  oninput="value=value.replace(/[^\d.]/g,'')">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">是否共享服务费</p>
                        <select class="form-control" style="width: 250px;float:left;margin-top: 15px;" name="isservice">
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
                        <p style="font-size: 14px;margin-top: 60px;">补充信息（1000字以内）</p>
                        <textarea class="form-control" name="content" style="width:370px;height:50px;margin-top: 12px;"><?=$content?></textarea>
                    </div>
                    <div class="form-group" style="clear:both">
                        <span style="width:100px;float:left">附件上传</span>
                        <input type="file" name="upfile" style="width:200px;float:left;margin-bottom:10px;"/>
                        <p style="clear:both;font-size:12px;color:red">上传附件名称为：合同编号_add.jpg</p>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;">合同日期</p>
                        
                        <div style="float: left;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time" name="input_time" size="16" type="text" value="<?=$input_time?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        
                        <p style="float: left;position:relative;top:7px;margin-left:5px;"> 到 </p>

                        <div style="float: left;margin-left:10px;width:180px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="input_time2" name="input_time2" size="16" type="text" value="<?=$input_time2?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div style="clear: both;position:relative;top:10px;">
                        <button type="submit" class="btn btn-success btn-md">提交信息</button>
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