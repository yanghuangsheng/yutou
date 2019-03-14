<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:32
 */

namespace app\api\controller\v1;


use think\Controller;
use think\facade\Config;
use think\facade\Request;
use app\api\exception\ApiException;

class Base extends Controller
{
    protected $isAuth = true;
    protected $isToken = false;
    protected $app = [];
    protected $headers = [];


    protected function initialize()
    {
        parent::initialize();
        $this->app = Config::get('app');
        $this->headers = Request::header();
    }

    /**
     * 检测请求是否合法
     * @throws ApiException
     */
    protected function checkRequestAuth()
    {
        //基础参数校验
        if(empty($this->headers['sign'])) {
            throw new ApiException('sign不存在', 400);
        }
        //客户端
        if(!in_array($this->headers['app_type'], $this->app['app_type'])) {
            throw new ApiException('app_type不合法', 400);
        }

    }

    /**
     * 获取请求头信息
     * @param $name
     * @return mixed|string
     */
    protected function getHeaders($name)
    {
        return isset($this->headers[$name])?$this->headers[$name]:'';
    }

    /**
     * 加密
     * @param $str
     * @return string
     */
    private function encrypt($str)
    {
        $key = $this->app['aes_key'];
        $iv = $this->app['aes_halt'];

        $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_CBC, $iv);
        return base64_encode($encrypted);
    }

    /**
     * 解密
     * @param $str
     * @return string
     */
    private function decrypt($str)
    {
        $key = $this->app['aes_key'];
        $iv = $this->app['aes_halt'];

        $deStr = base64_decode($str);
        $deStr = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $deStr, MCRYPT_MODE_CBC, $iv);
        return trim($deStr);

    }
}