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
$result = Builder::table('user_list', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colVarChar('userAccount', '32')->setColumnComment('会员账号');
    $blueprint->colVarChar('userName', '32')->setColumnComment('会员昵称');
    $blueprint->colVarChar('userPassword', '32')->setColumnComment('会员密码');
    $blueprint->colDateTime('addTime')->setColumnComment('新增时间');
    $blueprint->colTinyInt('isAdmin', 1)->setColumnComment('是否会管理员')->setDefaultValue(0);
    $blueprint->setTableComment('会员列表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
    $blueprint->indexNormal('userAccount', ['userAccount']);
});
echo $result;

//文章分类列表
$result = Builder::table('article_list', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colInt('pid', 11)->setColumnComment('上级id');
    $blueprint->colVarChar('categoryName', '64')->setColumnComment('分类名称');
    $blueprint->setTableComment('分类列表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
});
echo $result;

//文章列表
$result = Builder::table('article_list', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colInt('categoryId', 11)->setColumnComment('分类id');
    $blueprint->colVarChar('title', '64')->setColumnComment('标题');
    $blueprint->colVarChar('keyword', '64')->setColumnComment('关键字');
    $blueprint->colVarChar('description', '255')->setColumnComment('简介');
    $blueprint->colVarChar('author', '32')->setColumnComment('作者');
    $blueprint->colText('content')->setColumnComment('内容');
    $blueprint->colDateTime('addTime')->setColumnComment('新增时间');
    $blueprint->colTinyInt('isOriginal', 1)->setColumnComment('是否原创')->setDefaultValue(1);
    $blueprint->setTableComment('文章列表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
    $blueprint->indexNormal('title', ['title']);
});
echo $result;

//评论列表
$result = Builder::table('comment_list', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colInt('articleId', 11)->setColumnComment('文章id');
    $blueprint->colInt('commentPid', 11)->setColumnComment('评论父id')->setDefaultValue(0);
    $blueprint->colInt('userId', 11)->setColumnComment('评论会员id');
    $blueprint->colVarChar('userName', '64')->setColumnComment('评论会员名');
    $blueprint->colVarChar('content', '255')->setColumnComment('评论内容');
    $blueprint->colDateTime('addTime')->setColumnComment('评论时间');
    $blueprint->setTableComment('文章评论列表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
    $blueprint->indexNormal('articleId', ['articleId']);
    $blueprint->indexNormal('commentPid', ['commentPid']);
    $blueprint->indexNormal('userId', ['userId']);
});
echo $result;

//评论列表
$result = Builder::table('top_list', function (TableBlueprint $blueprint) {
    $blueprint->colInt('id', '11')->setColumnComment('主键id')->setIsPrimaryKey()->setIsAutoIncrement();
    $blueprint->colInt('articleId', 11)->setColumnComment('文章id');
    $blueprint->setTableComment('文章置顶列表');
    $blueprint->setTableEngine(\EasySwoole\Mysqli\DDLBuilder\Enum\Engines::INNODB);
    $blueprint->setTableCharset(\EasySwoole\Mysqli\DDLBuilder\Enum\Character::UTF8_GENERAL_CI);
    $blueprint->indexNormal('articleId', ['articleId']);
});
echo $result;