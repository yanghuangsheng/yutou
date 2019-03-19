<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/11
 * Time: 16:39
 */

namespace app\www\controller;


class Error extends Base
{
    public function index()
    {
        $this->init(['title'=>404]);
        return $this->fetch();
    }
}