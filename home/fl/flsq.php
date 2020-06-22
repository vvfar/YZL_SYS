<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=0.8">
        <meta name="renderer" content=webkit>
        <title>俞兆林_辅料申请</title>
        <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" media="screen" />
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="../../public/lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="../../public/css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="../../public/css/header.css?v=2" rel="stylesheet"/>
        <link href="../../public/css/flsq.css" rel="stylesheet"/>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="../../public/js/flsq.js?v=6"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="../../public/lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php");?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>
        
        <div class="flsq_div" style="margin-top:50px;">
            
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

            <div class="nav nav-pills" style="float:left;margin-top:10px;margin-left:30px;">
                <li role="presentation" class="active"><a href="#">新增辅料</a></li>
                <li role="presentation"><a href="saveFL.php">已保存</a></li>
            </div>

            <form action="../../../controller/fl/addFLSQD.php?no=1" method="POST" onkeydown="if(event.keyCode==13)return false;" enctype="multipart/form-data" onSubmit="return submitOnce(this)">
        
                <div class="sqdbh" style="float:left">
                    <p style="margin:0">申请单编号</p>
                    <input type="hidden" value="<?=$id?>" name="my_id" id="my_id">
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
                </div>
                
                <?php
                    if(!isset($_GET['id'])){
                        ?>
                            <button type="reset" class="btn btn-danger btn-sm" style="float:left;margin-left:695px;margin-top:-10px">重置表单</button>
                        <?php
                    }else{
                        ?>
                            <button type="reset" id="delete" class="btn btn-danger btn-sm" style="float:right;margin-right:50px;margin-top:-10px">删除表单</button>
                        <?php
                    }
                ?>
                

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
                        style="width:150px;" name="date" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>收货地址</td>
                        <td><input type="text" value="<?=$address?>" placeholder="请填写收货地址" class="w6" name="address"/></td>
                        <td>联系人</td>
                        <td><input type="text" value="<?=$connection?>" placeholder="请填写联系人" class="w7" name="connection"/></td>
                        <td>联系电话</td>
                        <td><input type="text" value="<?=$phone?>" placeholder="请填写联系电话" class="w8" name="phone" maxlength="13"/></td>
                        <td>运输方式</td>
                        <td>
                            <select style="height: 20px;width:150px;text-align:center; text-align-last:center;" id="driving" name="driving">
                                <option></option>
                                <?php

                                    $sqlstr1="select name from fl_wlfs";

                                    $result=mysqli_query($conn,$sqlstr1);

                                    while($myrow=mysqli_fetch_row($result)){
                                        if($myrow[0]==$driving){
                                            ?>
                                                <option selected><?=$myrow[0]?></option>
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
                    </tr>
                </table>
                <table  class="tb2" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="4">基本信息</td>
                        <td colspan="4">服务费用</td>
                        <td colspan="4">辅料费用</td>
                    </tr>
                    <tr>
                        <td>序号</td>
                        <td>品类</td>
                        <td>货号</td>
                        <td>品名</td>
                        <td>申请数量</td>
                        <td>
                            <select style="height: 20px;width:80%" name="ishs">
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
                        <td>费率 / 单价</td>
                        <td style="width:80px;">服务费小计</td>
                        <td style="width:80px;">辅料名称</td>
                        <td>单价</td>
                        <td>辅料数量</td>
                        <td style="width:80px;">辅料小计</td>
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
                                <td style="width:80px"><button type="button" class="btn btn-success btn-xs" id="addLine" style="width:32px;padding:2px;">添加<?php
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
                        
                        <td><input type="text" value="<?=$category_arr[$i]?>" name="category<?=$i?>"/></td>
                        <td><input type="text" value="<?=$productNo_arr[$i]?>" name="productNo<?=$i?>"/></td>
                        <td><input type="text" value="<?=$productName_arr[$i]?>" name="productName<?=$i?>"/></td>
                        <td class="sqsl"><input type="text" value="<?=$amount_arr[$i]?>" name="amount<?=$i?>"/></td>
                        <td class="bzjg"><input type="text" value="<?=$price_arr[$i]?>" name="price<?=$i?>"/></td>
                        <td class="fldj"><input type="text" value="<?=$fls_arr[$i]?>" name="fls<?=$i?>"/></td>
                        <td class="fwfxj"><?=$fwfxj_arr[$i]?></td>
                        <td class="flno">
                            <select style="width: 80%;height: 20px;text-align:center; text-align-last:center;" name="flsName<?=$i?>">
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
                        <td class="dj"><input type="text" value="<?=$dj_arr[$i]?>" name="dj<?=$i?>" readonly/></td>
                        <td class="sl"><input type="text" value="<?=$sl_arr[$i]?>" name="sl<?=$i?>"/></td>
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
                        <td class="sd"><input type="text" value="<?=$sd?>" name="sd"/></td>
                        <td id="flslhj"><?=$hd_flsl?></td>
                        <td id="flfhj" style="display:none"></td>
                        <td id="fwfhjhs"><?=$hd_flfhjsh?></td>
                    </tr>
                    <tr>
                        <td colspan="4">服务费辅料费总计</td>
                        <td colspan="4" id="fwfflfhj"><?=$hd_fwfflfzj?></td>
                        <td colspan="1">结款方式</td>
                        <td colspan="3">
                            
                            <select style="height: 20px;width:94%;text-align:center; text-align-last:center;" name="jkfs">
                                <option></option>
                                <?php
                                    $sqlstr1="select name from fl_jkfs";

                                    $result=mysqli_query($conn,$sqlstr1);

                                    while($myrow=mysqli_fetch_row($result)){
                                        if($myrow[0]==$jkfs){
                                            ?>
                                                <option selected><?=$myrow[0]?></option>
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
                    </tr>
                    <tr>
                        <td colspan="2">物流方式</td>
                        <td colspan="2"><input type="text" value="<?=$wlfs?>" name="wlfs"/></td>
                        <td colspan="2">物流单号</td>
                        <td colspan="2"><input type="text" value="<?=$wlno?>" name="wlno"/></td>
                        <td colspan="2">物流费用</td>
                        <td colspan="2"><input type="text" value="<?=$wlprice?>" name="wlprice"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">备注</td>
                        <td colspan="10"><input type="text" value="<?=$note?>" name="note" style="width:96%"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">授信编号</td>
                        <td colspan="2">
                            <select name="sxid" style="height:20px;width:80%" id="sxid">
                                <option></option>
                                <?php
                                    $sqlstr4="select distinct a.sqid from sx_form a,use_sx b where a.sqid=b.sqid and (a.department='$my_department' or a.gxDepartment='$my_department') and a.status !='已作废' and b.newMoney > 0";
                                    
                                    echo $sqlstr4;

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
                        <td colspan="2"><input colspan="2" type="text" value="<?=$nowUseMoney?>" name="sxmoney"/></td>
                        <td colspan="2">可使用额度</td>
                        <td colspan="2">￥<span colspan="2" id="newMoney"></span></td>
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
                
                <!-- 判断状态，保存0，提交1 -->
                <input type="hidden"  name="option" value="1" id="option"/>

                <div style="clear:both">
                    <button type="button" class="btn btn-success btn-sm mt20 ml20" id="submit">点击提交</button>
                    <button type="button" class="btn btn-info btn-sm mt20 ml20" id="save" style="margin-left:10px;">一键保存</button>
                    <button type="submit" class="btn btn-success btn-sm hidden" id="hd_submit">隐藏提交</button>
                </div>
            </form>
        </div>
    </body>
</html>