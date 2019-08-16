<?php

namespace App\Model;

use App\Bean\{
    AdminBean
};

/**
 * 超级管理员总表
 * Class AdminModel
 * Create With Automatic Generator
 */
class AdminModel extends BaseModel
{
    protected $table = 'admins';

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
                $this->getDb()->where('mobile', $keyword['mobile'],'=');
        }
        $fields = $allowAllField ? '*' : $this->openField;
        $list = $this->getDb()
            ->withTotalCount()
            ->orderBy($this->primaryKey, 'DESC')
            ->get($this->table, [$pageSize * ($page - 1), $pageSize], $fields);
        $total = $this->getDb()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }


    /**
     * 默认根据主键(id)进行搜索
     * @getOne
     * @param  AdminBean $bean
     * @param  string $field
     * @return AdminBean
     */
    public function getOne(AdminBean $bean, string $field = '*'): ?AdminBean
    {
        $info = $this->getDb()->where($this->primaryKey, $bean->getId())->getOne($this->table, $field);
        if (empty($info)) {
            return null;
        }
        return new AdminBean($info);
    }


    /**
     * 默认根据bean数据进行插入数据
     * @add
     * @param  AdminBean $bean
     * @return bool
     */
    public function add(AdminBean $bean): bool
    {
        return $this->getDb()->insert($this->table, $bean->toArray(null, $bean::FILTER_NOT_NULL));
    }


    /**
     * 默认根据主键(id)进行删除
     * @delete
     * @param  AdminBean $bean
     * @return bool
     */
    public function delete(AdminBean $bean): bool
    {
        return $this->getDb()->where($this->primaryKey, $bean->getId())->delete($this->table);
    }


    /**
     * 默认根据主键(id)进行更新
     * @delete
     * @param  AdminBean $bean
     * @param  array $data
     * @return bool
     */
    public function update(AdminBean $bean, array $data): bool
    {
        if (empty($data)) {
            return false;
        }
        return $this->getDb()->where($this->primaryKey, $bean->getId())->update($this->table, $data);
    }
}

