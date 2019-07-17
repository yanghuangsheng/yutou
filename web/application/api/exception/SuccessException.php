<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 18:29
 */

namespace app\api\exception;

use think\Exception;

class SuccessException extends Exception {

    public $httpCode = 200;
    public $code = 0;
    public $message = '';
    public $data = [];

    /**
     * API成功处理
     * SuccessException constructor.
     * @param string $message
     * @param array $data
     * @param int $code
     * @param int $httpCode
     */
    public function __construct($message = 'success', $data = [], $code = 0, $httpCode = 200) {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
        $this->data = $data;
    }
}