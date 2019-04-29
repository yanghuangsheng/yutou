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
    protected $versions = '1.0.3';

    public function getUpdate()
    {
        $param = $this->param();
        $oVersion = explode('.', $param['version']);
        $version = explode('.', $this->versions);
        $platform = $param['platform'];

        if($version[0] > $oVersion[0]){
            //大版本

            //默认安卓
            $updateUrl = $this->getDomain() . '/app_update/app-20190429_01.apk';
            //苹果
            if($platform == 'ios'){
                $updateUrl = '';
            }

            $data = [
                'content' => '更新...',
                'wgt_url' => '',
                'pkg_url' => $updateUrl,
            ];
            return showResult(0, '', $data);
        }
        elseif ($version[1] != $oVersion[1] || $version[2] != $oVersion[2]){
            //小版本

            $data = [
                'content' => '更新...',
                'wgt_url' => $this->getDomain() . '/app_update/app-20190429_01.wgt',
                'pkg_url' => '',
            ];
            return showResult(0, '', $data);


        }else{

            return showResult(-1, '');
        }

    }
}