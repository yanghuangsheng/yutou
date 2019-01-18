<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 13:49
 */

namespace app\admin\controller;

use \app\admin\logic\ForumPost as logic;

class ForumPost extends Base
{
    /**
     * 列表
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

    /**
     * 设置热门
     */
    public function setHot()
    {
        return (new logic)->updateFieldByValue();
    }
}