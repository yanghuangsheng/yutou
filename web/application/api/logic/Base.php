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


class Base
{
    protected $validate;
    protected $error;

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

}