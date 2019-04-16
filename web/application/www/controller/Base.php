<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 15:02
 */

namespace app\www\controller;


use think\Controller;
use think\facade\Config;

class Base extends Controller
{
    /**
     * 初始化
     */
    protected function initialize()
    {
//        $domain = Request::domain();
//        echo str_replace(['_80','_443'], ['', ''], $domain);
//        echo "\n";
        $user = new \app\www\logic\User;
        $data = $user->getSessionUserInfo();

        $this->assign('index', $user->getController());
        $this->assign('app_debug', Config::get('app_debug'));
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
     * @param $index
     */
    protected function init($data, $index = 0)
    {
        $resultData = [
            'title' => '',
            'keywords' => '',
            'description' => '',
            'index' => $index,
        ];

        $this->assign('head', array_merge($resultData, $data));
    }
}