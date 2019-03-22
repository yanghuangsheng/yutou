<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:31
 */

namespace app\api\controller\v1;


class Forum extends Base
{
    //社区所有
    public function index()
    {
        $forum = new \app\api\logic\Forum;
        $data['data'][] = $forum->getList('hot'); //热门
        $data['data'][] = $forum->getList('new'); //最新
        $data['start_id'] =  $forum->getNewsId(); //用于获取下一页数据，预防有新数据重复出现

        return showResult(0, '', $data);

    }


}