<?php

    header("content-type:text/html;charset=utf-8");
    include_once("../../common/conn/conn.php");

    $name=$_GET['name'];

    if($_GET['option']==0){
        $mysqlstr="mysqldump -uroot -proot --databases yzl_database > ../../common/backup/".$name;
        exec($mysqlstr);
        echo "<script>alert('数据库备份成功！');location='../../admin/manager/manager_backup.php'</script>";
    }elseif($_GET['option']==1){
        $mysqlstr="mysql -uroot -proot yzl_database < ../../common/backup/".$name;
        exec($mysqlstr);
        echo "<script>alert('数据库恢复成功！');location='../../admin/manager/manager_backup.php'</script>";
    }elseif($_GET['option']==2){
        function show_file(){
            $folder_name="../../common/backup";
            $d_open=opendir($folder_name);
            $num=0;
            while($file=readdir($d_open)){
                $filename[$num]=$file;
                $num++;
            }
            closedir($d_open);
            return $filename;
        }

        $filename=show_file();

        for($i=2;$i<sizeof($filename);$i++){
            unlink("../backup/".$filename[$i]);
        }
        echo "<script>alert('数据库备份文件删除成功！');location='../../admin/manager/manager_backup.php'</script>";
    }
    

?>