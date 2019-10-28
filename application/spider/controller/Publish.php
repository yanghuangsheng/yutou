<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/26
 * Time: 14:05
 */

namespace app\spider\controller;


class Publish extends Base
{
    protected function initialize()
    {
        ignore_user_abort(true);
        set_time_limit(3600);
        @ob_end_clean();//清除之前的缓冲内容，这是必需的，如果之前的缓存不为空的话，里面可能有http头或者其它内容，导致后面的内容不能及时的输出
        header("Connection: close");//告诉浏览器，连接关闭了，这样浏览器就不用等待服务器的响应
        header("HTTP/1.1 200 OK");
    }

    /**
     * 定时任务
     */
    public function task()
    {
        (new \app\spider\service\Publish)->timeTask();
    }
}