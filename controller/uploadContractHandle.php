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

                    $sqlstr1="select max(id) from contract";

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

                        $re_date=(string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();
                        $no=(string)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();
                        $department=(string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue();
                        $pingtai=(string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();
                        $category=(string)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();
                        $company=(string)$objPHPExcel->getActiveSheet()->getCell("F$j")->getValue();
                        $store=(string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();
                        $input_time=(string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();
                        $input_time2=(string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();
                        $money=(string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();
                        $ismoney=(string)$objPHPExcel->getActiveSheet()->getCell("K$j")->getValue();
                        $sales=(string)$objPHPExcel->getActiveSheet()->getCell("L$j")->getValue();
                        $issales=(string)$objPHPExcel->getActiveSheet()->getCell("M$j")->getValue();
                        $service=(string)$objPHPExcel->getActiveSheet()->getCell("N$j")->getValue();
                        $isservice=(string)$objPHPExcel->getActiveSheet()->getCell("O$j")->getValue();
                        $note=(string)$objPHPExcel->getActiveSheet()->getCell("P$j")->getValue();
                        $status=(string)$objPHPExcel->getActiveSheet()->getCell("Q$j")->getValue();

                        $t1 = $re_date;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $re_date=gmdate('Y-m-d',$n1);
                        
                        $t2 = $input_time;
                        $n2 = intval(($t2 - 25569) * 3600 * 24);
                        $input_time=gmdate('Y-m-d',$n2);

                        $t3 = $input_time2;
                        $n3 = intval(($t3 - 25569) * 3600 * 24);
                        $input_time2=gmdate('Y-m-d',$n3);
                        
                        $sqlstr2="insert into contract values('$maxID','$re_date','$no','$department','$pingtai',
                            '$category','$company','$store','$input_time','$input_time2','$money','$ismoney','$sales',
                            '$issales','$service','$isservice','$note','$status')";

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
