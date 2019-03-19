<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/18
 * Time: 17:55
 */

namespace app\api\logic;

use app\api\service\PortalNews;

class News extends Base
{
    /**
     * 获取列表
     * @param $category_id
     * @return mixed
     */
    public function getList($category_id)
    {
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new PortalNews;
        $categoryList[] = $category_id;
        $where = [
            ['PortalNews.status', '=', 1],
        ];

        $category_id && $where[] = ['PortalNewsInCategory.category_id', 'in', join(',', $categoryList)];

        isset($param['start_id']) && $where[] = ['PortalNews.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = date('Y-m-d H:i', $value['published_time']);

        }
        $data['category'] = $category_id;

        return $data;
    }

    /**
     * 首页快讯
     * @return mixed
     */
    public function sevenDayTopData()
    {
        return (new PortalNews)->hotData(30, 10, [['PortalNews.recommended','=',1]]);
    }


    /**
     * 获取最新的ID
     * @return mixed
     */
    public function getNewsId()
    {
        $service = new PortalNews;

        return $service->newsId();
    }
}