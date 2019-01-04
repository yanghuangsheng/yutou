<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/25
 * Time: 12:01
 */

namespace app\www\service;


class News extends Common
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
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,description,author,source_name')
            ->view('PortalNewsInCategory', 'category_id', 'PortalNewsInCategory.news_id = PortalNews.id')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
    }

    /**
     * 查询单条详情View
     * @return $this
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,description,author,source_name')
            ->view('PortalNewsContent', 'content', 'PortalNewsContent.news_id = PortalNews.id')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
    }

    /**
     * 上一条 下一条
     * @param $id
     * @return mixed
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
     * @return mixed
     */
    public function hotData($day = 7, $num = 15, $map = [])
    {
        $newTime = $this->newsId([], 'published_time');
        //发布时间最新的时间 7天前的时间
        $endTime = $newTime - $day * 24 * 360;

        return $this->oneView()->where('PortalNews.published_time', '<=', $newTime)
            ->where('PortalNews.published_time', '>=', $endTime)
            ->where('PortalNews.status', 1)
            ->where($map)
            ->order('PortalNews.id', 'desc')
            ->limit($num)->select();
    }

    /**
     * 查询上一条下一条View
     * @return $this
     */
    protected function oneView()
    {
        return $this->model->view('PortalNews', 'id,title,image_url,published_time,author,source_name')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');
    }





}