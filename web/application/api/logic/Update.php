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
    protected $versions = '1.0.1';

    public function getUpdate()
    {
        $param = $this->param();
        //$param['version'];
        $data = [
            'content' => '更新...',
            'wgt_url' => $this->getDomain() . '/app_update/app-20190429s.wgt',
            'pkg_url' => '', //$this->getDomain() . '/app_update/app-20190426.apk',
        ];
        return showResult(-1, '', $data);
    }
}