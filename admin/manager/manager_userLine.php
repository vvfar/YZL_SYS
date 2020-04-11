<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_用户管理</title>
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

        <div style="width: 1660px;height:890px;margin-left: 240px;">
            <?php
                include("base/manager_header.php");
                include_once("conn/conn.php");

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                }else{
                    $id="";
                }
                

                if($id != ""){
                    $sqlstr="select * from user_form where id='$id'";
                    $result=mysqli_query($conn,$sqlstr);
                
                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $username=$myrow[1];
                        $department=$myrow[3];
                        $level=$myrow[4];
                        $phone=$myrow[5];
                        $email=$myrow[6];
                        $nickname=$myrow[7];
                        $newLevel=$myrow[9];
                    }
                }else{
                    $id="";
                    $username="";
                    $department="";
                    $level="";
                    $phone="";
                    $email="";
                    $nickname="";
                    $newLevel="";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
            ?>


            <form action="formHandle/adminHandle/addUser.php" method="POST" style="padding-top: 10px;margin-left:45px;">                
                <div>
                    <h4 style="float: left">用户信息</h4>
                    <p style="float: left;margin-left: 270px;margin-top: 10px;"><a href="manager_index.php">返回</a></p>
                </div>
                
                <div class="form-group" style="clear: both;margin-bottom:0px;display:none">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">*id</p>
                    <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">*用户名</p>
                    <input type="text" class="form-control" name="username" value="<?=$username?>" placeholder="请输入用户名" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">*事业部</p>
                    <input type="text" class="form-control" name="department" value="<?=$department?>" placeholder="请输入事业部" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">*职位</p>
                    <input type="text" class="form-control" name="level" value="<?=$level?>" placeholder="请输入职位" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">*层级</p>
                    <select class="form-control" name="newLevel" style="width: 250px;float: left;margin-top: 15px;">
                        <?php
                            if($newLevel =="M级别"){
                                ?>
                                    <option>请选择层级</option>
                                    <option selected>M级别</option>
                                    <option>KA级别</option>
                                    <option>P级别</option>
                                    <option>数据专员</option>
                                <?php
                            }elseif($newLevel =="KA级别"){
                                ?>
                                    <option>请选择层级</option>
                                    <option>M级别</option>
                                    <option selected>KA级别</option>
                                    <option>P级别</option>
                                    <option>数据专员</option>
                                <?php
                            }elseif($newLevel =="P级别"){
                                ?>
                                    <option>请选择层级</option>
                                    <option>M级别</option>
                                    <option>KA级别</option>
                                    <option selected>P级别</option>
                                    <option>数据专员</option>
                                <?php
                            }elseif($newLevel =="数据专员"){
                                ?>
                                    <option>请选择层级</option>
                                    <option>M级别</option>
                                    <option>KA级别</option>
                                    <option>P级别</option>
                                    <option selected>数据专员</option>
                                <?php
                            }else{
                                ?>
                                    <option>请选择层级</option>
                                    <option>M级别</option>
                                    <option>KA级别</option>
                                    <option>P级别</option>
                                    <option>数据专员</option>
                                <?php
                            }
                        ?>
                        
                        
                    </select>
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">电话</p>
                    <input type="text" class="form-control" name="phone" value="<?=$phone?>" placeholder="请输入电话号码" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">邮箱</p>
                    <input type="text" class="form-control" name="email" value="<?=$email?>" placeholder="请输入邮箱地址" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div class="form-group" style="clear: both;margin-bottom:0px;">
                    <p style="width: 120px;font-size: 14px;float: left;margin-top: 20px;">昵称</p>
                    <input type="text" class="form-control" name="nickname" value="<?=$nickname?>" placeholder="请输入昵称" style="width: 250px;float: left;margin-top: 15px;">
                </div>
                <div style="clear: both">
                    <button type="submit" class="btn btn-success btn-md" style="margin-top: 20px;position:relative;left:250px;">提交</button>
                    <button type="reset" class="btn btn-danger btn-md" style="margin-top: 20px;position:relative;left:260px;">重置</button>
                </div>
            </form>

        </div>
    </body>
</html>

<style>

</style>