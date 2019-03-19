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
//        echo $this->encrypt('sign=db19c86c58e083427dadedded42f73da&time=1552619980267');
//        exit();
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
        //检查sign
        if(!$this->checkSignPass()){
            throw new ApiException('sign不合法', 400);
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
     * 检查sign密串的有效性
     * @return bool
     */
    private function checkSignPass()
    {
        $deSign = $this->decrypt($this->headers['sign']);

        if(empty($deSign)) {
            return false;
        }

        parse_str($deSign, $parse);
        if(empty($parse['sign']) || empty($parse['time'])){
            return false;
        }
        //sign
        if($this->app['sign'] != $parse['sign']){
            return false;
        }
        //有效期
        if(Config::get('app_debug') === false){
            if((time() - ceil($parse['time'] / 1000)) > $this->app['sign_time']){
                return false;
            }
        }

        return true;
    }

    /**
     * 加密
     * @param $str
     * @return string
     */
    private function encrypt($str)
    {

        $key = pack('H*', $this->app['aes_key']);
        $iv   = pack('H*', $this->app['aes_halt']);

        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encrypted);;
    }

    /**
     * 解密
     * @param $str
     * @return string
     */
    private function decrypt($str)
    {
        $key = pack('H*', $this->app['aes_key']);
        $iv   = pack('H*', $this->app['aes_halt']);

        $deStr = base64_decode($str);
        $deStr = openssl_decrypt($deStr, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return trim($deStr);

    }
}