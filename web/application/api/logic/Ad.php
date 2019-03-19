<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/19
 * Time: 14:53
 */

namespace app\api\logic;

use app\api\service\AdImages;

class Ad extends Base
{
    /**
     * 获取轮播
     * @return array
     */
    public function getCarousel()
    {
        return (new AdImages)->getCarousel(2);

    }

    /**
     * 获取广告
     * @param $ad_id
     * @return array|mixed
     */
    public function getBanner($ad_id)
    {
        return (new AdImages)->getBanner($ad_id);
    }
}