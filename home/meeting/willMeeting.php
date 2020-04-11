<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_订会议室</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="css/leftbar.css" rel="stylesheet"/>
        <link href="css/header.css" rel="stylesheet"/>
        <script src="lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
        <script src="lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body>
        <?php include 'base/header.php' ?>
        <?php include 'base/leftBar.php' ?>
            
        <div style="width: 1660px;height:890px;margin-left: 240px;">
            
            <div style="margin-top:50px;margin-left:60px;">
                <h4>待审核会议</h4>

                <table class="table table-responsive table-bordered table-hover" style="width: 1300px;margin-bottom:10px;">
                    <tr>
                        <td>序号</td>
                        <td>标题</td>
                        <td>事业部</td>
                        <td>申请人</td>
                        <td>日期</td>
                        <td>时间</td>
                        <td>会议室编号</td>
                        <td>操作</td>
                    <tr>
                    <?php
                        include_once("conn/conn.php");

                        $username=$_SESSION["username"];

                        $sqlstr0="select department from user_form";

                        $result=mysqli_query($conn,$sqlstr0);

                        while($myrow=mysqli_fetch_row($result)){
                            $department=$myrow[0];
                        }

                        if($department=="行政" or $department =="数据中心"){
                            $sqlstr1="select * from meeting where status = '待审核'";
                        }else{
                            $sqlstr1="select * from meeting where status = '待审核' and department='$department'";
                        }

                        $result=mysqli_query($conn,$sqlstr1);

                        $i=0;

                        while($myrow=mysqli_fetch_row($result)){
                            $i=$i+1;

                            ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><a href="/viewMeetingDetail.php?id=<?=$myrow[0]?>"><?=$myrow[1]?></a></td>
                                    <td><?=$myrow[2]?></td>
                                    <td><?=$myrow[10]?></td>
                                    <td><?=$myrow[3]?></td>
                                    <td><?=$myrow[4]?>-<?=$myrow[5]?></td>
                                    <td><?=$myrow[6]?></td>
                                    <td>
                                        <a class="btn btn-success btn-xs" id="yes" href="formHandle/meetingLiuCheng.php?id=<?=$myrow[0]?>&option=1">同意</a>
                                        <a class="btn btn-danger btn-xs" id="no" href="formHandle/meetingLiuCheng.php?id=<?=$myrow[0]?>&option=0">拒绝</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>

<script>

</script>

<style>

</style>