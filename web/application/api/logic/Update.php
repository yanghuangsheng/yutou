<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/26
 * Time: 16:54
 */

namespace app\api\logic;


class Update extends Base
{
    public function getUpdate()
    {
        $data = [
            'content' => '更新...',
            'wgt_url' => $this->getDomain() . '/app_update/app-20190426.wgt',
            'pkg_url' => '',
        ];
        return showResult(0, '', $data);
    }
}