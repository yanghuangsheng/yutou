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

        $data = $this->getCommonCommentList($comment, [['PortalNewsComment.news_id', '=', $newsId]]);

        $data['start_id'] = $comment->newsId();
        return $data;
    }

    /**
     * 指定获取评论ID
     * @param $comment
     * @param $where
     * @param $page
     * @return mixed
     */
    public function getCommonCommentList($comment, $where, $page = 1)
    {
        $data = $comment
            //->initWhere([['PortalNewsComment.news_id', '=', $newsId]])
            ->initWhere($where)
            ->initLimit($page)
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

        return $data;
    }

    /**
     * 评论新闻
     */
    public function commentAdd()
    {

        $this->checkToken();
        $param = $this->param();
        //提交数据验证 -> 暂缺


        $comment = new \app\api\service\PortalNewsComment;
        //用户ID
        $param['user_id'] = $this->tokenData['id'];
        if($result = $comment->addComment($param)){

            //累加新闻评论数
            $commentNum = (new \app\api\service\PortalNewsAttr)->saveNum($param, 'comment');

            //规则触发
            $this->ruleTrigger('comment_num', ['id'=>$param['id'], 'num'=>$commentNum]);

            //更新评论用户的评论数
            (new \app\api\service\UserAttr)->saveNum(['id'=>$param['user_id']], 'comment');

            //返回评论内容
            $where = [
                ['PortalNewsComment.news_id', '=', $result['news_id']],
                ['PortalNewsComment.id', '=', $result['id']]
            ];
            $data = $this->getCommonCommentList($comment, $where);

            return showResult(0, '评论成功', $data['list']);
        }

        return showResult(-1, '评论失败');
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


}