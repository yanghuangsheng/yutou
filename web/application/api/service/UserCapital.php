<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/24
 * Time: 18:16
 */

namespace app\api\service;


class UserCapital extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserCapital;
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }

    /**
     * 更新金币
     * @param $user_id
     * @param $num
     * @return bool|mixed
     */
    public function saveGolds($user_id, $num)
    {
        $operation = substr($num, 0, 1);
        $num = abs($num);
        if($this->model->where('user_id', $user_id)->count()){
            $oGolds = $this->getField([['user_id', '=', $user_id]], 'golds');
            if($operation == '+' || is_numeric($operation)){
                return $this->updateInc(['user_id', $user_id], 'golds', $num) ? $oGolds + $num : false;
            }elseif($operation == '-'){
                return $this->updateDec(['user_id', $user_id], 'golds', $num) ? $oGolds - $num : false;
            }else{
                return false;
            }

        }
        $updateData = [
            'user_id' => $user_id,
            'golds' => $num,

        ];
        return $this->save($updateData)?$num:false;
    }

    /**
     * 消费金币
     * @param $user_id
     * @param $num
     * @return bool
     */
    public function deductGolds($user_id, $num)
    {
        if($this->model->where('user_id', $user_id)->where('golds', '>=', $num)->count()){

            $oGolds = $this->getField([['user_id', '=', $user_id]], 'golds');
            if($this->updateDec(['user_id', $user_id], 'golds', $num)){

                return $oGolds - $num;
            }else{

                $this->error = '服务器繁忙';
            }
        }else{

            $this->error = '金币不足';
        }

        return false;

    }


}