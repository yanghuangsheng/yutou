<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/30
 * Time: 14:42
 */

namespace app\admin\controller;

use \app\admin\logic\SystemVersion as logic;

class SystemVersion extends Base
{

    public function index()
    {
        $logic = (new logic);

        $logic->saveData();

        $data = $logic->getOneData();
        //print_r($data);
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 上传文件
     */
    public function uploadFile()
    {
        $upload = (new \app\admin\logic\Upload);
        $data = $upload->upFile('app_update', 'file', 20, 'wgt,apk,ipa');
        if(isset($data['error'])){
            $upload->resultJson(-1,$data['error']);
        }

        $upload->resultJson(0,'success',$data);
    }
}