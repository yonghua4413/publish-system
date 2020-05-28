<?php

namespace App\Http\Controllers;

use App\Repository\UserPublishRepository;
use Illuminate\Support\Arr;

class CategoryController extends Controller
{
    public function showCategory($spell = "")
    {
        $data = $this->data;
        $data['list'] = [];
        $data['spell'] = $spell;
        $list = $this->getListObject($spell, $data);
        if($list) {
            $data['totalRow'] = $list->total();
            $data['list'] = $list->items();
            $data['totalPage'] = (int)ceil($data['totalRow']/$data['pageSize']);
        }
        return view("category/index", $data);
    }

    public function getListObject($spell, $data)
    {
        if (empty($spell)) {
            return null;
        }
        $page = (int)$this->request->get("page", 1);
        if($page > 1) {
            $data['page'] = $page;
        }
        $data['pageSize'] = 8;
        return app(UserPublishRepository::class)
            ->getListBySpell(
                $spell,
                Arr::get($data, 'page',1),
                Arr::get($data,"pageSize", 20)
            );
    }
}