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
        $data = (new AdImages)->getCarousel(2);
        $domain = $this->getDomain();
        foreach ($data['list'] as $key => &$value){
            $value['image_url'] = $domain.$value['image_url'];
        }
        return $data['list'];

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

    /**
     * 获取广播
     * @return mixed
     */
    public function getBroadcast()
    {
        return (new \app\api\service\SystemBroadcast)->initField('content')->getListData();
    }
}