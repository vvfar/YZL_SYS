<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <link href="/public/css/leftbar.css?v=2" rel="stylesheet"/>
        <link rel="stylesheet" href="/public/lib/layui/css/layui.css" ></script>
        <script src="/public/js/leftBar.js"></script>
        <script src="/public/lib/layui/layui.js"></script>
    </head>

    <body>
        <?php

            $username=$_SESSION["username"];

            $sqlstr1="select department,newLevel from user_form where username='$username'";

            $result=mysqli_query($conn,$sqlstr1);

            while($myrow=mysqli_fetch_row($result)){
                $department=$myrow[0];
                $newLevel=$myrow[1];
            }


        ?>

        <div class="leftBar">

            <ul class="leftbarAll">
                <li class="leftbar0"><i class="layui-icon layui-icon-home"></i><a href="#">我的门户</a></li>
                <div class="leftbar0Z zcd">
                    <li class="leftbar0Z1"><a href="/index.php">公司门户</a></li>
                    <li class="leftbar0Z2"><a href="/home/index/myWork.php">我的工作</a></li>
                    <li class="leftbar0Z3"><a href="/home/index/dataQuery.php">数据平台</a></li>
                </div>

                <li class="leftbar7"><i class="layui-icon layui-icon-template-1"></i><a href="#">公司合同</a></li>
                <div class="leftbar7Z zcd">
                    <li class="leftbar7Z2"><a href="/home/contract/contract.php">新增合同</a></li>
                    <li class="leftbar7Z3"><a href="/home/contract/w_contract.php">待审核合同</a></li>
                    <li class="leftbar7Z1"><a href="/home/contract/contractList.php">已审核合同</a></li>
                </div>

                <li class="leftbar1"><i class="layui-icon layui-icon-rmb"></i><a href="#">授信申请</a></li>
                <div class="leftbar1Z zcd">
                    <li class="leftbar1Z2"><a href="/home/sx/writeSX.php">新增授信单</a></li>
                    <li class="leftbar1Z1"><a href="/home/sx/zhangmu.php">待审核授信</a></li>
                    <li class="leftbar1Z4"><a href="/home/sx/zhangmu2.php">待回款授信</a></li>
                    <li class="leftbar1Z5"><a href="/home/sx/zhangmu3.php">已完成授信</a></li>
                </div>


                <li class="leftbar6"><i class="layui-icon layui-icon-form"></i><a href="#">辅料申请</a></li>
                <div class="leftbar6Z zcd">
                    <li class="leftbar6Z1"><a href="/home/fl/flsq.php">新增辅料单</a></li> 
                    <li class="leftbar6Z2"><a href="/home/fl/flList.php">待审核辅料</a></li> 
                    <li class="leftbar6Z3"><a href="/home/fl/flDone.php">已完成辅料</a></li>
                </div>

                <li class="leftbar11"><i class="layui-icon layui-icon-diamond"></i><a href="#">店铺信息</a></li>
                <div class="leftbar11Z zcd">
                    <li class="leftbar11Z2"><a href="/home/store/manStore.php">店铺管理</a></li>
                    <li class="leftbar11Z4"><a href="/home/store/dataStore.php">店铺数据</a></li>
                    <li class="leftbar11Z5"><a href="/home/store/storeQS.php">店铺问题</a></li>
                </div>
                <?php
                    if($newLevel=="ADMIN" or $department == "人事行政部"){
                ?>
                    <li class="leftbar8"><i class="layui-icon layui-icon-component"></i><a href="#">电脑设备</a></li>
                    <div class="leftbar8Z zcd">
                        <li class="leftbar8Z1"><a href="/home/it/itList.php">设备列表</a></li> 
                        <li class="leftbar8Z2"><a href="/home/it/it.php">新增设备</a></li>
                    </div>
                <?php
                    }
                ?>

                <!--
                    <li class="leftbar2"><img src="../img/left_icon6.png"><a href="#">数据统计</a></li>
                    <div class="leftbar2Z">
                        <li class="leftbar2Z1"><a href="data.php?month=">当月数据报表</a></li> 
                        <li class="leftbar2Z2"><a href="form.php">日数据报表</a></li>
                        <li class="leftbar2Z3"><a href="sumDayData.php">合计数据报表</a></li>
                        <li class="leftbar2Z4"><a href="powerPage.php">BI可视化报表</a></li>
                    </div>
                -->

                <li class="leftbar10"><i class="layui-icon layui-icon-chart-screen"></i><a href="#">订会议室</a></li>
                <div class="leftbar10Z zcd">
                    <li class="leftbar10Z1"><a href="/home/meeting/viewMeeting.php">查看会议</a></li> 
                </div>
                
                <li class="leftbar5"><i class="layui-icon layui-icon-user"></i><a href="#">个人中心</a></li>
                
                <div class="leftbar5Z zcd">
                    <li class="leftbar5Z1"><a href="/home/center/center.php">我的资料</a></li> 
                </div>

                <li class="leftbar9"><i class="layui-icon layui-icon-download-circle"></i><a href="#">文件公告</a></li>    
            
                <div class="leftbar9Z zcd">
                    <li class="leftbar9Z1"><a href="/home/news/allNews.php">公司公告</a></li>
                    <li class="leftbar9Z3"><a href="/home/document/document.php">文件下载</a></li> 
                </div>

                <div>
                    <?php
                        if($newLevel=="ADMIN"){
                    ?>
                        <li class="leftbar12"><i class="layui-icon layui-icon-password"></i><a href="/admin/manager/manager_index.php">后台管理</a></li>
                    <?php
                        }
                    ?>
                </div>
            </ul>
        </div>
    </body>
</html>
