<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/5/10
 * Time: 15:36
 */

namespace app\api\logic;


use app\api\exception\SuccessException;

class Face extends Base
{
    /**
     * 获取表情
     * @throws SuccessException
     */
    public function getList()
    {
//        throw new SuccessException('success');
        throw new SuccessException('success', $this->faceData());
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
            ['name' => '[微笑]', 'image_url' => $domain.'weixiao.gif', 'jpg_url' => $domain.'jpg/weixiao.jpg'],
            ['name' => '[撇嘴]', 'image_url' => $domain.'pizui.gif', 'jpg_url' => $domain.'jpg/pizui.jpg'],
            ['name' => '[色]', 'image_url' => $domain.'se.gif', 'jpg_url' => $domain.'jpg/se.jpg'],
            ['name' => '[发呆]', 'image_url' => $domain.'fadai.gif', 'jpg_url' => $domain.'jpg/fadai.jpg'],
            ['name' => '[得意]', 'image_url' => $domain.'deyi.gif', 'jpg_url' => $domain.'jpg/deyi.jpg'],
            ['name' => '[流泪]', 'image_url' => $domain.'liulei.gif', 'jpg_url' => $domain.'jpg/liulei.jpg'],
            ['name' => '[害羞]', 'image_url' => $domain.'haixiu.gif', 'jpg_url' => $domain.'jpg/haixiu.jpg'],
            ['name' => '[闭嘴]', 'image_url' => $domain.'bizui.gif', 'jpg_url' => $domain.'jpg/bizui.jpg'],

            ['name' => '[睡觉]', 'image_url' => $domain.'shuijiao.gif', 'jpg_url' => $domain.'jpg/shuijiao.jpg'],
            ['name' => '[大哭]', 'image_url' => $domain.'daku.gif', 'jpg_url' => $domain.'jpg/daku.jpg'],
            ['name' => '[尴尬]', 'image_url' => $domain.'gangga.gif', 'jpg_url' => $domain.'jpg/gangga.jpg'],
            ['name' => '[发怒]', 'image_url' => $domain.'danu.gif', 'jpg_url' => $domain.'jpg/danu.jpg'],
            ['name' => '[调皮]', 'image_url' => $domain.'tiaopi.gif', 'jpg_url' => $domain.'jpg/tiaopi.jpg'],
            ['name' => '[呲牙]', 'image_url' => $domain.'ciya.gif', 'jpg_url' => $domain.'jpg/ciya.jpg'],
            ['name' => '[惊讶]', 'image_url' => $domain.'jingya.gif', 'jpg_url' => $domain.'jpg/jingya.jpg'],
            ['name' => '[难过]', 'image_url' => $domain.'nanguo.gif', 'jpg_url' => $domain.'jpg/nanguo.jpg'],

            ['name' => '[酷]', 'image_url' => $domain.'ku.gif', 'jpg_url' => $domain.'jpg/ku.jpg'],
            ['name' => '[冷汗]', 'image_url' => $domain.'lenghan.gif', 'jpg_url' => $domain.'jpg/lenghan.jpg'],
            ['name' => '[抓狂]', 'image_url' => $domain.'zhuakuang.gif', 'jpg_url' => $domain.'jpg/zhuakuang.jpg'],
            ['name' => '[吐]', 'image_url' => $domain.'tu.gif', 'jpg_url' => $domain.'jpg/tu.jpg'],
            ['name' => '[偷笑]', 'image_url' => $domain.'touxiao.gif', 'jpg_url' => $domain.'jpg/touxiao.jpg'],
            ['name' => '[可爱]', 'image_url' => $domain.'keai.gif', 'jpg_url' => $domain.'jpg/keai.jpg'],
            ['name' => '[白眼]', 'image_url' => $domain.'baiyan.gif', 'jpg_url' => $domain.'jpg/baiyan.jpg'],
            ['name' => '[傲慢]', 'image_url' => $domain.'aoman.gif', 'jpg_url' => $domain.'jpg/aoman.jpg'],

            ['name' => '[饥饿]', 'image_url' => $domain.'er.gif', 'jpg_url' => $domain.'jpg/er.jpg'],
            ['name' => '[困]', 'image_url' => $domain.'kun.gif', 'jpg_url' => $domain.'jpg/kun.jpg'],
            ['name' => '[惊恐]', 'image_url' => $domain.'jingkong.gif', 'jpg_url' => $domain.'jpg/jingkong.jpg'],
            ['name' => '[流汗]', 'image_url' => $domain.'liuhan.gif', 'jpg_url' => $domain.'jpg/liuhan.jpg'],
            ['name' => '[憨笑]', 'image_url' => $domain.'haha.gif', 'jpg_url' => $domain.'jpg/haha.jpg'],
            ['name' => '[休闲]', 'image_url' => $domain.'dabing.gif', 'jpg_url' => $domain.'jpg/dabing.jpg'],
            ['name' => '[奋斗]', 'image_url' => $domain.'fendou.gif', 'jpg_url' => $domain.'jpg/fendou.jpg'],
            ['name' => '[咒骂]', 'image_url' => $domain.'ma.gif', 'jpg_url' => $domain.'jpg/ma.jpg'],

            ['name' => '[疑问]', 'image_url' => $domain.'wen.gif', 'jpg_url' => $domain.'jpg/wen.jpg'],
            ['name' => '[嘘]', 'image_url' => $domain.'xu.gif', 'jpg_url' => $domain.'jpg/xu.jpg'],
            ['name' => '[晕]', 'image_url' => $domain.'yun.gif', 'jpg_url' => $domain.'jpg/yun.jpg'],
            ['name' => '[折磨]', 'image_url' => $domain.'zhemo.gif', 'jpg_url' => $domain.'jpg/zhemo.jpg'],
            ['name' => '[衰]', 'image_url' => $domain.'shuai.gif', 'jpg_url' => $domain.'jpg/shuai.jpg'],
            ['name' => '[骷髅]', 'image_url' => $domain.'kulou.gif', 'jpg_url' => $domain.'jpg/kulou.jpg'],
            ['name' => '[敲打]', 'image_url' => $domain.'da.gif', 'jpg_url' => $domain.'jpg/da.jpg'],
            ['name' => '[再见]', 'image_url' => $domain.'zaijian.gif', 'jpg_url' => $domain.'jpg/zaijian.jpg'],

            ['name' => '[擦汗]', 'image_url' => $domain.'cahan.gif', 'jpg_url' => $domain.'jpg/cahan.jpg'],
            ['name' => '[抠鼻]', 'image_url' => $domain.'wabi.gif', 'jpg_url' => $domain.'jpg/wabi.jpg'],
            ['name' => '[鼓掌]', 'image_url' => $domain.'guzhang.gif', 'jpg_url' => $domain.'jpg/guzhang.jpg'],
            ['name' => '[糗大了]', 'image_url' => $domain.'qioudale.gif', 'jpg_url' => $domain.'jpg/qioudale.jpg'],
            ['name' => '[坏笑]', 'image_url' => $domain.'huaixiao.gif', 'jpg_url' => $domain.'jpg/huaixiao.jpg'],
            ['name' => '[左哼哼]', 'image_url' => $domain.'zuohengheng.gif', 'jpg_url' => $domain.'jpg/zuohengheng.jpg'],
            ['name' => '[右哼哼]', 'image_url' => $domain.'youhengheng.gif', 'jpg_url' => $domain.'jpg/youhengheng.jpg'],
            ['name' => '[哈欠]', 'image_url' => $domain.'haqian.gif', 'jpg_url' => $domain.'jpg/haqian.jpg'],


            ['name' => '[鄙视]', 'image_url' => $domain.'bishi.gif', 'jpg_url' => $domain.'jpg/bishi.jpg'],
            ['name' => '[委屈]', 'image_url' => $domain.'weiqu.gif', 'jpg_url' => $domain.'jpg/weiqu.jpg'],
            ['name' => '[哭了]', 'image_url' => $domain.'ku.gif', 'jpg_url' => $domain.'jpg/ku.jpg'],
            ['name' => '[快哭了]', 'image_url' => $domain.'kuaikule.gif', 'jpg_url' => $domain.'jpg/kuaikule.jpg'],
            ['name' => '[阴险]', 'image_url' => $domain.'yinxian.gif', 'jpg_url' => $domain.'jpg/yinxian.jpg'],
            ['name' => '[亲亲]', 'image_url' => $domain.'qinqin.gif', 'jpg_url' => $domain.'jpg/qinqin.jpg'],
            ['name' => '[亲吻]', 'image_url' => $domain.'kiss.gif', 'jpg_url' => $domain.'jpg/kiss.jpg'],
            ['name' => '[吓]', 'image_url' => $domain.'xia.gif', 'jpg_url' => $domain.'jpg/xia.jpg'],

            ['name' => '[可怜]', 'image_url' => $domain.'kelian.gif', 'jpg_url' => $domain.'jpg/kelian.jpg'],
            ['name' => '[菜刀]', 'image_url' => $domain.'caidao.gif', 'jpg_url' => $domain.'jpg/caidao.jpg'],
            ['name' => '[西瓜]', 'image_url' => $domain.'xigua.gif', 'jpg_url' => $domain.'jpg/xigua.jpg'],
            ['name' => '[啤酒]', 'image_url' => $domain.'pijiu.gif', 'jpg_url' => $domain.'jpg/pijiu.jpg'],
            ['name' => '[篮球]', 'image_url' => $domain.'lanqiu.gif', 'jpg_url' => $domain.'jpg/lanqiu.jpg'],
            ['name' => '[乒乓]', 'image_url' => $domain.'pingpang.gif', 'jpg_url' => $domain.'jpg/pingpang.jpg'],
            ['name' => '[咖啡]', 'image_url' => $domain.'kafei.gif', 'jpg_url' => $domain.'jpg/kafei.jpg'],
            ['name' => '[饭]', 'image_url' => $domain.'fan.gif', 'jpg_url' => $domain.'jpg/fan.jpg'],

            ['name' => '[猪头]', 'image_url' => $domain.'zhutou.gif', 'jpg_url' => $domain.'jpg/zhutou.jpg'],
            ['name' => '[玫瑰]', 'image_url' => $domain.'hua.gif', 'jpg_url' => $domain.'jpg/hua.jpg'],
            ['name' => '[凋谢]', 'image_url' => $domain.'diaoxie.gif', 'jpg_url' => $domain.'jpg/diaoxie.jpg'],
            ['name' => '[爱心]', 'image_url' => $domain.'love.gif', 'jpg_url' => $domain.'jpg/love.jpg'],
            ['name' => '[心碎]', 'image_url' => $domain.'xinsui.gif', 'jpg_url' => $domain.'jpg/xinsui.jpg'],
            ['name' => '[蛋糕]', 'image_url' => $domain.'dangao.gif', 'jpg_url' => $domain.'jpg/dangao.jpg'],
            ['name' => '[闪电]', 'image_url' => $domain.'shandian.gif', 'jpg_url' => $domain.'jpg/shandian.jpg'],
            ['name' => '[炸弹]', 'image_url' => $domain.'zhadan.gif', 'jpg_url' => $domain.'jpg/zhadan.jpg'],

            ['name' => '[刀]', 'image_url' => $domain.'dao.gif', 'jpg_url' => $domain.'jpg/dao.jpg'],
            ['name' => '[足球]', 'image_url' => $domain.'qiu.gif', 'jpg_url' => $domain.'jpg/qiu.jpg'],
            ['name' => '[虫]', 'image_url' => $domain.'chong.gif', 'jpg_url' => $domain.'jpg/chong.jpg'],
            ['name' => '[便便]', 'image_url' => $domain.'dabian.gif', 'jpg_url' => $domain.'jpg/dabian.jpg'],
            ['name' => '[月亮]', 'image_url' => $domain.'yueliang.gif', 'jpg_url' => $domain.'jpg/yueliang.jpg'],
            ['name' => '[太阳]', 'image_url' => $domain.'taiyang.gif', 'jpg_url' => $domain.'jpg/taiyang.jpg'],
            ['name' => '[礼物]', 'image_url' => $domain.'liwu.gif', 'jpg_url' => $domain.'jpg/liwu.jpg'],
            ['name' => '[拥抱]', 'image_url' => $domain.'yongbao.gif', 'jpg_url' => $domain.'jpg/yongbao.jpg'],

            ['name' => '[强]', 'image_url' => $domain.'qiang.gif', 'jpg_url' => $domain.'jpg/qiang.jpg'],
            ['name' => '[弱]', 'image_url' => $domain.'ruo.gif', 'jpg_url' => $domain.'jpg/ruo.jpg'],
            ['name' => '[握手]', 'image_url' => $domain.'woshou.gif', 'jpg_url' => $domain.'jpg/woshou.jpg'],
            ['name' => '[胜利]', 'image_url' => $domain.'shengli.gif', 'jpg_url' => $domain.'jpg/shengli.jpg'],
            ['name' => '[抱拳]', 'image_url' => $domain.'peifu.gif', 'jpg_url' => $domain.'jpg/peifu.jpg'],
            ['name' => '[勾引]', 'image_url' => $domain.'gouyin.gif', 'jpg_url' => $domain.'jpg/gouyin.jpg'],
            ['name' => '[拳头]', 'image_url' => $domain.'quantou.gif', 'jpg_url' => $domain.'jpg/quantou.jpg'],
            ['name' => '[差劲]', 'image_url' => $domain.'chajin.gif', 'jpg_url' => $domain.'jpg/chajin.jpg'],


            ['name' => '[干杯]', 'image_url' => $domain.'cheer.gif', 'jpg_url' => $domain.'jpg/cheer.jpg'],
            ['name' => '[NO]', 'image_url' => $domain.'no.gif', 'jpg_url' => $domain.'jpg/no.jpg'],
            ['name' => '[OK]', 'image_url' => $domain.'ok.gif', 'jpg_url' => $domain.'jpg/ok.jpg'],
            ['name' => '[给力]', 'image_url' => $domain.'geili.gif', 'jpg_url' => $domain.'jpg/geili.jpg'],
            ['name' => '[飞吻]', 'image_url' => $domain.'feiwen.gif', 'jpg_url' => $domain.'jpg/feiwen.jpg'],
            ['name' => '[跳跳]', 'image_url' => $domain.'tiao.gif', 'jpg_url' => $domain.'jpg/tiao.jpg'],
            ['name' => '[发抖]', 'image_url' => $domain.'fadou.gif', 'jpg_url' => $domain.'jpg/fadou.jpg'],

            ['name' => '[大叫]', 'image_url' => $domain.'dajiao.gif', 'jpg_url' => $domain.'jpg/dajiao.jpg'],
            ['name' => '[转圈]', 'image_url' => $domain.'zhuanquan.gif', 'jpg_url' => $domain.'jpg/zhuanquan.jpg'],
            ['name' => '[磕头]', 'image_url' => $domain.'ketou.gif', 'jpg_url' => $domain.'jpg/ketou.jpg'],
            ['name' => '[回头]', 'image_url' => $domain.'huitou.gif', 'jpg_url' => $domain.'jpg/huitou.jpg'],
            ['name' => '[跳绳]', 'image_url' => $domain.'tiaosheng.gif', 'jpg_url' => $domain.'jpg/tiaosheng.jpg'],
            ['name' => '[挥手]', 'image_url' => $domain.'huishou.gif', 'jpg_url' => $domain.'jpg/huishou.jpg'],
            ['name' => '[激动]', 'image_url' => $domain.'jidong.gif', 'jpg_url' => $domain.'jpg/jidong.jpg'],
            ['name' => '[街舞]', 'image_url' => $domain.'tiaowu.gif', 'jpg_url' => $domain.'jpg/tiaowu.jpg'],
            ['name' => '[献吻]', 'image_url' => $domain.'xianwen.gif', 'jpg_url' => $domain.'jpg/xianwen.jpg'],
            ['name' => '[左太极]', 'image_url' => $domain.'zuotaiji.gif', 'jpg_url' => $domain.'jpg/zuotaiji.jpg'],
            ['name' => '[右太极]', 'image_url' => $domain.'youtaiji.gif', 'jpg_url' => $domain.'jpg/youtaiji.jpg'],

//            ['name' => '[]', 'image_url' => $domain.'.gif'],





        ];
    }
}