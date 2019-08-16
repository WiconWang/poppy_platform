<?php

namespace App\Model;
use App\Bean\{
    NewsMediaBean
};

/**
 * 媒体总表
 * Class NewsMediaModel
 * Create With Automatic Generator
 */
class NewsMediaModel extends BaseModel
{
	protected $table = 'news_media';

	protected $primaryKey = 'id';


	/**
	 * @getAll
	 * @keyword ecosystem
	 * @param  int  $page  1
	 * @param  string  $keyword
	 * @param  int  $pageSize  10
	 * @param  string  $field  *
	 * @return array[total,list]
     *
     * @property int ecosystem | 生态圈
     * @property string media_name | 媒体
     * @property string order_name | 申请人姓名
     * @property string audit_name | 审核人姓名
     * @property string supplier_name | 供应商
     * @property mixed audit_at | 审核日期
	 */
	public function getAll(int $page = 1, array $keyword = [], int $pageSize = 10, string $field = '*'): array
	{
		if (!empty($keyword)) {
		    if (isset($keyword['ecosystem']))
		        $this->getDb()->where('ecosystem', $keyword['ecosystem']);

            if (isset($keyword['media_name']))
                $this->getDb()->where('media_name', '%' . $keyword['media_name'] . '%', 'like');

            if (isset($keyword['order_name']))
                $this->getDb()->where('order_name', '%' . $keyword['order_name'] . '%', 'like');

            if (isset($keyword['audit_name']))
                $this->getDb()->where('audit_name', '%' . $keyword['audit_name'] . '%', 'like');

            if (isset($keyword['supplier_name']))
                $this->getDb()->where('supplier_name', '%' . $keyword['supplier_name'] . '%', 'like');

            if (isset($keyword['audit_at_after']))
                $this->getDb()->where('audit_at', '%' . $keyword['audit_at_after'] . '%', '<');

            if (isset($keyword['audit_at_before']))
                $this->getDb()->where('audit_at', '%' . $keyword['audit_at_before'] . '%', '>');
		}
		$list = $this->getDb()
		    ->withTotalCount()
		    ->orderBy($this->primaryKey, 'DESC')
		    ->get($this->table, [$pageSize * ($page  - 1), $pageSize],$field);
		$total = $this->getDb()->getTotalCount();
		return ['total' => $total, 'list' => $list];
	}


	/**
	 * 默认根据主键(id)进行搜索
	 * @getOne
	 * @param  NewsMediaBean $bean
	 * @param  string $field
	 * @return NewsMediaBean
	 */
	public function getOne(NewsMediaBean $bean, string $field = '*'): ?NewsMediaBean
	{
		$info = $this->getDb()->where($this->primaryKey, $bean->getId())->getOne($this->table,$field);
		if (empty($info)) {
		    return null;
		}
		return new NewsMediaBean($info);
	}


	/**
	 * 默认根据bean数据进行插入数据
	 * @add
	 * @param  NewsMediaBean $bean
	 * @return bool
	 */
	public function add(NewsMediaBean $bean): bool
	{
		return $this->getDb()->insert($this->table, $bean->toArray(null, $bean::FILTER_NOT_NULL));
	}


	/**
	 * 默认根据主键(id)进行删除
	 * @delete
	 * @param  NewsMediaBean $bean
	 * @return bool
	 */
	public function delete(NewsMediaBean $bean): bool
	{
		return  $this->getDb()->where($this->primaryKey, $bean->getId())->delete($this->table);
	}


	/**
	 * 默认根据主键(id)进行更新
	 * @delete
	 * @param  NewsMediaBean $bean
	 * @param  array $data
	 * @return bool
	 */
	public function update(NewsMediaBean $bean, array $data): bool
	{
		if (empty($data)){
		    return false;
		}
		return $this->getDb()->where($this->primaryKey, $bean->getId())->update($this->table, $data);
	}
}

