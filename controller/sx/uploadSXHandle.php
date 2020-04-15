<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");
    //error_reporting(E_ALL^E_NOTICE);
    error_reporting(0);

	require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';
	require_once dirname(__FILE__) . '/PHPExcel/PHPExcel/IOFactory.php';


    if(!empty($_FILES['excel']['name'])){
        $fileName=$_FILES['excel']['name'];
        $dotArray=explode('.',$fileName);
        $type=end($dotArray);

        if($type!="xls" && $type!="xlsx"){
            ?>
            <script>
                alert("不是Excel文件，请重新上传！")
                window.location.href="../contract.php";
            </script>
            <?php
        }else{
            $fileinfo=$_FILES['excel'];

            $a=$fileinfo['size'];

            if($fileinfo['size']<120971520 && $fileinfo['size']>0){


                //iconv防止出现上传中文名乱码
                $path=iconv('utf-8','gb2312',"../daysData/".$_FILES["excel"]["name"]);

                if(file_exists($path)){
                    ?>
                    <script>
                        alert("文件已存在！")
                        window.location.href="../zhangmu.php"
                    </script>
                    
                    <?php
                }else{
                    move_uploaded_file($fileinfo['tmp_name'],$path);
                }

                if(!file_exists($path)){
                    ?>
                        <script>
                            alert("上传文件丢失！")
                            //window.location.href="../uploadInfo.php";
                        </script>
                    <?php
                }else{
                    //文件的扩展名
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if ($ext == 'xlsx') {
                        $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
                        $objPHPExcel = $objReader->load($path, 'utf-8');
                    } elseif ($ext == 'xls') {
                        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel = $objReader->load($path, 'utf-8');
                    }

                    

                    //第一张表：sx_form

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数

                    $ar=array();
                    $i=0;
                    $importRows=0;

                    $sqlstr1="select max(id) from sx_form";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $maxID=$myrow[0];
                    }
            
                    if($maxID==""){
                        $maxID=0;
                    }

                    //读表
                    for($j=2;$j<=$highestRow;$j++){
                        

                        $maxID++;

                        $importRows++;
                        
                        $companyName=(string)$objPHPExcel->getSheet(0)->getCell("A$j")->getValue();
                        $ywy=(string)$objPHPExcel->getSheet(0)->getCell("B$j")->getValue();
                        $department=(string)$objPHPExcel->getSheet(0)->getCell("C$j")->getValue();
                        $date1=(string)$objPHPExcel->getSheet(0)->getCell("D$j")->getValue();
                        $sqid=(string)$objPHPExcel->getSheet(0)->getCell("E$j")->getValue();
                        $sqmoney=(string)$objPHPExcel->getSheet(0)->getCell("F$j")->getValue();
                        $sxf=(string)$objPHPExcel->getSheet(0)->getCell("G$j")->getValue();
                        $dateTime=(string)$objPHPExcel->getSheet(0)->getCell("H$j")->getValue();
                        $hkje=(string)$objPHPExcel->getSheet(0)->getCell("I$j")->getValue();
                        $wyfl=(string)$objPHPExcel->getSheet(0)->getCell("J$j")->getValue();
                        $hkfs=(string)$objPHPExcel->getSheet(0)->getCell("K$j")->getValue();
                        $hkfsbz=(string)$objPHPExcel->getSheet(0)->getCell("L$j")->getValue();
                        $note=(string)$objPHPExcel->getSheet(0)->getCell("M$j")->getValue();
                        $shr=(string)$objPHPExcel->getSheet(0)->getCell("N$j")->getValue();
                        $file_name=(string)$objPHPExcel->getSheet(0)->getCell("O$j")->getValue();
                        $date2=(string)$objPHPExcel->getSheet(0)->getCell("P$j")->getValue();
                        $date3=(string)$objPHPExcel->getSheet(0)->getCell("Q$j")->getValue();
                        $status=(string)$objPHPExcel->getSheet(0)->getCell("R$j")->getValue();
                        $status2=(string)$objPHPExcel->getSheet(0)->getCell("S$j")->getValue();
                        $allTime=(string)$objPHPExcel->getSheet(0)->getCell("T$j")->getValue();
                        $csr=(string)$objPHPExcel->getSheet(0)->getCell("U$j")->getValue();
                        $isgx=(string)$objPHPExcel->getSheet(0)->getCell("V$j")->getValue();
                        $gxCount_val=(string)$objPHPExcel->getSheet(0)->getCell("W$j")->getValue();
                        $gxDepartment=(string)$objPHPExcel->getSheet(0)->getCell("X$j")->getValue();

                        

                        $t1 = $date1;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date1=gmdate('Y-m-d',$n1);

                        $t1 = $date2;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date2=gmdate('Y-m-d',$n1);

                        $t1 = $date3;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date3=gmdate('Y-m-d',$n1);
                        
                        $sqlstr2="insert into sx_form values('$maxID','$companyName','$ywy','$department','$date1',
                            '$sqid','$sqmoney','$sxf','$dateTime','$hkje','$wyfl','$hkfs','$hkfsbz','$note','$shr',
                            '$file_name','$date2','$date3','$status','$status2','$allTime','$csr','$isgx','$gxCount_val','$gxDepartment')";


                        $result=mysqli_query($conn,$sqlstr2);
                        
                    }

                    //第二张表：hk_form

                    $sheet = $objPHPExcel->getSheet(1);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数

                    $ar=array();
                    $i=0;
                    $importRows=0;

                    $sqlstr1="select max(id) from hk_form";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $maxID=$myrow[0];
                    }
            
                    if($maxID==""){
                        $maxID=0;
                    }

                    //读表
                    for($j=2;$j<=$highestRow;$j++){
                        

                        $maxID++;

                        $importRows++;
                        
                        $companyName=(string)$objPHPExcel->getSheet(1)->getCell("A$j")->getValue();
                        $department=(string)$objPHPExcel->getSheet(1)->getCell("B$j")->getValue();
                        $ywy=(string)$objPHPExcel->getSheet(1)->getCell("C$j")->getValue();
                        $sqid=(string)$objPHPExcel->getSheet(1)->getCell("D$j")->getValue();
                        $date1=(string)$objPHPExcel->getSheet(1)->getCell("E$j")->getValue();
                        $date2=(string)$objPHPExcel->getSheet(1)->getCell("F$j")->getValue();
                        $syhkje=(string)$objPHPExcel->getSheet(1)->getCell("G$j")->getValue();
                        $hkfs=(string)$objPHPExcel->getSheet(1)->getCell("H$j")->getValue();
                        $hkfs2=(string)$objPHPExcel->getSheet(1)->getCell("I$j")->getValue();
                        $syjehkfs=(string)$objPHPExcel->getSheet(1)->getCell("J$j")->getValue();
                        $dhkje=(string)$objPHPExcel->getSheet(1)->getCell("K$j")->getValue();

                        $t1 = $date1;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $dateTime=gmdate('Y-m-d',$n1);
                        
                        $sqlstr3="insert into hk_form values('$maxID','$companyName','$department','$ywy','$sqid',
                            '$date1','$date2','$syhkje','$hkfs','$hkfs2','$syjehkfs','$dhkje')";

                        $result=mysqli_query($conn,$sqlstr3);
                        
                    }

                    //第三张表：use_sx

                    $sheet = $objPHPExcel->getSheet(2);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数

                    $ar=array();
                    $i=0;
                    $importRows=0;

                    $sqlstr1="select max(id) from use_sx";

                    $result=mysqli_query($conn,$sqlstr1);

                    while($myrow=mysqli_fetch_row($result)){
                        $maxID=$myrow[0];
                    }
            
                    if($maxID==""){
                        $maxID=0;
                    }

                    //读表
                    for($j=2;$j<=$highestRow;$j++){
                        

                        $maxID++;

                        $importRows++;
                        
                        $sqid=(string)$objPHPExcel->getSheet(2)->getCell("A$j")->getValue();
                        $sqmoney=(string)$objPHPExcel->getSheet(2)->getCell("B$j")->getValue();
                        $useMoney=(string)$objPHPExcel->getSheet(2)->getCell("C$j")->getValue();
                        $nowUseMoney=(string)$objPHPExcel->getSheet(2)->getCell("D$j")->getValue();
                        $remainMoney=(string)$objPHPExcel->getSheet(2)->getCell("E$j")->getValue();
                        $fl_no=(string)$objPHPExcel->getSheet(2)->getCell("F$j")->getValue();
                        $useDepartment=(string)$objPHPExcel->getSheet(2)->getCell("G$j")->getValue();
                        $date=(string)$objPHPExcel->getSheet(2)->getCell("H$j")->getValue();
                        $note=(string)$objPHPExcel->getSheet(2)->getCell("I$j")->getValue();

                        $t1 = $date;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date=gmdate('Y-m-d',$n1);
                        
                        $sqlstr4="insert into use_sx values('$maxID','$sqid','$sqmoney','$useMoney','$nowUseMoney','$remainMoney',
                            '$fl_no','$useDepartment','$date','$note')";

                        $result=mysqli_query($conn,$sqlstr4);
                        
                    }

                    //删除文件
                    unlink($path)

                    ?>
                        <script>
                            alert("数据提交成功")
                            window.location.href="../zhangmu3.php";
                        </script>
                    <?php
                }
            }else{
                echo "文件过大！";
            }
        }

        mysqli_free_result($result);
        mysqli_close($conn);
    }else{
        ?>
        <script>
            alert("文件上传失败")
            window.location.href="../contract.php";
        </script>
        <?php
    }
?>
