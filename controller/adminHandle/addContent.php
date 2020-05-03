<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");

    $id=$_POST["id"];
    $title=$_POST["title"];
    $content=$_POST["description"];
    $newsType=$_POST["newsType"];
    $time=date('Y-m-d');

    session_start();
    $person=$_SESSION["username"];
    
    include_once("../../common/conn/conn.php");

    $sqlstr="select max(id) from news";
    $result=mysqli_query($conn,$sqlstr);

    while($myrow=mysqli_fetch_row($result)){
        $maxID=$myrow[0];
    }

    if($maxID==""){
        $maxID=0;
    }

    if($id==""){
        $sqlstr2="insert into news values('$maxID'+1,'$title','$time','$person','$content','$newsType')";
    }else{
        $sqlstr2="update news set title='$title',content='$content',newsType='$newsType' where id='$id'";
    }
        
    $result=mysqli_query($conn,$sqlstr2);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../../admin/manager/managerNews.php"
    </script> 
    <?php
    }else{
    ?>
    <script>
        alert("提交失败！")
        window.location.href="../../admin/manager/managerNews.php"
    </script> 
    <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);

     
?>

