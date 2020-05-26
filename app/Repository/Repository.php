<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class Repository
{
    public $orderBy = [];
    public $limit = 0;
    public $group = [];
    public $offset = 10;
    public $page = 1;
    public $in = [];

    public function getOne($table, $where = [], $field = ['*'])
    {
        return DB::table($table)->where($where)->first($field);
    }

    public function checkExists($table, $where = [])
    {
        return DB::table($table)->where($where)->exists();
    }

    public function count($table, $where = [], $field = ['*'])
    {
        return DB::table($table)
            ->where($where)
            ->where(function ($query) {
                if (!empty($this->in)) {
                    foreach ($this->in as $index => $value) {
                        $query->whereIn($index, $value);
                    }
                }

            })->count($field);
    }

    public function update($table, $where = [], $data)
    {
        return DB::table($table)
            ->where($where)
            ->where(function ($query) {
                if (!empty($this->in)) {
                    foreach ($this->in as $index => $value) {
                        $query->whereIn($index, $value);
                    }
                }
            })
            ->update($data);
    }

    public function insert($table, $data)
    {
        return DB::table($table)->insertGetId($data);
    }

    public function insertBatch($table, $data)
    {
        return DB::table($table)->insert($data);
    }

    /**
     * @param $table 数据表
     * @param $where 条件
     * @param $data  数据
     * 有则更新,没有则新增
     * @return int
     */
    public function firstOrCrate($table, $where = [], $data)
    {
        $exists = $this->checkExists($table,$where);
        if ($exists){
            return $this->update($table,$where,$data);
        }else{
            return $this->insert($table,$data);
        }
    }

    public function getList($table, $where = [], $field = ['*'])
    {
        return DB::table($table)
            ->where($where)
            ->when(count($this->orderBy), function ($query) {
                foreach ($this->orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->where(function ($query) {
                if (!empty($this->in)) {
                    foreach ($this->in as $index => $value) {
                        $query->whereIn($index, $value);
                    }
                }
            })
            ->when(count($this->group), function ($query) {
                $query->groupBy($this->group);
            })
            ->when($this->limit, function ($query) {
                $query->limit($this->limit);
            })
            ->get($field)
            ->toArray();
    }

    public function getEachPageList($table, $where = [], $field = ['*'])
    {
        return DB::table($table)
            ->select($field)
            ->where($where)
            ->when(count($this->orderBy), function ($query) {
                foreach ($this->orderBy as $key => $item) {
                    $query->orderBy($key, $item);
                }
            })
            ->where(function ($query) {
                if (!empty($this->in)) {
                    foreach ($this->in as $index => $value) {
                        $query->whereIn($index, $value);
                    }
                }
            })
            ->when(count($this->group), function ($query) {
                $query->groupBy($this->group);
            })
            ->when($this->limit, function ($query) {
                $query->limit($this->limit);
            })
            ->forPage($this->page)
            ->paginate($this->offset);
    }

    /**
     * 自增
     */
    public function increment($table, $where, $field, $value = 1)
    {

        return DB::table($table)
            ->where($where)
            ->increment($field, $value);
    }

    public function formatPage($table, $where = [], $field = ['*'])
    {
        $builder = $this->getEachPageList($table, $where, $field);

        return [
            'total' => $builder->total(),
            'items' => $builder->items()
        ];
    }

    public function delete($table,$where)
    {
        return DB::table($table)
            ->where($where)
            ->where(function ($query) {
                if (!empty($this->in)) {
                    foreach ($this->in as $index => $value) {
                        $query->whereIn($index, $value);
                    }
                }
            })
            ->delete();
    }
}
