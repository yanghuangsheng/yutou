<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/5/10
 * Time: 15:36
 */

namespace app\api\logic;


class Face extends Base
{
    /**
     * 获取表情
     * @return array
     */
    public function getList()
    {
        return showResult(0, '', $this->faceData());
    }

    /**
     * 转换图片表表
     * @param $contents
     * @return mixed
     */
    public function ruleFace($contents)
    {
        $ruleName = [];
        $ruleImg = [];

        foreach ($this->faceData() as $value)
        {
            $ruleName[] = $value['name'];
            $ruleImg[] = '<img src="'.$value['image_url'].'" >';
        }

        return str_replace($ruleName, $ruleImg, $contents);
    }

    /**
     * 表情图数据包
     * @return array
     */
    protected function faceData()
    {
        $domain = $this->getDomain();
        $domain .= '/static/face/';
        return [
            ['name' => '[微笑]', 'image_url' => $domain.'weixiao.gif'],
            ['name' => '[爱你]', 'image_url' => $domain.'aini.gif'],
            ['name' => '[撇嘴]', 'image_url' => $domain.'pizui.gif'],
            ['name' => '[爱情]', 'image_url' => $domain.'aiqing.gif'],
            ['name' => '[色]', 'image_url' => $domain.'se.gif'],
            ['name' => '[发呆]', 'image_url' => $domain.'fadai.gif'],
            ['name' => '[得意]', 'image_url' => $domain.'deyi.gif'],
            ['name' => '[流泪]', 'image_url' => $domain.'liulei.gif'],
        ];
    }
}