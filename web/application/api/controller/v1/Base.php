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
        $str = $this->encrypt('After all, tomorrow is another day.');
        echo $str."\n";
        echo $this->decrypt($str)."\n";
        $this->isAuth && $this->checkRequestAuth();
    }

    /**
     * 检测请求是否合法
     * @throws ApiException
     */
    protected function checkRequestAuth()
    {
        //基础参数校验
        if(empty($this->getHeaders('sign'))) {
            throw new ApiException('sign不存在', 400);
        }
        //客户端
        if(!in_array($this->getHeaders('app-type'), $this->app['app_type'])) {
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
     * 检查sign回密串
     * @param $sign
     */
    private function checkSignPass($sign)
    {

    }

    /**
     * 加密
     * @param $str
     * @return string
     */
    private function encrypt($str)
    {

        $key = pack('H*', $this->app['aes_key']);  //md5('123456')
        $iv   = pack('H*', $this->app['aes_halt']);



        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, 0, $iv);
        return $encrypted;
    }

    /**
     * 解密
     * @param $str
     * @return string
     */
    private function decrypt($str)
    {
        $key = pack('H*', $this->app['aes_key']);  //md5('123456')
        $iv   = pack('H*', $this->app['aes_halt']);

        $deStr = $str;
        $deStr = openssl_decrypt($deStr, 'AES-128-CBC', $key, 0, $iv);
        return trim($deStr);

    }
}