<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/16
 * Time: 14:08
 */

namespace app\admin\controller;

use \app\admin\logic\User as logic;

class User extends Base
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
     * 新增
     * @return mixed
     */
    public function add()
    {
        (new logic)->saveAdd();

        return $this->fetch();
    }

    public function edit()
    {
        $data = (new logic)->getEdit();

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

    /**
     * 上传文件
     * @param $type
     * @return mixed
     */
    public function uploadFile($type)
    {
        $upload = (new \app\admin\logic\Upload);
        $data = $upload->upFile($type);
        if(isset($data['error'])){
            $upload->resultJson(-1,$data['error']);
        }
        if($type == 'user_avatar'){
            $avatarImg = [
                '200' => resultThumb($data['file'], 'avatar', 200, 200),
                '100' => resultThumb($data['file'], 'avatar', 100, 100),
                '50' => resultThumb($data['file'], 'avatar', 50, 50),
            ];
            $data['file'] = $avatarImg;
        }

        $upload->resultJson(0,'success',$data);
    }
}