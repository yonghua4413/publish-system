<?php

namespace App\Http\Controllers;

use App\Repository\UserPublishRepository;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    public function showSearch()
    {
        $data = $this->data;
        $data['q'] = $query = $this->request->get("q", "");
        $data['list'] = [];
        $list = $this->getList($query, $data);
        if($list) {
            $data['totalRow'] = $list->total();
            $data['list'] = $list->items();
            $data['totalPage'] = (int)ceil($data['totalRow']/$data['pageSize']);
        }
        return view("search/index", $data);
    }

    public function getList($title, $data)
    {
        if (empty($title)) {
            return null;
        }
        $page = (int)$this->request->get("page", 1);
        if($page > 1) {
            $data['page'] = $page;
        }
        $data['pageSize'] = 8;
        return app(UserPublishRepository::class)
            ->getListByTitle(
                "%" . $title . "%",
                Arr::get($data, 'page',1),
                Arr::get($data,"pageSize", 20)
            );
    }
}