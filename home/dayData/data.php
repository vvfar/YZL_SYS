<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_数据统计</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\flotr2\flotr2.min.js"></script>
        <!-- [if lt IE 9]>
            <script src="flotr2/excanvas.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>

        <div style="background-color: rgb(243, 243, 243);width: 1660px;height:890px;margin-left: 240px;">

            <div class="nav nav-pills" style="float:left;margin-left:30px;position:relative;top:20px;">
                <li role="presentation" class="active"><a href="data.php?month=">当月实时数据图表</a></li>
                <li role="presentation"><a href="form.php">日数据报表</a></li>
                <li role="presentation"><a href="sumDayData.php">合计数据报表</a></li>
                <li role="presentation"><a href="powerPage.php">BI数据可视化报表</a></li>
            </div>
            <div style="clear:both;margin-left:40px;position:relative;top:20px;">
                <p style="float:left;margin-top:23px;">选择日期</p>

                <?php
                    include_once("conn/conn.php");

                    if(isset($_GET["month"])){
                        $month=$_GET["month"];
                        if($month==""){
                            $sqlstr3="select distinct max(left(date,7)) as month from day_data order by month desc";
                            $result=mysqli_query($conn,$sqlstr3);

                            while($myrow=mysqli_fetch_row($result)){
                                $month=$myrow[0];
                            }
                        }
                    }
                ?>

                <select style="float:left;margin-left:20px;margin-top:17px;width: 125px;" class="form-control" id="month" onchange="queryMonth()">
                    <?php
                        $sqlstr3="select distinct left(date,7) as month from day_data order by month desc";
                        $result=mysqli_query($conn,$sqlstr3);

                        while($myrow=mysqli_fetch_row($result)){
                            if($month==$myrow[0]){
                            ?>
                                <option selected="selected"><?=$myrow[0]?></option>
                            <?php
                            }else{
                                ?>
                            
                                <option><?=$myrow[0]?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="pannel-body" style="clear: both;margin-left:30px;position:relative;top:50px;">
                <div id="chart" style="width: 550px;height:310px;float: left;"></div>
                <div id="chart2" style="width: 550px;height:310px;float: left;margin-left: 50px;"></div>
                <div id="chart3" style="width: 500px;height:300px;float: left;margin-left:50px;margin-top: 45px;"></div>
                <div id="chart4" style="width: 550px;height:310px;float: left;margin-left:60px;margin-top: 45px;"></div>
            </div>
        </div>
    </body>
</html>

<style>
    .user_header:hover p{
        color:#fff;
        cursor: pointer;
    }
</style>

<script>
    //柱状图数据
    <?php

        $sqlstr1="select department,ROUND(sum(fwfhk),2)+ROUND(sum(flfhk),2) from day_data where date like '%$month%' group by department order by ROUND(sum(fwfhk),2)+ROUND(sum(flfhk),2) desc";            
        $result1=mysqli_query($conn,$sqlstr1);

        $count_id=0;

        $wins="[[";
        $years="[";

        $str="";
        $str1="";
        
        while($myrow=mysqli_fetch_row($result1)){
            //数量
            $str=$str."[".$count_id.",".$myrow[1]."],";
            //部门
            $str1=$str1.'['.$count_id.','.'"'.$myrow[0].'"'.'],';

            $count_id++;
        }
        $str = substr($str,0,strlen($str)-1);
        $str1 = substr($str1,0,strlen($str1)-1);

        $wins=$wins.$str."]]";
        $years=$years.$str1."]";
    ?>

    var wins=JSON.parse('<?=$wins?>');
    //alert('<?=$years?>')
    var years=JSON.parse('<?=$years?>');



    //折线图数据
    var zero=[];

    for (var yr=2006;yr<2010;yr++){
        zero.push([yr,0]);
    }

    <?php
        $sqlstr2="select date,ROUND(sum(salesMoney),2) from day_data where date like '%$month%' group by date order by date";            
        $result2=mysqli_query($conn,$sqlstr2);

        $count_id=1;
        
        $co2="[";
        $str="";

        while($myrow=mysqli_fetch_row($result2)){
            //数量
            $str=$str."[".$count_id.",".$myrow[1]."],";
            
            $count_id++;
        }
        $str = substr($str,0,strlen($str)-1);

        $co2=$co2.$str."]";
    ?>

    var co2=JSON.parse('<?=$co2?>');
    
    //饼图数据
    <?php
        $sqlstr3="select pingtai,ROUND(sum(fwfhk),2)+ROUND(sum(flfhk),2) from day_data where date like '%$month%' group by pingtai order by pingtai";            
        $result3=mysqli_query($conn,$sqlstr3);

        $count_id=1;
        
        $data="[";
        $str="";
    ?>    
    
    var data=[

    <?    
        while($myrow=mysqli_fetch_row($result3)){
            //数量
            if($myrow[1]>0){
                echo '{data:[['.$count_id.','.$myrow[1].']],label:'.'"'.$myrow[0].'"'.'},';
                $count_id++;
            }
            
        }
        //$str = substr($str,0,strlen($str)-1);
    ?>
    ];
    /*var data=[
        {data:[[0,15]],label:"京东"},
        {data:[[1,27]],label:"天猫"},
        {data:[[2,0]],label:"唯平会"},
        {data:[[3,32]],label:"拼多多"},
        {data:[[5,3]],label:"线下"},
        {data:[[4,23]],label:"工厂"},
    ];
    */
    /*var data=[
        {data:[[1,40480.00]],label:"京东"},
        {data:[[2,3000.00]],label:"天猫"},
        {data:[[3,139532.00]],label:"拼多多"},
    ]
    */

    //离散图表
    var fujd_data=[
        {part:"内衣京东",spending:103.01,life:100.05},
    ]
    var pdd_data=[
        {part:"内衣拼多多",spending:68.66,life:65.60},
    ]
    var fz_data=[
        {part:"服装事业部",spending:213.85,life:85.16},
    ]
    var jf_data=[
        {part:"家纺事业部",spending:52.58,life:91.50},
    ]
    var nz_data=[
        {part:"女装事业部",spending:298.97,life:131.54},
    ]
    var jj_data=[
        {part:"居家百货事业部",spending:120.10,life:157.26},
    ]
    var my_data=[
        {part:"母婴童装事业部",spending:63.39,life:56.07},
    ]
    var ny_data=[
        {part:"内衣天猫唯品会事业部",spending:71.91,life:103.17},
    ]

    var fujd=[];
    var pdd=[];
    var fz=[];
    var jf=[];
    var nz=[];
    var jj=[];
    var my=[];
    var ny=[];

    for(var i=0;i<fujd_data.length;i++){
        fujd.push([
            fujd_data[i].spending,
            fujd_data[i].life
        ]);
    }

    for(var i=0;i<pdd_data.length;i++){
        pdd.push([
            pdd_data[i].spending,
            pdd_data[i].life
        ]);
    }

    for(var i=0;i<fz_data.length;i++){
        fz.push([
            fz_data[i].spending,
            fz_data[i].life
        ]);
    }

    for(var i=0;i<jf_data.length;i++){
        jf.push([
            jf_data[i].spending,
            jf_data[i].life
        ]);
    }

    for(var i=0;i<nz_data.length;i++){
        nz.push([
            nz_data[i].spending,
            nz_data[i].life
        ]);
    }

    for(var i=0;i<jj_data.length;i++){
        jj.push([
            jj_data[i].spending,
            jj_data[i].life
        ]);
    }

    for(var i=0;i<my_data.length;i++){
        my.push([
            my_data[i].spending,
            my_data[i].life
        ]);
    }

    for(var i=0;i<ny_data.length;i++){
        ny.push([
            ny_data[i].spending,
            ny_data[i].life
        ]);
    }

    window.onload=function(){
        Flotr.draw(document.getElementById("chart"),wins,{
            title:"<?=$month?>事业部回款柱状图",
            colors:["#89AFD2","#1D1D1D","DF021D","0E204B","#E67840","#89AFD2","#1D1D1D"],
            bars:{
                show:true,
                barWidth:0.5,
                shadowSize:0,
                fillOpacity:1,
                lineWidth:0
            },
            yaxis:{
                min:0,
                tickDecimals:0
            },
            xaxis:{
                ticks:years
            },
            grid:{
                horizontailLines:false,
                verticalLines:false
            }
        });

        Flotr.draw(
            document.getElementById("chart2"),
            [{
                data:zero,
                lines:{show:true,lineWidth:1},
                shadowSize:0,
                color:"#545454"
            },
            {
                data:co2,
                label:"总销售额",
                lines:{show:true,lineWidth:1},
                shadowSize:0,
                color:"#545454"
            }],
            {
                title:"<?=$month?>所有事业部销售额折线图",
                grid:{horizontailLines:false,verticalLines:false},
                xaxis:{min:1,max:31,tickDecimals:0},
                yaxis:{min:0,max:10000000},
            }
        );

        Flotr.draw(
            document.getElementById("chart3"),data,{
                title:"<?=$month?>平台回款占比",
                pie:{
                    show:true
                },
                yaxis:{
                    showLabels:false
                },
                xaxis:{
                    showLabels:false
                },
                grid:{
                    horizontailLines:false,
                    verticalLines:false
                }
            }
        )

        Flotr.draw(
            document.getElementById("chart4"),
            [
                {
                    data:fujd,
                    label:"内衣京东",
                    points:{show:true}
                },
                {
                    data:pdd,
                    label:"内衣拼多多",
                    points:{show:true}
                },
                {
                    data:fz,
                    label:"服装",
                    points:{show:true}
                },
                {
                    data:jf,
                    label:"家纺",
                    points:{show:true}
                },
                {
                    data:nz,
                    label:"女装",
                    points:{show:true}
                },
                {
                    data:jj,
                    label:"居家百货",
                    points:{show:true}
                },
                {
                    data:my,
                    label:"母婴童装",
                    points:{show:true}
                },
                {
                    data:ny,
                    label:"内衣天猫唯品会",
                    points:{show:true}
                },
            ],
            {
                title:"5月销售与回款完成百分比[销售x,回款y]",
                xaxis:{min:-130,max:350,tickDecimals:0,
                        tickFormatter:function(val){
                            return val + "%"
                        }},
                yaxis:{min:0,max:350,tickDecimals:0,
                        tickFormatter:function(val){
                            return val + "%"
                        }}
            }    
        );

    }

    var queryMonth=function(){
        month=$("#month").val()

        window.location.href="<?php echo $_SERVER['PHP_SELF']?>?month=" + month
    }
</script>