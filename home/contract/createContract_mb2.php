<?php
 
 
$html = "
<html xmlns:v=\"urn:schemas-microsoft-com:vml\"
      xmlns:o=\"urn:schemas-microsoft-com:office:office\"
      xmlns:w=\"urn:schemas-microsoft-com:office:word\"
      xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\"
      xmlns=\"http://www.w3.org/TR/REC-html40\">
<head><meta http-equiv=Content-Type content=\"text/html; charset=utf-8\"><title></title>
    <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        w\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
    </style>
    <style>
    .a 
    {
       border-collapse:collapse;
       border:1px solid black;
    }
     .a td
    {
       border:1px solid black;
    }
    .psc{
       border:1px solid black;
    }
</style>
    <style>
        @page
        {
            mso-page-orientation: landscape;
            size:29.7cm 21cm;    margin:1cm 1cm 1cm 1cm;
        }
        @page Section1 {
            mso-header-margin:.5in;
            mso-footer-margin:.5in;
            mso-header: h1;
            mso-footer: f1;
        }
        div.Section1 { page:Section1; }
        table#hrdftrtbl
        {
            margin:0in 0in 0in 900in;
            width:1px;
            height:1px;
            overflow:hidden;
        }
        p.MsoFooter, li.MsoFooter, div.MsoFooter
        {
            margin:0in;
            margin-bottom:.0001pt;
            mso-pagination:widow-orphan;
            tab-stops:center 3.0in right 6.0in;
            font-size:12.0pt;
        }
       #one{padding: 10px 15px;background-color: #FFFFFF;background-image: url(http://www.aaa.com/Uploads/print.png);background-repeat: no-repeat;background-size: 50%;background-position: center;opacity: 0.9;}
    </style>
    <xml>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>100</w:Zoom>
            <w:DoNotOptimizeForBrowser/>
        </w:WordDocument>
    </xml>
</head>
<body>
<div class=\"Section1\" id='one'>
   
           <div style='mso-element:header' id=h1 >
            <!-- HEADER-tags -->
            <p class=MsoHeader style='float: left'><img src='http://www.aaa.com/Uploads/print.png' >www.migelab.com</p>
          
            <!-- end HEADER-tags -->
            </div>
       <div style=\"width: 100%;text-align: center\">
    DE 20191107-5469- TEM拍摄
</div>
<div style=\"width: 100%;\">
  <table style=\"width: 100%\">
      <tr>
          <td style=\"text-align: center\">编号：QP-0008-04(A/0)</td>
          <td style=\"text-align: center\">单号：20191107-5469</td>
      </tr>
  </table>
</div>
<div style=\"width: 100%;\">
 
</div>
<div style=\"width: 100%;\">
    <h4>需求信息</h4>
    <table class=\"a\" style=\"text-align: left;border: 1px solid black;width: 100%\">
       <tr>
           <td style=\"width: 70%\">样品名称：</td>
           <td style=\"width: 70%\">数量：1.0</td>
       </tr>
        <tr>
            <td style=\"width: 100%\" colspan=\"2\"><h4>样品情况：</h4>样品形态:薄膜、样品处理 :不回收、存放要求 :室温、</td>
        </tr>
        <tr>
            <td style=\"width: 100%\" colspan=\"2\"><h4>样品描述及需求信息：（包括尺寸、结构、成分、形态、数量等信息）</h4>样品形态:薄膜、样品处理 :不回收、存放要求 :室温、
                <p>
                制样+拍摄
                </p>
                <p>
                    附件：用户未上传
                </p>
            </td>
        </tr>
    </table>
</div>
<div style=\"width: 100%;\">
    <h4>方案与报价</h4>
    <table  class=\"a\" style=\"text-align: left;border: 1px solid black;width: 100%\">
        <tr>
            <td colspan=\"6\" style=\"width: 100%;\">
                <p>方案描述：（给出测试使用的仪器、检测项目、及相关的方法描述）</p>
            </td>
        </tr>
        <tr>
            <td style=\"width: 16.6%;text-align: center\">收费项目</td>
            <td style=\"width: 16.6%;text-align: center\">数量</td>
            <td style=\"width: 16.6%;text-align: center\">单位</td>
            <td style=\"width: 16.6%;text-align: center\">单价</td>
            <td style=\"width: 16.6%;text-align: center\">总价</td>
            <td style=\"width: 16.6%;text-align: center\">优惠后</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
               
                <div style='mso-element:footer;text-align: center' id=f1><span style='position:relative;z-index:-1'>
               <!-- FOOTER-tags -->
            为用户提供严谨的检测环境、专业的检测方案
                </div>
    
  
</div>
</body></html>
"
;
 
class Word
{
    function start()
    {
        ob_start();
 
    }
    function save($path)
    {
 
 
 
        $data = ob_get_contents();
        ob_end_clean();
 
 
        $this->wirtefile ($path,$data);
    }
 
 
    function wirtefile ($fn,$data)
    {
        $fp=fopen($fn,"wb");
        fwrite($fp,$data);
        fclose($fp);
    }
 
}

$word = new Word();
$word->start();
$name = './'.$newname.".doc";//生成文件路径
echo $html;
$word->save($name );
ob_flush();
flush();