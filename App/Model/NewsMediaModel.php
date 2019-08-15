<?php

namespace App\Model;

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
	 */
	public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10, string $field = '*'): array
	{
		if (!empty($keyword)) {
		    $this->getDb()->where('ecosystem', '%' . $keyword . '%', 'like');
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

