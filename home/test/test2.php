<?php
    function send_sms($phone,$message) {
        $appkey = "zlsy66";
        $appKey = "36426a9xxxxxxxxxxxx7bed8583a3c";
        $appcode = "1000";
        $timestamp="1590378352165";
        $sign="bbc69c06f0ed5355afd8afc63e544fae";

        $sms=[
            "phone" => $phone,
            "extend" => $extend,
            "msg" => $message
        ];

        $data = [
            "sign" => $sign,
            "timestamp" => $timestamp,
            "appcode" => $appcode,
            "appkey" => $appkey,
            "sms" => $sms
        ];

        echo var_dump($data);

        $url = "http://39.97.4.102:9090/sms/distinct/v1";//此处为短信接口的链接，具体的用法参考短信接口的说明
        $curl = curl_init(); //初始化一个新的会话
        
        $timeout = 15;   

        $headers[] = 'Content-Type:text/xml';

        curl_setopt ($curl, CURLOPT_URL, $url);  
        curl_setopt($curl, CURLOPT_HEADER, $headers); 
        
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_POST, 1);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);   //模仿一个用户行为，具体用法参考curl_setopt函数用法。此处模仿一个浏览器输入行为
        
        $res = curl_exec($curl);  //执行会话
        var_dump(curl_error($curl));
        
        curl_close($curl);   // 关闭会话，释放资源。
        
        return $res;
    }

    send_sms("18516097646",'【兆林实业】您的验证码为：123456');
?>