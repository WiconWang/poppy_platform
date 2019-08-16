<?php

namespace App\HttpController\User;

use App\Config\ReturnCode;
use App\Model\MemberModel;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\Validate\Validate;
use EasySwoole\RedisPool\Redis;

/**
 * 用户登陆
 * Class Member
 * Create With Automatic Generator
 */
class Login extends Base
{



    public function checkLogin()
    {
        $db = Mysql::defer('mysql');
        $model = new MemberModel($db);
        $where = $this->request()->getRequestParam();
        $data = $model->getAll(1, ['mobile' => $where['mobile']], 1);
        // 用户是否存在
        if (!empty($data) && $data['total'] == 0) {
            $this->responseJson(ReturnCode::USER_NOT_EXIST);
            return false;
        }
        if ($where['code'] != 8888){
            $this->responseJson(ReturnCode::USER_MOBILE_CODE_ERROR);
            return false;
        }

        $token = md5(time());


        $redis = Redis::defer('redis');
        $redis->set($token, $data['list'][0]);

        $this->responseJson(ReturnCode::SUCCESS, '', ['token' => $token]);
    }

    public function getSMS()
    {
        // TODO
        $this->responseJson(ReturnCode::SUCCESS, '发送成功');
    }



    /**
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function getValidateRule(?string $action): ?Validate
    {
        $validate = null;
        switch ($action) {

            case 'checkLogin':
                $validate = new Validate();
                $validate->addColumn('mobile', '手机号mobile')->required();
                $validate->addColumn('code', '验证码code')->required();
                break;
        }
        return $validate;
    }
}

