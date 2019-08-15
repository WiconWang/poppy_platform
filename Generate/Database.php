<?php
/**
 * 557 easy.
 * @author WiconWang <WiconWang@gmail.com>
 * @copyright  2019/8/14 7:58 PM
 */

include "./vendor/autoload.php";
use \EasySwoole\Mysqli\DDLBuilder\DDLBuilder as Builder;
use \EasySwoole\Mysqli\DDLBuilder\Blueprints\TableBlueprint as TableBlueprint;
//会员列表
//$result = Builder::table('user_list', function (TableBlueprint $blueprint) {
//    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
//    $blueprint->colVarChar('userAccount', '32')->setColumnComment('会员账号');
//    $blueprint->colVarChar('userName', '32')->setColumnComment('会员昵称');
//    $blueprint->colVarChar('userPassword', '32')->setColumnComment('会员密码');
//    $blueprint->colDateTime('addTime')->setColumnComment('新增时间');
//    $blueprint->colTinyInt('isAdmin', 1)->setColumnComment('是否会管理员')->setDefaultValue(0);
//    $blueprint->setTableComment('会员列表');
//    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
//    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
//    $blueprint->indexNormal('userAccount', ['userAccount']);
//});
//echo $result;

//文章分类列表
$result = Builder::table('news_media', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colTinyInt('ecosystem', 1)->setColumnComment('生态圈')->setDefaultValue(0);
    $blueprint->colVarChar('pl', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('PL部门');
    $blueprint->colVarChar('order_no', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('申请单号');
    $blueprint->colVarChar('pay_no', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('资金支付单号');
    $blueprint->colVarChar('f0_no', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('F0单号');
    $blueprint->colVarChar('media_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('媒体');
    $blueprint->colTimestamp('apply_at')->setIsNotNull(false)->setColumnComment('申请日期');
    $blueprint->colTimestamp('audit_at')->setIsNotNull(false)->setDefaultValue('')->setColumnComment('审核日期');
    $blueprint->colInt('charge_no', 11)->setIsNotNull()->setDefaultValue(0)->setColumnComment('出账公司编码');
    $blueprint->colVarChar('charge_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('出账公司名称');
    $blueprint->colVarChar('department_no', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('部门编码');
    $blueprint->colVarChar('department_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('部门名称');
    $blueprint->colInt('order_id', 11)->setIsNotNull()->setDefaultValue(0)->setColumnComment('申请人工号');
    $blueprint->colVarChar('order_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('申请人姓名');
    $blueprint->colInt('audit_id', 11)->setIsNotNull()->setDefaultValue(0)->setColumnComment('审核人工号');
    $blueprint->colVarChar('audit_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('审核人姓名');
    $blueprint->colVarChar('project_id', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('费用项目编码');
    $blueprint->colVarChar('project_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('费用项目名称');
    $blueprint->colInt('order_amount', 11)->setIsNotNull()->setDefaultValue(0)->setColumnComment('申请金额');
    $blueprint->colInt('pay_amount', 11)->setIsNotNull()->setDefaultValue(0)->setColumnComment('支付金额');
    $blueprint->colVarChar('module', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('系统来源名称');
    $blueprint->colVarChar('description', '255')->setIsNotNull()->setDefaultValue('')->setColumnComment('业务描述');
    $blueprint->colVarChar('supplier_no', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('供应商编码');
    $blueprint->colVarChar('supplier_name', '100')->setIsNotNull()->setDefaultValue('')->setColumnComment('供应商');
    $blueprint->colTimestamp('created_at')->setIsNotNull(false)->setColumnComment('新建时间');
    $blueprint->colTimestamp('updated_at')->setIsNotNull(false)->setColumnComment('修改时间');
    $blueprint->setTableComment('媒体总表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
});
echo $result;