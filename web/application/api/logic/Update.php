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
    protected $versions = '1.0.4';
    protected $open = false;

    public function getUpdate()
    {
        $param = $this->param();
        $oVersion = explode('.', $param['version']);
        $version = explode('.', $this->versions);
        $platform = $param['platform'];

        $versionData = (new \app\api\service\System)->getVersionData();
        $this->open = $versionData['open'];
        $this->versions = $versionData['version'];

        if(!$this->open){
            return showResult(-1, '');
        }

        if($version[0] > $oVersion[0]){
            //大版本

            //默认安卓
            $updateUrl = $this->getDomain() . $versionData['android'];
            //苹果
            if($platform == 'ios'){
                $updateUrl = $this->getDomain() . $versionData['ios'];
            }

            $data = [
                'content' => $versionData['content'],
                'wgt_url' => '',
                'pkg_url' => $updateUrl,
            ];
            return showResult(0, '', $data);
        }
        elseif ($version[1] > $oVersion[1] || $version[2] > $oVersion[2]){
            //小版本

            $data = [
                'content' => $versionData['content'],
                'wgt_url' => $this->getDomain() . $versionData['wgt_url'],
                'pkg_url' => '',
            ];
            return showResult(0, '', $data);


        }else{

            return showResult(-1, '');
        }

    }
}