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
        $domain = $this->getDomain();

        foreach ($data['list'] as $key => &$value){
            $value['image_url'] = $domain.$value['image_url'];
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = friendlyDate($value['published_time']);

        }
        $data['category'] = $category_id;

        return $data;
    }

    /**
     * 加载更多
     * @return mixed
     */
    public function loadList()
    {
        $categoryId = $this->param('category_id');
        return $this->getList($categoryId);
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
     * 获取新闻详情
     * @return mixed
     */
    public function getItem()
    {
        $newsId = $this->param('id');

        $service = new PortalNews;
        $data = $service->getOneData($newsId);
        $data['published_time_txt'] = date('Y-m-d H:i', $data['published_time']);
        $data['content'] = $this->ruleImg($data['content']);



        //更新浏览量
        $browseNum = (new \app\www\service\PortalNewsAttr)->saveNum(['id'=>$newsId], 'browse');
        //规则触发
        $this->ruleTrigger('browse_num', ['id'=>$newsId, 'num'=>$browseNum]);

        return $data;

    }

    /**
     * 新闻评论
     * @return mixed
     */
    public function getCommentList()
    {
        $newsId = $this->param('id');
        $comment = new \app\api\service\PortalNewsComment;
        $data = $comment
            ->initWhere([['PortalNewsComment.news_id', '=', $newsId]])
            ->getListData();

        $domain = $this->getDomain();
        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            foreach ($value['user_avatar'] as $keys => $values){
                $value['user_avatar'][$keys] = $domain.$values;
            }
            foreach ($value['reply_avatar'] as $keys => $values){
                $value['reply_avatar'][$keys] = $domain.$values;
            }

        }

        $data['start_id'] = $comment->newsId();
        return $data;
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

    /**
     * 规则触发器
     * @param $event 事件
     * @param $dara ['id','num']
     */
    protected function ruleTrigger($event, $dara){
        (new \app\api\service\PortalNewsRule)->trigger($event, $dara);
    }

    /**
     * 替换文章图片
     * @param $content
     * @return mixed
     */
    protected function ruleImg($content)
    {
        $domain = $this->getDomain();
        $pregRule = "/<[img|IMG].*?src=[\'|\"]([\/uploads].*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp]))[\'|\"].*?[\/]?>/";
        $contents = preg_replace($pregRule, '<img src="'.$domain.'${1}" style="max-width:100%">', $content);
        $pregRule = "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/";
        $contents = preg_replace($pregRule, '<img src="${1}" style="max-width:100%">', $contents);
        return $contents;

    }
}