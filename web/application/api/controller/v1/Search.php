<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 15:53
 */

namespace app\api\controller\v1;

use app\api\logic\Search as searchService;

class Search extends Base
{
    /**
     * 搜索
     * @throws \app\api\exception\SuccessException
     */
    public function index()
    {

        (new searchService)->getList();
    }

    /**
     * 加载更多
     * @throws \app\api\exception\SuccessException
     */
    public function loadList()
    {

        (new searchService)->loadList();
    }

    /**
     * 热门
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function hotNews()
    {

        (new searchService)->hotNews();
    }
}