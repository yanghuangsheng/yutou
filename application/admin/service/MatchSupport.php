<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-06-05
 * Time: 16:34
 */

namespace app\admin\service;


class MatchSupport extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\MatchSupport;
    }

    /**
     * 获取用户支持列表
     * @param $match_id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userSupportList($match_id)
    {
        return $this->model->view('MatchSupport', 'id,match_id,user_id,support_status,golds_num')
            ->view('Match', 'name', 'Match.id = MatchSupport.match_id')
            ->where('MatchSupport.match_id', $match_id)
            ->where('MatchSupport.status', 0)
            ->select()->toArray();;
    }

    /**
     * 更新用户支处理状态
     * @param $id
     * @param $data
     * @return \app\common\model\MatchSupport
     */
    public function userUpdate($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }


}