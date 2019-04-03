<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/12
 * Time: 13:41
 */

namespace app\api\service;


class PortalNewsRule extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsRule;
    }

    /**
     * 触发器
     * @param $event 事件
     * @param $data
     */
    public function trigger($event, $data)
    {
        $rule = new \app\common\model\PortalNewsRule;
        $portalNews = new \app\common\model\PortalNews;
        $ruleData = $rule->where('trigger_field', '=', $event)->field('trigger_type,condition')->select();
        foreach ($ruleData as $key => $value){

            if($data['num'] == $value['condition']){
                if($value['trigger_type'] == 'hot'){
                    $portalNews->where('id', '=', $data['id'])->update(['hot'=>1]);
                }elseif ($value['trigger_type'] == 'recommend'){
                    $portalNews->where('id', '=', $data['id'])->update(['recommend'=>1]);
                }
            }
        }
    }
}