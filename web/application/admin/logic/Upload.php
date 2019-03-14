<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/6
 * Time: 10:34
 */

namespace app\admin\logic;


class Upload extends Base
{
    //上传文件
    public function upFile($upCatalog, $fileName = 'file', $size = 1, $ext = 'jpg,jpeg,png,gif')
    {

        $rootDirectory = './uploads/' . $upCatalog . '/';
        if (!is_dir($rootDirectory)) {
            mkdir($rootDirectory, 0777, true);
        }
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($fileName);
        // 移动到框架应用根目录/uploads/ 目录下  //测试不在/public目录下
        $info = $file->validate(['size' => $size * 1024 * 1024, 'ext' => str_replace('.','',$ext)])->move($rootDirectory);
        if (empty($info)) {
            $data['error'] = $file->getError();
        } else {
            $data['file'] = ltrim($rootDirectory, '.') . str_replace('\\', '/', $info->getSaveName());
            $data['tmp_name'] = $info->getInfo()['name'];
        }

        return $data;
    }

    //上传
    public function upBase64($upCatalog, $fileName = 'file', $size = 1)
    {
        $rootDirectory = './uploads/' . $upCatalog . '/' . date('Ymd') . '/';
        if (!is_dir($rootDirectory)) {
            mkdir($rootDirectory, 0777, true);
        }
        $image = $this->param($fileName);
        $img = base64_decode(trim($image));
        $fileSize = strlen($img);
        if($fileSize > $size*1204*1203){
            return ['error' => '超出上传的大小'];
        }
        $imgInfo = getimagesizefromstring($img);
        $imgExtCode = $imgInfo[2];
        if(!isset($imgExtCode) || !is_numeric($imgExtCode) || $imgExtCode == 0 || $imgExtCode > 3){
            return ['error' => '不支持的上传文件格式'];
        }
        $extData = [1 => '.gif', 2 => '.jpg', 3 => '.png'];
        $fileName = $rootDirectory . '/' . md5('base64' . date('YmdHis') . mt_rand(10000,99999)).$extData[$imgExtCode];

        if(file_put_contents($fileName,$img)){
            $data['file'] = ltrim($fileName, '.');
            $data['tmp_name'] = '';
        }else{
            $data['error'] = '上传失败';
        }

        return $data;
    }


    //详情上传图片
    public function upDetailsImages($updateName,$type)
    {
        $config = [
            'imageActionName' => 'uploadimage',
            'imageFieldName' => 'file',
            "imageCompressEnable" => true,
            'imageAllowFiles' => ['.png', '.jpg','.gif'],
            'imageMaxSize' => 1024*1024*2,
            'imageUrlPrefix' => '',

            /* 涂鸦图片上传配置项 */
            "scrawlActionName" => "uploadscrawl", /* 执行上传涂鸦的action名称 */
            "scrawlFieldName" => "file", /* 提交的图片表单名称 */
            "scrawlMaxSize" => 1024*1024*2, /* 上传大小限制，单位B */
            "scrawlUrlPrefix" => "", /* 图片访问路径前缀 */
            "scrawlInsertAlign" => "none",

            /* 上传视频配置 */
            "videoActionName" => "uploadvideo", /* 执行上传视频的action名称 */
            "videoFieldName" => "file", /* 提交的视频表单名称 */
            "videoUrlPrefix" => "", /* 视频访问路径前缀 */
            "videoMaxSize" => 1024*1024*10, /* 上传大小限制，单位B */
            "videoAllowFiles" => [
                ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"], /* 上传视频格式显示 */

            //图片列表
            "imageManagerActionName" => 'listimage',
            "imageManagerListPath" => '/uploads/'.$updateName.'/' . $type . '/images',
            "imageManagerListSize" => 20,
            "imageManagerUrlPrefix" => '',
            "imageManagerInsertAlign" => 'none',
            "imageManagerAllowFiles" => ['.png', '.jpg', '.gif'],
        ];

        $getData = $this->param();
        if($getData['action'] == 'config'){
            //读取配置
            $this->json($config);
        }elseif ($getData['action'] == $config['imageActionName']) {
            //上传图片
            $data = $this->upFile($updateName . '/' . $type . '/images', $config['imageFieldName'], 2, $config['imageAllowFiles']);
            if (isset($data['file'])) {
                sleep(1);//停留
                $this->json(['state' => 'SUCCESS', 'url' => $data['file']]);
            }
            $this->json(['state' => 'NO', 'url' => $data['error']]);
        }elseif ($getData['action'] == $config['scrawlActionName']){
            //上传涂鸦图片
            $data = $this->upBase64($updateName . '/' . $type . '/images', $config['scrawlFieldName']);
            if (isset($data['file'])) {
                sleep(1);//停留
                $this->json(['state' => 'SUCCESS', 'url' => $data['file']]);
            }
            $this->json(['state' => 'NO', 'url' => $data['error']]);

        }elseif ($getData['action'] == $config['videoActionName']){
            //上传视频
            $data = $this->upFile($updateName . '/' . $type . '/video', $config['imageFieldName'], 10, $config['videoAllowFiles']);
            if (isset($data['file'])) {
                sleep(1);//停留
                $this->json(['state' => 'SUCCESS', 'url' => $data['file']]);
            }
            $this->json(['state' => 'NO', 'url' => $data['error']]);
        }elseif ($getData['action'] == $config['imageManagerActionName']){
            //获取图片列表
            $data = $this->manageImage($config,$getData);
            $this->json($data);
        }
    }

    //editor 管理图片
    public function manageImage($config,$getData)
    {
        $allowFiles = substr(str_replace(".", "|", join("", $config['imageManagerAllowFiles'])), 1);
        /* 获取参数 */
        $size = isset($getData['size']) ? htmlspecialchars($getData['size']) : $config['imageManagerListSize'];
        $start = isset($getData['start']) ? htmlspecialchars($getData['start']) : 0;
        $end = $start + $size;

        /* 获取文件列表 */
        $path = $_SERVER['DOCUMENT_ROOT'] . (substr($config['imageManagerListPath'], 0, 1) == "/" ? "":"/") . $config['imageManagerListPath'];
        $files = getFiles($path, $allowFiles);
        if (!count($files)) {
            return array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            );
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
            $list[] = $files[$i];
        }
        //倒序
//            for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
//                $list[] = $files[$i];
//            }

        /* 返回数据 */
        return array(
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files)
        );
    }
}