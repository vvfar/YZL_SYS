<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    error_reporting(0);

	require_once dirname(__FILE__) . '../../PHPExcel/PHPExcel.php';
	require_once dirname(__FILE__) . '../../PHPExcel/PHPExcel/IOFactory.php';

    session_start();
    $username=$_SESSION["username"];

    if(!empty($_FILES['excel']['name'])){
        $fileName=$_FILES['excel']['name'];
        $dotArray=explode('.',$fileName);
        $type=end($dotArray);

        if($type!="xls" && $type!="xlsx"){
            ?>
            <script>
                alert("不是Excel文件，请重新上传！")
                window.location.href="../../home/store/dataStore.php"
            </script>
            <?php
        }else{
            $fileinfo=$_FILES['excel'];

            $a=$fileinfo['size'];

            if($fileinfo['size']<120971520 && $fileinfo['size']>0){

                //iconv防止出现上传中文名乱码
                $path=iconv('utf-8','gb2312',"../../common/file/daysData/".$_FILES["excel"]["name"]);

                if(file_exists($path)){
                    ?>
                    <script>
                        alert("文件已存在！")
                        window.location.href="../../home/store/dataStore.php"
                    </script>
                    
                    <?php
                }else{
                    move_uploaded_file($fileinfo['tmp_name'],$path);
                }

                if(!file_exists($path)){
                    ?>
                        <script>
                            alert("上传文件丢失！")
                            window.location.href="../../home/store/dataStore.php"
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

                    $sqlstr1="select max(id) from store_data_sales";

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

                        $storeID=(string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();
                        $salesMoney=(string)$objPHPExcel->getActiveSheet()->getCell("H$j")->getValue();
                        $salesNum=(string)$objPHPExcel->getActiveSheet()->getCell("I$j")->getValue();
                        $date=(string)$objPHPExcel->getActiveSheet()->getCell("J$j")->getValue();
                        $staff=(string)$objPHPExcel->getActiveSheet()->getCell("G$j")->getValue();
                        
                        $t1 = $date;
                        $n1 = intval(($t1 - 25569) * 3600 * 24);
                        $date=gmdate('Y-m-d',$n1);
                        
                        $sqlstr2="select count(*) from store_data_sales where storeID='$storeID' and date='$date'";

                        $result=mysqli_query($conn,$sqlstr2);

                        while($myrow=mysqli_fetch_row($result)){
                            $dup_data=$myrow[0];
                        }

                        if($dup_data >0){
                            $sqlstr3="update store_data_sales set salesMoney='$salesMoney',salesNum='$salesNum',date='$date',corp='$username' where storeID='$storeID' and date='$date'";
                        }else{
                            $sqlstr3="insert into store_data_sales values('$maxID','$storeID','$salesMoney','$salesNum','$date','$staff','$username')";
                        }

                        $result=mysqli_query($conn,$sqlstr3);

                    }

                    //删除文件
                    unlink($path)

                    ?>
                        <script>
                            alert("数据提交成功")
                            window.location.href="../../home/store/dataStore.php"
                        </script>
                    <?php
                }
            }else{
                ?>
                    <script>
                        alert("文件过大")
                        window.location.href="../../home/store/dataStore.php"
                    </script>
                <?php
                
            }
        }

        //mysqli_free_result($result);
        mysqli_close($conn);
    }else{
        ?>
        <script>
            alert("文件上传失败")
            window.location.href="../../home/store/dataStore.php"
        </script>
        <?php
    }
?>