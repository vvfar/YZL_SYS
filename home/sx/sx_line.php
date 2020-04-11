<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_公司授信</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:auto;margin-left: 240px;">
            
            <div style="clear: both;position:relative;top:20px;margin-left:40px;">
                <?php
                    include_once("conn/conn.php");
                    error_reporting(E_ALL || ~E_NOTICE);

                    $username=$_SESSION["username"];
                    $sxid=$_GET['id'];

                    $sqlstr1="select a.sqid,a.companyName,a.department,a.ywy,a.date1,a.sqmoney,a.sxf,". 
                    "b.dhkje,a.shr,a.date2,a.date3,a.dateTime,a.hkje,a.wyfl,a.hkfs,a.hkfsbz,b.date2,".
                    "b.sjhkje,b.hkfs,b.hkfs2,a.file_name,a.status,a.status2,a.allTime,a.note,a.gxDepartment,b.syjehkfs ".
                    "from sx_form a,hk_form b where a.sqid=b.sqid and a.id=$sxid";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $sqid=$myrow[0];

                        $shr2_arr=explode(",",$myrow[8]);

                        if($myrow[21]=="待生效"){
                    ?>  
                        <button class="btn btn-warning btn-sm" style="float: left;margin-left: 640px;margin-left: 10px;">待生效</button>
                    <?php
                        }elseif($myrow[21]=="已生效"){
                        ?>  
                            <button class="btn btn-success btn-sm" style="float: left;margin-left: 640px;margin-left: 10px;">已生效</button>
                        <?php
                        }elseif($myrow[21]=="已作废"){
                        ?>  
                            <button class="btn btn-danger btn-sm" style="float: left;margin-left: 640px;margin-left: 10px;">已作废</button>
                        <?php
                        }elseif($myrow[21]=="已完成"){
                        ?>  
                            <button class="btn btn-info btn-sm" style="float: left;margin-left: 640px;margin-left: 10px;">已完成</button>
                        <?php
                        }
                    ?>

                        <div style="width:1005px;float:left">
                            <p style="float: left;margin-left: 10px;font-size:16px;margin-top:5px"><strong>授信编号：<?=$myrow[0]?></strong></p>
                            <p style="float: left;margin-left:60px;font-size:16px;margin-left: 10px;margin-top:5px"><strong>有效期限：从 <?=$myrow[9]?> 到 <?=$myrow[10]?></strong></p>  
                        </div>
                        

                        <div style="float:left;width:240px;">
                            <button class="btn btn-info btn-sm" style="float:right;margin-left:10px" id="tomb">查看模板</button>
                            
                            <?php
                                if($department=="数据中心"){
                                    ?>
                                        <button class="btn btn-danger btn-sm"  data-target="#myModal" data-toggle="modal" style="float:right;margin-left:10px">作废单据</button>
                                    <?php
                                }
                            ?>

                            <?php
                                if($myrow[20]==""){
                                    ?>
                                    <button class="btn btn-success btn-sm" style="float:right;margin-left:10px" onclick="alert('没有附件')">附件下载</button>
                                    <?php
                                }else{
                                    ?>
                                    <button class="btn btn-success btn-sm" style="float:right;margin-left:10px" onclick="window.location.href='sx_file/<?=$myrow[20]?>'">附件下载</button>
                                    <?php
                                }

                            ?>
                        </div>
                        

                        <div style="clear:both"></div>
                        <!-- Excel导入模态框,确认是否作废单据 -->
                        <form method="POST" action="formHandle/sxLiucheng.php?id=<?=$sxid?>&option=3">
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:30%">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:350px;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                是否作废此授信单据？
                                            </h4>

                                        </div>
                                        <div class="modal-body" style="height: 120px;">
                                            <div>
                                                <input type="text" class="form-control" placeholder="请输入作废理由" style="width:280px;" name="note"/>
                                            </div>
                                            
                                            <div style="clear: both;position: relative;top:20px;width:350px;">
                                                <p>温馨提示：作废后单据将在已完成页面中显示</p>
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
                        <hr>
                        
                        <p style="margin-left:10px;">授信基本信息：</p>
                        <table class="base_list table table-responsive table-bordered table-hover" style="clear:both;position:relative;width: 1300px;">
                            <tr>
                                <td>公司名称</td>
                                <td><?=$myrow[1]?></td>
                                <td>事业部</td>
                                <td><?=$myrow[2]?></td>
                                <td>申请人</td>
                                <td><?=$myrow[3]?></td>
                                <td>签署时间</td>
                                <td><?=$myrow[4]?></td>
                                <td>状态</td>
                                <td><?=$myrow[22]?></td>
                            </tr>
                            <tr>
                                <td>授信金额</td>
                                <td>￥<?=$myrow[5]?></td>
                                <td>手续费</td>
                                <td>￥<?=$myrow[6]?></td>
                                <td>已还款金额</td>
                                <td>￥<?=(float)$myrow[5]-(float)$myrow[7]?></td>
                                <td>待还款金额</td>
                                <td>￥<?=(float)$myrow[7]?></td>
                                <td>共享事业部</td>
                                <?php
                                    if($myrow[25]==""){
                                        ?>
                                            <td>/</td>
                                        <?php
                                    }else{
                                        ?>
                                            <td><?=$myrow[25]?></td>
                                        <?php
                                    }
                                ?>
                                
                            </tr>
                        </table>

                    <?php
                        $syhkje=$myrow[7];
                        $dateTime=explode(",",$myrow[11]);
                        $hkje=explode(",",$myrow[12]);
                        $wyfl=explode(",",$myrow[13]);
                        $hkfs=explode(",",$myrow[14]);
                        $hkfsbz=explode(",",$myrow[15]);
                        $date1=explode(",",$myrow[16]);
                        $sjhkje=explode(",",$myrow[17]);
                        $sjhkfs=explode(",",$myrow[18]);
                        $hkfs2=explode(",",$myrow[19]);

                        $status=explode(",",$myrow[22]);
                        $allTime=explode(",",$myrow[23]);
                        $note=$myrow[24];
                        $syjehkfs=$myrow[26];
                    }

                    date_default_timezone_set("Asia/Shanghai");
                    $now=date('Y-m-d', time());  //签署日期
                    
                ?>
            </div>

            <p style="margin-left:50px;margin-top:50px;">计划与实际回款信息：</p>
            <table class="table table-responsive table-bordered table-hover" style="clear:both;position:relative;width: 1300px;margin-left: 50px;">
                <tr>
                    <th>期数</th>
                    <th>计划回款日期</th>
                    <th>回款金额</th>
                    <th>违约费率</th>
                    <th>小计</th>
                    <th>回款方式</th>
                    <th>实际回款日期</th>
                    <th>回款金额</th>
                    <th>回款方式</th>
                    <th>是否逾期</th>
                </tr>

                <?php
                    for($i=0;$i<12;$i++){
                        if($dateTime[$i] != "" || $date1[$i] != ""){
                        ?>
                            <tr>
                                <td>第<?=$i+1?>期</td>
                                <td><?=$dateTime[$i]?></td>
                                <td><?=$hkje[$i]?></td>
                                <?php
                                    if($wyfl[$i] !=""){
                                        ?>
                                            <td><?=$wyfl[$i].'%'?></td>
                                        <?php
                                    }else{
                                        ?>
                                            <td></td>
                                        <?php
                                    }
                                    ?>

                                <td><?php echo $hkje[$i]*($wyfl[$i]/100+1)?></td>
                                <td><a href="#" title="<?=$hkfsbz[$i]?>" style="color:#333"><?=$hkfs[$i]?></a></td>
                                <td><?=$date1[$i]?></td>
                                <td><?=$sjhkje[$i]?></td>
                                <td><a href="#" title="<?=$hkfsbz[$i]?>" style="color:#333"><?=$sjhkfs[$i]?></a></td>
                                <?php
                                    $D1 = strtotime($now);

                                    if($dateTime[$i] !=""){
                                        $D2 = strtotime($dateTime[$i]);
                                    }else{
                                        $D2="";
                                    }
                                    
                                    if($D1>$D2 and $date1[$i]=="" and $syhkje !="0"){
                                        ?>
                                            <td style="color: darkred;">逾期</td>
                                        <?php
                                    }elseif($D1<=$D2 and $date1[$i]=="" and $syhkje !="0"){
                                        ?>
                                            <td style="color: darkyellow;">待还款</td>
                                        <?php
                                    }else{
                                        ?>
                                            <td style="color: darkgreen;">已还款</td>
                                        <?php
                                    }
                                ?>
                                
                            </tr>
                        <?php
                        }
                    }
                ?>
            </table>

            <p style="margin-left:50px;">剩余金额回款方式：<?=$syjehkfs?></p>
            
            <?php
                if($syhkje !=0){
                    ?>
                        <p><a href="companyManger2.php?no=<?=$sqid?>" style="margin-left:50px;">填写回款单</a></p>
                    <?php
                }
            ?>
            

            <?php
                $sqlstr2="select department from user_form where username='$username'";

                $result2=mysqli_query($conn,$sqlstr2);

                while($myrow=mysqli_fetch_row($result2)){
                    $my_department=$myrow[0];
                }

                $result=mysqli_query($conn,$sqlstr1);
                
                while($myrow=mysqli_fetch_row($result)){
                    $department=$myrow[2];
                    $status=$myrow[21];
                }

                
                if($department==$my_department and $status=="待生效"){
                    ?>
                        <form method="POST" action="formHandle/companyMangerHandle3.php" enctype="multipart/form-data" style="margin-top: 10px;margin-left: 51px;">
                            
                            <input type="hidden" class="form-control" name="sqid" value="<?=$sxid?>" readonly = "readonly" placeholder="请输入授信编号" style="width: 250px;float: left;margin-top: 15px;">
                            
                            <div class="form-group" style="clear: both;position:relative;top:10px;border:1px solid #ccc;width:650px;padding:15px;">
                                <p style="font-weight:bold">授信单据附件上传</p>
                                <p style="color:red">(文件名为授信单编号，不能出现中文)</p>
                                <span style="float: left">上传授信照片</span><input type="file" name="upfile" style="float: left;margin-left: 35px;"/>
                                <div style="clear:both"></div>
                            </div>

                            <div style="clear:both;position:relative;top:25px;">
                                <button type="submit" class="btn btn-success btn-sm" id="upload">上传附件</button>
                                <button type="button" class="btn btn-info btn-sm" id="edit" style="margin-left:5px;">重新编辑</button>
                            </div>
                        </form>

                    <?php
                }

            ?>
            
            <p style="margin-left:50px;clear:both;position:relative;top:50px;">扣款明细：</p>
            
            <table class="table table-responsive table-bordered table-hover" style="clear:both;position:relative;width: 1300px;margin-left: 50px;top:50px;">
                <tr>
                    <th>序号</th>
                    <th>辅料编号</th>
                    <th>总授信</th>
                    <th>已使用金额</th>
                    <th>本次使用金额</th>
                    <th>剩余金额</th>
                    <th>使用部门</th>
                    <th>日期</th>
                    <th>备注</th>
                </tr>
                <?php
                    $sqlstr1="select a.*,b.id from use_sx a left join flsqd b on a.fl_no=b.no where a.sqid='$sqid' order by a.id asc";

                    $result=mysqli_query($conn,$sqlstr1);
                
                    $i=0;

                    while($myrow=mysqli_fetch_row($result)){
                        $i=$i+1;
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <?php
                                if($myrow[11] !=""){
                                    ?>
                                    <td><a href="flLine.php?id=<?=$myrow[11]?>"><?=$myrow[6]?></a></td>
                                    <?php
                                }else{
                                    ?>
                                    <td><?=$myrow[6]?></td>
                                    <?php
                                }
                            ?>
                            
                            <td>￥<?=$myrow[2]?></td>
                            <td>￥<?=$myrow[3]?></td>
                            <td>￥<?=$myrow[4]?></td>
                            <td>￥<?=$myrow[5]?></td>
                            <td><?=$myrow[7]?></td>
                            <td><?=$myrow[8]?></td>
                            <td><?=$myrow[9]?></td>
                        </tr>
                        <?php

                       
                    }
                ?>
            </table>

            <p style="margin-left:50px;clear:both;position:relative;top:45px;">备注信息：<?=$note?></p>

        </div>

    </body>
</html>

<style>
    span{
        width:300px;
    }
    
    .base_list{
        margin-left: 12px;
        padding: 0;
    }

    .base_list li{
        float: left;
        width: 270px;
        list-style-type: none;
    }

    th{
        background-color:#eff;
    }
</style>

<script>
    $("#yes").click(function(){
        window.location.href="formHandle/sxLiucheng.php?id=<?=$sxid?>&option=1"
    })

    $("#no").click(function(){
        window.location.href="formHandle/sxLiucheng.php?id=<?=$sxid?>&option=0"
    })

    $("#edit").click(function(){
        window.location.href="companyManger1_edit.php?id=<?=$sxid?>"
    })

    $("#tomb").click(function(){
        window.location.href="sxmb.php?id=<?=$sxid?>"
    })
</script>