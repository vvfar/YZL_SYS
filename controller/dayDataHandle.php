<?php
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $id=$_POST["id"];
    $storeID=$_POST["storeID"];
    $clientName=$_POST["clientName"];
    $storeName=$_POST["storeName"];
    $pingtai=$_POST["pingtai"];
    $category=$_POST["category"];
    $department=$_POST["department"];
    $ywy=$_POST["ywy"];
    $salesMoney=$_POST["salesMoney"];
    $salesNum=$_POST["salesNum"];
    $lbts=$_POST["lbts"];
    $fwf=$_POST["fwf"];
    $fwfhk=$_POST["fwfhk"];
    $fwfsx=$_POST["fwfsx"];
    $flf=$_POST["flf"];
    $flfhk=$_POST["flfhk"];
    $flfsx=$_POST["flfsx"];
    $date=$_POST["date"];
        
    if($id==""){
        $sqlstr="select max(id) from day_data";
        $result=mysqli_query($conn,$sqlstr);

        while($myrow=mysqli_fetch_row($result)){
            $maxID=$myrow[0];
        }

        if($maxID==""){
            $maxID=0;
        }

        $sqlstr1="insert into day_data values('$maxID'+1,'$storeID','$clientName','$storeName','$pingtai','$category','$department','$ywy','$salesMoney','$salesNum','$lbts','$fwf','$fwfhk','$fwfsx','$flf','$flfhk','$flfsx','$date')";

    }else{
        $sqlstr1="update day_data set storeID='$storeID',clientName='$clientName',storeName='$storeName',pingtai='$pingtai',department='$department',department='$department',ywy='$ywy',salesMoney='$salesMoney',salesNum='$salesNum',lbts='$lbts',fwf='$fwf',fwfhk='$fwfhk',fwfsx='$fwfsx',flf='$flf',flfhk='$flfhk',flfsx='$flfsx',date='$date' where id='$id'";
    }
    
    $result=mysqli_query($conn,$sqlstr1);

    if($result){
        ?>
        <script>
            alert("提交成功！")
            window.location.href="../form.php"
        </script>

        <?php
    }else{
        ?>
        <script>
            alert("提交失败！")
            window.location.href="../form.php"
        </script>
        <?php
    }

    mysqli_free_result($result);
    mysqli_close($conn);

?>