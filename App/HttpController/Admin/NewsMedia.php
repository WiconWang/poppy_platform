<?php

namespace App\HttpController\Admin;

use App\Bean\NewsMediaBean;
use App\Model\NewsMediaModel;
use EasySwoole\Http\Message\Status;
use EasySwoole\MysqliPool\Mysql;
use EasySwoole\Validate\Validate;

/**
 * 媒体总表
 * Class NewsMedia
 * Create With Automatic Generator
 */
class NewsMedia extends Base
{
	/**
	 * @api {get|post} /Admin/NewsMedia/add
	 * @apiName add
	 * @apiGroup /Admin/NewsMedia
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @apiParam {int} ecosystem 生态圈
	 * @apiParam {string} pl PL部门
	 * @apiParam {string} order_no 申请单号
	 * @apiParam {string} pay_no 资金支付单号
	 * @apiParam {string} f0_no F0单号
	 * @apiParam {string} media_name 媒体
	 * @apiParam {mixed} [apply_at] 申请日期
	 * @apiParam {mixed} [audit_at] 审核日期
	 * @apiParam {int} charge_no 出账公司编码
	 * @apiParam {string} charge_name 出账公司名称
	 * @apiParam {string} department_no 部门编码
	 * @apiParam {string} department_name 部门名称
	 * @apiParam {int} order_id 申请人工号
	 * @apiParam {string} order_name 申请人姓名
	 * @apiParam {int} audit_id 审核人工号
	 * @apiParam {string} audit_name 审核人姓名
	 * @apiParam {string} project_id 费用项目编码
	 * @apiParam {string} project_name 费用项目名称
	 * @apiParam {int} order_amount 申请金额
	 * @apiParam {int} pay_amount 支付金额
	 * @apiParam {string} module 系统来源名称
	 * @apiParam {string} description 业务描述
	 * @apiParam {string} supplier_no 供应商编码
	 * @apiParam {string} supplier_name 供应商
	 * @apiParam {mixed} [created_at] 新建时间
	 * @apiParam {mixed} [updated_at] 修改时间
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
		$model = new NewsMediaModel($db);
		$bean = new NewsMediaBean();
		$bean->setEcosystem($param['ecosystem']);
		$bean->setPl($param['pl']);
		$bean->setOrderNo($param['order_no']);
		$bean->setPayNo($param['pay_no']);
		$bean->setF0No($param['f0_no']);
		$bean->setMediaName($param['media_name']);
		$bean->setApplyAt($param['apply_at']??'');
		$bean->setAuditAt($param['audit_at']??'');
		$bean->setChargeNo($param['charge_no']);
		$bean->setChargeName($param['charge_name']);
		$bean->setDepartmentNo($param['department_no']);
		$bean->setDepartmentName($param['department_name']);
		$bean->setOrderId($param['order_id']);
		$bean->setOrderName($param['order_name']);
		$bean->setAuditId($param['audit_id']);
		$bean->setAuditName($param['audit_name']);
		$bean->setProjectId($param['project_id']);
		$bean->setProjectName($param['project_name']);
		$bean->setOrderAmount($param['order_amount']);
		$bean->setPayAmount($param['pay_amount']);
		$bean->setModule($param['module']);
		$bean->setDescription($param['description']);
		$bean->setSupplierNo($param['supplier_no']);
		$bean->setSupplierName($param['supplier_name']);
		$bean->setCreatedAt($param['created_at']??'');
		$bean->setUpdatedAt($param['updated_at']??'');
		$rs = $model->add($bean);
		if ($rs) {
		    $bean->setId($db->getInsertId());
		    $this->writeJson(Status::CODE_OK, $bean->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $db->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/NewsMedia/update
	 * @apiName update
	 * @apiGroup /Admin/NewsMedia
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @apiParam {int} id 主键id
	 * @apiParam {int} [ecosystem] 生态圈
	 * @apiParam {string} [pl] PL部门
	 * @apiParam {string} [order_no] 申请单号
	 * @apiParam {string} [pay_no] 资金支付单号
	 * @apiParam {string} [f0_no] F0单号
	 * @apiParam {string} [media_name] 媒体
	 * @apiParam {mixed} [apply_at] 申请日期
	 * @apiParam {mixed} [audit_at] 审核日期
	 * @apiParam {int} [charge_no] 出账公司编码
	 * @apiParam {string} [charge_name] 出账公司名称
	 * @apiParam {string} [department_no] 部门编码
	 * @apiParam {string} [department_name] 部门名称
	 * @apiParam {int} [order_id] 申请人工号
	 * @apiParam {string} [order_name] 申请人姓名
	 * @apiParam {int} [audit_id] 审核人工号
	 * @apiParam {string} [audit_name] 审核人姓名
	 * @apiParam {string} [project_id] 费用项目编码
	 * @apiParam {string} [project_name] 费用项目名称
	 * @apiParam {int} [order_amount] 申请金额
	 * @apiParam {int} [pay_amount] 支付金额
	 * @apiParam {string} [module] 系统来源名称
	 * @apiParam {string} [description] 业务描述
	 * @apiParam {string} [supplier_no] 供应商编码
	 * @apiParam {string} [supplier_name] 供应商
	 * @apiParam {mixed} [created_at] 新建时间
	 * @apiParam {mixed} [updated_at] 修改时间
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
		$model = new NewsMediaModel($db);
		$bean = $model->getOne(new NewsMediaBean(['id' => $param['id']]));
		if (empty($bean)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateBean = new NewsMediaBean();

		$updateBean->setEcosystem($param['ecosystem']??$bean->getEcosystem());
		$updateBean->setPl($param['pl']??$bean->getPl());
		$updateBean->setOrderNo($param['order_no']??$bean->getOrderNo());
		$updateBean->setPayNo($param['pay_no']??$bean->getPayNo());
		$updateBean->setF0No($param['f0_no']??$bean->getF0No());
		$updateBean->setMediaName($param['media_name']??$bean->getMediaName());
		$updateBean->setApplyAt($param['apply_at']??$bean->getApplyAt());
		$updateBean->setAuditAt($param['audit_at']??$bean->getAuditAt());
		$updateBean->setChargeNo($param['charge_no']??$bean->getChargeNo());
		$updateBean->setChargeName($param['charge_name']??$bean->getChargeName());
		$updateBean->setDepartmentNo($param['department_no']??$bean->getDepartmentNo());
		$updateBean->setDepartmentName($param['department_name']??$bean->getDepartmentName());
		$updateBean->setOrderId($param['order_id']??$bean->getOrderId());
		$updateBean->setOrderName($param['order_name']??$bean->getOrderName());
		$updateBean->setAuditId($param['audit_id']??$bean->getAuditId());
		$updateBean->setAuditName($param['audit_name']??$bean->getAuditName());
		$updateBean->setProjectId($param['project_id']??$bean->getProjectId());
		$updateBean->setProjectName($param['project_name']??$bean->getProjectName());
		$updateBean->setOrderAmount($param['order_amount']??$bean->getOrderAmount());
		$updateBean->setPayAmount($param['pay_amount']??$bean->getPayAmount());
		$updateBean->setModule($param['module']??$bean->getModule());
		$updateBean->setDescription($param['description']??$bean->getDescription());
		$updateBean->setSupplierNo($param['supplier_no']??$bean->getSupplierNo());
		$updateBean->setSupplierName($param['supplier_name']??$bean->getSupplierName());
		$updateBean->setCreatedAt($param['created_at']??$bean->getCreatedAt());
		$updateBean->setUpdatedAt($param['updated_at']??$bean->getUpdatedAt());
		$rs = $model->update($bean, $updateBean->toArray([], $updateBean::FILTER_NOT_NULL));
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $db->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/NewsMedia/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/NewsMedia
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
		$model = new NewsMediaModel($db);
		$bean = $model->getOne(new NewsMediaBean(['id' => $param['id']]));
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/NewsMedia/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/NewsMedia
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
		$model = new NewsMediaModel($db);
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/NewsMedia/delete
	 * @apiName delete
	 * @apiGroup /Admin/NewsMedia
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
		$model = new NewsMediaModel($db);

		$rs = $model->delete(new NewsMediaBean(['id' => $param['id']]));
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
		        $validate->addColumn('ecosystem', '生态圈')->required();
		        $validate->addColumn('pl', 'PL部门')->required();
		        $validate->addColumn('order_no', '申请单号')->required();
		        $validate->addColumn('pay_no', '资金支付单号')->required();
		        $validate->addColumn('f0_no', 'F0单号')->required();
		        $validate->addColumn('media_name', '媒体')->required();
		        $validate->addColumn('apply_at', '申请日期')->optional();
		        $validate->addColumn('audit_at', '审核日期')->optional();
		        $validate->addColumn('charge_no', '出账公司编码')->required();
		        $validate->addColumn('charge_name', '出账公司名称')->required();
		        $validate->addColumn('department_no', '部门编码')->required();
		        $validate->addColumn('department_name', '部门名称')->required();
		        $validate->addColumn('order_id', '申请人工号')->required();
		        $validate->addColumn('order_name', '申请人姓名')->required();
		        $validate->addColumn('audit_id', '审核人工号')->required();
		        $validate->addColumn('audit_name', '审核人姓名')->required();
		        $validate->addColumn('project_id', '费用项目编码')->required();
		        $validate->addColumn('project_name', '费用项目名称')->required();
		        $validate->addColumn('order_amount', '申请金额')->required();
		        $validate->addColumn('pay_amount', '支付金额')->required();
		        $validate->addColumn('module', '系统来源名称')->required();
		        $validate->addColumn('description', '业务描述')->required();
		        $validate->addColumn('supplier_no', '供应商编码')->required();
		        $validate->addColumn('supplier_name', '供应商')->required();
		        $validate->addColumn('created_at', '新建时间')->optional();
		        $validate->addColumn('updated_at', '修改时间')->optional();

		        break;
		    case 'update':
		        $validate = new Validate();
		        $validate->addColumn('id', 'id')->required();
		        $validate->addColumn('ecosystem', '生态圈')->optional();
		        $validate->addColumn('pl', 'PL部门')->optional();
		        $validate->addColumn('order_no', '申请单号')->optional();
		        $validate->addColumn('pay_no', '资金支付单号')->optional();
		        $validate->addColumn('f0_no', 'F0单号')->optional();
		        $validate->addColumn('media_name', '媒体')->optional();
		        $validate->addColumn('apply_at', '申请日期')->optional();
		        $validate->addColumn('audit_at', '审核日期')->optional();
		        $validate->addColumn('charge_no', '出账公司编码')->optional();
		        $validate->addColumn('charge_name', '出账公司名称')->optional();
		        $validate->addColumn('department_no', '部门编码')->optional();
		        $validate->addColumn('department_name', '部门名称')->optional();
		        $validate->addColumn('order_id', '申请人工号')->optional();
		        $validate->addColumn('order_name', '申请人姓名')->optional();
		        $validate->addColumn('audit_id', '审核人工号')->optional();
		        $validate->addColumn('audit_name', '审核人姓名')->optional();
		        $validate->addColumn('project_id', '费用项目编码')->optional();
		        $validate->addColumn('project_name', '费用项目名称')->optional();
		        $validate->addColumn('order_amount', '申请金额')->optional();
		        $validate->addColumn('pay_amount', '支付金额')->optional();
		        $validate->addColumn('module', '系统来源名称')->optional();
		        $validate->addColumn('description', '业务描述')->optional();
		        $validate->addColumn('supplier_no', '供应商编码')->optional();
		        $validate->addColumn('supplier_name', '供应商')->optional();
		        $validate->addColumn('created_at', '新建时间')->optional();
		        $validate->addColumn('updated_at', '修改时间')->optional();

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

