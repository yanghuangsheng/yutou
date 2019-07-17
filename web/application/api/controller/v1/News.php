<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:20
 */

namespace app\api\controller\v1;

use \app\api\logic\News as Logic;

class News extends Base
{
    /**
     * 新闻列表
     * @throws \app\api\exception\SuccessException
     */
    public function index()
    {
        (new Logic)->loadList();
    }

    /**
     * 新闻详情
     * @throws \app\api\exception\SuccessException
     */
    public function item()
    {
        (new Logic)->getItem();
    }

    /**
     * 更新任务
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function upTask()
    {
        (new Logic)->updateTask();
    }

    /**
     * 加载更多
     * @throws \app\api\exception\SuccessException
     */
    public function moreComment()
    {
        (new Logic)->getMoreCommentList();
    }

    /**
     * 查看评论
     * @throws \app\api\exception\SuccessException
     */
    public function lookComment()
    {
        (new Logic)->getLookCommentList();
    }

    /**
     * 评论
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function submitComment()
    {
        (new Logic)->addComment();

    }

    /**
     * 收藏新闻
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function collect()
    {
        (new Logic)->collect();
    }

    /**
     * 点赞新闻
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function praise()
    {
        (new Logic)->praiseNews();
    }

    /**
     * 点赞评论
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function praiseComment()
    {
        (new Logic)->praiseComment();
    }


}