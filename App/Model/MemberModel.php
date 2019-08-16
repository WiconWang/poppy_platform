<?php

namespace App\Model;
use App\Bean\{
    MemberBean
};

/**
 * 用户总表
 * Class MemberModel
 * Create With Automatic Generator
 */
class MemberModel extends BaseModel
{
	protected $table = 'members';

	protected $primaryKey = 'id';

    protected $openField  = ['id', 'username', 'mobile', 'email', 'photo', 'status', 'last_login', 'created_at', 'updated_at'];

    /**
     * @getAll
     * @keyword mobile
     * @param  int $page 1
     * @param array $keyword
     * @param  int $pageSize 10
     * @param bool $allowAllField
     * @return array[total,list]
     * @throws \EasySwoole\Mysqli\Exceptions\ConnectFail
     * @throws \EasySwoole\Mysqli\Exceptions\Option
     * @throws \EasySwoole\Mysqli\Exceptions\OrderByFail
     * @throws \EasySwoole\Mysqli\Exceptions\PrepareQueryFail
     * @throws \Throwable
     */
	public function getAll(int $page = 1, array $keyword = [], int $pageSize = 10, bool $allowAllField = false): array
	{
        if (!empty($keyword)) {
            if (isset($keyword['mobile']))
                $this->getDb()->where('mobile', $keyword['mobile']);
		}
        $fields = $allowAllField ? '*' : $this->openField;
		$list = $this->getDb()
		    ->withTotalCount()
		    ->orderBy($this->primaryKey, 'DESC')
		    ->get($this->table, [$pageSize * ($page  - 1), $pageSize], $fields);
		$total = $this->getDb()->getTotalCount();
		return ['total' => $total, 'list' => $list];
	}


	/**
	 * 默认根据主键(id)进行搜索
	 * @getOne
	 * @param  MemberBean $bean
	 * @param  string $field
	 * @return MemberBean
	 */
	public function getOne(MemberBean $bean, string $field = '*'): ?MemberBean
	{
		$info = $this->getDb()->where($this->primaryKey, $bean->getId())->getOne($this->table,$field);
		if (empty($info)) {
		    return null;
		}
		return new MemberBean($info);
	}


	/**
	 * 默认根据bean数据进行插入数据
	 * @add
	 * @param  MemberBean $bean
	 * @return bool
	 */
	public function add(MemberBean $bean): bool
	{
		return $this->getDb()->insert($this->table, $bean->toArray(null, $bean::FILTER_NOT_NULL));
	}


	/**
	 * 默认根据主键(id)进行删除
	 * @delete
	 * @param  MemberBean $bean
	 * @return bool
	 */
	public function delete(MemberBean $bean): bool
	{
		return  $this->getDb()->where($this->primaryKey, $bean->getId())->delete($this->table);
	}


	/**
	 * 默认根据主键(id)进行更新
	 * @delete
	 * @param  MemberBean $bean
	 * @param  array $data
	 * @return bool
	 */
	public function update(MemberBean $bean, array $data): bool
	{
		if (empty($data)){
		    return false;
		}
		return $this->getDb()->where($this->primaryKey, $bean->getId())->update($this->table, $data);
	}
}

