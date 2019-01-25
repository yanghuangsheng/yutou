<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/24
 * Time: 15:04
 */

namespace app\admin\logic;

use app\admin\service\UserCapitalLog as oService;
use think\Db;

class UserCapitalLog extends Base
{
    /**
     * 获取列表
     * @return string
     */
    public function getList()
    {
        $this->getListJson();

        return [];
    }

    /**
     * 删除分类
     */
    public function delete()
    {
        if($this->isAjax()){
            $del_id = $this->param('id');

            if((new oService)->delete($del_id)){
                $this->resultJson(0, '删除成功');
            }else{
                $this->resultJson(-1, '删除失败');
            }
        }
    }

    /**
     * 赠送用户金币
     */
    public function give()
    {
        if($this->isAjax()){
            $param = $this->param();
            $user = new \app\admin\service\User;
            if($param['type'] == 'phone') {
                if($user->checkCount($param['type_value'], 'phone') == 0){
                    $this->resultJson(-1, '用户不存在');
                }
                $userId = $user->getOneField([['phone', '=', $param['type_value']]], 'id');
            }elseif($param['type'] == 'id'){
                if($user->checkCount($param['type_value'], 'id') == 0){
                    $this->resultJson(-1, '用户不存在');
                }
                $userId = $param['type_value'];
            }else{
                $this->resultJson(-1, '非法提交');
            }

            Db::startTrans();
            $userCapital = new \app\admin\service\UserCapital;
            $residue = $userCapital->saveGolds($userId, $param['num']);
            if($residue === false){
                $this->resultJson(-1, '赠送失败1');
            }

            $data = [
                'user_id' => $userId,
                'pay' => $param['num'],
                'residue'=> $residue,
                'explain'=> $param['explain'],
            ];
            if((new oService)->giveGoldsLog($data)){
                Db::commit();
                $this->resultJson(0, '赠送成功');
            }else{
                Db::rollback();
                $this->resultJson(-1, '赠送失败2');
            }
        }
    }



    /**
     * 获取数据列表
     */
    protected function getListJson()
    {
        if($this->isAjax()){
            $param = $this->param();
            $order = false;
            $where = [];
//            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
//            if($param['phone']){
//                if(is_numeric($param['phone'])){
//                    $where[] = ['phone', '=', $param['phone']];
//                }
//                else{
//                    $where[] = ['name', '=', $param['phone']];
//                }
//            }

            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }
}