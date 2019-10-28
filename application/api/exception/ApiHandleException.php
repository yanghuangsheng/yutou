<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 18:08
 */

namespace app\api\exception;


use think\exception\Handle;

class ApiHandleException extends  Handle {

    /**
     * http 状态码
     * @var int
     */
    public $httpCode = 500;
    public $code = 0;
    public $message = '';
    public $data = [];

    /**
     * 异常处理
     * @param \Exception $e
     * @return array|\think\Response
     */
    public function render(\Exception $e) {

        if(config('app_debug') == true) {
            return parent::render($e);
        }
        if($e instanceof ErrorException) {
            $this->httpCode = $e->httpCode;
            $this->code = $e->getCode();
        }
        if($e instanceof SuccessException) {
            $this->httpCode = $e->httpCode;
            $this->code = $e->getCode();
            $this->data = $e->getData();
            //print_r($this->data);
        }
        return  showResult($this->code, $e->getMessage(), $this->data, $this->httpCode);
    }
}