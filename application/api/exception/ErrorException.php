<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 18:29
 */

namespace app\api\exception;

use think\Exception;

class ErrorException extends Exception {

    public $message = '';
    public $httpCode = 200;
    public $code = 0;

    /**
     * API错误处理
     * ErrorException constructor.
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($message = 'error', $httpCode = 200, $code = -1) {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }
}