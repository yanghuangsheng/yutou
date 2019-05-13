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
            ['name' => '[吐]', 'image_url' => $domain.'tu.gif'],
            ['name' => '[偷笑]', 'image_url' => $domain.'touxiao.gif'],
            ['name' => '[可爱]', 'image_url' => $domain.'keai.gif'],
            ['name' => '[白眼]', 'image_url' => $domain.'baiyan.gif'],
            ['name' => '[傲慢]', 'image_url' => $domain.'aoman.gif'],

            ['name' => '[饥饿]', 'image_url' => $domain.'er.gif'],
            ['name' => '[困]', 'image_url' => $domain.'kun.gif'],
            ['name' => '[惊恐]', 'image_url' => $domain.'jingkong.gif'],
            ['name' => '[流汗]', 'image_url' => $domain.'liuhan.gif'],
            ['name' => '[憨笑]', 'image_url' => $domain.'haha.gif'],
            ['name' => '[休闲]', 'image_url' => $domain.'dabing.gif'],
            ['name' => '[奋斗]', 'image_url' => $domain.'fendou.gif'],
            ['name' => '[咒骂]', 'image_url' => $domain.'ma.gif'],


            ['name' => '[疑问]', 'image_url' => $domain.'wen.gif'],
            ['name' => '[嘘]', 'image_url' => $domain.'xu.gif'],
            ['name' => '[晕]', 'image_url' => $domain.'yun.gif'],
            ['name' => '[折磨]', 'image_url' => $domain.'zhemo.gif'],
            ['name' => '[衰]', 'image_url' => $domain.'shuai.gif'],
            ['name' => '[骷髅]', 'image_url' => $domain.'kulou.gif'],
            ['name' => '[敲打]', 'image_url' => $domain.'da.gif'],
            ['name' => '[再见]', 'image_url' => $domain.'zaijian.gif'],

            ['name' => '[擦汗]', 'image_url' => $domain.'cahan.gif'],
            ['name' => '[抠鼻]', 'image_url' => $domain.'wabi.gif'],
            ['name' => '[鼓掌]', 'image_url' => $domain.'guzhang.gif'],
            ['name' => '[糗大了]', 'image_url' => $domain.'qioudale.gif'],
            ['name' => '[坏笑]', 'image_url' => $domain.'huaixiao.gif'],
            ['name' => '[左哼哼]', 'image_url' => $domain.'zuohengheng.gif'],
            ['name' => '[右哼哼]', 'image_url' => $domain.'youhengheng.gif'],
            ['name' => '[哈欠]', 'image_url' => $domain.'haqian.gif'],


            ['name' => '[鄙视]', 'image_url' => $domain.'bishi.gif'],
            ['name' => '[委屈]', 'image_url' => $domain.'weiqu.gif'],
            ['name' => '[哭了]', 'image_url' => $domain.'ku.gif'],
            ['name' => '[快哭了]', 'image_url' => $domain.'kuaikule.gif'],
            ['name' => '[阴险]', 'image_url' => $domain.'yinxian.gif'],
            ['name' => '[亲亲]', 'image_url' => $domain.'qinqin.gif'],
            ['name' => '[亲吻]', 'image_url' => $domain.'kiss.gif'],
            ['name' => '[吓]', 'image_url' => $domain.'xia.gif'],

            ['name' => '[可怜]', 'image_url' => $domain.'kelian.gif'],
            ['name' => '[菜刀]', 'image_url' => $domain.'caidao.gif'],
            ['name' => '[西瓜]', 'image_url' => $domain.'xigua.gif'],
            ['name' => '[啤酒]', 'image_url' => $domain.'pijiu.gif'],
            ['name' => '[篮球]', 'image_url' => $domain.'lanqiu.gif'],
            ['name' => '[乒乓]', 'image_url' => $domain.'pingpang.gif'],
            ['name' => '[咖啡]', 'image_url' => $domain.'kafei.gif'],
            ['name' => '[饭]', 'image_url' => $domain.'fan.gif'],

            ['name' => '[猪头]', 'image_url' => $domain.'zhutou.gif'],
            ['name' => '[玫瑰]', 'image_url' => $domain.'hua.gif'],
            ['name' => '[凋谢]', 'image_url' => $domain.'diaoxie.gif'],
            ['name' => '[爱心]', 'image_url' => $domain.'love.gif'],
            ['name' => '[心碎]', 'image_url' => $domain.'xinsui.gif'],
            ['name' => '[蛋糕]', 'image_url' => $domain.'dangao.gif'],
            ['name' => '[闪电]', 'image_url' => $domain.'shandian.gif'],
            ['name' => '[炸弹]', 'image_url' => $domain.'zhadan.gif'],

            ['name' => '[刀]', 'image_url' => $domain.'dao.gif'],
            ['name' => '[足球]', 'image_url' => $domain.'qiu.gif'],
            ['name' => '[虫]', 'image_url' => $domain.'chong.gif'],
            ['name' => '[便便]', 'image_url' => $domain.'dabian.gif'],
            ['name' => '[月亮]', 'image_url' => $domain.'yueliang.gif'],
            ['name' => '[太阳]', 'image_url' => $domain.'taiyang.gif'],
            ['name' => '[礼物]', 'image_url' => $domain.'liwu.gif'],
            ['name' => '[拥抱]', 'image_url' => $domain.'yongbao.gif'],

            ['name' => '[强]', 'image_url' => $domain.'qiang.gif'],
            ['name' => '[弱]', 'image_url' => $domain.'ruo.gif'],
            ['name' => '[握手]', 'image_url' => $domain.'woshou.gif'],
            ['name' => '[胜利]', 'image_url' => $domain.'shengli.gif'],
            ['name' => '[抱拳]', 'image_url' => $domain.'peifu.gif'],
            ['name' => '[勾引]', 'image_url' => $domain.'gouyin.gif'],
            ['name' => '[拳头]', 'image_url' => $domain.'quantou.gif'],
            ['name' => '[差劲]', 'image_url' => $domain.'chajin.gif'],


            ['name' => '[干杯]', 'image_url' => $domain.'cheer.gif'],
            ['name' => '[NO]', 'image_url' => $domain.'no.gif'],
            ['name' => '[OK]', 'image_url' => $domain.'ok.gif'],
            ['name' => '[给力]', 'image_url' => $domain.'geili.gif'],
            ['name' => '[飞吻]', 'image_url' => $domain.'feiwen.gif'],
            ['name' => '[跳跳]', 'image_url' => $domain.'tiao.gif'],
            ['name' => '[发抖]', 'image_url' => $domain.'fadou.gif'],

            ['name' => '[大叫]', 'image_url' => $domain.'dajiao.gif'],
            ['name' => '[转圈]', 'image_url' => $domain.'zhuanquan.gif'],
            ['name' => '[磕头]', 'image_url' => $domain.'ketou.gif'],
            ['name' => '[回头]', 'image_url' => $domain.'huitou.gif'],
            ['name' => '[跳绳]', 'image_url' => $domain.'tiaosheng.gif'],
            ['name' => '[挥手]', 'image_url' => $domain.'huishou.gif'],
            ['name' => '[激动]', 'image_url' => $domain.'jidong.gif'],
            ['name' => '[街舞]', 'image_url' => $domain.'tiaowu.gif'],
            ['name' => '[献吻]', 'image_url' => $domain.'xianwen.gif'],
            ['name' => '[左太极]', 'image_url' => $domain.'zuotaiji.gif'],
            ['name' => '[右太极]', 'image_url' => $domain.'youtaiji.gif'],

//            ['name' => '[]', 'image_url' => $domain.'.gif'],





        ];
    }
}