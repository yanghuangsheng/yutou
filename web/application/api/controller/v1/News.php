<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:20
 */

namespace app\api\controller\v1;


class News extends Base
{
    //新闻列表
    public function index()
    {
        echo 'index';
    }

    //新闻详情
    public function item()
    {
        return showResult(0,'3844');
        //echo 'item';
    }

    //评论列表
    public function comment()
    {
        echo 'comment';

    }

    //增加评论
    public function addComment()
    {
        echo 'addComment';

    }

}