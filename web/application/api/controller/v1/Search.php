<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 15:53
 */

namespace app\api\controller\v1;


class Search extends Base
{
    /**
     * 搜索
     * @return mixed
     */
    public function index()
    {
        $search = new \app\api\logic\Search;

        return $search->getList();
    }

    /**
     * 加载更多
     * @return mixed
     */
    public function loadList()
    {
        $search = new \app\api\logic\Search;

        return $search->loadList();
    }
}