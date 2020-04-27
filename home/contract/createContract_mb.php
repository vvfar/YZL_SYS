<?php

    include_once("../../common/conn/conn.php");

    $sqlstr1="select * from contract where id=1";

    $result=mysqli_query($conn,$sqlstr1);

    while($myrow=mysqli_fetch_row($result)){
        
    }

    $sqlstr2="select content from news where title='公司合同'";

    $result=mysqli_query($conn,$sqlstr2);

    while($myrow=mysqli_fetch_row($result)){
        $html=$myrow[0];
    }


    /**
     * @desc 方法一、生成word文档
     * @param $content
     * @param string $fileName
     */
    function createWord($content = 'aabbcc', $fileName = '111')
    {
        if (empty($content)) {
            return;
        }
        $content='<html 
                xmlns:o="urn:schemas-microsoft-com:office:office" 
                xmlns:w="urn:schemas-microsoft-com:office:word" 
                xmlns="http://www.w3.org/TR/REC-html40">
                <meta charset="UTF-8" />'.$content.'</html>';
        if (empty($fileName)) {
            $fileName = date('YmdHis').'.doc';
        }
        file_put_contents($fileName, $content);
    }

    /**
     * @desc 方法二、生成word文档并下载
     * @param $content
     * @param string $fileName
     */
    function downloadWord($content, $fileName=''){

        if(empty($content)){
            return;
        }
        if (empty($fileName)) {
            $fileName = date('YmdHis').'.doc';
        }
        //header("location:xxx.doc");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename={$fileName}");

        $html = '<html xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office"
            xmlns:w="urn:schemas-microsoft-com:office:word" 
            xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" 
            xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta http-equiv="Content-Type" content="text/html;charset="UTF-8" /></head>';
        
        echo $html_doc . '<body style="font-size:12px;font-family:微软雅黑">'.$content .'</body></html>';
    }
    
    downloadWord($html,"YZL《经销商加盟合同》.doc");
    
?>

<script>
    window.location.href="/sxmb.php?id=<?=$id?>"
</script>