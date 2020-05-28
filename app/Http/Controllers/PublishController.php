<?php

namespace App\Http\Controllers;

use App\Repository\UserPublishRepository;

class PublishController extends Controller
{
    public function showDetail($id)
    {
        $data = $this->data;
        $data['publish'] = $this->getPublicById($id);
        return view("publish/detail", $data);
    }

    private function getPublicById($id)
    {
        $where = ['user_publish.id' => $id];
        $info = app(UserPublishRepository::class)->getPublishDetail($where);
        if(!$info) {
            return null;
        }
        if(!$info->head_img) {
            $info->head_img = "/res/images/avatar/default-user.png";
        }
        if($info->create_time) {
            $info->create_time = date('Y-m-d H:i', $info->create_time);
        }
        return (array)$info;
    }
}