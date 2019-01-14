<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 16:43
 */

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    protected $userData = [];

    protected function initialize()
    {
        $admin = new \app\admin\logic\Admin;
        $this->userData = $admin->session('admin');
        if(!isset($this->userData['id'])){
            exit ('<script language=JavaScript> top.location.href = "'.url("Index/index").'"; </script>');
        }
    }
}