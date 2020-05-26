<?php

namespace App\Http\Providers;

use App\Repository\Repository;
use Illuminate\Support\Facades\Redis;

class Helper
{
    public function getCategory()
    {
        $redis_key = "category";
        $category = Redis::get($redis_key);
        if($category) {
            return json_decode($category, true);
        }
        $repository = app(Repository::class);
        $repository->limit = 10;
        $category = $repository->getList("category", [], ['*']);
        foreach ($category as $key => $item){
            $category[$key] = (array)$item;
        }
        Redis::setex($redis_key, env('REDIS_LIFETIME'), json_encode($category));
        return $category;
    }

    public function getBlogroll()
    {
        $redis_key = "blogroll";
        $blogroll = Redis::get($redis_key);
        if($blogroll) {
            return json_decode($blogroll, true);
        }
        $repository = app(Repository::class);
        $repository->limit = 10;
        $blogroll = $repository->getList("blogroll", [], ['*']);
        foreach ($blogroll as $key => $item){
            $blogroll[$key] = (array)$item;
        }
        Redis::setex($redis_key, env('REDIS_LIFETIME'), json_encode($blogroll));
        return $blogroll;
    }
}