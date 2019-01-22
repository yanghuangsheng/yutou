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
     * 更新发布、热门、推荐
     */
    public function update()
    {
        return (new logic)->updateFieldByValue();
    }
}