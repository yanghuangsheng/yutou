<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:46
 */

namespace app\admin\logic;

use think\facade\Session;
use think\facade\Request;

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
     * session 操作
     * @param $name 键名
     * @param string $value
     * @return mixed
     */
    public function session($name, $value = '')
    {
        if ($value && $value == 'del') {
            return Session::delete($name);
        } else if ($value) {
            return Session::set($name, $value);
        } else {
            return Session::get($name);
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
     * 输出Api
     * @param $code
     * @param $msg
     * @param array $data
     * @param int $json
     * @return array
     */
    public function resultJson($code, $msg, $data = [], $json = 1)
    {
        $returnData = ['code' => $code, 'msg' => $msg];
        if (array_key_exists('count', $data)) {
            $returnData['data'] = $data['list'];
            $returnData['count'] = $data['count'];
        } else {
            $returnData['data'] = $data;
        }

        if ($json) $this->json($returnData);
        return $returnData;
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