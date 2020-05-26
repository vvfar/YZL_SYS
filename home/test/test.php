<?php
    header("content-type:text/html;charset=utf-8"); 
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT');

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    function send_post($url, $post_data) {
    
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
    
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
   
        return $result;
    }

    //使用方法
    $post_data = array(
        'username' => 'stclair2201',
        'password' => 'handan'
    );
    send_post('http://39.97.4.102:9090/sms/distinct/v1', $post_data);
   
    /*
  //使用方法
  $post_data = array(
    'username' => 'stclair2201',
    'password' => 'handan'
  );
  send_post('http://www.jb51.net', $post_data);

    $appcode="1000";
    $appkey="zlsy66";
    $appsecret="440I53";
    $extend="";
    $phone="18516097646";
    $timestamp=new Date().valueOf();
    $sign=hex_md5($appkey + $appsecret + $timestamp);
    $msg="【兆林实业】您的验证码是123456";
    $url="http://39.97.4.102:9090/sms/distinct/v1";

    $data={"sign": $sign,
        "timestamp": $timestamp,
        "appcode": $appcode,
        "appkey": $appkey,
        
        "sms": [
            {
                "phone": $phone,
                "extend":$extend,
                "msg":$msg,
            }
        ]
    };

    echo send_post($url, $data);
    */
?>