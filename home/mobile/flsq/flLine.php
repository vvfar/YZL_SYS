<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_登陆网站</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="../../../public/lib/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet"/>
        <script src="../../../public/lib/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>

        <div data-role="header" data-theme="b" data-position="fixed">
            <a href="#" data-role="button" data-icon="back" data-rel="back">后退</a>
            <h1>辅料单详情</h1>
            <?php
                include_once("../../../common/conn/conn.php");
                error_reporting(E_ALL || ~E_NOTICE);

                session_start();

                if(isset($_SESSION["username"])){
                    $username=$_SESSION["username"];
    
                    $sqlstr1="select department,level from user_form where username='$username'";
        
                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                        $level=$myrow[1];
                    }
                }else{
                    echo("<script>alert('请先登录！');window.location.href='../login.php'</script>");
                }
            ?>
            
            <a href="#"><?=$username?></a>
        </div>

        <div data-role="content" style="font-size:8px;">
        <?php


            $username=$_SESSION["username"];

            $sqlstr1="select department,level from user_form where username='$username'";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $department=$myrow[0];
                $level=$myrow[1];
                $department2=$myrow[0];
            }


            $id=$_GET['id'];

            if(isset($_GET['tab_name'])){
                if($_GET['tab_name']==1){
                    $sqlstr2="select * from flsqd where id='$id'";
                }else{
                    $sqlstr2="select * from oldflsqd where id='$id'";
                }
                
            }else{
                $sqlstr2="select * from flsqd where id='$id'";
            }
            
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

        ?>

        
        
        <form action="formHandle/addFLSQD.php" method="POST" style="clear:both;">
            <div style="float:left;margin-top:20px;">
                <div class="sqd_st" style="clear:both;float: left;">
                    <?php
                        $status_arr=explode(",",$status);
                        $status_pop=array_pop($status_arr);
                    ?>
                    <p>申请单状态：<?=$status_pop?></p>
                </div>

                <div class="sqd_bh" style="float: left;margin-left:10px;">
                    <p style="float: left;">申请单编号:<?=$no?></p>
                </div>

                <div class="sqd_print" style="float: left;margin-left:10px;">
                    <p style="float: left;">义乌是否已打印：<?php
                        if($isprint=="1"){
                            echo "是";
                        }else{
                            echo "否";
                        }
                    ?></p>
                </div>
            </div>

            <table class="tb1" border="1" cellspacing="0" style="clear:both;margin-bottom:30px;text-align:center">
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
                    <td colspan="9">服务费辅料费总计</td>
                    <td colspan="9" id="fwfflfhj"><?=$hd_fwfflfzj?></td>
                    <td colspan="6">结款方式</td>
                    <td colspan="6"><?=$jkfs?></td>
                    <td colspan="3">业务员</td>
                    <td colspan="3"><?=$ywy?></td>
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


                    if($department=="义乌"){
                        if($status_pop=="义乌审批单据"){
                        ?>
                            <tr>
                                <td colspan="6">物流方式</td>
                                <td colspan="6"><input type="text" value="<?=$wlfs?>" style="width: 100%;" name="wlfs" id="wlfs"/></td>
                                <td colspan="6">物流单号</td>
                                <td colspan="6"><input type="text" value="<?=$wlno?>" style="width: 100%;" name="wlno" id="wlno"/></td>
                                <td colspan="6">物流费用</td>
                                <td colspan="6"><input type="text" value="<?=$wlprice?>" style="width: 100%;" name="wlprice" id="wlprice"/></td>
                            </tr>
                            <tr>
                                <td colspan="6">备注</td>
                                <td colspan="30"><input type="text" value="<?=$note?>" style="width: 100%;" name="note" id="note"/></td>
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
                            <td colspan="6"><a href="sx_file/<?=$file_name?>"><?=$sqid?></a></td>
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
            
            <?php

                if($file !="" and (explode(".",$file)[1]=="jpg" or explode(".",$file)[1]=="png")){
            ?>
                <p style="margin-left:40px;" class="fj"><a href="fl_file/<?=$file?>">照片预览</a></p>
                <span style="margin-left:40px;margin-bottom:50px;">文件名：<?=$file?></span>
            <?php
                }else if($file !="" and explode(".",$file)[1] !="jpg"){
                ?>
                    <p style="margin-left:40px;" class="fj"><a href="fl_file/<?=$file?>">下载附件</a></p>
                    <span style="margin-left:40px;margin-bottom:50px;">文件名：<?=$file?></span>
                <?php
                }
            ?>
            
            <div>
                <?php
                    $arr_shr=explode(",",$shr);
                    $shr_arr3=array_shift($arr_shr);
                    $shr_arr1=array_pop($arr_shr);
                    

                    if($shr_arr1 == $username){
                        if($department != "义乌" and $department != "品牌部"){

                        
                ?>
                    <button type="button" class="btn btn-success btn-sm" id="yes" style="width:45%;float:left;">同意</button>
                    <button type="button" class="btn btn-danger btn-sm" id="no" style="width:45%;float:right;">拒绝</button>
            
                <?php
                        }else{
                            ?>
                                <button type="button" class="btn btn-info btn-sm" id="yes" style="margin-left:50px;">已记录</button>
                            <?php
                        }
                    
                    }else{
                        ?>

                        <?php
                    }
                    

                    if(sizeof($arr_shr)==0){
                        if($shr_arr3 == $username){
                        ?>
                            <button type="button" class="btn btn-info btn-sm" id="yes4" style="margin-left:37px;">修改单据</button>
                        <?php
                        }
                    }

                    $sqlstr1="select department,level from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $department2=$myrow[0];
                        $level=$myrow[1];
                    }

                    if($status=="待业务员审核" and $department==$department2){
                        if($level == "专员"){
                        ?>
                            <button type="button" class="btn btn-info btn-sm" id="yes4" style="margin-left:37px;">修改单据</button>
                        <?php
                        }
                    }
                ?>
            </div>
        </form>
        
        <div style="clear:both;" class="sh_time">
            <p>单据审核过程：</p>
            <?php
                for($i=0;$i<sizeof($allTime_arr);$i++){
                    ?>
                    <p>状态：<?=$status_arr2[$i]?>&nbsp;&nbsp;&nbsp;&nbsp;
                        审核人：<?=$shr_arr2[$i]?>&nbsp;&nbsp;&nbsp;&nbsp;
                        审核时间：<?=$allTime_arr[$i]?></p>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

        <div data-role="footer" data-theme="b" data-position="fixed">
            <nav data-role="navbar">
                <ul>
                    <li><a href="#" onclick="alert('暂未开放，请在PC端填写单据！')">新增辅料单</a></li>
                    <li><a href="flList.php">未完成辅料</a></li>
                    <li><a href="../index.php">主菜单</a></li>
                    <li><a href="flDone.php">已完成辅料</a></li>
                    <li><a href="flQuery.php">辅料单查询</a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>

<script>
    <?php
        if($shr_arr1==$username and $department != "义乌部" and $status !="义乌打包发货"){
            ?>
            $("#yes").click(function(){
                window.location.href="../../../controller/fl/flLiucheng.php?id=<?=$id?>&option=1"
            })
        
            $("#no").click(function(){
                window.location.href="../../../controller/fl/flLiucheng.php?id=<?=$id?>&option=0"
            })
    <?php
        }else{
            ?>
            $("#yes").click(function(){

                wlfs=$("#wlfs").val()
                wlno=$("#wlno").val()
                wlprice=$("#wlprice").val()
                note=$("#note").val()

                window.location.href="../../../controller/fl/flLiucheng.php?id=<?=$id?>&option=3&wlfs=" + wlfs + "&wlno=" + wlno + "&wlprice=" + wlprice + "&note=" + note
            })
        
            $("#no").click(function(){
                window.location.href="../../../controller/fl/flLiucheng.php?id=<?=$id?>&option=0"
            })
        <?php

        }
    ?>
   
   $("#yes4").click(function(){
        window.location.href="../../../controller/fl/flLiucheng.php?id=<?=$id?>&option=6"
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

        xmlhttp.open("GET","formHandle/isPrint.php?id=<?=$id?>&department=<?=$department?>",true);

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



</script>