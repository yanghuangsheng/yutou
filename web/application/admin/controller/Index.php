<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:26
 */

namespace app\admin\controller;


class Index extends Base
{
    /**
     * 后台登陆页
     * @return mixed
     */
    public function index()
    {
        $this->view->engine->layout('layout/main');
        return $this->fetch();
    }


    /**
     * 登陆处理
     */
    public function login()
    {

    }

    /**
     * 安全退出
     */
    public function logout()
    {
        return json(['code'=>0, 'msg'=>'', 'data'=>'']);
    }
}