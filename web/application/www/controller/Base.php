<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 15:02
 */

namespace app\www\controller;


use think\Controller;

class Base extends Controller
{
    /**
     * 初始化
     */
    protected function initialize()
    {
        $user = new \app\www\logic\User;
        $data = $user->getSessionUserInfo();

        $this->assign('index', $user->getController());
        $this->assign('user_data', $data);
    }

    /**
     * 判断获取json
     * @param string $text
     * @return bool
     */
    protected function isFormat($text = 'json')
    {
        return \think\facade\Request::param('_format_') == $text;
    }

    /**
     * 设置头部信息
     * @param $data
     */
    protected function init($data)
    {
        $resultData = [
            'title' => '',
            'keywords' => '',
            'description' => '',
        ];

        $this->assign('head', array_merge($resultData, $data));
    }
}