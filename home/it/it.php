<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>俞兆林_IT设备</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" media="screen" />
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap.css" rel="stylesheet"/>
        <link href="..\..\public\lib\bootstrap-3.3.7-dist\css\bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"/>
        <link href="..\..\public\css\leftbar.css" rel="stylesheet"/>
        <link href="..\..\public\css\header.css" rel="stylesheet"/>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\jquery-3.3.1.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
        <script src="..\..\public\lib\bootstrap-3.3.7-dist\js\bootstrap-datetimepicker.js"></script>
    </head>
    <body>
        <?php include_once("../../common/conn/conn.php") ?>
        <?php include '../base/header.php' ?>
        <?php include '../base/leftBar.php' ?>

        <div style="margin-left: 180px;">

            <div class="nav nav-pills" style="float:left;margin-top:10px;margin-left:10px;">
                <li role="presentation"><a href="itList.php">设备列表</a></li>
                <li role="presentation" class="active"><a href="#">新增设备</a></li>
            </div>

            <?php
                

                if(isset($_GET['id']) && $_GET['id']!=""){
                    $id=$_GET['id'];
                
                    $sqlstr2="select * from it where id='$id'";

                    $result=mysqli_query($conn,$sqlstr2);

                    while($myrow=mysqli_fetch_row($result)){
                        $id=$myrow[0];
                        $leibie=$myrow[1];
                        $user=$myrow[2];
                        $department=$myrow[3];
                        $orginalDepartment=$myrow[4];
                        $ytMac=$myrow[5];
                        $wxMac=$myrow[6];
                        $leixing=$myrow[7];
                        $brand=$myrow[8];
                        $xinghao=$myrow[9];
                        $year=$myrow[10];
                        $system=$myrow[11];
                        $cpu=$myrow[12];
                        $ram=$myrow[13];
                        $hardpan=$myrow[14];
                        $barcode=$myrow[15];
                        $position=$myrow[16];
                        $mouse=$myrow[17];
                        $power=$myrow[18];
                        $bag=$myrow[19];
                        $note=$myrow[20];               
                    }
                }else{
                    $id="";
                    $leibie="";
                    $user="";
                    $department="";
                    $orginalDepartment="";
                    $ytMac="";
                    $wxMac="";
                    $leixing="";
                    $brand="";
                    $xinghao="";
                    $year="";
                    $system="";
                    $cpu="";
                    $ram="";
                    $hardpan="";
                    $barcode="";
                    $mouse="";
                    $power="";
                    $bag="";
                    $note="";
                    $position="";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
            ?>


            <div style="clear: both;margin-left:30px;position:relative;top:10px;">
                <form method="POST" action="formHandle/itHandle.php">
                    <div class="form-group hidden" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">id</p>
                        <input type="text" class="form-control" name="id" value="<?=$id?>" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">类别</p>
                        <input type="text" class="form-control" name="leibie" value="<?=$leibie?>" placeholder="请输入类别" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">使用人</p>
                        <input type="text" class="form-control" name="user" value="<?=$user?>" placeholder="请输入事业部" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">事业部</p>
                        <input type="text" class="form-control" name="department" value="<?=$department?>" placeholder="请输入事业部" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">归属事业部</p>
                        <input type="text" class="form-control" name="orginalDepartment" value="<?=$orginalDepartment?>" placeholder="请输入归属事业部" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">MAC地址(以太)</p>
                        <input type="text" class="form-control" name="ytMac" value="<?=$ytMac?>" placeholder="请输入MAC地址(以太)" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">MAC地址(无线)</p>
                        <input type="text" class="form-control" name="wxMac" value="<?=$wxMac?>" placeholder="请输入MAC地址(无线)" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">类型</p>
                        <input type="text" class="form-control" name="leixing" value="<?=$leixing?>" placeholder="请输入类型" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">品牌</p>
                        <input type="text" class="form-control" name="brand" value="<?=$brand?>" placeholder="请输入品牌" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">型号</p>
                        <input type="text" class="form-control" name="xinghao" value="<?=$xinghao?>" placeholder="请输入型号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">采购年份</p>
                        <input type="text" class="form-control" name="year" value="<?=$year?>" placeholder="请输入采购年份" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">操作系统</p>
                        <input type="text" class="form-control" name="system" value="<?=$system?>" placeholder="请输入操作系统" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">CPU</p>
                        <input type="text" class="form-control" name="cpu" value="<?=$cpu?>" placeholder="请输入CPU" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">内存</p>
                        <input type="text" class="form-control" name="ram" value="<?=$ram?>" placeholder="请输入内存" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">硬盘大小</p>
                        <input type="text" class="form-control" name="hardpan" value="<?=$hardpan?>" placeholder="请输入硬盘/转速" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">序列号</p>
                        <input type="text" class="form-control" name="barcode" value="<?=$barcode?>" placeholder="请输入序列号" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">位置</p>
                        <input type="text" class="form-control" name="position" value="<?=$position?>" placeholder="请输入电脑位置" style="width: 250px;float: left;margin-top: 15px;">
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">鼠标</p>
                        <select class="form-control" name="mouse" style="width:250px;position: relative;top: 15px;">
                            <?php 
                                if($mouse=="/"){
                                ?>
                                    <option selected="selected">/</option>
                                    <option>有</option>
                                    <option>无</option>
                                <?php
                                }elseif($mouse=="有"){
                                ?>
                                    <option>/</option>
                                    <option selected="selected">有</option>
                                    <option>无</option>
                                <?php
                                }elseif($mouse=="无"){
                                ?>
                                    <option>/</option>
                                    <option>有</option>
                                    <option selected="selected">无</option>
                                <?php
                                }else{
                                    ?>
                                        <option>/</option>
                                        <option>有</option>
                                        <option>无</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">电源</p>
                        <select class="form-control" name="power" style="width:250px;position: relative;top: 15px;">
                        <?php 
                            if($power=="/"){
                            ?>
                                <option selected="selected">/</option>
                                <option>有</option>
                                <option>无</option>
                            <?php
                            }elseif($power=="有"){
                            ?>
                                <option>/</option>
                                <option selected="selected">有</option>
                                <option>无</option>
                            <?php
                            }elseif($power=="无"){
                            ?>
                                <option>/</option>
                                <option>有</option>
                                <option selected="selected">无</option>
                            <?php
                            }else{
                                ?>
                                    <option>/</option>
                                    <option>有</option>
                                    <option>无</option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">电脑包</p>
                        <select class="form-control" name="bag" style="width:250px;position: relative;top: 15px;">
                        <?php 
                            if($bag=="/"){
                            ?>
                                <option selected="selected">/</option>
                                <option>有</option>
                                <option>无</option>
                            <?php
                            }elseif($bag=="有"){
                            ?>
                                <option>/</option>
                                <option selected="selected">有</option>
                                <option>无</option>
                            <?php
                            }elseif($bag=="无"){
                            ?>
                                <option>/</option>
                                <option>有</option>
                                <option selected="selected">无</option>
                            <?php
                            }else{
                                ?>
                                    <option>/</option>
                                    <option>有</option>
                                    <option>无</option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group" style="clear: both;">
                        <p style="width: 120px;font-size: 14px;float: left;margin-top: 22px;">备注</p>
                        <input type="text" class="form-control" name="note" value="<?=$note?>" placeholder="备注" style="width: 250px;float: left;margin-top: 15px;">
                    </div>

                    <div style="clear: both;">
                        <button type="submit" class="btn btn-success btn-md" style="margin-top:10px;margin-left:315px;">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<style>
    th{
        background-color:lemonchiffon;
        text-align: center;
    }

    td{
        text-align: center;
    }
</style>  