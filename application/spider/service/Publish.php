<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/26
 * Time: 14:07
 */

namespace app\spider\service;


class Publish extends Base
{
    public function timeTask()
    {
         $news = new \app\common\model\PortalNews;
         $time = time();
         //查询当前时间任务
         $TaskList = $news->where([['status', '=', 0], ['task', '=', 1], ['published_time', '<', $time]])
             ->field('id')->select()->toArray();
        //如果存在定时任务
         if($TaskList){
             $idArr = array_column($TaskList, 'id');
             $news->where('id', 'in', implode(',', $idArr))->update(['status'=>1, 'task'=>0]);
         }
    }
}