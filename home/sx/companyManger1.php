<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-theme.css" rel="stylesheet" media="screen"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="background-color: rgb(243, 243, 243);width: 1660px;height:auto;margin-left: 240px;">

            <form method="POST" action="formHandle/companyMangerHandle1.php" enctype="multipart/form-data" style="clear:both;float: left;margin-top: 10px;margin-left: 40px;">
                <?php
                    include_once("conn/conn.php");
                    error_reporting(E_ALL || ~E_NOTICE);
                                        
                    $username=$_SESSION["username"];

                    $sqlstr1="select department from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                    }

                    if($department !="数据中心"){
                        $sqlstr2="select name,id from sx_id";

                        $result1=mysqli_query($conn,$sqlstr2);
    
                        if($result1){
                            while($myrow=mysqli_fetch_row($result1)){
                                $sx_id=$myrow[0];
                                $sx_id_id=$myrow[1];
                            }
    
                            //拆分，获取最新sx_id
                            $sx_id_arr=explode("-",$sx_id);

                            $sx_xl=array_pop($sx_id_arr);
                            $sx_year=(int)substr($sx_xl,0,4);
                            $sx_month=(int)substr($sx_xl,4,2);
                            $sx_no=(int)substr($sx_xl,6,9);

                            date_default_timezone_set("Asia/Shanghai");
                            $date=date('Y-m-d H:i:s', time());
                            $year=date("Y",strtotime($date));
                            $month=date("m",strtotime($date));

                            if((int)$year != (int)$sx_year || (int)$month != (int)$sx_month){
                                $sx_year_new=$year;
                                $sx_month_new=$month;
                                $sx_no_new=1;
                            }else{
                                $sx_year_new=$year;
                                $sx_month_new=$sx_month;
                                $sx_no_new=$sx_no+1;
                            
                                if((int)$sx_month_new<10){
                                    $sx_month_new="0".$sx_month_new;
                                }
                            }
                            


                            if($sx_no<10){
                                $sx_no_new="00".$sx_no_new; 
                            }elseif($sx_no<100){
                                $sx_no_new="0".$sx_no_new;
                            }

                            $sx_xl_new=$sx_year_new.$sx_month_new.$sx_no_new;

                            $sx_id=str_replace($sx_xl,$sx_xl_new,$sx_id);

                        }else{
                            $sx_id="";
                        }
                        

                    }else{
                        $sx_id="";
                    }
                    

                ?>

                <p style="font-size:16px;margin-top:20px">授信单据</p>
                <hr>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">授信编号</p>
                    
                    <input type="text" class="form-control" name="sx_id_id" value="" readonly = "readonly" placeholder="请输入授信编号" style="width: 250px;float: left;margin-top: 15px;display:none">
                    <input type="text" class="form-control" name="sqid" value="<?=$sx_id?>" readonly = "readonly" placeholder="请输入授信编号" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">公司名称</p>
                    <input type="text" class="form-control" style="margin-top:15px;width: 250px;float: left;" id="cn" name="cn" readonly = "readonly"  value="" placeholder="搜索公司名称后自动推荐公司全称"/>
                    <input type="text" name="companyName" id="companyName" class="form-control" placeholder="搜索公司名称" style="width: 200px;float: left;margin-top: 15px;margin-left:17px;" value="">
                    <button class="btn btn-info btn-sm"  type="button" style="float: left;margin-left: 20px;margin-top:17px;" id="search">搜索</button>
                    <button class="btn btn-success btn-sm"  type="button" style="float: left;margin-left: 10px;margin-top:17px;" id="add" data-target="#myModal" data-toggle="modal">添加</button>            
                </div>
                    

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">是否共享授信</p>
                    <select class="form-control" style="float: left;width:250px;margin-top: 15px;" id="isgx" name="isgx">
                        <option>是</option>
                        <option selected>否</option>
                    </select>
                </div>
                <div class="form-group gxCount" style="clear: both;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">共享事业部数</p>
                    <select class="form-control" style="float: left;width:250px;margin-top: 15px;" id="gxCount_val" name="gxCount_val">
                        <option selected>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>
                <?php
                    for($i=0;$i<=12;$i++){  
                ?>
                <div class="form-group gxDepartment<?=$i?> gxDepartment" style="clear: both;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">共享事业部</p>

                    <select class="form-control " style="float: left;width:250px;margin-top: 15px;" name="gxDepartment<?=$i?>">
                        <option selected>内衣京东</option>
                        <option>内衣拼多多</option>
                        <option>内衣天猫唯品会事业管理部</option>
                        <option>女装事业管理部</option>
                        <option>居家百货事业管理部</option>
                        <option>母婴童装事业管理部</option>
                        <option>家纺事业管理部</option>
                        <option>服饰事业管理部</option>
                        <option>线下事业管理部</option>
                    </select>
        
                </div>
                <?php
                    }
                ?>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">申请人</p>
                    <select style="float: left;width: 250px;margin-top: 15px;" name="ywy" class="form-control">
                        <option></option>
                        <?php
                            $username=$_SESSION["username"];
                
                            $sqlstr1="select department from user_form where username='$username'";

                            $result=mysqli_query($conn,$sqlstr1);

                            while($myrow=mysqli_fetch_row($result)){
                                $department=$myrow[0];
                            }


                            if($department != "数据中心"){
                                $sqlstr2="select * from staff where department='$department'";
                                
                            }else{
                                $sqlstr2="select * from staff";
                            }

                            $result=mysqli_query($conn,$sqlstr2);

                            while($myrow=mysqli_fetch_row($result)){
                                    ?>
                                    <option><?=$myrow[2]?></option>
                                <?php
                            }

                            mysqli_free_result($result);
                            mysqli_close($conn);

                        ?> 
                    </select>

                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">授信额度</p>
                    <input type="text" class="form-control" name="sqmoney" placeholder="请输入金额" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">手续费</p>
                    <input type="text" class="form-control" name="sxf" placeholder="请输入手续费" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">计划回款期数</p>
                    <select id="qs" name="qs" class="form-control" style="float: left;width: 250px;margin-top:15px;" onclick="over()">
                        <?php
                            for($i=0;$i<=12;$i++){  
                        ?>
                            <option><?=$i?></option>
                        <?php
                            }
                        ?>
                    
                    </select>
                </div>
                
                <div class="form-group" style="clear: both;">
                
                </div>

                <?php
                    for($a=0;$a<=11;$a++){
                ?>
                <div style="clear: both;position: relative;top: 0px;display: none" class="zh<?=$a+1?>">
                    <div class="form-group" style="float:left">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top:5px;">第<?=$a+1?>期回款日期</p>
                        <div style="width: 180px;font-size: 14px;float: left;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" name="dateTime<?=$a+1?>" size="16" type="text" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 60px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">回款金额</p>
                        <input type="text" class="form-control" name="hkje<?=$a+1?>" placeholder="请输入还款金额" style="width: 125px;float: left;margin-left:20px;">
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 60px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">违约费率</p>
                        <input type="text" class="form-control" name="wyfl<?=$a+1?>" placeholder="" style="width: 62px;float: left;margin-left:20px;"><span style="position:relative;top:7px;margin-left:5px;font-size:16px;">%</span>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 60px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">回款方式</p>
                        <select class="form-control" name="hkfs<?=$a+1?>" style="float: left;width: 120px;margin-left:20px;">
                            <option></option>
                            <option>现金还款</option>
                            <option>货物冲抵</option>
                            <option>其他方式</option>
                            <option>汇款</option>
                            <option>汇款+冲抵</option>
                            <option>其他方式</option>
                        </select>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 100px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">还款计划备注</p>
                        <input type="text" class="form-control" name="hkjhbz<?=$a+1?>" placeholder="请输入还款计划备注" style="width: 160px;float: left;margin-left:20px;">
                    </div>

                </div>
                <?php
                    }
                ?>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top:5px;">备注</p>
                    <input type="text" class="form-control" name="note" placeholder="请输入备注信息" style="width: 250px;float: left;">
                </div>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top:20px;">有效期限</p>
                    <p style="float:left;margin-top:20px;margin-right:20px;">从</p>
                    <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        
                        <input class="form-control" name="date2" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <p style="float:left;margin-top:20px;margin-right:20px;margin-left:20px;">到</p>
                    <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        
                        <input class="form-control" name="date3" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>

                <div style="clear: both;margin-top:65px;">
                    <button type="button" class="btn btn-success btn-md" id="submit">点击提交</button>
                    <button type="submit" class="btn btn-default btn-md hidden" id="hd_submit">提交</button>
                </div>
                
            </form>
        </div>
        <!-- Excel导入模态框,确认是否作废单据 -->
        <form method="POST" action="formHandle/addCompanyHandle.php">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:30%">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:350px;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                新增授信公司
                            </h4>

                        </div>
                        <div class="modal-body" style="height: 100px;">
                            <div class="form-group" style="clear: both;margin-bottom:0px;">
                                <p style="width: 120px;font-size: 14px;float: left;">公司名称</p>
                                <input type="text" class="form-control" name="companyName" placeholder="请输入公司名称" style="width: 250px;float: left;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">确认</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>                           
    </body>
