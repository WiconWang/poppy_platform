<?php

namespace App\HttpController\User;

use App\Bean\NewsMediaBean;
use App\Model\NewsMediaModel;
use App\Config\ReturnCode;
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
	 * @api {get|post} /User/NewsMedia/getOne
	 * @apiName getOne
	 * @apiGroup /User/NewsMedia
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
            $this->responseJson(ReturnCode::SUCCESS, '', $bean);
		} else {
            $this->responseJson(ReturnCode::RECORD_NOT_FOUND);
		}
	}


	/**
	 * @api {get|post} /User/NewsMedia/getAll
	 * @apiName getAll
	 * @apiGroup /User/NewsMedia
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
		$data = $model->getAll($page, $param??[], $limit);
        $this->responseJson(ReturnCode::SUCCESS, '', $data);
	}



	/**
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function getValidateRule(?string $action): ?Validate
	{
		$validate = null;
		switch ($action) {
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
		}
		return $validate;
	}
}

