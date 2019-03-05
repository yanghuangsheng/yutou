<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 16:20
 */

namespace app\spider\service;


class Base
{
    protected $url;
    protected $result;
    protected $error;

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getResult()
    {
        return $this->result;
    }



    /**
     * 读取网页内容
     * @return bool
     */
    public function curlGet()
    {
        $ip_long = [
            ['607649792', '608174079'], //36.56.0.0-36.63.255.255
            ['1038614528', '1039007743'], //61.232.0.0-61.237.255.255
            ['1783627776', '1784676351'], //106.80.0.0-106.95.255.255
            ['2035023872', '2035154943'], //121.76.0.0-121.77.255.255
            ['2078801920', '2079064063'], //123.232.0.0-123.235.255.255
            ['-1950089216', '-1948778497'], //139.196.0.0-139.215.255.255
            ['-1425539072', '-1425014785'], //171.8.0.0-171.15.255.255
            ['-1236271104', '-1235419137'], //182.80.0.0-182.92.255.255
            ['-770113536', '-768606209'], //210.25.0.0-210.47.255.255
            ['-569376768', '-564133889'], //222.16.0.0-222.95.255.255
        ];
        $rand_key = mt_rand(0, 9);
        $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
        $header = ["Connection: Keep-Alive",
            "Accept: text/html, application/xhtml+xml, */*",
            "Pragma: no-cache",
            "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3",
            "User-Agent: Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0)",
            'CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_TIMEOUT,30); //允许执行的最长秒数
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code != '404' && $result) {
            $this->result = $this->strToGBK($result);
            return true;
        }

        return false;
    }


    /**
     * 匹配一条内容
     * @param $pattern
     * @return bool
     */
    public function getOneContent($pattern)
    {
        if(preg_match($pattern, $this->result, $data)){
            $this->result = $data[1];
            return $this->result?true:false;
        }

        return false;

    }

    /**
     * 匹配一条内容并返回
     * @param $pattern
     * @return bool
     */
    public function getOneContentTo($pattern)
    {
        if(preg_match($pattern, $this->result, $data)){
            return $data[1];
        }

        return false;
    }

    /**
     * 匹配多条内容
     * @param $pattern
     * @return bool
     */
    public function getAllContent($pattern)
    {
        if(preg_match_all($pattern, $this->result, $data)){

            return $data[1];
        }

        return false;
    }


    /**
     * 编码转换
     * @param $strText
     * @return string
     */
    public static function strToGBK($strText)
    {
        $encode = mb_detect_encoding($strText, array("ASCII","GB2312","GBK","UTF-8"));

        if($encode == 'CP936' || $encode == 'EUC-CN'){
            return mb_convert_encoding($strText, "UTF-8", "GBK");
        }

        return $strText;

    }

    /**
     * 提取拼接域名
     * @return string
     */
    public function getHost()
    {
        $parse = parse_url($this->url);
        return $parse['scheme'].'://'.$parse['host'];
    }

    /**
     * 是否拼接域名
     * @param $url
     * @return string
     */
    public function isSplicing($url)
    {
        if(strpos($url,'//') === 0){
            return 'http:'.$url;
        }

        if(strpos($url,'http') === false && strpos($url,'https') === false){
            return $this->getHost().$url;
        }

        return $url;
    }
}