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
        <?php
            include_once("../../../common/conn/conn.php");
            
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

            $sqlstr1="select department,level from user_form where username='$username'";

            $result=mysqli_query($conn,$sqlstr1);
    
            while($myrow=mysqli_fetch_row($result)){
                $department=$myrow[0];
                $level=$myrow[1];
            }
        ?>


        <div data-role="header" data-theme="b" data-position="fixed">
            <a href="#" data-role="button" data-icon="back" data-rel="back">后退</a>
            <h1>已完成辅料单</h1>
            
            <a href="#"><?=$username?></a>
        </div>

        <div data-role="content" class="content">
            <form class="ui-filterable">
                <input id="myFilter2" data-type="search" style="font-size: 14px;" placeholder="查找辅料单据" data-ajax='false'>
            </form>

            <ul data-role="listview" data-filter="true" data-input="#myFilter2" data-theme="g">
                <?php
                    if($department !="数据中心"){
                        $sqlstr2="select id,no,company,people,date,date2,status,allTime from flsqd where (shr like '%$username%' or csr like '%$username%') and (status like '%品牌部归档%'  or status like '%作废%')";
                    }else{
                        $sqlstr2="select id,no,company,people,date,date2,status,allTime from flsqd where status like '%品牌部归档%' or status like '%作废%'";
                    }

                    if(isset($_GET['company'])){
                        $companyName=$_GET['company'];

                        $sqlstr2=$sqlstr2." and company='$companyName'";
                    }

                    $sqlstr2=$sqlstr2." order by id desc";

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        $arr_status=explode(",",$myrow[6]);
                        $status=array_pop($arr_status);

                        $arr_shr=explode(",",$myrow[7]);
                        $shr=array_pop($arr_shr);
                ?>
                <li>
                    <a href="flLine.php?id=<?=$myrow[0]?>" data-ajax="false">
                        <p style="font-size:16px;color:skyblue;font-weight:bold"><?=$myrow[2]?><img src="../../img/renz.png" width='20px;' style="position: relative;top:-2px;left:3px;"/></p>
                        <div>
                            <span class="label label-warning"><?=$status?></span>
                            <span class="label label-primary" style="margin-left: 5px;"  data-filtertext="<?=$shr?>"><?=$shr?></span>
                        </div>
                        <div style="clear:both;">
                            <div style="margin-top: 5px;float:left">
                                <p style="color: #aaaaaa;float:left" data-filtertext="<?=$myrow[1]?>"><?=$myrow[1]?></p>
                                <p style="color: #aaaaaa;float:left;margin-left:10px;" data-filtertext="<?=$myrow[3]?>"><?=$myrow[3]?></p>
                                <p style="color: #aaaaaa;clear: both;" data-filtertext="<?=$myrow[4]?>">开始时间：<?=$myrow[4]?></p>
                                
                            </div>
                            <p style="float:right;color: rgb(0, 162, 255);">查看详情>></p>
                        </div>
                        
                    </a>
                </li>
                <?php
                    }

                    mysqli_free_result($result);
                    mysqli_close($conn);
                ?>
            </ul>
        </div>

        <div data-role="footer" data-theme="b" data-position="fixed">
            <nav data-role="navbar">
                <ul>
                    <li><a href="#" onclick="alert('暂未开放，请在PC端填写单据！')">新增辅料单</a></li>
                    <li><a href="flList.php">未完成辅料</a></li>
                    <li><a href="../index.php">主菜单</a></li>
                    <li><a href="flDone.php" class="ui-btn-active">已完成辅料</a></li>
                    <li><a href="flQuery.php">辅料单查询</a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>

<style>
    .content li a{
        font-size:14px;
    }

    .ui-page-theme-a .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a .ui-btn, html head+body .ui-btn.ui-btn-a, .ui-page-theme-a .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a .ui-btn:visited, html head+body .ui-btn.ui-btn-a:visited{
        text-shadow: none;
    }

</style>
