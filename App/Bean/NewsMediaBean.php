<?php

namespace App\Bean;

/**
 * 媒体总表
 * Class NewsMediaBean
 * Create With Automatic Generator
 * @property int id | 主键id
 * @property int ecosystem | 生态圈
 * @property string pl | PL部门
 * @property string order_no | 申请单号
 * @property string pay_no | 资金支付单号
 * @property string f0_no | F0单号
 * @property string media_name | 媒体
 * @property mixed apply_at | 申请日期
 * @property mixed audit_at | 审核日期
 * @property int charge_no | 出账公司编码
 * @property string charge_name | 出账公司名称
 * @property string department_no | 部门编码
 * @property string department_name | 部门名称
 * @property int order_id | 申请人工号
 * @property string order_name | 申请人姓名
 * @property int audit_id | 审核人工号
 * @property string audit_name | 审核人姓名
 * @property string project_id | 费用项目编码
 * @property string project_name | 费用项目名称
 * @property int order_amount | 申请金额
 * @property int pay_amount | 支付金额
 * @property string module | 系统来源名称
 * @property string description | 业务描述
 * @property string supplier_no | 供应商编码
 * @property string supplier_name | 供应商
 * @property mixed created_at | 新建时间
 * @property mixed updated_at | 修改时间
 */
class NewsMediaBean extends \EasySwoole\Spl\SplBean
{
	protected $id;

	protected $ecosystem;

	protected $pl;

	protected $order_no;

	protected $pay_no;

	protected $f0_no;

	protected $media_name;

	protected $apply_at;

	protected $audit_at;

	protected $charge_no;

	protected $charge_name;

	protected $department_no;

	protected $department_name;

	protected $order_id;

	protected $order_name;

	protected $audit_id;

	protected $audit_name;

	protected $project_id;

	protected $project_name;

	protected $order_amount;

	protected $pay_amount;

	protected $module;

	protected $description;

	protected $supplier_no;

	protected $supplier_name;

	protected $created_at;

	protected $updated_at;


	public function setId($id)
	{
		$this->id = $id;
	}


	public function getId()
	{
		return $this->id;
	}


	public function setEcosystem($ecosystem)
	{
		$this->ecosystem = $ecosystem;
	}


	public function getEcosystem()
	{
		return $this->ecosystem;
	}


	public function setPl($pl)
	{
		$this->pl = $pl;
	}


	public function getPl()
	{
		return $this->pl;
	}


	public function setOrderNo($order_no)
	{
		$this->order_no = $order_no;
	}


	public function getOrderNo()
	{
		return $this->order_no;
	}


	public function setPayNo($pay_no)
	{
		$this->pay_no = $pay_no;
	}


	public function getPayNo()
	{
		return $this->pay_no;
	}


	public function setF0No($f0_no)
	{
		$this->f0_no = $f0_no;
	}


	public function getF0No()
	{
		return $this->f0_no;
	}


	public function setMediaName($media_name)
	{
		$this->media_name = $media_name;
	}


	public function getMediaName()
	{
		return $this->media_name;
	}


	public function setApplyAt($apply_at)
	{
		$this->apply_at = $apply_at;
	}


	public function getApplyAt()
	{
		return $this->apply_at;
	}


	public function setAuditAt($audit_at)
	{
		$this->audit_at = $audit_at;
	}


	public function getAuditAt()
	{
		return $this->audit_at;
	}


	public function setChargeNo($charge_no)
	{
		$this->charge_no = $charge_no;
	}


	public function getChargeNo()
	{
		return $this->charge_no;
	}


	public function setChargeName($charge_name)
	{
		$this->charge_name = $charge_name;
	}


	public function getChargeName()
	{
		return $this->charge_name;
	}


	public function setDepartmentNo($department_no)
	{
		$this->department_no = $department_no;
	}


	public function getDepartmentNo()
	{
		return $this->department_no;
	}


	public function setDepartmentName($department_name)
	{
		$this->department_name = $department_name;
	}


	public function getDepartmentName()
	{
		return $this->department_name;
	}


	public function setOrderId($order_id)
	{
		$this->order_id = $order_id;
	}


	public function getOrderId()
	{
		return $this->order_id;
	}


	public function setOrderName($order_name)
	{
		$this->order_name = $order_name;
	}


	public function getOrderName()
	{
		return $this->order_name;
	}


	public function setAuditId($audit_id)
	{
		$this->audit_id = $audit_id;
	}


	public function getAuditId()
	{
		return $this->audit_id;
	}


	public function setAuditName($audit_name)
	{
		$this->audit_name = $audit_name;
	}


	public function getAuditName()
	{
		return $this->audit_name;
	}


	public function setProjectId($project_id)
	{
		$this->project_id = $project_id;
	}


	public function getProjectId()
	{
		return $this->project_id;
	}


	public function setProjectName($project_name)
	{
		$this->project_name = $project_name;
	}


	public function getProjectName()
	{
		return $this->project_name;
	}


	public function setOrderAmount($order_amount)
	{
		$this->order_amount = $order_amount;
	}


	public function getOrderAmount()
	{
		return $this->order_amount;
	}


	public function setPayAmount($pay_amount)
	{
		$this->pay_amount = $pay_amount;
	}


	public function getPayAmount()
	{
		return $this->pay_amount;
	}


	public function setModule($module)
	{
		$this->module = $module;
	}


	public function getModule()
	{
		return $this->module;
	}


	public function setDescription($description)
	{
		$this->description = $description;
	}


	public function getDescription()
	{
		return $this->description;
	}


	public function setSupplierNo($supplier_no)
	{
		$this->supplier_no = $supplier_no;
	}


	public function getSupplierNo()
	{
		return $this->supplier_no;
	}


	public function setSupplierName($supplier_name)
	{
		$this->supplier_name = $supplier_name;
	}


	public function getSupplierName()
	{
		return $this->supplier_name;
	}


	public function setCreatedAt($created_at)
	{
		$this->created_at = $created_at;
	}


	public function getCreatedAt()
	{
		return $this->created_at;
	}


	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = $updated_at;
	}


	public function getUpdatedAt()
	{
		return $this->updated_at;
	}
}

