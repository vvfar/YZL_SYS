<?php
    header("Content-Type:text/html;charset=utf-8");

    $phone=$_GET['phone'];

    function send_sms($phone,$message) {
        $appkey = "zlsy66";
        $appcode = "1000";
        $appsecret="440I53";
        $timestamp=time()*1000;

        $sign=md5($appkey.$appsecret.$timestamp);

        $data=array(
                "sign" => $sign,
                'appkey'=>$appkey,
                'appcode'=>$appcode,
                'timestamp'=>$timestamp,
                'sms' =>[ array(
                    'msg'=>$message,
                    'phone'=> $phone,
                    'extend'=>''
                )]
            );

        $url = "http://39.97.4.102:9090/sms/distinct/v1";//此处为短信接口的链接，具体的用法参考短信接口的说明
        $curl = curl_init(); //初始化一个新的会话
        
        $timeout = 15;   

        $headers = array('Accept:text/plain;charset=utf-8', 'Content-type:application/json','charset=utf-8'); 

        /* 设置验证方式 */
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);

        /* 设置返回结果为流 */
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        /* 设置超时时间*/
        curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

        /* 设置通信方式 */
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt ($curl, CURLOPT_URL, $url);        

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $res = curl_exec($curl);  //执行会话

        curl_close($curl);   // 关闭会话，释放资源。
        
    }

    $chars = array("1", "2",  "3", "4", "5", "6", "7", "8", "9" ); 
    $charsLen = count($chars) - 1; 
    shuffle($chars);   
    $yzm = ""; 
    for ($i=0; $i<4; $i++) 
    { 
        $yzm .= $chars[mt_rand(0, $charsLen)]; 
    } 

    send_sms($phone,'【上海兆林实业】您的CRM系统的验证码为：'.$yzm);

    echo $yzm;


?>