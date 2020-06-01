<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_店铺合同</title>
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
        <?php include_once("..\..\common\conn\conn.php");?>
        <?php include '..\base\header.php' ?>
        <?php include '..\base\leftBar.php' ?>

        <div style="margin-left: 180px;margin-top:70px">
            <div class="nav nav-pills" style="float: left;margin-top: 30px;margin-left:30px;">
                <?php
                    
                    $username=$_SESSION["username"];

                    $sqlstr1="select department,level,newLevel from user_form where username='$username'";

                    $result=mysqli_query($conn,$sqlstr1);
            
                    while($myrow=mysqli_fetch_row($result)){
                        $department=$myrow[0];
                        $level=$myrow[1];
                        $newLevel=$myrow[2];
                    }

                    if(isset($_GET['id']) and $_GET['option'] == "合同"){
                        $id=$_GET["id"];
                        $sqlstr2="select * from contract where id='$id'";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            $id=$myrow[0];
                            $re_date=$myrow[1];
                            $no=$myrow[2];
                            $department2=$myrow[3];
                            $pingtai=$myrow[4];
                            $category=$myrow[5];
                            $company=$myrow[6];
                            $store=$myrow[7];
                            $input_time=$myrow[8];
                            $input_time2=$myrow[9];
                            $money=$myrow[10];
                            $ismoney=$myrow[11];
                            $sales=$myrow[12];
                            $issales=$myrow[13];
                            $service=$myrow[14];
                            $isservice=$myrow[15];
                            $note=$myrow[16];
                            $status=$myrow[17];
                            $oldNo=$myrow[18];
                            $shr=$myrow[19];
                            $shTime=$myrow[20];

                        }
                    }
                    
                    
                ?>
            </div>
            
            <div> 
                <?php

                    if($status =="审核拒绝"){
                    ?>
                        <button class="btn btn-sm btn-danger" style="float:left">已拒绝</button>
                    <?php
                    }elseif($status !="已归档"){
                    ?>
                        <button class="btn btn-sm btn-warning" style="float:left">待归档</button>
                    <?php
                    }else{
                    ?>
                        <button class="btn btn-sm btn-success" style="float:left">已归档</button>
                    <?php
                    }
                ?>
                <p style="font-size: 16px;float:left;margin-top:5px;margin-left:10px;width:644px">合同编号：<?=$no?></p>
                <p style="font-size: 16px;float:left;">合同期限：从 <?=$input_time?> 到 <?=$input_time2?></p>
            </div>

            <div style="clear:both;margin-left:30px;position:relative;top:15px;">
                <div>
                    <p style="border-bottom:1px solid #ddd;padding:5px;float:left">登记日期：<?=$re_date?></p>
                    
                    <?php
                        if($department=="商业运营部" or $newLevel == "ADMIN"){
                            ?>
                                <button class="btn btn-sm btn-info" style="float:left;margin-left:698px;" onclick="changeContract()">修改合同</button>
                                <button class="btn btn-sm btn-danger" style="float:left;margin-left:10px" onclick="delContract()">删除合同</button>
                            <?php
                        }
                    ?>
                </div>

                <div style="clear:both;width:1000px;">
                    <p style="float:left;margin-top:20px;">基本信息：</p>
                    <div style="float:right;margin-top:20px;">
                        <p style="float:left">所属事业部：<?=$department2?></p>
                        <p style="float:left;margin-left:20px;">业务员：<?=$shr?></p>
                    </div>

                </div>

                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:50px">
                    <tr>
                        <th>公司名称</th>
                        <td colspan="7"><?=$company?></td>
                    </tr>
                    <tr>
                        <th>店铺名称</th>
                        <td colspan="7"><?=$store?></td>
                    </tr>
                    <tr>
                        <th>授权平台</th>
                        <td colspan="2"><?=$pingtai?></td>
                        <th>授权类目</th>
                        <td colspan="3"><?=$category?></td>
                    </tr>
                    <tr>
                        <th>保证金</th>
                        <td colspan="2">
                            <?=$money?>
                            <?php
                                if($ismoney == "是"){
                                    echo "(共享)";
                                }else{
                                    echo "(不共享)";
                                }
                            ?>
                        </td>
                        <th>销售额</th>
                        <td>
                            <?=$sales?>万
                            <?php
                                if($issales == "是"){
                                    echo "(共享)";
                                }else{
                                    echo "(不共享)";
                                }
                            ?>
                        </td>
                        <th>服务费</th>
                        <td>
                            <?=$service?>万
                            <?php
                                if($isservice == "是"){
                                    echo "(共享)";
                                }else{
                                    echo "(不共享)";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                
                <?php

                    if($department == "商业运营部" and $status == "待归档"){
                        ?>

                        <div style="width:1000px;">
                            <button class="btn btn-sm btn-danger" style="float:right" id="no">拒绝</button>
                            <button class="btn btn-sm btn-success" style="float:right;margin-right:10px;" id="yes">同意</button>
                        </div>

                        <?php
                    }


                    if(($status=="审核拒绝" or $status == "待归档") and $username == $shr){
                        ?>
                            <div style="width:1000px;">
                                <button class="btn btn-sm btn-info" style="float:right" id="edit">重新编辑</button>
                            </div>
                        <?php
                    }

                    $sqlstr4="select count(*) from contract_add where no='$no'";

                    $result=mysqli_query($conn,$sqlstr4);

                    while($myrow=mysqli_fetch_row($result)){
                        $count=$myrow[0];
                    }

                    if($count > 0){

                        $sqlstr5="select * from contract_add where no='$no' and status='待归档' ";

                        $result=mysqli_query($conn,$sqlstr5);
                        
                        $count=1;

                        while($myrow=mysqli_fetch_row($result)){
                            
                            $id_add=$myrow[0];
                            $company_add=$myrow[9];
                            $store_add=$myrow[10];
                            $pingtai_add=$myrow[7];
                            $category_add=$myrow[8];
                            $bzj_add=$myrow[13];
                            $isbzj_add=$myrow[14];
                            $sales_add=$myrow[15];
                            $issales_add=$myrow[16];
                            $service_add=$myrow[17];
                            $isservice_add=$myrow[18];
                            $content=$myrow[2];
                            $status2=$myrow[3];
                            $shr2=$myrow[4];
                            $file=$myrow[6];

                            ?>
                            <div style="display:none">
                                <div style="border:1px solid #ccc;width:1000px;padding:5px;margin-top:60px;">
                                    <p>补充合同 <?=$count?>：</p>

                                    <table class="table table-responsive table-bordered table-hover" style="width:990px;margin-top:20px">
                                        <tr>
                                            <th>公司名称</th>
                                            <td colspan="7"><?=$company_add?></td>
                                        </tr>
                                        <tr>
                                            <th>店铺名称</th>
                                            <td colspan="7"><?=$store_add?></td>
                                        </tr>
                                        <tr>
                                            <th>授权平台</th>
                                            <td colspan="2"><?=$pingtai_add?></td>
                                            <th>授权类目</th>
                                            <td colspan="3"><?=$category_add?></td>
                                        </tr>
                                        <tr>
                                            <th>保证金</th>
                                            <td colspan="2">
                                                <?=$bzj_add?>
                                                <?php
                                                    if($isbzj_add == "是"){
                                                        echo "(共享)";
                                                    }else{
                                                        echo "(不共享)";
                                                    }
                                                ?>
                                            </td>
                                            <th>销售额</th>
                                            <td>
                                                <?=$sales_add?>万
                                                <?php
                                                    if($issales_add == "是"){
                                                        echo "(共享)";
                                                    }else{
                                                        echo "(不共享)";
                                                    }
                                                ?>
                                            </td>
                                            <th>服务费</th>
                                            <td>
                                                <?=$service_add?>万
                                                <?php
                                                    if($isservice_add == "是"){
                                                        echo "(共享)";
                                                    }else{
                                                        echo "(不共享)";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>

                                   

                                    <p style="margin-top:10px"><?=$content?></p>

                                    <?php
                                        if($file != ""){
                                            ?>
                                                <a class="btn btn-info btn-sm" style="margin-top:10px;" href="../../common/file/contractAdd_file/<?=$file?>">附件下载</a>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                        if($department == "商业运营部" and $status2 == "待归档"){
                                    ?>
                                        <div style="width:1000px;height:40px;padding:10px;">
                                            <button class="btn btn-sm btn-danger" style="float:right" id="no2">拒绝</button>
                                            <button class="btn btn-sm btn-success" style="float:right;margin-right:10px;" id="yes2">同意</button>
                                        </div>
                                    <?php
                                        }elseif($shr2==$username and ($status2 == "审核拒绝" or $status2 == "待归档")){
                                            ?>
                                                <div style="width:1000px;height:40px;padding:10px;">
                                                    <button class="btn btn-sm btn-info" style="float:right" id="edit_contractAdd">重新编辑</button>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            <?php
                            $count=$count+1;
                        }

                        ?>

                        <?php

                    }

                ?>
                <p>备注信息：</p>
                <p style="width:1000px;margin-top:10px;"><?=$note?></p>
                <p style="width:1000px;margin-top:10px;">原合同编号：</p>
                <?php
                    $sqlstr3="select count(*) from contract where no='$oldNo'";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $count=$myrow[0];
                    }

                    if($count==0){
                        ?>
                            <p style="width:1000px;"><?=$oldNo?></p>
                        <?php
                    }else{
                        ?>
                            <p style="width:1000px;"><a href="contract_line.php?no=<?=$oldNo?>"><?=$oldNo?></a></p>
                        <?php
                    }
                ?>
                
                <div style="display:none">
                    <p style="margin-top: 50px;">授权店铺列表：</p>

                    <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:10px;">
                        
                        <tr>
                            <th>授权编号</th>
                            <th>公司名称</th>
                            <th>授权平台</th>
                            <th>授权类目</th>
                            <th>事业部</th>
                            <th>登记日期</th>
                        </tr>

                        <?php
                            $sqID="";

                            $sqlstr1="select id,no,companyName,pingtai,category,department,bzj,'/','/',re_date,'授权',status,shr,shTime from sq where contractNo='$no' ";

                            $result=mysqli_query($conn,$sqlstr1);

                            while($myrow=mysqli_fetch_row($result)){

                                $id_sq=$myrow[0];
                                $isContract=$myrow[10];
                                $contractID=$myrow[1];
                                $companyName=$myrow[2];
                                $pingTai=$myrow[3];
                                $category=$myrow[4];
                                $department=$myrow[5];
                                $re_date=$myrow[9];
                                $status=$myrow[11];
                                $shr=$myrow[12];

                                ?>
                                    <tr>
                                        <td><a href="sq_line.php?id=<?=$id_sq?>&option=授权" target="_blank"><?=$contractID?></a></td>   
                                        <td><?=$companyName?></td>
                                        <td class="category" style="width:130px"><p style="margin:0"><?=$pingTai?></p></td>
                                        <td class="category" style="width:130px"><p style="margin:0"><?=$category?></p></td>
                                        <td style="width:190px"><?=$department?></td>
                                        <td><?=$re_date?></td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
                
                


                <p style="margin-top: 50px;">主合同店铺列表：</p>

                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:10px;">
                    
                    <tr>
                        <th>公司名称</th>
                        <th>店铺名称</th>
                        <th>授权平台</th>
                        <th>授权类目</th>
                        <th>保证金</th>
                        <th>是否共享保证金</th>
                        <th>销售额（万）</th>
                        <th>是否共享销售额</th>
                        <th>服务费（万）</th>
                        <th>是否共享服务费</th>
                    </tr>

                    <?php
                        $sqlstr1="select company,store,pingtai,category,money,ismoney,sales,issales,service,isservice from contract where no='$no' ";

                        $result=mysqli_query($conn,$sqlstr1);

                        while($myrow=mysqli_fetch_row($result)){
                            ?>
                                <tr>
                                    <td style="width:200px;"><?=$myrow[0]?></td>
                                    <td style="width:200px;"><?=$myrow[1]?></td>
                                    <td><?=$myrow[2]?></td>
                                    <td><?=$myrow[3]?></td>
                                    <td><?=$myrow[4]?></td>
                                    <td><?=$myrow[5]?></td>
                                    <td><?=$myrow[6]?></td>
                                    <td><?=$myrow[7]?></td>
                                    <td><?=$myrow[8]?></td>
                                    <td><?=$myrow[9]?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
                
                <!--

                <p style="margin-top: 50px;">补充合同店铺列表：</p>

                <table class="table table-responsive table-bordered table-hover" style="width:1000px;margin-top:10px;">
                    
                    <tr>
                        <th>公司名称</th>
                        <th>店铺名称</th>
                        <th>授权平台</th>
                        <th>授权类目</th>
                        <th>保证金</th>
                        <th>是否共享保证金</th>
                        <th>销售额（万）</th>
                        <th>是否共享销售额</th>
                        <th>服务费（万）</th>
                        <th>是否共享服务费</th>
                    </tr>

                    <?php
                        $sqlstr1="select company,store,pingtai,category,money,ismoney,sales,issales,service,isservice from contract_add where no='$no' and status='已归档' ";

                        $result=mysqli_query($conn,$sqlstr1);

                        while($myrow=mysqli_fetch_row($result)){
                            ?>
                                <tr>
                                    <td style="width:200px;"><?=$myrow[0]?></td>
                                    <td style="width:200px;"><?=$myrow[1]?></td>
                                    <td><?=$myrow[2]?></td>
                                    <td><?=$myrow[3]?></td>
                                    <td><?=$myrow[4]?></td>
                                    <td><?=$myrow[5]?></td>
                                    <td><?=$myrow[6]?></td>
                                    <td><?=$myrow[7]?></td>
                                    <td><?=$myrow[8]?></td>
                                    <td><?=$myrow[9]?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
                -->
         
            </div>
            
        </div>

    </body>
</html>

<style>
    th{
        text-align: center;
    }

    td{
        text-align: center;
        width:150px;
        height:40px;
        line-height:40px;
        vertical-align: middle;
    }

    .pager li a:hover{
        background-color:#337ab7;
        color:#fff;
    }

    ul{
        list-style: none;
        margin:0;
        padding:0;
    }

    .notice ul li{
        float: left;
        width:250px;
    }
</style>

<script>
    $("#status").click(function(){
        if($("#status").val()=="合同编号"){
            $("#contractID").css("display","inline");
            $("#clientName").css("display","none");
        }else if($("#status").val()=="公司名称"){
            $("#contractID").css("display","none");
            $("#clientName").css("display","inline");
        }
    })

    $("#edit").click(function(){
        window.location.href="contract.php?id=<?=$id?>"
    })

    $("#yes").click(function(){
        window.location.href="../../controller/contract/contractHandle.php?id=<?=$id?>&progress=4"
    })

    $("#yes2").click(function(){
        window.location.href="../../controller/contract/contractAdditionHandle.php?id=<?=$id_add?>&progress=2&option=1"
    })

    $("#no2").click(function(){
        window.location.href="../../controller/contract/contractAdditionHandle.php?id=<?=$id_add?>&progress=2&option=0"
    })

    $("#no").click(function(){
        window.location.href="../../controller/contract/contractHandle.php?id=<?=$id?>&progress=5"
    })

    $("#edit_contractAdd").click(function(){
        window.location.href="../../home/contract/contractAddition.php?id=<?=$id_add?>";
    })

    var changeContract=function(){
        window.location.href="contract.php?id=<?=$id?>&option=0"
    }

    var delContract=function(){
        window.location.href="../../controller/contract/contractHandle.php?id=<?=$id?>&progress=6"
    }
</script>
