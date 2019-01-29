<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/9
 * Time: 17:11
 */

namespace oauth;


class Weixin
{
    protected $AuthURL = 'https://open.weixin.qq.com/connect/qrconnect';
    protected $AccessTokenURL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    protected $userInfoURL = 'https://api.weixin.qq.com/sns/userinfo';
    protected $token = [];
    protected $param = [];


    protected $config = [
        'app_key' => 'wx4a84c27095d9e156',
        'app_secret' => '91bfe189c0dbe8e42679bd34e12a6d5a',
        'response_type' => 'code',
        'scope' => 'snsapi_login',
        'callback' => 'http://www.bh3721.com/user/callback?type=weixin&jump=',
    ];

    /**
     * 拼接授权请求地址
     * @param $param
     * @return string
     */
    public function getAuthURL($param) {
        $this->config['callback'] .= isset($param['top_url'])? $param['top_url']:'';
        //Oauth 标准参数
        $params = [
            'appid'         => $this->config['app_key'],
            'redirect_uri'  => $this->config['callback'],
            'response_type' => $this->config['response_type'],
            'scope'         => $this->config['scope'],
            'state'         => 'pc',
        ];
        return $this->AuthURL . '?' . http_build_query($params) . '#wechat_redirect';
    }

    /**
     * 设置Param 参数
     * @param $name
     * @param $value
     */
    public function setParam($name, $value){

        $this->param[$name] = $value;
    }

    /**
     * 获取通信AccessToken
     * @param $code
     * @return mixed|string
     */
    public function getAccessToken($code)
    {
        $params = [
            'appid' => $this->config['app_key'],
            'secret' =>  $this->config['app_secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',

        ];
        $url = $this->AccessTokenURL . '?' . http_build_query($params);
        $data = json_decode(curlGet($url, 0), true);
        if(!is_array($data) || isset($data['errcode'])){
            exception('登录失败，获取微信 ACCESS_TOKEN 出错', 404);
        }
        $this->token = $data;
        return true;
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo()
    {
        $this->getAccessToken($this->param['code']);
        $params = [
            'access_token' => $this->token['access_token'],
            'openid' =>  $this->token['openid'],
        ];

        $url = $this->userInfoURL . '?' . http_build_query($params);

        $data = json_decode(curlGet($url, 0), true);
        if(!is_array($data) || isset($data['errcode'])){
            exception('登录失败，获取微信用户信息出错', 404);
        }

        return $this->resultData($data);
    }

    /**
     * 重组统一数据集
     * @param $data
     * @return mixed
     */
    public function resultData($data)
    {
        $data = [
            'open_id' => $data['openid'],
            'name' => $data['nickname'],
            'union_id' => $data['unionid'],
            'sex' => ($data['sex'] == 1)?1:0,
            'address' => $data['province'] . ' ' . $data['city'],
            'avatar' => $this->downloadImage($data['headimgurl']),
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