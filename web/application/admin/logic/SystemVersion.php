<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/30
 * Time: 14:50
 */

namespace app\admin\logic;

use \app\admin\service\System as Service;

class SystemVersion extends Base
{

    public function getOneData()
    {
       $data = (new Service)->getOneData([['name', '=', 'version']]);

       return $data['data'];
    }


    public function saveData()
    {
        if($this->isAjax()){
            $param = $this->param();

            if((new Service)->saveData($param['data'], 'version')){
                $this->resultJson(0, '保存成功');
            }else{
                $this->resultJson(-1, '保存失败');
            }
        }
    }
}