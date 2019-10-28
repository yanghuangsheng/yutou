<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/14
 * Time: 13:58
 */

namespace app\admin\validate;


class Login extends Base
{
    protected $rule = [
        'user_account' => 'require',
        'user_password' => 'require'
    ];

    protected $message = [
        'user_account.require' => '用户名不能为空',
        'user_password.require' => '密码不能为空'
    ];
}