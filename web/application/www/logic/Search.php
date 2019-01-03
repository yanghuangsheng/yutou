<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/3
 * Time: 14:25
 */

namespace app\www\logic;

use \app\www\service\News as newsService;

class Search extends Base
{
    /**
     * 获取列表
     * @return mixed
     */
    public function getList()
    {
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new newsService;
        $q = isset($param['q'])?$param['q']:'';
        $where = [
            ['PortalNews.status', '=', 1],
        ];
        $q && $where[] = ['PortalNews.title', 'like', '%'. $q .'%'];
        isset($param['start_id']) && $where[] = ['PortalNews.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initGroup('PortalNews.id')->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = date('Y-m-d H:i', $value['published_time']);

        }
        $data['q'] = $q;

        return $data;
    }

    /**
     * 加载更多
     */
    public function formatList()
    {
        if($this->isAjax()){

            $data = $this->getList();

            $this->resultJson(0, '', $data);

        }

    }

    /**
     * 获取取新ID
     * @return mixed
     */
    public function getNewId()
    {
       return (new newsService)->newsId();
    }

}