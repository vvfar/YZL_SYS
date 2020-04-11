<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    error_reporting(E_ALL^E_NOTICE);
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
                        window.location.href="../contract.php"
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

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数

                    $ar=array();
                    $i=0;
                    $importRows=0;

                    $sqlstr1="select max(id) from oldflsqd";

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

                        $no=(string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();
                        $company=(string)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();
                        $people=(string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue();
                        $department=(string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();
                        $date=(string)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();
                        $address=(string)$objPHPExcel->getActiveSheet()->getCell("F$j")->getValue();
                        $connection=(string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();
                        $phone=(string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();
                        $driving=(string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();
                        $ishs=(string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();
                        $category=(string)$objPHPExcel->getActiveSheet()->getCell("K$j")->getValue();
                        $productNo=(string)$objPHPExcel->getActiveSheet()->getCell("L$j")->getValue();
                        $productName=(string)$objPHPExcel->getActiveSheet()->getCell("M$j")->getValue();
                        $amount=(string)$objPHPExcel->getActiveSheet()->getCell("N$j")->getValue();
                        $price=(string)$objPHPExcel->getActiveSheet()->getCell("O$j")->getValue();
                        $fls=(string)$objPHPExcel->getActiveSheet()->getCell("P$j")->getValue();
                        $fwfxj=(string)$objPHPExcel->getActiveSheet()->getCell("Q$j")->getValue();
                        $flsName=(string)$objPHPExcel->getActiveSheet()->getCell("R$j")->getValue();
                        $dj=(string)$objPHPExcel->getActiveSheet()->getCell("S$j")->getValue();
                        $sl=(string)$objPHPExcel->getActiveSheet()->getCell("T$j")->getValue();
                        $flfxj=(string)$objPHPExcel->getActiveSheet()->getCell("U$j")->getValue();
                        $sd=(string)$objPHPExcel->getActiveSheet()->getCell("V$j")->getValue();
                        $jkfs=(string)$objPHPExcel->getActiveSheet()->getCell("W$j")->getValue();
                        $wlfs=(string)$objPHPExcel->getActiveSheet()->getCell("X$j")->getValue();
                        $wlno=(string)$objPHPExcel->getActiveSheet()->getCell("Y$j")->getValue();
                        $wlprice=(string)$objPHPExcel->getActiveSheet()->getCell("Z$j")->getValue();
                        $note=(string)$objPHPExcel->getActiveSheet()->getCell("AA$j")->getValue();
                        $hd_sqslhj=(string)$objPHPExcel->getActiveSheet()->getCell("AB$j")->getValue();
                        $hd_fwfhj=(string)$objPHPExcel->getActiveSheet()->getCell("AC$j")->getValue();
                        $hd_flsl=(string)$objPHPExcel->getActiveSheet()->getCell("AD$j")->getValue();
                        $hd_flfhjhs=(string)$objPHPExcel->getActiveSheet()->getCell("AE$j")->getValue();
                        $hd_fwfflfzj=(string)$objPHPExcel->getActiveSheet()->getCell("AF$j")->getValue();
                        $hd_count=(string)$objPHPExcel->getActiveSheet()->getCell("AG$j")->getValue();
                        $ywy=(string)$objPHPExcel->getActiveSheet()->getCell("AH$j")->getValue();
                        $status=(string)$objPHPExcel->getActiveSheet()->getCell("AI$j")->getValue();
                        $date2=(string)$objPHPExcel->getActiveSheet()->getCell("AJ$j")->getValue();
                        $isprint=(string)$objPHPExcel->getActiveSheet()->getCell("AK$j")->getValue();
                        $shr=(string)$objPHPExcel->getActiveSheet()->getCell("AL$j")->getValue();
                        $csr=(string)$objPHPExcel->getActiveSheet()->getCell("AM$j")->getValue();
                        $allTime=(string)$objPHPExcel->getActiveSheet()->getCell("AN$j")->getValue();
                        $file=(string)$objPHPExcel->getActiveSheet()->getCell("AO$j")->getValue();

                        $t1 = $date;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date=gmdate('Y-m-d H:i:s',$n1);

                        $t2 = $date2;
                        $n2 = intval(($t2 - 25569) * 3600 * 24);
                        $date2=gmdate('Y-m-d H:i:s',$n2);

                        $t3 = $allTime;
                        $n3 = intval(($t3 - 25569) * 3600 * 24);
                        $allTime=gmdate('Y-m-d H:i:s',$n3);
                        
                        $sqlstr2="insert into oldflsqd values('$maxID','$no','$company','$people','$department','$date','$address',
                                '$connection','$phone','$driving','$ishs','$category','$productNo','$productName','$amount','$price',
                                '$fls','$fwfxj','$flsName','$dj','$sl','$flfxj','$sd','$jkfs','$wlfs','$wlno','$wlprice','$note',
                                '$hd_sqslhj','$hd_fwfhj','$hd_flsl','$hd_flfhjhs','$hd_fwfflfzj','$hd_count','$ywy','$status',
                                '$date2','$isprint','$shr','$csr','$allTime','$file')";

                        $result=mysqli_query($conn,$sqlstr2);

                    }

                    //删除文件
                    unlink($path)

                    ?>
                        <script>
                            alert("数据提交成功")
                            window.location.href="../contractList.php";
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
