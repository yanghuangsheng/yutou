<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 14:41
 */

namespace app\admin\controller;

use app\admin\logic\PortalNews as PortalNewsLogic;

class PortalNews extends Base
{
    /**
     * 列表
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function index(PortalNewsLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function add(PortalNewsLogic $logic)
    {
        $data = $logic->getAdd();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function edit(PortalNewsLogic $logic)
    {
        $data = $logic->getEdit();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function delete(PortalNewsLogic $logic)
    {
        return (new $logic)->delete();
    }

    /**
     * 更新发布、热门、推荐
     * @param PortalNewsLogic $logic
     * @return mixed
     */
    public function update(PortalNewsLogic $logic)
    {
        return (new $logic)->updateFieldByValue();
    }

    /**
     * 上传缩略图
     * @param $type
     * @return mixed
     */
    public function uploadImage($type)
    {
        $upload = (new \app\admin\logic\Upload);
        $data = $upload->upFile('partal_news/'.$type);
        if(isset($data['error'])){
            $upload->resultJson(-1,$data['error']);
        }
        resultThumb($data['file'], 'no', 247, 146);
        $upload->resultJson(0,'success',$data);
    }

    /**
     * 上传队图片
     */
    public function uploadTeamImage(){
        $upload = (new \app\admin\logic\Upload);
        $data = $upload->upFile('team');
        if(isset($data['error'])){
            $upload->resultJson(-1,$data['error']);
        }
        $upload->resultJson(0,'success',$data);
    }


    /**
     * 新闻正文相关上传 图片 视频
     * @param $type
     */
    public function upDetailsImages($type)
    {
        (new \app\admin\logic\Upload)->upDetailsImages('partal_news',$type);
    }

    /**
     * 搜索列表
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function team()
    {
        (new PortalNewsLogic)->getTeamList();
    }

}