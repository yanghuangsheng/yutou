<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-30
 * Time: 18:36
 */

namespace app\admin\controller;

use app\admin\logic\Match as MatchLogic;

class Match extends Base
{
    /**
     * 列表
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function index()
    {
        $data = (new MatchLogic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 设置比赛结果
     * @return mixed
     */
    public function setEdit(){

        return $this->fetch();
    }

    /**
     * 提交比赛结果
     * @return mixed
     */
    public function setSave()
    {
        (new MatchLogic)->saveResult();
    }
}