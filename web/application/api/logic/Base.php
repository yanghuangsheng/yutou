<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/18
 * Time: 17:56
 */

namespace app\api\logic;

use think\facade\Cache;
use think\facade\Session;
use think\facade\Request;
use think\facade\Cookie;
use think\facade\Config;
use app\api\exception\ApiException;


class Base
{
    protected $validate;
    protected $error;

    protected $isAuth = true;
    protected $isToken = false;
    protected $app = [];
    protected $headers = [];
    protected $tokenData = [];


    //初始化类
    public function __construct()
    {
        $this->app = Config::get('app');
        $this->headers = Request::header();
        //echo $this->encrypt('sign=db19c86c58e083427dadedded42f73da&time=1552619980267');
        //exit();
        $this->isAuth && $this->checkRequestAuth();
        $this->tokenData = $this->cache($this->getHeaders('token'));
    }

    /**
     * 检测登陆状态
     * @throws ApiException
     */
    protected function checkToken()
    {
        if (!$this->tokenData){
            throw new ApiException('登陆过期', 401);
        }
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

    /**
     * 判断ajax提交
     * @return bool
     */
    public function isAjax()
    {
        return Request::isAjax();
    }

    /**
     * 判断Post提交
     * @return mixed
     */
    public function isPost()
    {
        return Request::isPost();
    }

    /**
     * 获取Post变量
     * @param string $name
     * @return mixed
     */
    public function post($name = '')
    {
        return $name?Request::post($name):Request::post();
    }

    /**
     * 获取get变量
     * @param string $name
     * @return mixed
     */
    public function get($name = '')
    {
        return $name?Request::get($name):Request::get();
    }

    /**
     * 获取请求变量
     * @param string $name
     * @return mixed
     */
    public function param($name = '')
    {
        return $name?Request::param($name):Request::param();
    }

    /**
     * 生成唯-ID
     * @param $prefix
     * @return string
     */
    public function unId($prefix)
    {
        return md5(uniqid($prefix . '_', TRUE));
    }

    /**
     * 缓存
     * @param $name
     * @param string $value
     * @param int $time
     * @return mixed
     */
    public function cache($name, $value = '', $time = 0)
    {
        if($value){
            return Cache::set($name, $value, $time);
        }
        return Cache::get($name);
    }

    /**
     * session 操作
     * @param $name 键名
     * @param string $value
     * @return mixed
     */
    public function session($name, $value = '')
    {
        $name = 'yutou_' . $name;
        if ($value && $value == 'del') {
            return Session::delete($name);
        } else if ($value) {
            return Session::set($name, $value);
        } else {
            return Session::get($name);
        }
    }

    /**
     * cookie 操作
     * @param $name
     * @param $value
     * @return mixed|void
     */
    public function cookie($name , $value = '')
    {
        $name = 'www_' . $name;
        if ($value && $value == 'del') {
            return Cookie::delete($name);
        }else if ($value){
            return Cookie::forever($name, $value);
        }else{
            return Cookie::get($name);
        }

    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 获取当前控制器
     * @return string
     */
    public function getController()
    {
        return strtolower(Request::controller());
    }

    /**
     * 获取当前方法
     * @return string
     */
    public function getAction()
    {
        return strtolower(Request::action());
    }

    /**
     * 获取域名
     * @return mixed
     */
    public function getDomain()
    {
        return Request::domain();
    }

    /**
     * 返回json 以结束
     * @param $data
     */
    public function json($data)
    {
        exit(json_encode($data));
    }

    /**
     * 替换文章图片
     * @param $content
     * @return mixed
     */
    protected function ruleImg($content)
    {
        $domain = $this->getDomain();
        $pregRule = "/<[img|IMG].*?src=[\'|\"]([\/uploads].*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp|\.JPG|\.JPEG|\.PNG|\.GIF]))[\'|\"].*?[\/]?>/";
        $contents = preg_replace($pregRule, '<img src="'.$domain.'${1}" style="max-width:100%">', $content);
        $pregRule = "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
        $contents = preg_replace($pregRule, '<img src="${1}" style="max-width:100%">', $contents);
        $content = str_replace(['<section>','</section>'], ['', ''], $contents);


        return $contents;

    }

}