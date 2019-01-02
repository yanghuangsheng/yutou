<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 14:27
 */

namespace app\admin\controller;

use app\admin\logic\ForumPostComment as logic;

class ForumPostComment extends Base
{
    /**
     * 帖子评论列表
     * @return mixed
     */
    public function index()
    {
        $data = (new logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @return mixed
     */
    public function delete()
    {
        return (new logic)->delete();
    }
}