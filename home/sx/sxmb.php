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
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <?php

            $id=$_GET["id"];

            $sqlstr1="select * from sx_form where id=$id";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $no=$myrow[5];
                $company=$myrow[1];
                $sqmoney=$myrow[6];
                $sxf=$myrow[7];
                $startDate=$myrow[16];
                $endDate=$myrow[17];
                $reDate=$myrow[4];
                $dateTime=explode(",",$myrow[8]);
                $hkje=explode(",",$myrow[9]);
                $wyfl=explode(",",$myrow[10]);
                $hkfs=explode(",",$myrow[11]);
                $hkfsbz=explode(",",$myrow[12]);
            }

            $startDate_arr=explode("-",$startDate);
            $endDate_arr=explode("-",$endDate);
            $reDate_arr=explode("-",$reDate);
            
        ?>


        <div class="content">
            <div style="margin-left: 180px;">
                <div style="margin-left:830px;position:relative;top:30px;">
                    <button class="btn btn-sm btn-warning btn-download" style="float:left;margin-left:10px;">下载</button>
                    <button class="btn btn-sm btn-info btn-blue" style="float:left;margin-left:10px;">返回</button>
                </div>
                
                <div class="zw">
                    <div class="zw_content">
                        <p class="hd middle">授信欠据</p>
                        <p class="middle">编号：（<?=$no?>）</p>
                        <p style="margin-top:30px;">尊敬的上海俞兆林品牌管理有限公司领导：</p>
                        <p style="text-indent: 2em;"><span style="text-decoration: underline;" class="longLine"></span>（下称欠款人）因业务需求向上海俞兆林品牌管理有限公司申领商标、防伪标、合格证等（下称商标辅料），每次申领需向上海俞兆林品牌管理有限公司支付相关品牌服务费，为方便双方合作，现向<span style="text-decoration: underline;">上海俞兆林品牌管理有限公司</span>申请给与<span style="text-decoration: underline;"><?=$company?></span>&nbsp;<span id="xs" style="text-decoration: underline;"><?=$sqmoney?></span>元（大写人民币<span id="ds" style="text-decoration: underline;"></span>）授信额度，授信手续费<span style="text-decoration: underline;"><?=$sxf?></span>元，授信额度有效期限为<span style="text-decoration: underline;"><?=$startDate_arr[0]?></span>年<span style="text-decoration: underline;"><?=$startDate_arr[1]?></span>月<span style="text-decoration: underline;"><?=$startDate_arr[2]?></span>日至<span style="text-decoration: underline;"><?=$endDate_arr[0]?></span>年<span style="text-decoration: underline;"><?=$endDate_arr[1]?></span>月<span style="text-decoration: underline;"><?=$endDate_arr[2]?></span>日。在授信额度用完时，再次申领辅料需缴纳相应的标费及辅料费。
                        <p style="text-indent: 2em;">欠款人应当支付的品牌服务费具体金额由产品单价、申领数量及品牌服务费费率共同确定，申领数量及品牌服务费费率固定不变，如果因欠款人申领的商标辅料使用在不同单价的产品上，导致的实际品牌服务费与本授信欠据已确定品牌服务费产生差异的，可以在支付时间截止日之前书面提出异议，进行金额调整。</p>
                        <p style="text-indent: 2em;">欠款人未按还款计划（见附件）还清欠款时，每延期一日需按照应还款日当日银行贷款利息<span style="color:red">双倍</span>的标准向上海俞兆林品牌管理有限公司支付利息，欠款人如超期一年仍未能还清欠款时，上海俞兆林品牌管理有限公司即可凭此据向人民法院起诉，一切费用由欠款人承担，诉讼管辖地为债权人所在地的人民法院，同时永远取消授信资格。</p>
                        <p style="text-indent: 2em;margin-top:20px;">此据盖章生效，具有法律效力。</p>
                    </div>
                    <div style="margin-top:120px;">
                        <p>欠款人：<span style="text-decoration: underline;" class="longLine"></span>（盖章）（签字）</p>
                        <p>签署时间：<span style="text-decoration: underline;" class="shortLine"></span>年<span style="text-decoration: underline;" class="vshortLine"></span>月<span style="text-decoration: underline;" class="vshortLine"></span>日</p>
                        <p>签署地点：上海市虹口区东大名路948号白金湾广场19楼</p>
                    </div>
                    <div style="margin-top:30px;">
                        <p>俞兆林品牌管理有限公司签署：</p>    
                        <p>申请人：<span style="text-decoration: underline;" class="middleLine"></span>部门领导：<span style="text-decoration: underline;" class="middleLine"></span>总经理：<span style="text-decoration: underline;" class="middleLine"></span>商务运营(COC)：<span style="text-decoration: underline;" class="middleLine"></span></p>
                    </div>
                </div>
                <hr>
                <div class="fj">
                    <p style="font-weight:bold">附件：还款计划</p>
                    <table class="table table-responsive table-bordered table-hover" style="width:900px;">
                        <tr>
                            <td colspan="5">授信金额：<span style="text-decoration: underline;"><?=$sqmoney?></span>元   授信起止时间：<span style="text-decoration: underline;"><?=$startDate_arr[0]?></span>年<span style="text-decoration: underline;"><?=$startDate_arr[1]?></span>月<span style="text-decoration: underline;"><?=$startDate_arr[2]?></span>日至<span style="text-decoration: underline;"><?=$endDate_arr[0]?></span>年<span style="text-decoration: underline;"><?=$endDate_arr[1]?></span>月<span style="text-decoration: underline;"><?=$endDate_arr[2]?></span>日</td>
                        </tr>
                        <tr>
                            <th>计划回款时间</th>
                            <th>金额</th>
                            <th>违约费率</th>
                            <th>小计</th>
                            <th>备注</th>
                        </tr>
                        <?php
                            $hkje_hj=0;
                            $wyfl_hj=0;
                            $hkjez_hj=0;

                            for($i=0;$i<12;$i++){
                                if($dateTime[$i] != ""){
                                ?>
                                <tr>
                                    <td><?=$dateTime[$i]?></td>
                                    <td><?=$hkje[$i]?></td>
                                    <td><?=$wyfl[$i]?>%</td>
                                    <td><?=$hkje[$i]*($wyfl[$i]/100+1)?></td>
                                    <td><?=$hkfsbz[$i]?></td>
                                </tr>
                                <?php
                                    $hkje_hj=$hkje_hj+$hkje[$i];
                                    $wyfl_hj=$wyfl[$i];
                                    $hkjez_hj=$hkjez_hj+$hkje[$i]*($wyfl[$i]/100+1);
                                }
                            }
                        ?>
                        <tr>
                            <td>合计</td>
                            <td><?=$hkje_hj?></td>
                            <td><?=$wyfl_hj?>%</td>
                            <td><?=$hkjez_hj?></td>
                            <td></td>
                        </tr>
                    </table>

                    <p class="qkr" style="margin-top:40px;">欠款人：<span style="text-decoration: underline;" class="longLine"></span>（盖章）（签字）</p>
                </div>
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

    /** 数字金额大写转换(可以处理整数,小数,负数) */    
    function smalltoBIG(n)     
    {    
        var fraction = ['角', '分'];    
        var digit = ['零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'];    
        var unit = [ ['元', '万', '亿'], ['', '拾', '佰', '仟']  ];    
        var head = n < 0? '欠': '';    
        n = Math.abs(n);    
      
        var s = '';    
      
        for (var i = 0; i < fraction.length; i++)     
        {    
            s += (digit[Math.floor(n * 10 * Math.pow(10, i)) % 10] + fraction[i]).replace(/零./, '');    
        }    
        s = s || '整';    
        n = Math.floor(n);    
      
        for (var i = 0; i < unit[0].length && n > 0; i++)     
        {    
            var p = '';    
            for (var j = 0; j < unit[1].length && n > 0; j++)     
            {    
                p = digit[n % 10] + unit[1][j] + p;    
                n = Math.floor(n / 10);    
            }    
            s = p.replace(/(零.)*零$/, '').replace(/^$/, '零')  + unit[0][i] + s;    
        }    
        return head + s.replace(/(零.)*零元/, '元').replace(/(零.)+/g, '零').replace(/^整$/, '零元整');    
    }

    $("#ds").html(function(){
        return smalltoBIG($("#xs").html())
    })

    $(".longLine").html(function(){
        return '<?php for($i=0;$i<25;$i++){ echo "&nbsp;"; }?>'
    })

    $(".middleLine").html(function(){
        return '<?php for($i=0;$i<8;$i++){ echo "&nbsp;"; }?>'
    })

    $(".shortLine").html(function(){
        return '<?php for($i=0;$i<5;$i++){ echo "&nbsp;"; }?>'
    })

    $(".vshortLine").html(function(){
        return '<?php for($i=0;$i<3;$i++){ echo "&nbsp;"; }?>'
    })

    $(".btn-blue").click(function(){
        window.location.href='sx_line.php?id=<?=$id?>'
    })

    $(".btn-download").click(function(){
        ds=$("#ds").html();

        window.location.href='createSX_mb.php?id=<?=$id?>&ds=' + ds
    })
    
    window.onload=function(){
        ds=$("#ds").html();

        window.location.href='createSX_mb.php?id=<?=$id?>&ds=' + ds

        //window.location.href="javascript:history.go(-1)";
    }

        
    
</script>

<style>
    .hd{
        font-size:24px;
        font-weight:bold;
    }

    .middle{
        text-align:center;
    }

    .zw{
        font-family:'楷体';
        width:900px;
        margin-left:60px;
        font-size:16px;
    }

    .fj{
        font-family:'楷体';
        width:1000px;
        margin-left:60px;
        font-size:14px;
        line-height: 40px;
    }

    .qkr{
        margin-left:520px;"
    }

    @media print {
        .content{
            position:relative;
            right:250px;
        }

        .nav,.leftBar,.header_bar,.sqd_st,.btn,.sf,.sqd_print,.sh_time,.btn-blue{
            display:none;
        }

        .zw{
            font-family:'楷体';
            width:1000px;
            margin-left:60px;
            font-size:28px;
            line-height: 40px;
        }

        .fj{
            font-family:'楷体';
            width:1000px;
            margin-left:60px;
            font-size:24px;
            line-height: 40px;
        }

        .hd{
            margin-top:30px;
            font-size:40px;
            font-weight:bold;
        }

        .zw_content{
            height:1100px;
        }

        .qkr{
            margin-left:320px;"
        }

    }
</style>

