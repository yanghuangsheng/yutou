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
     *
     *
     */
    protected function faceData()
    {
        $domain = $this->getDomain();
        $domain .= '/static/face/';
        return [
            ['name' => '[微笑]', 'image_url' => $domain.'weixiao.gif'],
            ['name' => '[撇嘴]', 'image_url' => $domain.'pizui.gif'],
            ['name' => '[色]', 'image_url' => $domain.'se.gif'],
            ['name' => '[发呆]', 'image_url' => $domain.'fadai.gif'],
            ['name' => '[得意]', 'image_url' => $domain.'deyi.gif'],
            ['name' => '[流泪]', 'image_url' => $domain.'liulei.gif'],
            ['name' => '[害羞]', 'image_url' => $domain.'haixiu.gif'],
            ['name' => '[闭嘴]', 'image_url' => $domain.'bizui.gif'],

            ['name' => '[睡觉]', 'image_url' => $domain.'shuijiao.gif'],
            ['name' => '[大哭]', 'image_url' => $domain.'daku.gif'],
            ['name' => '[尴尬]', 'image_url' => $domain.'gangga.gif'],
            ['name' => '[发怒]', 'image_url' => $domain.'danu.gif'],
            ['name' => '[调皮]', 'image_url' => $domain.'tiaopi.gif'],
            ['name' => '[呲牙]', 'image_url' => $domain.'ciya.gif'],
            ['name' => '[惊讶]', 'image_url' => $domain.'jingya.gif'],
            ['name' => '[难过]', 'image_url' => $domain.'nanguo.gif'],

            ['name' => '[酷]', 'image_url' => $domain.'ku.gif'],
            ['name' => '[冷汗]', 'image_url' => $domain.'lenghan.gif'],
            ['name' => '[抓狂]', 'image_url' => $domain.'zhuakuang.gif'],
            ['name' => '[尴尬]', 'image_url' => $domain.'zhuakuang.gif'],
            ['name' => '[偷笑]', 'image_url' => $domain.'touxiao.gif'],
            ['name' => '[可爱]', 'image_url' => $domain.'keai.gif'],
            ['name' => '[白眼]', 'image_url' => $domain.'baiyan.gif'],
            ['name' => '[傲慢]', 'image_url' => $domain.'aoman.gif'],

//            ['name' => '', 'image_url' => $domain.'.gif'],







        ];
    }
}