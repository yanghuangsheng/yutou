<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/24
 * Time: 16:20
 */

namespace app\www\service;


class Upload
{
    //上传文件
    public function upFile($upCatalog, $fileName = 'file', $size = 2, $ext = 'jpg,jpeg,png,gif')
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
}