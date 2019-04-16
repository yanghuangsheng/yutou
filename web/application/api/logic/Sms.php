<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/28
 * Time: 11:47
 */

namespace app\api\logic;

use app\api\service\Sms as SmsService;

class Sms extends Base
{
    /**
     * 发送验证码
     */
    public function send()
    {
        $data = $this->param();
        //手机号码验证 -> 暂缺

        //生成和保存验证码
        $code = random_string(6, 'number');
        $codeSign = $this->unId('sms');
        $this->cache($codeSign, $code, 600);

        //短信模板
        $content = '您的验证码是' . $code . '，在10分钟内输入有效。如非本人操作请忽略此短信。';
        $content = urlencode($content);
        //comp$content = mb_convert_encoding($content, "GBK", "UTF-8");
        $data = (new SmsService)->smsSend($data['mobile'], $content);

        if(isset($data['error'])){

            return showResult( -1, '', ['error'=>$data['error']]);
        }

        return showResult( 0, '', ['sign'=>$codeSign]);

    }
}