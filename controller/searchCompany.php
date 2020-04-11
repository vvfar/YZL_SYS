<?php
    //解决中文乱码
    header("content-type:text/html;charset=utf-8");
    include_once("../conn/conn.php");

    $name=trim(isset($_GET['name'])?$_GET['name']:"");

    session_start();
    $username=$_SESSION["username"];
    $sqlstr="select companyName from store_form where companyName like '%$name%' and department=(select department from user_form where username='$username')";

    $result=mysqli_query($conn,$sqlstr);

    $companyName="";

    if($result){
        while($myrow=mysqli_fetch_object($result)){
            $companyName=$myrow->companyName;
        }
    }
    

    try{
        if($companyName==""){
            echo "查无此公司";
        }else{
            echo $companyName;
        }
    }catch(Exception $e){
        echo "查无此公司";
    }

    $rel_companyName=trim(isset($_GET['rel_companyName'])?$_GET['rel_companyName']:"");

    if($companyName != ""){

        $sqlstr="select storeName from store_form where companyName like '%$companyName%' and department=(select department from user_form where username='$username')";

        $result=mysqli_query($conn,$sqlstr);
    
        $companyName="";

        echo "<option></option>";
        echo "<option>选择客户所有店铺</option>";

        if($result){

            while($myrow=mysqli_fetch_row($result)){
                foreach($myrow as $storeName){
                    echo "<option>".$storeName."</option>";
                }      
            }            
        }
        
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>
