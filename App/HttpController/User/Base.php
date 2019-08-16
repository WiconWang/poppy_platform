<?php

namespace App\HttpController\User;

use App\Config\ReturnCode;
use App\Utilities\ResponseHelper;

/**
 * BaseController
 * Class Base
 * Create With Automatic Generator
 */
abstract class Base extends \EasySwoole\Http\AbstractInterface\Controller
{
    use ResponseHelper;

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

