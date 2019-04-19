<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/19
 * Time: 15:16
 */

namespace oauth;


class MpWeixin
{
    protected $AuthURL = 'https://api.weixin.qq.com/sns/jscode2session';

    protected $config = [
        'app_key' => 'wx084abc0677b7a12d',
        'app_secret' => 'f626cb282ee76d7547dc5e46737c973b',
    ];

    /**
     * 拼接授权请求地址
     * @param $code
     * @return string
     */
    public function getAuthURL($code) {
        //Oauth 标准参数
        $params = [
            'appid'   => $this->config['app_key'],
            'secret'  => $this->config['app_secret'],
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];
        return $this->AuthURL . '?' . http_build_query($params);
    }

    /**
     * 获取授权信息
     * @param $param
     * @return mixed|string
     */
    public function getUserInfo($param)
    {
        $authUrl = $this->getAuthURL($param['code']);

        $data = json_decode(curlGet($authUrl, 0), 1);
        if(!is_array($data) || isset($data['errcode'])){

            return['err'=> '登录失败，获取微信用户信息出错'];
        }
        return $this->resultData($data, $param);
    }


    /**
     * 重组统一数据集
     * @param $data
     * @param $param
     * @return array
     */
    public function resultData($data, $param)
    {
        $data = [
            'open_id' => $data['openid'],
            'name' => $param['nickName'],
            'union_id' => isset($data['unionid'])?$data['unionid']:'',
            'sex' => ($param['gender'] == 1)?1:0,
            'address' => $param['province'] . ' ' . $param['city'],
            'avatar' => $this->downloadImage($param['avatarUrl']),
        ];

        return $data;
    }

    /**
     * 生成各种尺寸
     * @param $img_url
     * @return array
     */
    protected function downloadImage($img_url)
    {
        $img_url = str_replace(['/0','/46','/64','/96','/132'], '', $img_url).'/0';
        $imageUrl = downloadFile($img_url, './uploads/user_avatar','date');
        //echo $imageUrl;
        return  [
            '200' => resultThumb($imageUrl, 'avatar', 200, 200),
            '100' => resultThumb($imageUrl, 'avatar', 100, 100),
            '50' => resultThumb($imageUrl, 'avatar', 50, 50),
        ];
    }

}