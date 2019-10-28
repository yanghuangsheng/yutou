<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/11
 * Time: 17:27
 */

namespace app\www\service;


class ForumPostRule extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostRule;
    }

    /**
     * 触发器
     * @param $event 事件
     * @param $data
     */
    public function trigger($event, $data)
    {
        $rule = new \app\common\model\ForumPostRule;
        $forumPost = new \app\common\model\ForumPost;
        $ruleData = $rule->where('trigger_field', '=', $event)->field('trigger_type,condition')->select();
        foreach ($ruleData as $key => $value){

            if($data['num'] == $value['condition']){
                if($value['trigger_type'] == 'hot'){
                    $forumPost->where('id', '=', $data['id'])->update(['hot'=>1]);
                }elseif ($value['trigger_type'] == 'topic'){
                    $forumPost->where('id', '=', $data['id'])->update(['topic'=>1]);
                }
            }
        }
    }
}