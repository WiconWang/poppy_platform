<?php

namespace App\HttpController\Admin;

use App\Bean\AdminBean;
use App\Config\ReturnCode;
use App\Model\AdminModel;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\Validate\Validate;
use EasySwoole\RedisPool\Redis;

/**
 * 用户登陆
 * Class Admin
 * Create With Automatic Generator
 */
class Login extends Base
{


    public function checkLogin()
    {
        $db = Mysql::defer('mysql');
        $model = new AdminModel($db);
        $where = $this->request()->getRequestParam();
        $data = $model->getAll(1, ['mobile' => $where['mobile']], 1, true);
        // 用户是否存在
        if (!empty($data) && $data['total'] < 1) {
            $this->responseJson(ReturnCode::USER_NOT_EXIST);
            return false;
        }
        $password = $data['list'][0]['password'];

        if (password_verify($where['password'], $password)) {

            $token = md5(time());
            $redis = Redis::defer('redis');
            $redis->set($token, $data['list'][0]);

            $this->responseJson(ReturnCode::SUCCESS, '', ['token' => $token]);
        }else{
            $this->responseJson(ReturnCode::USER_PASSWORD_ERROR);

        }
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
                $validate->addColumn('mobile', '手机号')->required();
                $validate->addColumn('password', '密码')->required();

                break;
            case 'sms':
                $validate = new Validate();
                $validate->addColumn('mobile', '手机号')->required();

                break;
        }
        return $validate;
    }
}

