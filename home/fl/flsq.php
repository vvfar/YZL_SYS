<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=0.8">
        <title>俞兆林_辅料申请</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="../../public/css/leftbar.css" rel="stylesheet"/>
        <link href="../../public/css/header.css" rel="stylesheet"/>
        <link href="../../public/css/flsq.css" rel="stylesheet"/>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="../../public/js/flsq.js"></script>
        
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>
        
        <div class="flsq_div">
            
            <?php
                error_reporting(E_ALL || ~E_NOTICE);

                $username=$_SESSION["username"];
                
                $sqlstr1="select department from user_form where username='$username'";

                $result=mysqli_query($conn,$sqlstr1);

                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[0];
                    $my_department=$myrow[0];
                }

                if(isset($_GET['id']) && $_GET['id']!=""){
                    $id=$_GET['id'];

                    $sqlstr2="select * from flsqd where id='$id'";

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
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
                    }

                    $sqlstr3="select sqid,nowUseMoney from use_sx where fl_no='$no'";

                    $result=mysqli_query($conn,$sqlstr3);

                    while($myrow=mysqli_fetch_row($result)){
                        $sqid=$myrow[0];
                        $nowUseMoney=$myrow[1];
                    }
                }else{
                    $id="";
                    $no="";
                    $company="";
                    $people="";
                    $department="";
                    $date="";
                    $address="";
                    $connection="";
                    $phone="";
                    $driving="";
                    $ishs="";

                    $category="";
                    $productNo="";
                    $productName="";
                    $amount="";
                    $price="";
                    $fls="";
                    $fwfxj="";
                    $flsName="";
                    $dj="";
                    $sl="";
                    $flfxj="";

                    $sd="";
                    $jkfs="";
                    $wlfs="";
                    $wlno="";
                    $wlprice="";
                    $note="";

                    $hd_sqslhj="";
                    $hd_fwfhj="";
                    $hd_flsl="";
                    $hd_flfhjsh="";
                    $hd_fwfflfzj="";
                    $hd_count=2;
                    $ywy="";
                    $status="";
                }
            
            ?>
                    
            <form action="../../../controller/fl/addFLSQD.php?no=1" method="POST" onkeydown="if(event.keyCode==13)return false;" enctype="multipart/form-data" onSubmit="return submitOnce(this)">
        
                <div class="sqdbh">
                    <p>申请单编号</p>
                    <?php
                        if($no==""){

                            //订单自动编号
                            $sqlstr3="select no from fl_no where department='$my_department'";
                            $result=mysqli_query($conn,$sqlstr3);

                            while($myrow=mysqli_fetch_row($result)){
                                $fl_no=$myrow[0];
                            }

                            $fl_no_date_arr=explode("-",$fl_no);
                            $fl_no_date=array_pop($fl_no_date_arr);

                            $fl_no_year=(int)substr($fl_no_date,0,4);
                            $fl_no_month=(int)substr($fl_no_date,4,2);
                            $fl_no_num=substr($fl_no_date,6,3);

                            date_default_timezone_set("Asia/Shanghai");
                            $sys_date=date('Y-m-d', time());
                            $sys_date_arr=explode("-",$sys_date);

                            $sys_date_year=(int)$sys_date_arr[0];
                            $sys_date_month=(int)$sys_date_arr[1];
                            
                            if($sys_date_month>$fl_no_month and $sys_date_year==$fl_no_year){
                                $fl_no_month=$sys_date_month;
                                $fl_no_num=0;
                            }
                            
                            if($sys_date_year>$fl_no_year){
                                $fl_no_month=$sys_date_month;
                                $fl_no_year=$sys_date_year;

                                $fl_no_num=0;
                            }

                            $fl_no_num=$fl_no_num + 1;

                            if($fl_no_num<10){
                                $fl_no_num="00".$fl_no_num;
                            }elseif($fl_no_num<100){
                                $fl_no_num="0".$fl_no_num;
                            }

                            if($fl_no_month<10){
                                $fl_no_month="0".$fl_no_month;
                            }

                            $fl_no_date_new=$fl_no_year.$fl_no_month.$fl_no_num;

                            $fl_no_new=str_replace($fl_no_date,$fl_no_date_new,$fl_no);

                    ?>
                        <input type="text" value="<?=$fl_no_new?>" placeholder="请填写申请单编号" name="no" id="no_input" readonly/>
                    <?php
                        }else{
                        ?>
                            <input type="text" value="<?=$no?>" placeholder="请填写申请单编号" name="no" id="no_input" readonly/>
                        <?php 
                        }
                    ?>

                    
                    <span></span>
                </div>
                            
                <table class="tb1" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>申请单位</td>
                        <td><input type="text" value="<?=$company?>" placeholder="请填写申请单位" class="w6" name="company"/></td>
                        <td>部门</td>
                        <td><input type="text" value="<?php
                            if($department==""){
                                echo $my_department;
                            }else{
                                echo $department;
                            }?>"
                        
                        class="w7" name="department" readonly="readonly"/></td>
                        <td>申请人</td>
                        <td><input type="text" class="w8" name="people" value="<?php
                            if($department==""){
                                echo $username;
                            }else{
                                echo $people;
                            }?>" readonly="readonly"/></td>

                        <td>申请日期</td>
                        <td><input type="text" value="<?php
                            if($date==""){
                                date_default_timezone_set("Asia/Shanghai");
                                echo date('Y-m-d H:i:s', time());
                            }else{
                                echo $date;
                            }
                        
                        ?>"
                        class="w9" name="date" readonly="readonly"/></td>
                        <!--<td><input type="text" value="<?=$date?>" placeholder="请填写申请日期" style="width: 140px;" name="date"/></td>-->
                    </tr>
                    <tr>
                        <td>收货地址</td>
                        <td><input type="text" value="<?=$address?>" placeholder="请填写收货地址" class="w6" name="address"/></td>
                        <td>联系人</td>
                        <td><input type="text" value="<?=$connection?>" placeholder="请填写联系人" class="w7" name="connection"/></td>
                        <td>联系电话</td>
                        <td><input type="text" value="<?=$phone?>" placeholder="请填写联系电话" class="w8" name="phone"/></td>
                        <td>运输方式</td>
                        <td>
                            <select style="height: 25px;" class="w9" name="driving">
                                <?php
                                    if($driving=="物流寄付"){
                                ?>
                                    <option selected="selected">物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option>
                                <?php
                                    }elseif($driving=="物流到付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option selected="selected">物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="快递寄付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option selected="selected">快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="快递到付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option selected="selected">快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="顺丰到付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option selected="selected">顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="德邦快递到付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option selected="selected">德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="德邦物流到付"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option selected="selected">德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="送货上门"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option selected="selected">送货上门</option>
                                    <option>自提</option> 
                                <?php
                                    }elseif($driving=="自提"){
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option selected="selected">自提</option> 
                                <?php
                                    }else{
                                ?>
                                    <option>物流寄付</option>
                                    <option>物流到付</option>
                                    <option>快递寄付</option>
                                    <option>快递到付</option>
                                    <option>顺丰到付</option>
                                    <option>德邦快递到付</option>
                                    <option>德邦物流到付</option>
                                    <option>送货上门</option>
                                    <option>自提</option> 
                                <?php  
                                    }
                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">基本信息</td>
                        <td colspan="2">服务费用</td>
                        <td colspan="3">辅料费用</td>
                    </tr>
                </table>
                <table  class="tb2" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="w1">序号</td>
                        <td class="w1">品类</td>
                        <td class="w1">货号</td>
                        <td class="w1">品名</td>
                        <td class="w2">申请数量</td>
                        <td class="w2">
                            <select style="height: 25px;" name="ishs">
                                <option></option>
                                <?php
                                    if($ishs=="含税包装价格"){
                                ?>
                                    <option selected="selected">含税包装价格</option>
                                    <option>不含税包装价格</option>
                                <?php
                                    }elseif($ishs=="不含税包装价格"){
                                ?>
                                    <option>含税包装价格</option>
                                    <option selected="selected">不含税包装价格</option>
                                <?php
                                    }else{
                                ?>
                                    <option>含税包装价格</option>
                                    <option selected="selected">不含税包装价格</option>
                                <?php        
                                    }
                                ?>
                                
                            </select>
                        </td>
                        <td class="w2">费率 /<br>单价</td>
                        <td class="w2">服务费<br>小计</td>
                        <td class="w3">辅料名称</td>
                        <td class="w3">单价</td>
                        <td class="w3">辅料数量</td>
                        <td class="w3">辅料小计</td>
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

                        
                    ?>
                    <tr>
                        <?php 
                            if($id==""){
                                ?>
                                <td><button type="button" class="btn btn-success btn-xs" id="addLine" style="width:32px;padding:2px;">添加<?php
                                    if($hd_count<2){
                                        ?><p id="count" style="display:none">1</p></button><?php
                                    }else{
                                        ?><p id="count" style="display:none"><?=$hd_count-2?></p></button>
                                    <?php    
                                    }
                                    ?>
                                    <button type="button" class="btn btn-danger btn-xs" id="delLine" style="width:32px;padding:2px;">删除<?php
                                        if($hd_count<2){
                                        ?>
                                        <p id="count" style="display:none">1</p></button>
                                        <?php
                                        }else{
                                        ?>
                                            <p id="count" style="display:none"><?=$hd_count-2?></p></button>
                                        <?php    
                                        }
                                        ?>
                                </td>
                                <?php
                                }else{
                                    ?>
                                    <td><button type="button" class="btn btn-success btn-xs" id="addLine2">添加<?php
                                        if($hd_count<2){
                                            ?><p id="count" style="display:none">1</p></button><?php
                                        }else{
                                            ?><p id="count" style="display:none"><?=$hd_count-2?></p></button>
                                        <?php    
                                        }
                                        ?>
                                        <button type="button" class="btn btn-danger btn-xs" id="delLine2" style="clear:both">删除<?php
                                            if($hd_count<2){
                                            ?>
                                            <p id="count" style="display:none">1</p></button>
                                            <?php
                                            }else{
                                            ?>
                                                <p id="count" style="display:none"><?=$hd_count-2?></p></button>
                                            <?php    
                                            }
                                            ?>
                                    </td>
                                    <?php 
                                }
                            ?>                        
                        <td colspan="11" class="tdNote">注意：当一个流程内有多个品类需要辅料时，每个品类项下的辅料填写完成以后（含防伪标）方可填写下一个品类的辅料，不可合并填写。</td>
                    </tr>
                    <?php
                        if($hd_count ==1){
                            $hd_count =2;
                        }
                        
                        for($i=0;$i<$hd_count-1;$i++){
                            for($i=0;$i<20;$i++){
                                if($hd_count >2){
                                    if($i<$hd_count){
                                        ?>
                                        <tr class="tr<?=$i?>">
                                        <?php
                                    }else{
                                        ?>
                                        <tr class="tr<?=$i?> hidden">
                                        <?php  
                                    }
                                }elseif($hd_count ==2 && !isset($_GET['id'])){
                                    if($i<$hd_count-1){
                                        ?>
                                        <tr class="tr<?=$i?>">
                                        <?php
                                    }else{
                                        ?>
                                        <tr class="tr<?=$i?> hidden">
                                        <?php  
                                    }
                                }elseif($hd_count ==2 && isset($_GET['id'])){
                                    if($i<$hd_count){
                                        ?>
                                        <tr class="tr<?=$i?>">
                                        <?php
                                    }else{
                                        ?>
                                        <tr class="tr<?=$i?> hidden">
                                        <?php  
                                    }
                                }else{
                                    if($hd_count >2){
                                        if($i<$hd_count){
                                            ?>
                                            <tr class="tr<?=$i?>">
                                            <?php
                                        }else{
                                            ?>
                                            <tr class="tr<?=$i?> hidden">
                                            <?php  
                                        }
                                    }
                                }
                                
                    ?>
                    
                        <td><?=$i+1?></td>
                        <td><input type="text" value="<?=$category_arr[$i]?>" class="w100" name="category<?=$i?>"/></td>
                        <td><input type="text" value="<?=$productNo_arr[$i]?>" class="w100" name="productNo<?=$i?>"/></td>
                        <td><input type="text" value="<?=$productName_arr[$i]?>" class="w100" name="productName<?=$i?>"/></td>
                        <td class="sqsl"><input type="text" value="<?=$amount_arr[$i]?>" class="w100" name="amount<?=$i?>"/></td>
                        <td class="bzjg"><input type="text" value="<?=$price_arr[$i]?>" class="w100" name="price<?=$i?>"/></td>
                        <td class="fldj"><input type="text" value="<?=$fls_arr[$i]?>" class="w100" name="fls<?=$i?>"/></td>
                        <td class="fwfxj"><?=$fwfxj_arr[$i]?></td>
                        <td>
                            <select style="width: 100%;height: 25px;" name="flsName<?=$i?>">
                                <option></option>
                                <?php

                                    $sqlstr1="select fl_name from fl order by fl_name asc";

                                    $result=mysqli_query($conn,$sqlstr1);

                                    while($myrow=mysqli_fetch_row($result)){
                                        if($myrow[0]==$flsName_arr[$i]){
                                            ?>
                                                <option selected="selected"><?=$myrow[0]?></option>
                                            <?php
                                        }else{
                                            ?>
                                                <option><?=$myrow[0]?></option>
                                            <?php
                                        }
                                        ?>
    
                                    <?php
                                    }
                                
                            ?> 
                            </select>
                        </td>
                        <td class="dj"><input type="text" value="<?=$dj_arr[$i]?>" style="width: 100%;" name="dj<?=$i?>"/></td>
                        <td class="sl"><input type="text" value="<?=$sl_arr[$i]?>" style="width: 100%;" name="sl<?=$i?>"/></td>
                        <td class="flfxj"><?=$flfxj_arr[$i]?></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                    
                    <tr>
                        <td colspan="4">申请数量合计</td>
                        <td id="hj"><?=$hd_sqslhj?></td>
                        <td colspan="2">服务费合计</td>
                        <td id="fwfhj"><?=$hd_fwfhj?></td>
                        <td>税点</td>
                        <td class="sd"><input type="text" value="<?=$sd?>" style="width: 100%;" name="sd"/></td>
                        <td id="flslhj"><?=$hd_flsl?></td>
                        <td id="flfhj" style="display:none"></td>
                        <td colspan="1" id="fwfhjhs"><?=$hd_flfhjsh?></td>
                    </tr>
                    <tr>
                        <td colspan="4">服务费辅料费总计</td>
                        <td colspan="4" id="fwfflfhj"><?=$hd_fwfflfzj?></td>
                        <td colspan="2">结款方式</td>
                        <td colspan="2">
                            <select style="height: 25px;width: 100%;" name="jkfs">
                                <?php
                                    if($jkfs=="全现金"){
                                ?>
                                    <option selected="selected">全现金</option>
                                    <option>全授信</option>
                                    <option>服务费授信，辅料费现金</option>
                                    <option>服务费现金，辅料费授信</option>
                                    <option>其他</option>
                                <?php
                                    }elseif($jkfs=="全授信"){
                                ?>
                                    <option>全现金</option>
                                    <option selected="selected">全授信</option>
                                    <option>服务费授信，辅料费现金</option>
                                    <option>服务费现金，辅料费授信</option>
                                    <option>其他</option>
                                <?php  
                                    }elseif($jkfs=="服务费授信，辅料费现金"){
                                ?>
                                    <option>全现金</option>
                                    <option>全授信</option>
                                    <option selected="selected">服务费授信，辅料费现金</option>
                                    <option>服务费现金，辅料费授信</option>
                                    <option>其他</option>
                                <?php
                                    }elseif($jkfs=="服务费现金，辅料费授信"){
                                ?>
                                    <option>全现金</option>
                                    <option>全授信</option>
                                    <option>服务费授信，辅料费现金</option>
                                    <option selected="selected">服务费现金，辅料费授信</option>
                                    <option>其他</option>
                                <?php
                                    }elseif($jkfs=="其他"){
                                ?>
                                    <option>全现金</option>
                                    <option>全授信</option>
                                    <option>服务费授信，辅料费现金</option>
                                    <option>服务费现金，辅料费授信</option>
                                    <option selected="selected">其他</option>
                                <?php
                                    }else{
                                        ?>
                                        <option>全现金</option>
                                        <option>全授信</option>
                                        <option>服务费授信，辅料费现金</option>
                                        <option>服务费现金，辅料费授信</option>
                                        <option>其他</option>
                                    <?php        
                                    }
                                ?>
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">物流方式</td>
                        <td colspan="2"><input type="text" value="<?=$wlfs?>" class="w100" name="wlfs"/></td>
                        <td colspan="2">物流单号</td>
                        <td colspan="2"><input type="text" value="<?=$wlno?>" class="w100" name="wlno"/></td>
                        <td colspan="2">物流费用</td>
                        <td colspan="2"><input type="text" value="<?=$wlprice?>" class="w100" name="wlprice"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">备注</td>
                        <td colspan="10"><input type="text" value="<?=$note?>" class="w100" name="note"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">授信编号</td>
                        <td colspan="2">
                            <select name="sxid" class="w100" style="height:23px;" id="sxid">
                                <option></option>
                                <?php
                                    $sqlstr4="select distinct a.sqid from sx_form a,use_sx b where a.sqid=b.sqid and (a.department='$department' or a.gxDepartment='$department') and a.status='已生效' and b.newMoney > 0";

                                    $result4=mysqli_query($conn,$sqlstr4);

                                    while($myrow=mysqli_fetch_row($result4)){
                                        if($sqid==$myrow[0]){
                                            ?>
                                                <option selected><?=$myrow[0]?></option>
                                            <?php
                                        }else{
                                            ?>
                                                <option><?=$myrow[0]?></option>
                                            <?php
                                        }
                                        
                                    }

                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                            </select>
                        </td>
                        <td colspan="2">使用授信金额</td>
                        <td colspan="2"><input type="text" value="<?=$nowUseMoney?>" class="w100" name="sxmoney"/></td>
                        <td colspan="2">可使用额度</td>
                        <td colspan="2">￥<span id="newMoney"></span></td>
                    </tr>
                    <!-- 隐藏表单用于数据提交 -->
                    <tr class="hidden">
                        <td><input type="text"  name="hd_sqslhj" id="hd_sqslhj"/></td>
                        <td><input type="text"  name="hd_fwfhj" id="hd_fwfhj"/></td>
                        <td><input type="text"  name="hd_flsl" id="hd_flsl"/></td>
                        <td><input type="text"  name="hd_flfhjsh" id="hd_flfhjsh"/></td>
                        <td><input type="text"  name="hd_fwfflfzj" id="hd_fwfflfzj"/></td>
                        <td><input type="text"  name="hd_count" id="hd_count"/></td>
                        <td><input type="id"  name="id" value="<?=$id?>" id="hd_count"/></td>
                    </tr>
                </table>
                
                <!--
                <div style="margin-top:30px;margin-left:30px;">
                    <p style="font-weight:bold">授信单据附件上传</p>
                    <p style="color:red">(文件名为申请单编号，不能出现中文)</p>
                    <span style="float: left">上传</span><input type="file" name="upfile" style="float: left;margin-left: 15px;"/>
                </div>
                -->
                
                <!-- 判断状态，保存0，提交1 -->
                <input type="hidden"  name="option" value="1" id="option"/>

                <div style="clear:both">
                    <button type="button" class="btn btn-success btn-sm mt30 ml30" id="submit">点击提交</button>
                    <button type="button" class="btn btn-info btn-sm mt30" id="save" style="margin-left:10px;">一键保存</button>
                    <button type="submit" class="btn btn-success btn-sm hidden" id="hd_submit">隐藏提交</button>
                </div>
            </form>
        </div>
    </body>
</html>

<script language="javascript">  
    var submitcount=0;  
    function submitOnce (form){  
        if (submitcount == 0){  
            submitcount++;  
            return true;  
        } else{  
            alert("正在操作，请不要重复提交，谢谢！");  
            return false;  
        }  
    }  

</script>