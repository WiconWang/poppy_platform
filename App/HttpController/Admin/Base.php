<?php

namespace App\HttpController\Admin;

use App\Config\ReturnCode;
use App\Utilities\ResponseHelper;
use EasySwoole\RedisPool\Redis;

/**
 * BaseController
 * Class Base
 * Create With Automatic Generator
 */
abstract class Base extends \EasySwoole\Http\AbstractInterface\Controller
{
    use ResponseHelper;
    private $noVerifyAction = ['getValidateRule', 'checkLogin', 'getSMS'];

    public function index()
    {
        $this->actionNotFound('index');
    }


    public function onRequest(?string $action): ?bool
    {
        if (!parent::onRequest($action)) {
            return false;
        };
        /*
         * 不在列表中的方法，进行权限验证
         */
        if (!in_array($action, $this->noVerifyAction)) {
            if (!$this->request()->hasHeader('authorization')) {
                $this->responseJson(ReturnCode::TOKEN_LOST);
                return false;
            }
            $tokenArray = $this->request()->getHeader('authorization');

            $redis = Redis::defer('redis');
            $info = $redis->get($tokenArray[0]);

            if (!$info) {
                $this->responseJson(ReturnCode::TOKEN_ERROR);
                return false;
            }

        }
        /*
        * 各个action的参数校验
        */
        $v = $this->getValidateRule($action);
        if ($v && !$this->validate($v)) {
            $this->responseJson(ReturnCode::PARAM_ERROR, $v->getError()->__toString(), []);
            return false;
        }
        return true;
    }


    abstract protected function getValidateRule(?string $action): ?\EasySwoole\Validate\Validate;
}

