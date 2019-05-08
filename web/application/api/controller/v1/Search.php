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
     * @return mixed
     */
    public function index()
    {

        return (new searchService)->getList();
    }

    /**
     * 加载更多
     * @return mixed
     */
    public function loadList()
    {

        return (new searchService)->loadList();
    }

    /**
     * 热门
     * @return mixed
     */
    public function hotNews()
    {

        return (new searchService)->hotNews();
    }
}