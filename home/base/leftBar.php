<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <script src="/public/js/leftBar.js"></script>
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
            <div style="height: 20px;float:right;margin-right:20px;margin-top:10px;">
                <img src="/public/img/lock.png" height="90%" style="cursor: pointer" id="center"/>
                <img src="/public/img/logout.jpg" height="100%" style="cursor: pointer;position: relative;left:2px;" id="logout" />

                <?php
                    if($newLevel=="ADMIN"){
                ?>
                    <a href="/admin/manager/manager_index.php" class="manager">[管理]</a>
                <?php
                    }
                ?>
            </div>

            <ul class="leftbarAll">
                <li class="leftbar0"><img src="/public/img/left_icon1.png"><a href="index.php">我的门户</a></li>

                <li class="leftbar1"><img src="/public/img/left_icon2.png"><a href="#">公司授信</a></li>
                <div class="leftbar1Z">
                    <li class="leftbar1Z2"><a href="/home/sx/companyManger1.php" style="margin-left:85px;">填写授信单</a></li>
                    <li class="leftbar1Z1"><a href="/home/sx/zhangmu.php" style="margin-left:85px;">待审核授信</a></li>
                    <li class="leftbar1Z4"><a href="/home/sx/zhangmu2.php" style="margin-left:85px;">待回款授信</a></li>
                    <li class="leftbar1Z5"><a href="/home/sx/zhangmu3.php" style="margin-left:85px;">已完成授信</a></li>
                    <li class="leftbar1Z6"><a href="/home/sx/timeSX.php" style="margin-left:85px;">到期授信单</a></li>
                    <li class="leftbar1Z7"><a href="/home/sx/ZFSX.php" style="margin-left:85px;">作废授信单</a></li>
                </div>


                <li class="leftbar6"><img src="/public/img/left_icon3.png"><a href="#">辅料申请单</a></li>
                <div class="leftbar6Z">
                    <li class="leftbar6Z1"><a href="/home/fl/flsq.php" style="margin-left:85px;">新增辅料单</a></li> 
                    <li class="leftbar6Z2"><a href="/home/fl/flList.php" style="margin-left:85px;">待审核辅料</a></li> 
                    <li class="leftbar6Z3"><a href="/home/fl/flDone.php" style="margin-left:85px;">已完成辅料</a></li>
                </div>

                <li class="leftbar11"><img src="/public/img/left_icon4.png"><a href="#">店铺信息</a></li>
                <div class="leftbar11Z">
                    <li class="leftbar11Z2"><a href="/home/store/manStore.php" style="margin-left:85px;">店铺管理</a></li>
                    <li class="leftbar11Z4"><a href="/home/store/dataStore.php" style="margin-left:85px;">店铺数据</a></li>
                </div>

                <li class="leftbar7"><img src="/public/img/left_icon4.png"><a href="#">合同授权</a></li>
                <div class="leftbar7Z">
                    <li class="leftbar7Z2"><a href="/home/contract/contract.php" style="margin-left:85px;">新增单据</a></li>
                    <li class="leftbar7Z3"><a href="/home/contract/w_contract.php" style="margin-left:85px;">待审批单据</a></li>
                    <li class="leftbar7Z1"><a href="/home/contract/contractList.php" style="margin-left:85px;">已审批单据</a></li>
                </div>
                
                <?php
                    if($newLevel=="ADMIN" or $department == "人事行政部"){
                ?>
                    <li class="leftbar8"><img src="/public/img/left_icon5.png"><a href="#">电脑设备</a></li>
                    <div class="leftbar8Z">
                        <li class="leftbar8Z1"><a href="/home/it/itList.php" style="margin-left:85px;">设备列表</a></li> 
                        <li class="leftbar8Z2"><a href="/home/it/it.php" style="margin-left:85px;">新增设备</a></li>
                    </div>
                <?php
                    }
                ?>

                <!--
                    <li class="leftbar2"><img src="../img/left_icon6.png"><a href="#">数据统计</a></li>
                    <div class="leftbar2Z">
                        <li class="leftbar2Z1"><a href="data.php?month=" style="margin-left:85px;">当月数据报表</a></li> 
                        <li class="leftbar2Z2"><a href="form.php" style="margin-left:85px;">日数据报表</a></li>
                        <li class="leftbar2Z3"><a href="sumDayData.php" style="margin-left:85px;">合计数据报表</a></li>
                        <li class="leftbar2Z4"><a href="powerPage.php" style="margin-left:85px;">BI可视化报表</a></li>
                    </div>
                -->

                <?php
                    if($newLevel=="ADMIN" or $department == "人事行政部"){
                ?>
                    <li class="leftbar10"><img src="/public/img/left_icon1.png"><a href="#">订会议室</a></li>
                    <div class="leftbar10Z">
                        <li class="leftbar10Z1"><a href="/home/meeting/viewMeeting.php" style="margin-left:85px;">查看会议</a></li> 
                    </div>
                <?php
                    }
                ?>    
                
                <li class="leftbar5"><img src="/public/img/left_icon1.png"><a href="#">个人中心</a></li>
                
                <div class="leftbar5Z">
                    <li class="leftbar5Z1"><a href="/home/center/center.php" style="margin-left:85px;">我的资料</a></li> 
                </div>

                <li class="leftbar9"><img src="/public/img/left_icon7.png"><a href="/home/document/document.php">文件下载</a></li>
                
            </ul>
        </div>
    </body>
</html>
