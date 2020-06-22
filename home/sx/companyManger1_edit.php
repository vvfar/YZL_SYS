<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css/header.css?v=2" rel="stylesheet"/>
        <script src="..\..\public\lib\flotr2\flotr2.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:50px;">

            <form method="POST" action="../../controller/sx/newSXHandle.php" enctype="multipart/form-data" style="clear:both;float: left;margin-top: 10px;margin-left: 40px;">
                <?php
                    
                    error_reporting(E_ALL || ~E_NOTICE);
                                        
                    $username=$_SESSION["username"];
                    $id=$_GET["id"];

                    $sqlstr0="select * from sx_form where id=$id";

                    $result0=mysqli_query($conn,$sqlstr0);

                    while($myrow=mysqli_fetch_row($result0)){
                        $companyName=$myrow[1];
                        $ywy=$myrow[2];
                        $department=$myrow[3];
                        $date1=$myrow[4];
                        $sqid=$myrow[5];
                        $sqmoney=$myrow[6];
                        $sxf=$myrow[7];
                        $dateTime=$myrow[8];
                        $hkje=$myrow[9];
                        $wyfl=$myrow[10];
                        $hkfs=$myrow[11];
                        $hkfsbz=$myrow[12];
                        $note=$myrow[13];
                        $file_name=$myrow[15];
                        $date2=$myrow[16];
                        $date3=$myrow[17];
                        $isgx=$myrow[22];
                        $gxCount_val=$myrow[23];
                        $gxDepartment=$myrow[24];
                        $bpeople=$myrow[25];

                        $gxDepartment_arr=explode(",",$gxDepartment); 
                    }

                    $sqlstr1="select department from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                    }
                ?>

                <p style="font-size:16px;">修改授信单据</p>
                <hr>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">授信编号</p>
                    
                    <input type="text" class="form-control" name="sx_id_id" value="<?=$id?>" readonly = "readonly" placeholder="请输入授信编号" style="width: 250px;float: left;margin-top: 15px;display:none">
                    <input type="text" class="form-control" name="sqid" value="<?=$sqid?>" readonly = "readonly" placeholder="请输入授信编号" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">公司名称</p>
                    <select name="companyName" class="form-control" style="width: 250px;float: left;margin-top: 15px;">
                        <option></option>
                        <?php
                            $sqlstr1="select client from store where staff='$username' and status='正常' and htsq='合同授权已提交'";

                            echo $sqlstr1;

                            $result=mysqli_query($conn,$sqlstr1);
        
                            while($myrow=mysqli_fetch_row($result)){
                                if($companyName == $myrow[0]){
                                    echo "<option selected>$myrow[0]</option>";
                                }else{
                                    echo "<option>$myrow[0]</option>";
                                }
                                
                            }
                        ?>
                    
                    </select>
                </div>


                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">是否共享授信</p>
                    <select class="form-control" style="float: left;width:250px;margin-top: 15px;" id="isgx" name="isgx">
                        <?php
                            if($isgx=="是"){
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

                <?php
                    if($isgx=="是"){
                        ?>
                            <div class="form-group gxCount" style="clear: both;">
                        <?php
                    }else{
                        ?>
                            <div class="form-group gxCount" style="clear: both;display:none">
                        <?php
                    }
                    ?>
                
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">共享事业部数</p>
                    <select class="form-control" style="float: left;width:250px;margin-top: 15px;" id="gxCount_val" name="gxCount_val">
                        <?php
                            for($i=0;$i<=10;$i++){
                                if($gxCount_val==$i){
                                ?>
                                    <option selected><?=$i?></option>
                                <?php
                                }else{
                                ?>
                                    <option><?=$i?></option>
                                <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <?php
                    for($i=0;$i<=10;$i++){
                        if($i<=(int)$gxCount_val-1){
                        ?>
                            <div class="form-group gxDepartment<?=$i?> gxDepartment" style="clear: both;">
                        <?php
                        }else{
                        ?>
                            <div class="form-group gxDepartment<?=$i?> gxDepartment" style="clear: both;display:none">
                        <?php
                        }
                        ?>
               
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">共享事业部</p>

                        <?php
                            $department_list=["","内衣京东","内衣拼多多","内衣天猫唯品会事业管理部","女装事业管理部",
                                            "居家百货事业管理部","母婴童装事业管理部","家纺事业管理部","服饰事业管理部","线下事业管理部"];
                        ?>

                        <select class="form-control " style="float: left;width:250px;margin-top: 15px;" name="gxDepartment<?=$i?>">
                            <?php
                                for($j=0;$j<sizeof($department_list);$j++){
                                    if($gxDepartment_arr[$i]==$department_list[$j]){
                                        ?>
                                            <option selected><?=$gxDepartment_arr[$i]?></option>
                                        <?php    
                                    }else{
                                        ?>
                                            <option><?=$department_list[$j]?></option>
                                        <?php 
                                    }
                                }
                            ?>
                        </select>
            
                    </div>
                <?php
                    }
                ?>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">授信额度</p>
                    <input type="text" class="form-control" name="sqmoney" placeholder="请输入金额" style="width: 250px;float: left;margin-top: 15px;" value="<?=$sqmoney?>">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">手续费</p>
                    <input type="text" class="form-control" name="sxf" placeholder="请输入手续费" style="width: 250px;float: left;margin-top: 15px;" value="<?=$sxf?>">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">计划回款期数</p>
                    <select id="qs" name="qs" class="form-control" style="float: left;width: 250px;margin-top:15px;" onclick="over()">
                        <?php
                        $dateTime_arr=explode(",",$dateTime);
                        $hkje_arr=explode(",",$hkje);
                        $wyfl_arr=explode(",",$wyfl);
                        $hkfs_arr=explode(",",$hkfs);
                        $hkfsbz_arr=explode(",",$hkfsbz);  
                        
                        $count=0;

                        for($i=0;$i<=12;$i++){
                            if($dateTime_arr[$i] !=""){
                                $count=$count+1;
                            }
                        }

                        for($i=0;$i<=12;$i++){ 
                            if($i==$count){
                                ?>
                                    <option selected><?=$i?></option>
                                <?php
                            }else{
                                ?>
                                    <option><?=$i?></option>
                                <?php
                            }
                        }
                    ?>
                    
                    </select>
                </div>

                <div class="form-group" style="clear: both;">
                
                </div>

                <?php
                    for($a=0;$a<=11;$a++){
                        if($dateTime_arr[$a] ==""){
                            ?>
                            <div style="clear: both;position: relative;top: 0px;display: none" class="zh<?=$a+1?>">
                            <?php
                        }else{
                            ?>
                            <div style="clear: both;position: relative;top: 0px;" class="zh<?=$a+1?>">
                            <?php
                        }
                ?>
                
                    <div class="form-group" style="float:left">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top:5px;">第<?=$a+1?>期回款日期</p>
                        <div style="width: 180px;font-size: 14px;float: left;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" name="dateTime<?=$a+1?>" size="16" type="text" value="<?=$dateTime_arr[$a]?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 30px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">金额</p>
                        <input type="text" class="form-control" name="hkje<?=$a+1?>" placeholder="请输入还款金额" style="width: 80px;float: left;margin-left:20px;" value="<?=$hkje_arr[$a]?>">
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 30px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">费率</p>
                        <input type="text" class="form-control" name="wyfl<?=$a+1?>" placeholder="" style="width: 62px;float: left;margin-left:20px;" value="<?=$wyfl_arr[$a]?>"><span style="position:relative;top:7px;margin-left:5px;font-size:16px;">%</span>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 30px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">方式</p>
                        <select class="form-control" name="hkfs<?=$a+1?>" value="" style="float: left;width: 120px;margin-left:20px;">
                            <?php
                                if($hkfs_arr[$a]=="现金还款"){
                                    ?>
                                        <option></option>
                                        <option selected>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }elseif($hkfs_arr[$a]=="货物冲抵"){
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option selected>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }elseif($hkfs_arr[$a]=="其他方式"){
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option selected>其他方式</option>
                                        <option>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }elseif($hkfs_arr[$a]=="汇款"){
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option selected>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }elseif($hkfs_arr[$a]=="汇款+冲抵"){
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option>汇款</option>
                                        <option selected>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }elseif($hkfs_arr[$a]=="其他方式"){
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option selected>其他方式</option>
                                    <?php
                                }else{
                                    ?>
                                        <option></option>
                                        <option>现金还款</option>
                                        <option>货物冲抵</option>
                                        <option>其他方式</option>
                                        <option>汇款</option>
                                        <option>汇款+冲抵</option>
                                        <option>其他方式</option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group" style="float:left">
                        <p style="width: 30px;font-size: 14px;float: left;margin-left:20px;margin-top:5px;">备注</p>
                        <input type="text" class="form-control" name="hkjhbz<?=$a+1?>" value="<?=$hkfsbz_arr[$a]?>" placeholder="请输入还款计划备注" style="width: 160px;float: left;margin-left:20px;">
                    </div>

                </div>
                <?php
                    }
                ?>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top:5px;">保证人</p>
                    <input type="text" class="form-control" name="bpeople" placeholder="请输入保证人" style="width: 250px;float: left;" value="<?=$bpeople?>">
                </div>
                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top:20px;">备注</p>
                    <input type="text" class="form-control" name="note" placeholder="请输入备注信息" style="width: 250px;float: left;margin-top:15px;" value="<?=$note?>">
                </div>

                <div class="form-group" style="clear: both;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top:20px;">有效期限</p>
                    <p style="float:left;margin-top:20px;margin-right:20px;">从</p>
                    <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        
                        <input class="form-control" name="date2" size="16" type="text" value="<?=$date2?>" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <p style="float:left;margin-top:20px;margin-right:20px;margin-left:20px;">到</p>
                    <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        
                        <input class="form-control" name="date3" size="16" type="text" value="<?=$date3?>" readonly>
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

    var over=function(){
        qs=parseFloat($("#qs").val());

        for(i=0;i<=qs;i++){
            $(".zh" + i).css("display","")
            $(".zh" + i).css("clear","both")
        }

        for(i=12;i>qs;i--){
            $(".zh" + i).css("display","none")
            $(".zh" + i).css("clear","both")
        } 
    }

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

        for(i=1;i<gx;i++){
            $(".gxDepartment" + i).css("display","")
            $(".gxDepartment" + i).css("clear","both")
        }

        for(i=12;i>=gx;i--){
            $(".gxDepartment" + i).css("display","none")
            $(".gxDepartment" + i).css("clear","both")
        }
    })

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