<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/18
 * Time: 17:33
 */

namespace app\api\service;


class PortalNews extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNews;
        $this->order = ['id', 'desc'];
        $this->keyId = 'PortalNews.id';
    }

    /**
     * 查询列表View
     * @return \app\common\model\PortalNews
     */
    protected function setWithOnView()
    {
        $this->order = ['published_time', 'desc'];
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,description,author,source_name')
            ->view('PortalNewsInCategory', 'category_id', 'PortalNewsInCategory.news_id = PortalNews.id')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
    }

    /**
     * 查询单条详情View
     * @return \app\common\model\PortalNews
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,keywords,description,author,source_name')
            ->view('PortalNewsContent', 'content', 'PortalNewsContent.news_id = PortalNews.id')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT')
            ->view('Match', ['id'=>'match_status', 'type'=>'match_type', 'league_name', 'attr_data', 'open_time', 'support_main_num', 'support_o_num', 'support_passenger_num'], 'Match.news_id = PortalNews.id', 'LEFT')
            ->view('Team Main', ['id'=>'main_id', 'name'=>'main_name', 'image_url'=>'main_image_url'], 'Main.id = Match.main_id', 'LEFT')
            ->view('Team Passenger', ['id'=>'passenger_id', 'name'=>'passenger_name', 'image_url'=>'passenger_image_url'], 'Passenger.id = Match.passenger_id', 'LEFT');
    }

    /**
     * 上一条 下一条
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function relatedData($id)
    {
        return [
            'prev' => $this->oneView()->where('status', 1)->where('id', '<', $id)->order('id', 'desc')->find(),
            'next' => $this->oneView()->where('status', 1)->where('id', '>', $id)->order('id', 'asc')->find(),
        ];

    }

    /**
     * 最近7天热门资讯
     * @param int $day
     * @param int $num
     * @param array $map
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function hotData($day = 7, $num = 15, $map = [])
    {
        $newTime = $this->newsId([], 'published_time');
        //发布时间最新的时间 7天前的时间
        $endTime = $newTime - $day * 24 * 3600;

        return $this->oneView()
            ->where('PortalNews.published_time', ['>=', $endTime], ['<=', $newTime], 'and')
            ->where('PortalNews.status', 1)
            ->where($map)
            ->order('PortalNews.id', 'desc')
            ->limit($num)->select();
    }

    /**
     * 查询上一条下一条View
     * @return \app\common\model\PortalNews
     */
    protected function oneView()
    {
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,author,source_name')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
    }
}