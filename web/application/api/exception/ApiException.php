<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 18:29
 */

namespace app\api\exception;


use think\Exception;

class ApiException extends Exception {

    public $message = '';
    public $httpCode = 500;
    public $code = 0;
    /**
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($message = '', $httpCode = 0, $code = 0) {
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->code = $code;
    }
}