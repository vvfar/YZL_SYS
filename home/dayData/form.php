<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据统计</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="css/leftbar.css?v=2" rel="stylesheet"/>
        <link href="css/header.css?v=2" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <div class="nav nav-pills" style="float:left;margin-left:30px;position:relative;top:20px;">
                <li role="presentation"><a href="data.php?month=">当月实时数据图表</a></li>
                <li role="presentation" class="active"><a href="form.php">日数据报表</a></li>
                <li role="presentation"><a href="sumDayData.php">合计数据报表</a></li>
                <li role="presentation"><a href="powerPage.php">BI数据可视化报表</a></li>
            </div>

            <div style="float: left;margin-left:525px;margin-top:22px;">
                <span><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Excel模板</button></span>
                <span><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" style="position:relative;left: 10px;">Excel导入</button></span>
                <span><button type="button" class="btn btn-default"  onclick="addText()" style="position:relative;left: 20px;">逐行添加</button></span>
            </div>

            <!-- Excel导入模态框 -->
            <form method="POST" action="formHandle/uploadInfoHandle.php" enctype="multipart/form-data">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    上传Excel文件
                                </h4>
                            </div>
                            
                            <div class="modal-body" style="height: 150px;">
                                <input type="file" name="excel"/>
                                <div style="clear: both;position: relative;top:20px;width:300px;">
                                    <p>温馨提示：文件必须为EXCEL格式，请按模板文件格式进行上传，文件大小需小于2M</p>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary">导入表格</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>

            <!-- Excel导入模态框 -->
            <form method="POST" action="formHandle/downloadHandle.php" enctype="multipart/form-data">
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    下载Excel模板
                                </h4>
                            </div>
                            
                            <div class="modal-body" style="height: 150px;">
                                <p>选择需要提交数据日期</p>
                                <div style="width: 220px;font-size: 14px;float: left;margin-top: 5px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" name="date1" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" class="btn btn-primary">下载表格</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </form>

            <?php
                if(isset($_GET["date1"]) && isset($_GET["date2"])){
                    $date1=$_GET["date1"];
                    $date2=$_GET["date2"];   
                }

            
                if(isset($_GET["storeID"])){
                    $storeID=$_GET["storeID"];
                }

                if(isset($_GET["storeName"])){
                    $storeName=$_GET["storeName"];
                }

                if(!isset($_GET["date1"]) && !isset($_GET["date2"]) && !isset($_GET["storeID"]) && !isset($_GET["storeName"])){
                    $date1="";
                    $date2="";   
                    $storeID="";
                    $storeName="";
                }

                if(!isset($_GET["pagesize"])){
                    $pagesize=15;
                }else{
                    $pagesize=$_GET["pagesize"];
                }

            ?>

            <div class="form-group" style="clear: both;float:left;margin-top:10px;margin-left:47px;">
                <button class="btn btn-danger" style="float:left;margin-top:20px;" id="all">查看全部</button>
                <select class="form-control" style="float:left;margin-top:20px;width:120px;margin-left:15px;" id="form_option2" onclick="optionClick2()">
                    <option>搜索数据</option>
                    <option>导出数据</option>
                </select>


                <div style="clear:both">
                    <div style="display: inline;" class="search_div">
                        <p style="float:left;margin-top:20px;">选择日期</p>
                        <p style="width: 20px;font-size: 14px;float: left;margin-top:20px;margin-left:20px;">从</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="date1" size="16" type="text" value="<?=$date1?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <p style="width: 20px;font-size: 14px;float: left;margin-top:20px;margin-left:20px;">到</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="date2" size="16" type="text" value="<?=$date2?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <div style="float:left;margin-left:20px;margin-top:17px;width: 125px;">
                            <button class="btn btn-success btn-sm" onclick="search()">搜索</button>
                        </div>
                    </div>

                    <div style="display: none;"  class="output_div">
                        <p style="float:left;margin-top:20px;">选择日期</p>
                        <p style="width: 20px;font-size: 14px;float: left;margin-top:20px;margin-left:20px;">从</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="date3" size="16" type="text" value="<?=$date1?>" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <p style="width: 20px;font-size: 14px;float: left;margin-top:20px;margin-left:20px;">到</p>
                        <div style="width: 180px;font-size: 14px;float: left;margin-top:15px;" class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" id="date4" size="16" type="text" value="" readonly disabled>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <div style="float:left;margin-left:20px;margin-top:17px;width: 125px;">
                            <button class="btn btn-warning btn-sm" onclick="excel()">导出Excel</button>
                        </div>
                    </div>
                    

                    <div style="float:left;margin-left:295px;margin-top:15px;">
                        <select class="form-control" id="form_option" onclick="optionClick()">
                            <option>店铺编号</option>
                            <option>店铺名称</option>
                        </select>
                    </div>
                    
                    <div style="float:left;margin-top:7px;" class="storeID_div">
                        <div class="navbar-form">
                            <div class="input-group">
                                <input type="text" style="width:200px;" name="storeID" class="form-control" value="<?=$storeID?>" id="storeID" placeholder="搜索店铺编号" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="buttton"  onclick="search()">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>   
                        </div>
                    </div>
                    <div style="float:left;margin-top:7px;display: none;" class="storeName_div">
                        <div class="navbar-form">
                            <div class="input-group">
                                <input type="text" style="width:200px;" name="storeName" class="form-control" value="<?=$storeName?>" id="storeName" placeholder="搜索店铺名称" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="buttton"  onclick="search2()">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>   
                        </div>
                    </div>
                </div>
                
            </div> 

            <div style="clear: both;margin-left: 42px;">
                <p style="float:left">注意：数据查询可以查询任意时间的日数据，数据导出只能导出近2个月的日数据，历史数据只提供月度合计。</p>
                <div style="float:left;margin-left:480px;">
                    <p style="float:left">每页最大行数</p>
                    <select style="float:left;margin-left:13px;" id="pagesize" onchange="pagesize()" value="<?=$pagesize?>">
                        <?php
                            if($pagesize==15){
                            ?>
                                <option selected="selected">15</option>
                                <option>30</option>
                                <option>45</option>
                                <option>60</option>
                            <?php
                            }elseif($pagesize==30){
                            ?>
                                <option>15</option>
                                <option selected="selected">30</option>
                                <option>45</option>
                                <option>60</option>
                            <?php
                            }elseif($pagesize==45){
                            ?>
                                <option>15</option>
                                <option>30</option>
                                <option selected="selected">45</option>
                                <option>60</option>
                            <?php
                            }elseif($pagesize==45){
                            ?>
                                <option>15</option>
                                <option>30</option>
                                <option>45</option>
                                <option selected="selected">60</option>
                            <?php
                            }elseif($pagesize==60){
                            ?>
                                <option>15</option>
                                <option>30</option>
                                <option>45</option>
                                <option selected="selected">60</option>
                            <?php
                            }
                        ?>
                        

                    </select>
                </div>
                
            </div>

            
            

            <div class="table" style="clear: both;position:relative;top:0px;width:1300px;margin-left:40px;">
                <table class="table table-responsive table-bordered table-hover">
                    <tr>
                        <th>店铺编号</th>
                        <th>客户名称</th>
                        <th>店铺名称</th>
                        <th>平台</th>
                        <th>事业部</th>
                        <th>业务员</th>
                        <th>销售额</th>
                        <th>销量</th>
                        <th>领标套数</th>
                        <th>服务费回款</th>
                        <th>辅料费回款</th>
                        <th>日期</th>
                    </tr>
                    <?php
                        include_once("conn/conn.php");
                        //分页代码
                        if(!isset($_GET["page"]) || !is_numeric($_GET["page"])){
                            $page=1;
                        }else{
                            $page=intval($_GET["page"]);
                        }

                        //$pagesize=15;

                        $username=$_SESSION["username"];
                        $sqlstr="select department from user_form where username='$username'";
                
                        $result=mysqli_query($conn,$sqlstr);
                
                        while($myrow=mysqli_fetch_row($result)){
                            $department=$myrow[0];
                        }
                
                        $sqlstr1="select count(*) as total from day_data where 1=1";

                        if($department !="数据中心"){
                            $sqlstr1=$sqlstr1." and department='$department'";
                        }

                        if($date1 !="" and $date2 !=""){
                            $sqlstr1=$sqlstr1." and date >= '$date1' and date <= '$date2'";
                        }

                        if($storeID !=""){
                            $sqlstr1=$sqlstr1." and storeID='$storeID' ";
                        }

                        if($storeName !=""){
                            $sqlstr1=$sqlstr1." and storeName like '%$storeName%' ";
                        }

                        $result=mysqli_query($conn,$sqlstr1);
                        $info=mysqli_fetch_array($result);
                        $total=$info['total'];


                        if($total%$pagesize==0){
                            $pagecount=intval($total/$pagesize);
                        }else{
                            $pagecount=ceil($total/$pagesize);
                        }


                        $sqlstr2="select * from day_data where 1=1";

                        if($department !="数据中心"){
                            $sqlstr2=$sqlstr2." and department='$department'";
                        }

                        if($date1 !="" and $date2 !=""){
                            $sqlstr2=$sqlstr2." and date >= '$date1' and date <= '$date2'";
                        }

                        if($storeID !=""){
                            $sqlstr2=$sqlstr2." and storeID='$storeID'";
                        }

                        if($storeName !=""){
                            $sqlstr2=$sqlstr2." and storeName like '%$storeName%'";
                        }

                        $sqlstr2=$sqlstr2." order by date desc limit ".($page-1)*$pagesize.",$pagesize";

                        $result=mysqli_query($conn,$sqlstr2);

                        $sqlstr3="select date from data_can_change where id=1";

                        $result3=mysqli_query($conn,$sqlstr3);
                        while($myrow=mysqli_fetch_row($result3)){
                            $changeDate=$myrow[0];
                        }

                        while($myrow=mysqli_fetch_row($result)){
                    ?>               
                        <tr>
                            <?php
                                if($changeDate>$myrow[17]){
                                    ?>
                                        <td><?=$myrow[1]?></td>
                                    <?php
                                }else{
                                    ?>
                                        <td><a href="/addDayData.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                                    <?php
                                }
                            ?>
                            
                            <td><?=$myrow[2]?></td>
                            <td><?=$myrow[3]?></td>
                            <td><?=$myrow[4]?></td>
                            <td><?=$myrow[6]?></td>
                            <td><?=$myrow[7]?></td>
                            <td><?=$myrow[8]?></td>
                            <td><?=$myrow[9]?></td>
                            <td><?=$myrow[10]?></td>
                            <td><?=$myrow[12]?></td>
                            <td><?=$myrow[15]?></td>
                            <td><?=$myrow[17]?></td>
                        </tr>
                        

                    <?php
                        }
                        
                        mysqli_free_result($result);
                        mysqli_close($conn);
                    ?>
                </table>

                <div style="clear: both;position: absolute;">
                    <a href="<?php echo $_SERVER['PHP_SELF']?>?page=1&date1=<?=$date1?>&date2=<?=$date2?>&storeID=<?=$storeID?>&storeName=<?=$storeName?>&pagesize=<?=$pagesize?>">首页</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page>1)
                            echo $page-1;
                        else
                            echo 1;  
                    ?>&date1=<?=$date1?>&date2=<?=$date2?>&storeID=<?=$storeID?>&storeName=<?=$storeName?>&pagesize=<?=$pagesize?>">上一页</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php
                        if($page<$pagecount)
                            echo $page+1;
                        else
                            echo $pagecount;  
                    ?>&date1=<?=$date1?>&date2=<?=$date2?>&storeID=<?=$storeID?>&storeName=<?=$storeName?>&pagesize=<?=$pagesize?>">下一页</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']?>?page=<?php echo $pagecount; ?>&date1=<?=$date1?>&date2=<?=$date2?>&storeID=<?=$storeID?>&storeName=<?=$storeName?>&pagesize=<?=$pagesize?>">尾页</a>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    th{
        background-color:#f5eded;
        text-align: center;
    }

