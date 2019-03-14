<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:32
 */

namespace app\api\controller\v1;


class Index extends Base
{
    //轮播图
    public function banner()
    {
        echo 'banner';
    }

    //广播
    public function broadcast()
    {
        echo 'broadcast';

    }

    //热门资讯
    public function hotNews()
    {
        echo 'hotNews';

    }

    //资讯栏目
    public function newsColumn()
    {
        echo 'newsColumn';

    }
}