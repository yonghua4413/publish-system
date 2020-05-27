<?php

namespace App\Http\Controllers;

use App\Repository\Repository;
use App\Repository\UserPublishRepository;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->data;
        $data['recommend'] = $this->getRecommend();
        $data['type'] = $this->request->get("type", "1");
        $data['list'] = $this->getList();
        return view("home/index", $data);
    }

    private function getRecommend($limit = 5)
    {
        $redis_key = "recommend";
        $recommend = Redis::get($redis_key);
        if ($recommend) {
            return json_decode($recommend, true);
        }
        $repository = app(UserPublishRepository::class);
        $recommend = $repository->getRecommend($limit);
        if (!$recommend) {
            return null;
        }
        foreach ($recommend as $key => $item) {
            $recommend[$key] = (array)$item;
        }
        Redis::setex($redis_key, 30, json_encode($recommend));
        return $recommend;
    }

    /**
     * @param int $_type 1 最新，2 热门
     * @return mixed|null
     */
    private function getList($_type = 1)
    {
        if ($this->request->get("type")) {
            $_type = $this->request->get("type");
        }
        $redis_key = "recommend_type_" . $_type;
        $list = Redis::get($redis_key);
        if ($list) {
            return json_decode($list, true);
        }
        $repository = app(UserPublishRepository::class);
        switch ($_type) {
            case 2:
                $list = $repository->getHot();
                break;
            default:
                $list = $repository->getNew();
        }

        if (!$list) {
            return null;
        }
        foreach ($list as $key => $item) {
            $list[$key] = (array)$item;
        }
        Redis::setex($redis_key, 30, json_encode($list));
        return $list;
    }
}