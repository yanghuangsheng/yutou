<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 10:43
 */

namespace app\admin\controller;

use app\admin\logic\PortalNewsComment as PortalNewsCommentLogic;

class PortalNewsComment extends Base
{
    /**
     * 新闻评论列表
     * @param PortalNewsCommentLogic $logic
     * @return mixed
     */
    public function index(PortalNewsCommentLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param PortalNewsCommentLogic $logic
     * @return mixed
     */
    public function delete(PortalNewsCommentLogic $logic)
    {
        return (new $logic)->delete();
    }
}