</html>

<script type="text/javascript">  

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

    //$("#search").click(function(){
    $("#companyName").keyup(function(){

        var xmlhttp;
        if(window.ActiveXObject){
            xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
        }else{
            xmlhttp=new XMLHttpRequest();
        }

        name=$("#companyName").val();

        xmlhttp.open("GET","formHandle/searchCompany.php?name=" + name,true);
        
        new_company=""
    

        xmlhttp.onreadystatechange=function(){
            
            if(xmlhttp.readyState==4 && xmlhttp.status ==200){

                var msg=xmlhttp.responseText;
                if(msg==0){
                    $("#cn").attr("value","");
                }else{
                    $("#sn").html(msg);
                    msg_list=msg.split("<option>")
                    //$("#cn").html(msg_list[0]);
                    $("#cn").attr("value",msg_list[0]);
                    
                }
            }
        }
        
        //xmlhttp.send(null);

        if(new_company != ""){

            xmlhttp.open("GET","formHandle/searchCompany.php?rel_companyName=" + new_company,true);

            xmlhttp.onreadyStatechange=function(){

                if(xmlhttp.readyState==4 && xmlhttp.status ==200){
                    var msg2=xmlhttp.responseText;
                    $("#storeOption").html("<option>"+msg2+"</option>");
                }
            }
            
        }
        
        xmlhttp.send(null);
    })

    $("#isgx").click(function(){
        if($(this).val()=="是"){
            $(".gxCount").css("display","")
            $(".gxCount").css("clear","both")
        }else{
            $(".gxCount").css("display","none")
            $(".gxDepartment").css("display","none")       
        }
    })

    $("#gxCount_val").click(function(){
        gx=parseFloat($(this).val());

        for(i=1;i<=gx;i++){
            $(".gxDepartment" + i).css("display","")
            $(".gxDepartment" + i).css("clear","both")
        }

        for(i=12;i>gx;i--){
            $(".gxDepartment" + i).css("display","none")
            $(".gxDepartment" + i).css("clear","both")
        }
    })

    var over=function(){
        qs=parseFloat($("#qs").val());
        
        for(i=1;i<=qs;i++){
            $(".zh" + i).css("display","")
            $(".zh" + i).css("clear","both")
        }

        for(i=12;i>qs;i--){
            $(".zh" + i).css("display","none")
            $(".zh" + i).css("clear","both")
        }

        
    }

    $("#submit").click(function(){
        if($("input[name='cn']").val() =="" || $("input[name='storeName']").val() =="" ||
            $("input[name='ywy']").val() =="" || $("input[name='date1']").val() =="" || 
            $("input[name='sqid']").val() =="" ||  $("input[name='sqmoney']").val() =="" || 
            $("input[name='qs']").val() =="" ||  $("input[name='zzqrr']").val() ==""){
            alert("请将表单填写完整！")
        }else{
            $("#hd_submit").click()
        } 
    })


</script>