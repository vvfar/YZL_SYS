<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_辅料申请</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="..\..\public\css\leftbar.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css\header.css?v=2" rel="stylesheet"/>
        <link href="..\..\public\css\flLine.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once("..\..\common\conn\conn.php");?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>
            
        <?php
            
            error_reporting(E_ALL || ~E_NOTICE);

            $username=$_SESSION["username"];

            $sqlstr1="select department,newLevel from user_form where username='$username'";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $department=$myrow[0];
                $department2=$myrow[0];
                $newLevel=$myrow[1];
            }

            $id=$_GET['id'];

            $sqlstr2="select * from flsqd where id='$id'";

            $result=mysqli_query($conn,$sqlstr2);

            while($myrow=mysqli_fetch_row($result)){
                $id=$myrow[0];
                $no=$myrow[1];
                $company=$myrow[2];
                $people=$myrow[3];
                $department=$myrow[4];
                $date=$myrow[5];
                $address=$myrow[6];
                $connection=$myrow[7];
                $phone=$myrow[8];
                $driving=$myrow[9];
                $ishs=$myrow[10];

                $category=$myrow[11];
                $productNo=$myrow[12];
                $productName=$myrow[13];
                $amount=$myrow[14];
                $price=$myrow[15];
                $fls=$myrow[16];
                $fwfxj=$myrow[17];
                $flsName=$myrow[18];
                $dj=$myrow[19];
                $sl=$myrow[20];
                $flfxj=$myrow[21];

                $sd=$myrow[22];
                $jkfs=$myrow[23];
                $wlfs=$myrow[24];
                $wlno=$myrow[25];
                $wlprice=$myrow[26];
                $note=$myrow[27];

                $hd_sqslhj=$myrow[28];
                $hd_fwfhj=$myrow[29];
                $hd_flsl=$myrow[30];
                $hd_flfhjsh=$myrow[31];
                $hd_fwfflfzj=$myrow[32];
                $hd_count=$myrow[33];
                $ywy=$myrow[34];
                $status=$myrow[35];
                $isprint=$myrow[37];
                $shr=$myrow[38];
                $allTime=$myrow[40];
                $file=$myrow[41];
            }

            $status_arr2=explode(",",$status);
            $shr_arr2=explode(",",$shr);
            $allTime_arr=explode(",",$allTime);

            $status_arr=explode(",",$status);
            $status_pop=array_pop($status_arr);

        ?>

        <div style="margin-left: 180px;margin-top:50px;">
            
            <div style="float:left;width:1040px;margin-top:20px;">
                <div style="float:left;">
                    <div class="sqd_st" style="margin-left:40px;float:left;">
                        <p>申请单状态：<?=$status_pop?></p>
                    </div>

                    <div class="sqd_bh" style="margin-left:10px;float:left;">
                        <p style="float: left;">申请单编号:<?=$no?></p>
                    </div>

                    <div class="sqd_print" style="margin-left:10px;float:left;">
                        <p style="float: left;">义乌是否已打印：<?php echo $isprint==1?'是':'否';?></p>
                    </div>
                </div>

                <div style="float:right;">
                    <?php 
                        if($newLevel == "ADMIN"){
                            ?>
                                <button type="button" class="btn btn-warning btn-sm" style="float:left;" id="backEdit">退回单据</button>
                                <button type="button" class="btn btn-danger btn-sm" style="float:left;margin-left:10px;" data-toggle="modal" data-target="#myModal">作废单据</button>
                            <?php
                        }else{
                            ?>
                                <button type="button" class="btn btn-success btn-sm" onclick="printPage()">打印辅料单</button>
                            <?php
                        }
                    ?>
                </div>
            </div>

                <table class="tb1" border="1" cellspacing="0" style="clear:both;position: relative;top:20px;margin-left:40px;width:1000px;margin-bottom:30px;">
                    <tr>
                        <td colspan="4" style="width:147px;">申请单位</td>
                        <td colspan="4" style="width:147px;"><?=$company?></td>
                        <td colspan="4" style="width:147px;">申请人</td>
                        <td colspan="6" style="width:205px;"><?=$people?></td>
                        <td colspan="6" style="width:147px;">申请部门</td>
                        <td colspan="4" style="width:135px;"><?=$department?></td>
                        <td colspan="4" style="width:135px;">申请日期</td>
                        <td colspan="4" style="width:135px;"><?=$date?></td>
                    </tr>
                    <tr>
                        <td colspan="4">收货地址</td>
                        <td colspan="4"><?=$address?></td>
                        <td colspan="4">联系人</td>
                        <td colspan="6"><?=$connection?></td>
                        <td colspan="6">联系电话</td>
                        <td colspan="4"><?=$phone?></td>
                        <td colspan="4">运输方式</td>
                        <td colspan="4"><?=$driving?></td>
                    </tr>
                    <tr>
                        <td colspan="12">基本信息</td>
                        <td colspan="12">服务费用</td>
                        <td colspan="12">辅料费用</td>
                    </tr>    
                    <tr>
                        <td colspan="3">序号</td>
                        <td colspan="3">品类</td>
                        <td colspan="3">货号</td>
                        <td colspan="3">品名</td>
                        <td colspan="3">申请数量</td>
                        <td colspan="3"><?=$ishs?></td>
                        <td colspan="3">费率 /<br>单价</td>
                        <td colspan="3">服务费<br>小计</td>
                        <td colspan="3">辅料名称</td>
                        <td colspan="3">单价</td>
                        <td colspan="3">辅料数量</td>
                        <td colspan="3">辅料小计</td>
                    </tr>
                    <?php
                        $category_arr=explode(',',$category);
                        $productNo_arr=explode(',',$productNo);
                        $productName_arr=explode(',',$productName);
                        $amount_arr=explode(',',$amount);
                        $price_arr=explode(',',$price);
                        $fls_arr=explode(',',$fls);
                        $fwfxj_arr=explode(',',$fwfxj);
                        $flsName_arr=explode(',',$flsName);
                        $dj_arr=explode(',',$dj);
                        $sl_arr=explode(',',$sl);
                        $flfxj_arr=explode(',',$flfxj);


                        for($i=0;$i<=$hd_count-1;$i++){
                    ?>
                    <tr class="tr<?=$i?>">
                        <td colspan="3"><?=$i+1?></td>
                        <td colspan="3"><?=$category_arr[$i]?></td>
                        <td colspan="3"><?=$productNo_arr[$i]?></td>
                        <td colspan="3"><?=$productName_arr[$i]?></td>
                        <td colspan="3" class="sqsl"><?=$amount_arr[$i]?></td>
                        <td colspan="3" class="bzjg"><?=$price_arr[$i]?></td>
                        <td colspan="3" class="fldj"><?=$fls_arr[$i]?></td>
                        <td colspan="3" class="fwfxj"><?=$fwfxj_arr[$i]?></td>
                        <td colspan="3"><?=$flsName_arr[$i]?></td>
                        <td colspan="3" class="dj"><?=$dj_arr[$i]?></td>
                        <td colspan="3" class="sl"><?=$sl_arr[$i]?></td>
                        <td colspan="3" class="flfxj"><?=$flfxj_arr[$i]?></td>
                    </tr>

                    <?php
                        }
                    ?>
                    
                    <tr>
                        <td colspan="12">申请数量合计</td>
                        <td colspan="3" id="hj"><?=$hd_sqslhj?></td>
                        <td colspan="6">服务费合计</td>
                        <td colspan="3" id="fwfhj"><?=$hd_fwfhj?></td>
                        <td colspan="3">税点</td>
                        <td colspan="3" class="sd"><?=$sd?></td>
                        <td colspan="3" id="flslhj"><?=$hd_flsl?></td>
                        <td colspan="3" id="flfhj" style="display:none"></td>
                        <td colspan="3" id="fwfhjhs"><?=$hd_flfhjsh?></td>
                    </tr>
                    <tr>
                        <td colspan="12">服务费辅料费总计</td>
                        <td colspan="12" id="fwfflfhj"><?=$hd_fwfflfzj?></td>
                        <td colspan="6">结款方式</td>
                        <td colspan="6"><?=$jkfs?></td>
                    </tr>
                    
                    <?php 

                        $username=$_SESSION["username"];

                        $sqlstr1="select level,department from user_form where username='$username'";

                        $result=mysqli_query($conn,$sqlstr1);

                        while($myrow=mysqli_fetch_row($result)){
                            $level=$myrow[0];
                            $department=$myrow[1];
                        }

                        $sqlstr3="select sqid,nowUseMoney,newMoney from use_sx where fl_no='$no'";

                        $result=mysqli_query($conn,$sqlstr3);

                        while($myrow=mysqli_fetch_row($result)){
                            $sqid=$myrow[0];
                            $nowUseMoney=$myrow[1];
                            $newMoney=$myrow[2];
                        }

                        
                        $sqlstr5="select file_name from sx_form where sqid='$sqid'";

                        $result=mysqli_query($conn,$sqlstr5);

                        while($myrow=mysqli_fetch_row($result)){
                            $file_name=$myrow[0];
                        }


                        if($department=="义乌部"){
                            if($status_pop=="义乌打包发货" or $status_pop=="商业运营归档单据"){
                            ?>
                                <tr>
                                    <td colspan="6">物流方式</td>
                                    <td colspan="6"><input type="text" value="<?=$wlfs?>" style="width: 90%;" name="wlfs" id="wlfs"/></td>
                                    <td colspan="6">物流单号</td>
                                    <td colspan="6"><input type="text" value="<?=$wlno?>" style="width: 90%;" name="wlno" id="wlno"/></td>
                                    <td colspan="6">物流费用</td>
                                    <td colspan="6"><input type="text" value="<?=$wlprice?>" style="width: 90%;" name="wlprice" id="wlprice"/></td>
                                </tr>
                                <tr>
                                    <td colspan="6">备注</td>
                                    <td colspan="30"><input type="text" value="<?=$note?>" style="width: 98%;" name="note" id="note"/></td>
                                </tr>
                            <?php
                            }else{
                                ?>
                                <tr>
                                    <td colspan="6">物流方式</td>
                                    <td colspan="6"><?=$wlfs?></td>
                                    <td colspan="6">物流单号</td>
                                    <td colspan="6"><?=$wlno?></td>
                                    <td colspan="6">物流费用</td>
                                    <td colspan="6"><?=$wlprice?></td>
                                </tr>
                                <tr>
                                    <td colspan="6">备注</td>
                                    <td colspan="30"><?=$note?></td>
                                </tr>
                                
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="6">物流方式</td>
                                <td colspan="6"><?=$wlfs?></td>
                                <td colspan="6">物流单号</td>
                                <td colspan="6"><?=$wlno?></td>
                                <td colspan="6">物流费用</td>
                                <td colspan="6"><?=$wlprice?></td>
                            </tr>
                            <tr>
                                <td colspan="6">备注</td>
                                <td colspan="30"><?=$note?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="6">授信编号</td>

                            <?php
                                if($file_name !=""){
                            ?>
                                <td colspan="6"><a href="../../common/file/sx_file/<?=$file_name?>" target="_blank"><?=$sqid?></a></td>
                            <?php
                                }else{
                            ?>
                                <td colspan="6"><?=$sqid?></td>
                            <?php
                                }
                            ?>
                            
                            <td colspan="6">使用授信金额</td>
                            <td colspan="6"><?=$nowUseMoney?></td>
                            <td colspan="6">可使用额度</td>
                            <td colspan="6"><?=$newMoney+$nowUseMoney?></td>
                        </tr>
                </table>
                <!--  
                <?php

                    if($file !="" and (explode(".",$file)[1]=="jpg" or explode(".",$file)[1]=="png")){
                ?>
                    <p style="margin-left:40px;" class="fj"><a href="../../common/file/fl_file/<?=$file?>">照片预览</a></p>
                    <span style="margin-left:40px;margin-bottom:50px;">文件名：<?=$file?></span>
                <?php
                    }else if($file !="" and explode(".",$file)[1] !="jpg"){
                    ?>
                        <p style="margin-left:40px;" class="fj"><a href="../../common/file/fl_file/<?=$file?>">下载附件</a></p>
                        <span style="margin-left:40px;margin-bottom:50px;">文件名：<?=$file?></span>
                    <?php
                    }
                ?>
                -->
                    
                <div style="width:1040px;">
                    <?php

                        $arr_shr=explode(",",$shr);
                        $shr_arr3=array_shift($arr_shr);
                        $shr_arr1=array_pop($arr_shr);


                        if($shr_arr1 == $username){
                            

                            if($department == "商业运营部" and $status_pop=="商业运营归档单据" ){
                                ?>
                                    <button type="button" class="btn btn-info btn-sm" id="yes" style="float:right;margin-left:50px;">已记录</button>
                                <?php
                            }elseif($status_pop !="待KA审核单据"){
                                if($department2=="财务部"){
                                    ?>
                                        <button type="button" class="btn btn-danger btn-sm" id="no" style="float:right;margin-left:10px;">拒绝</button>
                                        <button type="button" class="agree_yzm btn btn-success btn-sm" style="float:right;"  data-toggle="modal" data-target="#myModal2">同意</button>
                                    <?php
                                }else{
                                    ?>
                                        <button type="button" class="btn btn-danger btn-sm" id="no" style="float:right;margin-left:10px;">拒绝</button>
                                        <button type="button" class="btn btn-success btn-sm" id="yes" style="float:right;">同意</button>
                                    <?php
                                }

                               
                            }
                        }
                        
                        if($department=="义乌部" and $status_pop=="商业运营归档单据"){
                            ?>
                                <button type="button" class="btn btn-info btn-sm" id="edit_YW" style="float:right;margin-left:37px;">修改单据</button>
                            <?php
                        }

                        if(sizeof($arr_shr)==0){
                            if($shr_arr3 == $username){
                            ?>
                                <div style="width:105px">
                                    <button type="button" class="btn btn-info btn-sm" id="yes4" style="float:right;">修改单据</button>
                                </div>
                            <?php
                            }
                        }

                        $sqlstr1="select department,newLevel from user_form where username='$username'";

                        $result=mysqli_query($conn,$sqlstr1);
                
                        while($myrow=mysqli_fetch_row($result)){
                            $department2=$myrow[0];
                            $newLevel=$myrow[1];
                        }
                            
                        if($status_pop=="待KA审核单据" and $department==$department2){
                            if($people == $username){
                            ?>
                                <button type="button" class="btn btn-info btn-sm" id="yes4" style="float:right;margin-left:37px;">修改单据</button>
                            <?php
                            }
                        }
                    ?>
                </div>

            
            <div style="clear:both;margin-left:40px;" class="sh_time">
                <p style="margin-top:80px;">单据审核过程：</p>
                <?php
                    for($i=0;$i<sizeof($allTime_arr);$i++){
                    ?>
                        <ul style="clear:both">
                            <li style="width:200px;float:left;margin-top:2px;">状态：<?=$status_arr2[$i]?></li>
                            <li style="width:200px;float:left;margin-top:2px;">审核人：<?=$shr_arr2[$i]?></li>
                            <li style="width:200px;float:left;margin-top:2px;">审核时间：<?=$allTime_arr[$i]?></li>
                        </ul>
                    <?php
                    }
                ?>
            </div>
        </div>

        <!-- 作废模态框 -->
        <form method="POST" action="../../controller/fl/zffl.php" enctype="multipart/form-data">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                作废单据
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 270px;">
                            <input style="display:none" type="text" name="id" value="<?=$id?>"/>
                            <p>备注</p>
                            <textarea class="form-control" cols="10" rows="10" name="zf_note"></textarea>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">作废</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>

        
        <?php
            $sqlstr6="select phone from user_form where username='$username'";
            
            $result=mysqli_query($conn,$sqlstr6);
                
            while($myrow=mysqli_fetch_row($result)){
                $phone=$myrow[0];
            }
            
        ?>

        <!-- 财务短信验证码模态框 -->
        <form method="POST" action="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=1" enctype="multipart/form-data">
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:20%;left:20%">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:400px;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                短信验证码
                            </h4>
                        </div>
                        
                        <div class="modal-body" style="height: 150px;">
                            <p>发送验证码手机：<span id="phone"><?=$phone?></span></p>
                            <span id="yzm" style="display:none"></span>
                            <p style="margin-top:20px;">请输入短信验证码：</p>
                            <div style="margin-top:10px;">    
                                <input type="text" placeholder="请输入短信验证码" class="form-control" name="yzm" id="user_yzm" style="width:200px;float:left"/>
                                <button type="button" class="agree_yzm btn btn-sm btn-info" style="float:left;margin-top:2px;margin-left:10px;">重新发送</button>      
                                <!--<span style="float:left;margin-top:7px;margin-left:20px;">60s</span>-->
                            </div>                        
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="submit_yzm">确认</button>
                            <button type="submit" class="btn btn-success" id="hd_submit_yzm" style="display:none">确认</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>

<script>
    <?php
        if($shr_arr1==$username and $department != "义乌部" and $status !="义乌打包发货"){
            ?>
            $("#yes").click(function(){
                window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=1"
            })
        
            $("#no").click(function(){
                window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=0"
            })
    <?php
        }else{
            ?>
            $("#yes").click(function(){

                wlfs=$("#wlfs").val()
                wlno=$("#wlno").val()
                wlprice=$("#wlprice").val()
                note=$("#note").val()

                window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=3&wlfs=" + wlfs + "&wlno=" + wlno + "&wlprice=" + wlprice + "&note=" + note
            })
        
            $("#no").click(function(){
                window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=0"
            })
        <?php

        }
    ?>
   
   $("#yes4").click(function(){
        window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=6"
    })

    $("#edit_YW").click(function(){
        wlfs=$("#wlfs").val()
        wlno=$("#wlno").val()
        wlprice=$("#wlprice").val()
        note=$("#note").val()

        window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=8&wlfs=" + wlfs + "&wlno=" + wlno + "&wlprice=" + wlprice + "&note=" + note
    })

    $(".agree_yzm").click(function(){
        
        phone=$("#phone").html()

        $.ajax({
            type:"get",
            async:true,
            url:"../../controller/fl/fl_yzm.php?phone=" + phone,
            dataType:"json",
            success:function(result){
                $("#yzm").html(result)
                alert("发送成功！")
            }
        })
    })

    $("#submit_yzm").click(function(){
        user_yzm=$("#user_yzm").val();
        sys_yzm=$("#yzm").html();

        if(user_yzm !=sys_yzm){
            alert("验证码错误！")
        }else{
            $("#hd_submit_yzm").click()
        }
    })



    //打印页面
    var printPage= function(){

        //页面打印缩放比例设置
        //document.getElementsByTagName('form').style.zoom=2;
        var xmlhttp;
        if(window.ActiveXObject){
            xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
        }else{
            xmlhttp=new XMLHttpRequest();
        }

        xmlhttp.open("GET","../../controller/fl/isPrint.php?id=<?=$id?>&department=<?=$department?>",true);

        xmlhttp.onreadystatechange=function(){
            
            if(xmlhttp.readyState==4 && xmlhttp.status ==200){

                var msg=xmlhttp.responseText;
                if(msg==0){
                    //alert("打印订单！")
                }else{
                    //alert("打印失败！")                    
                }
            }
        }
        
        xmlhttp.send(null);


        window.print();
        
    }

    $("#backEdit").click(function(){
        window.location.href="../../controller/fl/flLiucheng.php?id=<?=$id?>&option=0"
    })

</script>