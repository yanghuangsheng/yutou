<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/2
 * Time: 14:29
 */

namespace app\api\logic;

use app\api\exception\SuccessException;
use \app\api\service\PortalNews as newsService;

class Search extends Base
{
    /**
     * 获取列表
     * @throws SuccessException
     */
    public function getList()
    {
        $data = $this->searchData();
        $data['start_id'] = $this->getNewId();

        throw new SuccessException('success', $data);

    }

    /**
     * 加载更多
     * @throws SuccessException
     */
    public function loadList()
    {

        $data = $this->searchData();

        throw new SuccessException('success', $data);

    }

    /**
     * 热门
     * @throws SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function hotNews()
    {
        $data = (new newsService)->hotData(30, 10, [['PortalNews.hot','=',0]]);

        throw new SuccessException('success', $data->toArray());
    }

    /**
     * 获取列表
     * @return mixed
     */
    private function searchData()
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
        $domain = $this->getDomain();

        foreach ($data['list'] as $key => &$value){
            $value['image_url'] = $domain.$value['image_url'];
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = friendlyDate($value['published_time']);

        }

        return $data;
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