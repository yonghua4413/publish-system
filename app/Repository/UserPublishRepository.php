<?php

namespace App\Repository;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserPublishRepository
{
    public function getRecommend($limit = 5)
    {
        return DB::table("user_publish")
            ->select(["user_publish.*", "user.user_name", "user.status as user_status", "category.name as category_name", "category.category_img"])
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
            ->select(["user_publish.*", "user.user_name", "user.status as user_status", "category.name as category_name", "category.category_img"])
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
            ->select(["user_publish.*", "user.user_name", "user.status as user_status", "category.name as category_name", "category.category_img"])
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->leftJoin("category", "category.id", "=", "user_publish.category_id")
            ->where(['is_recommend' => 0, 'is_show' => 1, 'is_delete' => 0])
            ->orderBy("create_time", "desc")
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getHotUser($limit = 10)
    {
        $list = DB::select("SELECT user_id,COUNT(user_id) AS num FROM t_user_publish GROUP BY user_id ORDER BY num DESC LIMIT $limit");
        if (!$list) {
            return null;
        }
        $user_ids = Arr::pluck($list, 'user_id');
        $users = DB::table("user")
            ->whereIn('id', $user_ids)
            ->get(['id', "user_name", "head_img"])
            ->toArray();
        if (!$users) {
            return null;
        }

        $data = [];
        foreach ($list as $key => $item) {
            $data[$key] = (array)$item;
            foreach ($users as $k => $user) {
                if ($item->user_id == $user->id) {
                    $data[$key]['user_name'] = $user->user_name;
                    $data[$key]['head_img'] = $user->head_img ? $user->head_img : "/res/images/avatar/default-user.png";
                    break;
                }
            }
        }
        return $data;
    }


    public function getUserInfoById($where = [], $field = ['*'])
    {
        return DB::table('user')
            ->where($where)
            ->get($field)
            ->first();
    }

    public function getUserBlog($where = [],$field = ['*'])
    {
        return DB::table('user_publish')
            ->where($where)
            ->get($field)
            ->toArray();
    }

    public function getListBySpell(String $spell = "", int $page = 1, int $size = 1)
    {
        return DB::table("category")
            ->select(["user_publish.*","user.user_name","user.status as user_status","category.name as category_name","category.category_img"])
            ->join("user_publish", "user_publish.category_id", "=", "category.id")
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->where(['category.spell'=> $spell])
            ->forPage($page)
            ->paginate($size);
    }

    public function getPublishDetail($where = [])
    {
        return DB::table("user_publish")
            ->select(["user_publish.*","user.user_name","user.head_img",
                "user.status as user_status","category.name as category_name","category.category_img"])
            ->leftJoin("user", "user.id", "=", "user_publish.user_id")
            ->leftJoin("category", "category.id", "=", "user_publish.category_id")
            ->where($where)
            ->where(['is_show' => 1, 'is_delete' => 0])
            ->first();
    }
}
