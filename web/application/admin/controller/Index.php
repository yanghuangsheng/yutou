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
        $this->login();
        //echo md5Encryption('admin');

        $this->view->engine->layout('layout/main');
        return $this->fetch();
    }


    /**
     * 登陆处理
     */
    protected function login()
    {
        return (new \app\admin\logic\Admin)->login();
    }

    /**
     * 安全退出
     */
    public function logout()
    {
        return json(['code'=>0, 'msg'=>'', 'data'=>'']);
    }
}