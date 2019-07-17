<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/26
 * Time: 16:54
 */

namespace app\api\logic;


use app\api\exception\ErrorException;
use app\api\exception\SuccessException;

class Update extends Base
{
    protected $versions = '1.0.4';
    protected $open = false;

    /**
     * app版本更新
     * @throws ErrorException
     * @throws SuccessException
     */
    public function getUpdate()
    {
        $param = $this->param();
        $oVersion = explode('.', $param['version']);
        $platform = $param['platform'];

        $versionData = (new \app\api\service\System)->getVersionData();
        is_array($versionData) || $versionData = json_decode($versionData, true);

        $this->open = $versionData['open'];
        $this->versions = $versionData['version'];

        if(!$this->open){

            throw new ErrorException('已经最新版本');
        }

        $version = explode('.', $this->versions);

        //整包更新地址
        //安卓
        $updateUrl = $versionData['android']?$this->getDomain() . $versionData['android']:'';
        //苹果
        if($platform == 'ios'){
            $updateUrl = $versionData['ios']?$this->getDomain() . $versionData['ios']:'';
        }

        if($version[0] > $oVersion[0]){
            //大版本
            $data = [
                'content' => $versionData['content'],
                'wgt_url' => '',
                'pkg_url' => $updateUrl,
            ];

            throw new SuccessException('success', $data);
        }
        elseif ($version[1] > $oVersion[1] || $version[2] > $oVersion[2]){
            //小版本
            $data = [
                'content' => $versionData['content'],
                'wgt_url' => $versionData['wgt_url']?$this->getDomain() . $versionData['wgt_url']:'',
                'pkg_url' => $updateUrl,
            ];

            throw new SuccessException('success', $data);

        }else{

            throw new ErrorException('已经最新版本：' . $this->versions);
        }

    }
}