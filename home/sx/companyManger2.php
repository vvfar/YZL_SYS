<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.css" rel="stylesheet"/>
        <link href="..\..\public\css/leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css/header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php")?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px;">
            
            <?php
                
                $username=$_SESSION["username"];

                $sqlstr1="select department from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                }

                $sqlstr2="select sqid from sx_form where department='$department' and status='已生效'";

                $result=mysqli_query($conn,$sqlstr2);

            ?>
            
            <form method="POST" action="../../controller/sx/companyMangerHandle2.php"  style="clear:both;float: left;margin-top: 10px;margin-left: 40px;">
                <p style="font-size:16px;margin-top:20px">回款单据</p>
                <hr>
                
                <div class="form-group" style="clear: both;margin-top: 0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">授信编号</p>
                    <select style="width: 250px;float: left;margin-top: 15px;" class="form-control" name="sxbh" id="sxbh">
                        <option></option>
                        <?php
                            if(isset($_GET['no']) && $_GET['no']!=""){
                                ?>
                                    <option selected><?=$_GET['no']?></option>
                                <?php
                                
                            }else{
                                while($myrow=mysqli_fetch_row($result)){
                                    ?>
                                        <option><?=$myrow[0]?></option>
                                    <?php
                                }    
                            }
                            
                        ?>
                    </select>
                </div>
                <div class="form-group" style="clear: both;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">id</p>
                    <input type="text" class="form-control" style="margin-top:15px;width: 250px;float: left;" id="id" name="id" readonly = "readonly"  value=""/>
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">公司名称</p>
                    <input type="text" class="form-control" style="margin-top:15px;width: 250px;float: left;" id="cn" name="cn" readonly = "readonly"  value=""/>
                </div>
                <div class="form-group" style="clear: both;margin-top: 0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">业务员</p>
                    <input type="text" class="form-control" name="ywy" style="width: 250px;float: left;margin-top: 15px;" id="ywy" readonly = "readonly">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">回款期数</p>
                    <input type="text" class="form-control" name="hkqs" style="float: left;width: 250px;margin-top: 15px;" id="hkqs" readonly = "readonly">
                </div>
                <div class="form-group" style="clear: both;margin-top: 30px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">实际回款日期</p>
                    <div style="width: 250px;font-size: 14px;float: left;margin-top: 15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" name="date2" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class="form-group" style="clear: both;margin-top: 0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">实际回款金额</p>
                    <input type="text" class="form-control" name="sjhkje" placeholder="请输入还款金额" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-top: 30px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">实际回款方式</p>
                    <select class="form-control" name="hkfs" style="float: left;width: 250px;margin-top: 15px;">
                        <option></option>
                        <option>现金还款</option>
                        <option>货物冲抵</option>
                        <option>汇款</option>
                        <option>汇款+冲抵</option>
                        <option>其他方式</option>
                    </select>
                    <input type="text" class="form-control" name="hkfs2" placeholder="请输入回款方式备注" style="width: 250px;float: left;margin-top: 15px;margin-left: 20px;">
                </div>
                <div class="form-group" style="clear: both;margin-top: 0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">剩余金额处理方式</p>
                    <input type="text" class="form-control" name="syjehkfs" placeholder="请输入剩余金额处理方式" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;position:relative;top:10px;">
                    <button type="button" class="btn btn-success btn-md" id="submit">点击提交</button>
                    <button type="submit" class="btn btn-default btn-md hidden" id="hd_submit">提交</button>
                </div>
            </form>

        </div>

    </body>
</html>

<script type="text/javascript"> 
    window.onload=function(){
        $("#sxbh").click();
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

    $("#sxbh").click(function(){

        var xmlhttp;
        if(window.ActiveXObject){
            xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
        }else{
            xmlhttp=new XMLHttpRequest();
        }

        sxbh=$("#sxbh").val();

        xmlhttp.open("GET","../../controller/sx/searchSX_info.php?sxid=" + sxbh,true);
    
        xmlhttp.onreadystatechange=function(){
            
            if(xmlhttp.readyState==4 && xmlhttp.status ==200){

                var msg=xmlhttp.responseText;
                msg_list=msg.split(",");

                $("#id").attr("value",msg_list[0]);
                $("#cn").attr("value",msg_list[1]);
                $("#ywy").attr("value",msg_list[2]);
                if(msg_list[3] != undefined){
                    $("#hkqs").attr("value","第" + msg_list[3] + "期");
                }
                

            }
        }
        
        xmlhttp.send(null);
    })


    $("#submit").click(function(){
        if($("input[name='sxbh']").val() =="" || $("input[name='cn']").val() =="" ||
            $("input[name='storeName']").val() =="" || $("input[name='ywy']").val() =="" || 
            $("input[name='date1']").val() =="" ||  $("input[name='date2']").val() =="" || 
            $("input[name='sjhkje']").val() =="" ||  $("input[name='hkfs']").val() ==""){
            alert("请将表单填写完整！")
        }else{
            $("#hd_submit").click()
        } 
    })
</script>