</style>

<script>
    window.onload=function(){
        if($("#storeName").val()!=""){
            $(".storeID_div").css("display","none")
            $(".storeName_div").css("display","inline")
        }

        $("#date4").attr("value",function(){
            var date = new Date();
            var seperator1 = "-";
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = year + seperator1 + month + seperator1 + strDate;
            return currentdate;
        })

        $("#date4").onclick=null 
    }


    var addText=function(){
        window.location.href="addDayData.php";
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

    var search=function(){

        date1=$("#date1").val()
        date2=$("#date2").val()
        storeID=$("#storeID").val()
        pagesize=$("#pagesize").val()
        
        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?date1=" +date1 + "&date2=" + date2 + "&storeID=" + storeID + "&pagesize=" +pagesize + "&storeName="

    }

    var search2=function(){

        date1=$("#date1").val()
        date2=$("#date2").val()
        storeName=$("#storeName").val()
        pagesize=$("#pagesize").val()

        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?date1=" +date1 + "&date2=" + date2 + "&storeID=" + "&storeName=" + storeName + "&pagesize=" +pagesize

        }

    var excel=function(){
        date1=$("#date3").val()
        date2=$("#date4").val()
        storeID=$("#storeID").val()
        storeName=$("#storeName").val()

        
        s1 = new Date(date1.replace(/-/g, "/"));
        s2 = new Date(date2.replace(/-/g, "/"));

        var days = s2.getTime() - s1.getTime();
        
        var time = parseInt(days / (1000 * 60 * 60 * 24));

        if(time>62){
            alert("时间跨度2个月以上的数据无法下载！")
        }else{
            window.location.href='formHandle/dayData_form.php?date1=' + date1 + '&date2=' + date2 + "&storeID=" + storeID + "&storeName=" + storeName
        }   
    }

    $("#all").click(function(){
        date1=""
        date2=""
        storeID=""
        storeName=""
        pagesize=$("#pagesize").val()

        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?date1=" +date1 + "&date2=" + date2 + "&storeID=" + storeID + "&storeName=" + storeName + "&pagesize=" +pagesize
    })

    var optionClick=function(){
        if($("#form_option").val()=="店铺编号"){
            $(".storeID_div").css("display","inline")
            $(".storeName_div").css("display","none")
        }else{
            $(".storeID_div").css("display","none")
            $(".storeName_div").css("display","inline")
        }
    }

    var optionClick2=function(){
        if($("#form_option2").val()=="搜索数据"){
            $(".search_div").css("display","inline")
            $(".output_div").css("display","none")
        }else{
            $(".search_div").css("display","none")
            $(".output_div").css("display","inline")
        }
    }

    var pagesize=function(){
        date1=$("#date3").val()
        date2=$("#date4").val()
        storeID=$("#storeID").val()
        storeName=$("#storeName").val()
        pagesize=$("#pagesize").val()

        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?date1=" +date1 + "&date2=" + date2 + "&storeID=" + storeID + "&storeName=" + storeName +"&pagesize=" +pagesize
    }
</script>