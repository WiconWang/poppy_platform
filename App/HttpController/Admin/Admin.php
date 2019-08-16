<?php

namespace App\HttpController\Admin;

use App\Bean\AdminBean;
use App\Config\ReturnCode;
use App\Model\AdminModel;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\Validate\Validate;

/**
 * 超级管理员总表
 * Class Admin
 * Create With Automatic Generator
 */
class Admin extends Base
{
    /**
     * @api {get|post} /Admin/Admin/add
     * @apiName add
     * @apiGroup /Admin/Admin
     * @apiPermission
     * @apiDescription add新增数据
     * @apiParam {string} username 用户昵称
     * @apiParam {string} mobile 用户手机号
     * @apiParam {string} email 用户邮箱
     * @apiParam {string} password 登陆密码
     * @apiParam {string} photo 头像
     * @apiParam {int} status 用户状态 0正常 1禁用
     * @apiParam {mixed} [last_login] 最后登陆时间
     * @apiParam {mixed} [created_at]
     * @apiParam {mixed} [updated_at]
     * @apiSuccess {Number} code
     * @apiSuccess {Object[]} data
     * @apiSuccess {String} msg
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {"code":200,"data":{},"msg":"success"}
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function add()
    {
        $db = Mysql::defer('mysql');
        $param = $this->request()->getRequestParam();
        $model = new AdminModel($db);
        $data = $model->getAll(1, ['mobile' => $param['mobile']], 1);
        if (!empty($data) && $data['total'] > 0) {
            $this->responseJson(ReturnCode::USER_MOBILE_EXIST);
            return false;
        }
        $bean = new AdminBean();
        $bean->setUsername($param['username']);
        $bean->setMobile($param['mobile']);
        $bean->setEmail($param['email']);
        $bean->setPassword(password_hash($param['password'], PASSWORD_DEFAULT));
        $bean->setPhoto($param['photo'] ?? '');
        $bean->setStatus($param['status']);
//        $bean->setLastLogin($param['last_login'] ?? NULL);
        $bean->setCreatedAt(date('Y-m-d H:i:s', time()));
        $rs = $model->add($bean);
        if ($rs) {
            $bean->setId($db->getInsertId());
            $this->responseJson(ReturnCode::SUCCESS, '', $bean->toArray());
        } else {
            $this->responseJson(ReturnCode::ERROR, $db->getLastError(), []);
        }
    }


    /**
     * @api {get|post} /Admin/Admin/update
     * @apiName update
     * @apiGroup /Admin/Admin
     * @apiPermission
     * @apiDescription update修改数据
     * @apiParam {int} id 主键id
     * @apiParam {string} [username] 用户昵称
     * @apiParam {string} [mobile] 用户手机号
     * @apiParam {string} [email] 用户邮箱
     * @apiParam {string} [password] 登陆密码
     * @apiParam {string} [photo] 头像
     * @apiParam {int} [status] 用户状态 0正常 1禁用
     * @apiParam {mixed} [last_login] 最后登陆时间
     * @apiParam {mixed} [created_at]
     * @apiParam {mixed} [updated_at]
     * @apiSuccess {Number} code
     * @apiSuccess {Object[]} data
     * @apiSuccess {String} msg
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {"code":200,"data":{},"msg":"success"}
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function update()
    {
        $db = Mysql::defer('mysql');
        $param = $this->request()->getRequestParam();
        $model = new AdminModel($db);
        $bean = $model->getOne(new AdminBean(['id' => $param['id']]));
        if (empty($bean)) {
            $this->responseJson(ReturnCode::RECORD_NOT_FOUND);
            return false;
        }
        $updateBean = new AdminBean();

        $updateBean->setUsername($param['username'] ?? $bean->getUsername());
        $updateBean->setMobile($param['mobile'] ?? $bean->getMobile());
        $updateBean->setEmail($param['email'] ?? $bean->getEmail());
        $updateBean->setPassword($param['password'] ? password_hash($param['password'], PASSWORD_DEFAULT) : $bean->getPassword());
        $updateBean->setPhoto($param['photo'] ?? $bean->getPhoto());
        $updateBean->setStatus($param['status'] ?? $bean->getStatus());
        $updateBean->setLastLogin($param['last_login'] ?? $bean->getLastLogin());
        $updateBean->setCreatedAt($param['created_at'] ?? $bean->getCreatedAt());
        $updateBean->setUpdatedAt($param['updated_at'] ?? $bean->getUpdatedAt());
        $rs = $model->update($bean, $updateBean->toArray([], $updateBean::FILTER_NOT_NULL));
        if ($rs) {
            $this->responseJson(ReturnCode::SUCCESS, '', $rs);
        } else {
            $this->responseJson(ReturnCode::ERROR, $db->getLastError(), []);
        }
    }


    /**
     * @api {get|post} /Admin/Admin/getOne
     * @apiName getOne
     * @apiGroup /Admin/Admin
     * @apiPermission
     * @apiDescription 根据主键获取一条信息
     * @apiParam {int} id 主键id
     * @apiSuccess {Number} code
     * @apiSuccess {Object[]} data
     * @apiSuccess {String} msg
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {"code":200,"data":{},"msg":"success"}
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function getOne()
    {
        $db = Mysql::defer('mysql');
        $param = $this->request()->getRequestParam();
        $model = new AdminModel($db);
        $bean = $model->getOne(new AdminBean(['id' => $param['id']]));
        if ($bean) {
            $this->responseJson(ReturnCode::SUCCESS, '', $bean);
        } else {
            $this->responseJson(ReturnCode::RECORD_NOT_FOUND);
        }
    }


    /**
     * @api {get|post} /Admin/Admin/getAll
     * @apiName getAll
     * @apiGroup /Admin/Admin
     * @apiPermission
     * @apiDescription 获取一个列表
     * @apiParam {String} [page=1]
     * @apiParam {String} [limit=20]
     * @apiParam {String} [mobile] 关键字,根据表的不同而不同
     * @apiSuccess {Number} code
     * @apiSuccess {Object[]} data
     * @apiSuccess {String} msg
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {"code":200,"data":{},"msg":"success"}
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function getAll()
    {
        $db = Mysql::defer('mysql');
        $param = $this->request()->getRequestParam();
        $page = (int)($param['page'] ?? 1);
        $limit = (int)($param['limit'] ?? 20);
        $model = new AdminModel($db);
        $data = $model->getAll($page, $param, $limit);
        $this->responseJson(ReturnCode::SUCCESS, '', $data);
    }


    /**
     * @api {get|post} /Admin/Admin/delete
     * @apiName delete
     * @apiGroup /Admin/Admin
     * @apiPermission
     * @apiDescription 根据主键删除一条信息
     * @apiParam {int} id 主键id
     * @apiSuccess {Number} code
     * @apiSuccess {Object[]} data
     * @apiSuccess {String} msg
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {"code":200,"data":{},"msg":"success"}
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function delete()
    {
        $db = Mysql::defer('mysql');
        $param = $this->request()->getRequestParam();
        $model = new AdminModel($db);

        $bean = $model->getOne(new AdminBean(['id' => $param['id']]));
        if (empty($bean)) {
            $this->responseJson(ReturnCode::RECORD_NOT_FOUND);
            return false;
        }

        $rs = $model->delete(new AdminBean(['id' => $param['id']]));
        $this->responseDefaultJson($rs);
    }


    /**
     * @author: AutomaticGeneration < 1067197739@qq.com >
     */
    public function getValidateRule(?string $action): ?Validate
    {
        $validate = null;
        switch ($action) {
            case 'add':
                $validate = new Validate();
                $validate->addColumn('username', '用户昵称')->required();
                $validate->addColumn('mobile', '用户手机号')->required();
                $validate->addColumn('email', '用户邮箱')->required();
                $validate->addColumn('password', '登陆密码')->required();
                $validate->addColumn('photo', '头像')->optional();
                $validate->addColumn('status', '用户状态 0正常 1禁用')->required();
                $validate->addColumn('last_login', '最后登陆时间')->optional();
                $validate->addColumn('created_at', '')->optional();
                $validate->addColumn('updated_at', '')->optional();

                break;
            case 'update':
                $validate = new Validate();
                $validate->addColumn('id', 'id')->required();
                $validate->addColumn('username', '用户昵称')->optional();
                $validate->addColumn('mobile', '用户手机号')->optional();
                $validate->addColumn('email', '用户邮箱')->optional();
                $validate->addColumn('password', '登陆密码')->optional();
                $validate->addColumn('photo', '头像')->optional();
                $validate->addColumn('status', '用户状态 0正常 1禁用')->optional();
                $validate->addColumn('last_login', '最后登陆时间')->optional();
                $validate->addColumn('created_at', '')->optional();
                $validate->addColumn('updated_at', '')->optional();

                break;
            case 'getAll':
                $validate = new Validate();
                $validate->addColumn('page', '页数')->optional();
                $validate->addColumn('limit', 'limit')->optional();
                $validate->addColumn('keyword', '关键词')->optional();
                break;
            case 'getOne':
                $validate = new Validate();
                $validate->addColumn('id', 'id')->required();

                break;
            case 'delete':
                $validate = new Validate();
                $validate->addColumn('id', 'id')->required();

                break;
        }
        return $validate;
    }
}

