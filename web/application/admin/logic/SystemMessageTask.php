<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:10
 */

namespace app\admin\logic;

use app\admin\service\SystemMessageTask as oService;

class SystemMessageTask extends Base
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
     * 删除
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
     * 新增页面
     */
    public function getAdd()
    {
        $this->saveAdd();
    }

    /**
     * 编辑页面
     */
    public function getEdit()
    {
        $this->saveEdit();
        $edit_id = $this->param('id');
        $data = (new oService)->getOneData($edit_id);

        return $data;
    }

    /**
     * 处理新增
     */
    protected function saveAdd()
    {
        if($this->isAjax()){
            $paramData = $this->param();
            $service = (new oService);
            if($obj = $service->save($paramData, 0, 1)){
                if($paramData['send'] == 0){
                    $this->toMessage($obj);
                    $service->save(['id'=>$obj['id'], 'status'=>1, 'send_time'=>time()],1);
                }

                $this->resultJson(0, '新增成功');
            }else{
                $this->resultJson(-1, '新增失败');
            }
        }
    }

    /**
     * 处理编辑
     */
    protected function saveEdit()
    {
        if($this->isAjax()){
            $paramData = $this->param();
            $service = (new oService);
            if($paramData['status']){
                $this->resultJson(-1, '已推送的信息，无法修改！');
            }
            if($obj = $service->save($paramData, 1, 1)){
                if($paramData['send'] == 0){
                    $this->toMessage($obj);
                    $service->save(['id'=>$obj['id'], 'status'=>1, 'send_time'=>time()],1);
                }

                $this->resultJson(0, '更新成功', ['send_time'=>date('Y-m-d H:i:s')]);
            }else{
                $this->resultJson(-1, '更新失败');
            }
        }
    }




    /**
     * 发送信息
     * @param $data
     * @return \think\Collection
     */
    protected function toMessage($data){
        $message = new \app\admin\service\SystemMessage;
        $messageData = [];
        $content = $data['content'] . ($data['link']?' <a target="_blank" style="margin-left:15px;" href="'.$data['link'].'">查看</a>':'');
        $time = time();
        if($data['type']){
            //私人信息
            $userId = trim($data['user_id']);
            foreach (explode(' ', $userId) as $key => $value){
                $value = trim($value);
                if(is_numeric($value)){
                    $messageData[] = [
                        'task_id' => $data['id'],
                        'user_id' => $value,
                        'type' => 0,
                        'content' => $content,
                        'create_time' => $time,
                    ];
                }
            }
        }else{
            //全体信息
            $userList = (new \app\common\model\User)->where([['status', '=', 0]])->field('id')->select();
            //print_r($userList);
            foreach ($userList as $key => $value){
                $messageData[] = [
                    'task_id' => $data['id'],
                    'user_id' => $value['id'],
                    'type' => 0,
                    'content' => $content,
                    'create_time' => $time,
                ];
            }

        }

        return $message->saveToMessage($messageData);
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
            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
            $param['title'] && $where[] = ['title', '=', '%' . $param['title'] . '%'];

            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }
}