<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/9
 * Time: 17:12
 */

namespace oauth;


class QQ
{
    protected $AuthURL = 'https://graph.qq.com/oauth2.0/authorize';
    protected $AccessTokenURL = 'https://graph.qq.com/oauth2.0/token';
    protected $userOpenidURL = 'https://graph.qq.com/oauth2.0/me';
    protected $userInfoURL = 'https://graph.qq.com/user/get_user_info';
    protected $token = [];
    protected $param = [];

    protected $config = [
        'app_key' => '101452266',
        'app_secret' => '054a4664754e19c6ae4ee8b89b54e2ec',
        'response_type' => 'code',
        'scope' => 'get_user_info',
        'callback' => 'http://www.bh3721.com/user/callback?type=qq',
    ];

    /**
     * 拼接授权请求地址
     * @return string
     */
    public function getAuthURL() {
        //Oauth 标准参数
        $params = array(
            'response_type' => $this->config['response_type'],
            'client_id'     => $this->config['app_key'],
            'redirect_uri'  => $this->config['callback'],
            'state'         => time(),
            'scope'         => $this->config['scope'],
            'display'       => 'pc'
        );
        return $this->AuthURL . '?' . http_build_query($params);
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
            'grant_type' => 'authorization_code',
            'client_id' => $this->config['app_key'],
            'client_secret' =>  $this->config['app_secret'],
            'code' => $code,
            'redirect_uri' => $this->config['callback']

        ];
        $url = $this->AccessTokenURL . '?' . http_build_query($params);
        parse_str(curlGet($url, 0), $data);
        if(!is_array($data) || isset($data['code'])){
            exception('登录失败，获取微信 ACCESS_TOKEN 出错', 404);
        }
        $this->token = $data;
        return true;
    }

    /**
     * 获取用户openid
     * @return bool
     */
    public function getUserOpenId()
    {
        $params = [
            'access_token' => $this->token['access_token'],
        ];
        $url = $this->userOpenidURL . '?' . http_build_query($params);
        $data = curlGet($url, 0);
        $data = json_decode(trim(substr($data, 9), " );\n"), true);

        if(!is_array($data) || isset($data['code'])){
            exception('登录失败， 获取openid出错', 404);
        }
        $this->token['openid'] = $data['openid'];
        return true;

    }

    /**
     * 获取用户信息
     * @return mixed
     */
    public function getUserInfo()
    {
        $this->getAccessToken($this->param['code']);
        //dump($this->token);
        $this->getUserOpenId();
        $params = [
            'access_token' => $this->token['access_token'],
            'oauth_consumer_key' => $this->config['app_key'],
            'openid' =>  $this->token['openid'],
        ];

        $url = $this->userInfoURL . '?' . http_build_query($params);

        $data = json_decode(curlGet($url, 0), true);
        if(!is_array($data) || $data['ret'] != 0){
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
            'open_id' => $this->token['openid'],
            'name' => $data['nickname'],
            'union_id' => '',
            'sex' => ($data['gender'] == '男')?1:0,
            'address' => $data['province'] . ' ' . $data['city'],
            'avatar' => $this->downloadImage($data['figureurl_qq_2']?$data['figureurl_qq_2']:$data['figureurl_qq_1']),
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
        $imageUrl = downloadFile($img_url, './uploads/user_avatar','date');
        //echo $imageUrl;
        return  [
            '200' => resultThumb($imageUrl, 'avatar', 200, 200),
            '100' => resultThumb($imageUrl, 'avatar', 100, 100),
            '50' => resultThumb($imageUrl, 'avatar', 50, 50),
        ];
    }

}