<?php

namespace App\HttpController\User;

use App\Bean\MemberBean;
use App\Model\MemberModel;
use EasySwoole\Http\Message\Status;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\Validate\Validate;

/**
 * 用户总表
 * Class Member
 * Create With Automatic Generator
 */
class Member extends Base
{
	/**
	 * @api {get|post} /User/Member/add
	 * @apiName add
	 * @apiGroup /User/Member
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @apiParam {string} username 用户昵称
	 * @apiParam {string} mobile 用户手机号
	 * @apiParam {string} email 用户邮箱
	 * @apiParam {string} password 登陆密码
	 * @apiParam {string} photo 头像
	 * @apiParam {string} signature 用户简介
	 * @apiParam {int} status 用户状态 0未知  1正常 2禁用
	 * @apiParam {mixed} [last_login] 最后登陆时间
	 * @apiParam {mixed} [created_at]
	 * @apiParam {mixed} [updated_at]
	 * @apiParam {string} permissions
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
		$model = new MemberModel($db);
		$bean = new MemberBean();
		$bean->setUsername($param['username']);
		$bean->setMobile($param['mobile']);
		$bean->setEmail($param['email']);
		$bean->setPassword($param['password']);
		$bean->setPhoto($param['photo']);
		$bean->setSignature($param['signature']);
		$bean->setStatus($param['status']);
		$bean->setLastLogin($param['last_login']??'');
		$bean->setCreatedAt($param['created_at']??'');
		$bean->setUpdatedAt($param['updated_at']??'');
		$bean->setPermissions($param['permissions']);
		$rs = $model->add($bean);
		if ($rs) {
		    $bean->setId($db->getInsertId());
		    $this->writeJson(Status::CODE_OK, $bean->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $db->getLastError());
		}
	}


	/**
	 * @api {get|post} /User/Member/update
	 * @apiName update
	 * @apiGroup /User/Member
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @apiParam {int} id 主键id
	 * @apiParam {string} [username] 用户昵称
	 * @apiParam {string} [mobile] 用户手机号
	 * @apiParam {string} [email] 用户邮箱
	 * @apiParam {string} [password] 登陆密码
	 * @apiParam {string} [photo] 头像
	 * @apiParam {string} [signature] 用户简介
	 * @apiParam {int} [status] 用户状态 0未知  1正常 2禁用
	 * @apiParam {mixed} [last_login] 最后登陆时间
	 * @apiParam {mixed} [created_at]
	 * @apiParam {mixed} [updated_at]
	 * @apiParam {string} [permissions]
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
		$model = new MemberModel($db);
		$bean = $model->getOne(new MemberBean(['id' => $param['id']]));
		if (empty($bean)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateBean = new MemberBean();

		$updateBean->setUsername($param['username']??$bean->getUsername());
		$updateBean->setMobile($param['mobile']??$bean->getMobile());
		$updateBean->setEmail($param['email']??$bean->getEmail());
		$updateBean->setPassword($param['password']??$bean->getPassword());
		$updateBean->setPhoto($param['photo']??$bean->getPhoto());
		$updateBean->setSignature($param['signature']??$bean->getSignature());
		$updateBean->setStatus($param['status']??$bean->getStatus());
		$updateBean->setLastLogin($param['last_login']??$bean->getLastLogin());
		$updateBean->setCreatedAt($param['created_at']??$bean->getCreatedAt());
		$updateBean->setUpdatedAt($param['updated_at']??$bean->getUpdatedAt());
		$updateBean->setPermissions($param['permissions']??$bean->getPermissions());
		$rs = $model->update($bean, $updateBean->toArray([], $updateBean::FILTER_NOT_NULL));
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $db->getLastError());
		}
	}


	/**
	 * @api {get|post} /User/Member/getOne
	 * @apiName getOne
	 * @apiGroup /User/Member
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
		$model = new MemberModel($db);
		$bean = $model->getOne(new MemberBean(['id' => $param['id']]));
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /User/Member/getAll
	 * @apiName getAll
	 * @apiGroup /User/Member
	 * @apiPermission
	 * @apiDescription 获取一个列表
	 * @apiParam {String} [page=1]
	 * @apiParam {String} [limit=20]
	 * @apiParam {String} [keyword] 关键字,根据表的不同而不同
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
		$page = (int)($param['page']??1);
		$limit = (int)($param['limit']??20);
		$model = new MemberModel($db);
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /User/Member/delete
	 * @apiName delete
	 * @apiGroup /User/Member
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
		$model = new MemberModel($db);

		$rs = $model->delete(new MemberBean(['id' => $param['id']]));
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
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
		        $validate->addColumn('photo', '头像')->required();
		        $validate->addColumn('signature', '用户简介')->required();
		        $validate->addColumn('status', '用户状态 0未知  1正常 2禁用')->required();
		        $validate->addColumn('last_login', '最后登陆时间')->optional();
		        $validate->addColumn('created_at', '')->optional();
		        $validate->addColumn('updated_at', '')->optional();
		        $validate->addColumn('permissions', '')->required();

		        break;
		    case 'update':
		        $validate = new Validate();
		        $validate->addColumn('id', 'id')->required();
		        $validate->addColumn('username', '用户昵称')->optional();
		        $validate->addColumn('mobile', '用户手机号')->optional();
		        $validate->addColumn('email', '用户邮箱')->optional();
		        $validate->addColumn('password', '登陆密码')->optional();
		        $validate->addColumn('photo', '头像')->optional();
		        $validate->addColumn('signature', '用户简介')->optional();
		        $validate->addColumn('status', '用户状态 0未知  1正常 2禁用')->optional();
		        $validate->addColumn('last_login', '最后登陆时间')->optional();
		        $validate->addColumn('created_at', '')->optional();
		        $validate->addColumn('updated_at', '')->optional();
		        $validate->addColumn('permissions', '')->optional();

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

