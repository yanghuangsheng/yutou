<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 密码加密
 * @param $text 要加密的字符
 * @param string $prefix 加密混淆字符串
 * @return string
 */
function md5Encryption($text, $prefix = 'yutou@20190114')
{
    return md5($prefix . trim($text));
}

/**
 * 将多个一维数组合拼成二维数组
 * @param $keys 定义新二维数组的键值，每个对应一个一维数组
 * @param $arrays 多个一维数组集合
 * @return array
 */
function array_merge_more($keys, $arrays){

    // 检查参数是否正确
    if(!$keys || !is_array($keys) || !$arrays || !is_array($arrays) || count($keys)!=count($arrays)){
        return array();
    }

    // 一维数组中最大长度
    $max_len = 0;

    // 整理数据，把所有一维数组转重新索引
    for($i=0,$len=count($arrays); $i<$len; $i++){
        $arrays[$i] = array_values($arrays[$i]);

        if(count($arrays[$i])>$max_len){
            $max_len = count($arrays[$i]);
        }
    }

    // 合拼数据
    $result = array();

    for($i=0; $i<$max_len; $i++){
        $tmp = array();
        foreach($keys as $k=>$v){
            if(isset($arrays[$k][$i])){
                $tmp[$v] = $arrays[$k][$i];
            }
        }
        $result[] = $tmp;
    }

    return $result;

}

/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param $allowFiles
 * @param array $files
 * @return array|null
 */
function getFiles($path, $allowFiles, &$files = array())
{
    if (!is_dir($path)) return null;
    if(substr($path, strlen($path) - 1) != '/') $path .= '/';
    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path . $file;
            if (is_dir($path2)) {
                getfiles($path2, $allowFiles, $files);
            } else {
                if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                    $files[] = array(
                        'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                        'mtime'=> filemtime($path2)
                    );
                }
            }
        }
    }
    return $files;
}

/**
 * 清除HTML
 * @param $string
 * @param $length 截取字符数量
 * @param int $open_len 开始位置
 * @return mixed|string
 */
function clean_html($string, $length, $open_len = 0)
{
    $string = strip_tags($string);
    $string = preg_replace ('/\n/is', '', $string);
    $string = preg_replace ('/ |　/is', '', $string);
    $string = preg_replace ('/&nbsp;/is', '', $string);

    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);

    if(count($t_string[0]) - $open_len > $length)
        $string = join('', array_slice($t_string[0], $open_len, $length))."…";
    else
        $string = join('', array_slice($t_string[0], $open_len, $length));

    return $string;
}

/**
 * 文章内容处理 图片本地化处理
 * @param $content
 * @param string $path
 * @return mixed
 */
function articleContent($content, $path)
{
    $path = './uploads' . $path;

    $pattern = '/<img.*?src=[\'|"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.bmp]))[\'|"].*?[\/]?>/i';
    preg_match_all($pattern, $content, $match);
    if($match[1]) {
        $path = $path.date('Ymd');
        !file_exists($path) && mkdir($path,0777,true);
        $new_url = [];
        foreach($match[1] as $k=>$vo) {
            $filename = $vo;
            $a = downloadFile(ltrim($filename, "//"),$path);
            $new_url[$k] = ltrim($a, '.');
        }
        $content = str_replace($match[1], $new_url, $content);
    }
    return $content;
}

/**
 * 获取文章第一张图片
 * @param $obj
 * @param string $defaultImg
 * @return string
 */
function getFirstImg($obj,$defaultImg='') {
    if (isset ( $obj )) {
        $pattern = '/<img.*?src=[\'|"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.bmp]))[\'|"].*?[\/]?>/i';
        if (preg_match_all( $pattern, $obj, $regs )) { // 用正则表达式匹配出所有图片
            return  $regs [1][0];//返回获取第一幅图像地址
        } else {

            return $defaultImg;//若正文没有图片，就返回默认图片
        }
    }
    return $defaultImg;//如果正文为空，返回默认图片;
}

/**
 * 远程图片保存到本地
 * @param $url 远程图片
 * @param string $path 保存图片路径
 * @param string $filename 图片自定义命名
 * @param int $type 使用什么方式下载 0:curl方式,1:readfile方式,2file_get_contents方式
 * @return bool|string 文件名
 * @throws Exception
 */
function downloadFile($url,$path='',$filename='',$type=0){
    if($url==''){return false;}
    //获取远程文件数据
    if($type===0){

        $img = curlGet($url);
    }
    if($type===1){
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
    }
    if($type===2){
        $img=file_get_contents($url);
    }
    //判断下载的数据 是否为空 下载超时问题
    if(empty($img)){
        throw new \Exception("下载错误,无法获取下载文件！");
    }

    //没有指定路径则默认当前路径
    if($path===''){
        $path="./";
    }
    //如果命名为空
    if($filename===""){
        $filename = md5($img);
    }elseif ($filename == 'date'){
        $path.='/'.date('Ymd');
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $filename = md5($img);
    }


    //获取后缀名
    $ext=substr($url, strrpos($url, '.'));
    if($ext && strlen($ext)<5){
        $filename .= $ext;
    }
    else{
        $filename .= '.jpg';
    }

    //防止"/"没有添加
    $path=rtrim($path,"/")."/";

    //var_dump($path.$filename);die();
    $resultName = $path.$filename;
    $fp2=@fopen($path.$filename,'a');
    fwrite($fp2,$img);
    fclose($fp2);
    //echo "finish";
    return ltrim($resultName, '.');
}


/**
 * 读取网页内容
 * @param $url
 * @return mixed|string
 */
