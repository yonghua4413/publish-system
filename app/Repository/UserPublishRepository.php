<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class UserPublishRepository
{
    public function getRecommend($limit = 5)
    {
        return DB::table("user_publish")
            ->select(["user_publish.*","user.user_name","user.status as user_status","category.name as category_name"])
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->leftJoin("category", "category.id", "=", "user_publish.category_id")
            ->where(['is_recommend' => 1, 'is_show' => 1, 'is_delete' => 0])
            ->orderBy("read", "desc")
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getHot($limit = 15)
    {
        return DB::table("user_publish")
            ->select(["user_publish.*","user.user_name","user.status as user_status","category.name as category_name"])
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->leftJoin("category", "category.id", "=", "user_publish.category_id")
            ->where(['is_recommend' => 0, 'is_show' => 1, 'is_delete' => 0])
            ->orderBy("read", "desc")
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getNew($limit = 15)
    {
        return DB::table("user_publish")
            ->select(["user_publish.*","user.user_name","user.status as user_status","category.name as category_name"])
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->leftJoin("category", "category.id", "=", "user_publish.category_id")
            ->where(['is_recommend' => 0, 'is_show' => 1, 'is_delete' => 0])
            ->orderBy("create_time", "desc")
            ->limit($limit)
            ->get()
            ->toArray();
    }
}