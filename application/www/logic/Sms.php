<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/21
 * Time: 13:13
 */

namespace app\www\logic;

use app\www\service\Sms as SmsService;

class Sms extends Base
{
    /**
     * 发送验证码
     */
    public function send()
    {
        if($this->isAjax()){

            $data = $this->param();
            //手机号码验证 -> 暂缺

            //生成和保存验证码
            $code = random_string(6, 'number');
            $this->session('sms_code', $code);

            //短信模板
            $content = '您的验证码是' . $code . '，在10分钟内输入有效。如非本人操作请忽略此短信。';
            //$content = urlencode(mb_convert_encoding($content, 'GBK', 'utf-8'));
            $data = (new SmsService)->smsSend($data['mobile'], $content);

            if(isset($data['error'])){
                $this->resultJson(-1, $data['error']);
            }

            $this->resultJson(0, '发送成功');
        }

    }
}