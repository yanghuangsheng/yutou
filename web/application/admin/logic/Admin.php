<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:47
 */

namespace app\admin\logic;

use \app\admin\service\Admin as AdminService;

class Admin extends Base
{
    /**
     * 处理登陆
     */
    public function login()
    {
        if($this->isAjax()){
            $param = $this->param();

            $validate = new \app\admin\validate\Login;
            if($validate->check($param)){
                $service = new AdminService;
                $result = $service->getInfoData($param['user_account']);
                $inputPass = md5Encryption($result['admin_password']);
                if($result['user_password'] === $inputPass){

                    $this->session('admin', $result);
                    $this->cookie('admin', $result);
                    $service->updateLastTime($result['id']);
                    return true;
                }
                //登陆失败
                $this->error = '帐号或密码错误';
            }
            else{
                //检测用户输入错误信息
                $this->error = $validate->getError();
            }

            return false;
        }
    }
}