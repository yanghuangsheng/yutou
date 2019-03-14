<?php

return [
    'app_debug' => false,

    'default_return_type' => 'json',
    'exception_tmpl'         => Env::get('think_path'). 'tpl/think_exception.tpl',
    'exception_handle' => '\app\api\exception\ApiHandleException',

    'app' => [
        'sign' => 'db19c86c58e083427dadedded42f73da', //md5('bh3721com@bh3721com@bh3721com')
        'aes_halt' => '1234567890abcdef1234567890abcdef',// 密码加密盐
        'aes_key' => 'e10adc3949ba59abbe56e057f20f883e',//aes 密钥 , 服务端和客户端必须保持一致
        'app_type' => [
            'h5',
            'wechat',
            'ios',
            'android',
        ],
        'app_sign_time' => 10,// sign失效时间
        'app_sign_cache_time' => 20,// sign 缓存失效时间
        'login_time_out_day' => 7,// 登录token的失效时间
    ]

];