function curlGet($url, $header = 1)
{
    if($header){
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
    }
    $timeout = 30;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if($header) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }
    curl_setopt($ch, CURLOPT_TIMEOUT,$timeout); //允许执行的最长秒数
    curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);//最长等待时间
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code != '404' && $result) {

        return $result;
    }

    return '';
}

/**
 * 生成缩略图
 * @param $image_url
 * @param $path
 * @param int $width
 * @param int $height
 * @return string
 */
function resultThumb($image_url , $path, $width = 200, $height = 200, $thumb = 1){
    if($image_url){
        $image = \think\Image::open('.'.$image_url);
        if($thumb == 0 && $image->width() < $width){
            return $image_url;
        }
        $defaultExt = '.jpg';
        ($image->type() == 'gif') && $defaultExt = '.gif';

        if($path == 'avatar'){
            if($width == 200){
                $thumb_file = '.' . $image_url;
            }
            else{
                $thumb_file = '.' . $image_url . '_'. $width . 'x'.$height.$defaultExt;
            }
        }
        elseif ($path == 'no'){
            $thumb_file = '.'.$image_url;
        }
        else{
            $path = './uploads'.$path;
            $path .= date('Ymd');
            !is_dir($path) && mkdir($path,0777,true);

            $thumb_file = $path .'/'. md5($image_url).'_thumb'.$defaultExt;
        }

        if($image->thumb($width,$height,\think\Image::THUMB_CENTER)->save($thumb_file)){
            return ltrim($thumb_file, '.');
        }


    }
    return $image_url;
}


/**
 * 生成随机数
 * @param int $length
 * @param string $chars_range
 * @return string
 */
function random_string($length = 8, $chars_range = 'alpha-number') {
    $str = '';
    $chars = '';
    $char_arr = array(
        "alpha" => "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",
        "number" => "0123456789",
    );
    if (empty($chars_range)) {
        $chars_rang = 'alpha-number';
    }
    if(strpos($chars_range, '-')) {
        $char_range_arr = explode('-',$chars_range);
        foreach($char_range_arr as $range){
            if(!array_key_exists($range, $char_arr)){
                exit("wrong range \"". $range ."\"");
            }
            $chars .= $char_arr[$range];
        }
    }else{
        if(!array_key_exists($chars_range, $char_arr)){
            exit("wrong range \"".$chars_range ."\"");
        }
        $chars = $char_arr[$chars_range];
    }
    while( strlen($str) < $length) {
        $str .= substr($chars, rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

/**
 * 友好的时间显示
 *
 * @param int    $sTime 待显示的时间
 * @param string $type  类型. normal | mohu | full | ymd | other
 * @param string $alt   已失效
 * @return string
 */
function friendlyDate($sTime,$type = 'mohu',$alt = 'false') {
    if (!$sTime)
        return '';
    //如是不是时间戳
    is_numeric($sTime) || $sTime = strtotime($sTime);
    //sTime=源时间，cTime=当前时间，dTime=时间差
    $cTime      =   time();
    $dTime      =   $cTime - $sTime;
    $dDay       =   intval(date("z",$cTime)) - intval(date("z",$sTime));
    //$dDay     =   intval($dTime/3600/24);
    $dYear      =   intval(date("Y",$cTime)) - intval(date("Y",$sTime));
    //normal：n秒前，n分钟前，n小时前，日期
    if($type=='normal'){
        if( $dTime < 60 ){
            if($dTime < 10){
                return '刚刚';    //by yangjs
            }else{
                return intval(floor($dTime / 10) * 10)."秒前";
            }
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
            //今天的数据.年份相同.日期相同.
        }elseif( $dYear==0 && $dDay == 0  ){
            //return intval($dTime/3600)."小时前";
            return '今天'.date('H:i',$sTime);
        }elseif($dYear==0){
            return date("m月d日 H:i",$sTime);
        }else{
            return date("Y-m-d H:i",$sTime);
        }
    }elseif($type=='mohu'){
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif( $dDay > 0 && $dDay<=7 ){
            return intval($dDay)."天前";
        }elseif( $dDay > 7 &&  $dDay <= 30 ){
            return intval($dDay/7) . '周前';
        }elseif( $dDay > 30 ){
            return intval($dDay/30) . '个月前';
        }
        //full: Y-m-d , H:i:s
    }elseif($type=='full'){
        return date("Y-m-d , H:i:s",$sTime);
    }elseif($type=='ymd'){
        return date("Y-m-d",$sTime);
    }else{
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif($dYear==0){
            return date("Y-m-d H:i:s",$sTime);
        }else{
            return date("Y-m-d H:i:s",$sTime);
        }
    }
}

/**
 * 美化前台URL
 * @param $path
 * @return mixed
 */
function urls($path)
{
    $url = url($path);
    return str_replace(['/www','/index','.html'], '', $url);
}

/**
 * 广告平台
 * @param $key
 * @return mixed
 */
function adType($key)
{
    $data = [
        '1' => 'PC',
        '2' => 'H5',
    ];
    return $data[$key];
}

/**
 * 用户默认头像
 * @return array
 */
function userAvatar()
{
    return [
        '200' => '/static/www/images/user_avatar.png',
        '100' => '/static/www/images/user_avatar_100.png',
        '50' => '/static/www/images/user_avatar_50.png',
    ];
}

/**
 * 返回以指定$key为索引的新数组
 * @param $data
 * @param string $keys
 * @return array
 */
function keyData($data, $keys = 'id')
{
    $resultData = [];
    foreach ($data as $key => $value) {
        $resultData[$value[$keys]] = $value;
    }

    return $resultData;
}


