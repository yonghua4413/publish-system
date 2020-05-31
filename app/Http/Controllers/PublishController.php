<?php

namespace App\Http\Controllers;

use App\Repository\Repository;
use App\Repository\UserPublishRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class PublishController extends Controller
{
    public function showDetail($id)
    {
        $data = $this->data;
        $data['publish'] = $publish = $this->getPublicById($id);
        if ($publish) {
            $data['seo']['title'] = '|' . $publish['title'];
            $data['seo']['keywords'] = "," . $publish['title'];
            $data['seo']['description'] = "|" . $publish['brief'];
        }
        $this->helper->readAutoIncrement($id);
        return view("publish/detail", $data);
    }

    public function showAdd()
    {
        $data = $this->data;
        return view("publish/add", $data);
    }

    private function getPublicById($id)
    {
        $where = ['user_publish.id' => $id];
        $info = app(UserPublishRepository::class)->getPublishDetail($where);
        if (!$info) {
            return null;
        }

        //没有审核通过仅自己可见is_show
        if($info->is_show == 0) {
            $user = $this->request->session()->get("user");
            if(!$user || $user['id'] != $info->user_id) {
                return null;
            }
        }

        if (!$info->head_img) {
            $info->head_img = "/res/images/avatar/default-user.png";
        }
        if ($info->create_time) {
            $info->create_time = date('Y-m-d H:i', $info->create_time);
        }
        return (array)$info;
    }

    public function doAdd()
    {
        try {
            $post = $this->request->all();
            $captcha = $this->helper->checkCaptcha($post['ticket'], $post['randstr']);
            if ($captcha) {
                return $this->helper->returnJson($captcha);
            }
            unset($post['_token'], $post['ticket'], $post['randstr']);

            $title = Arr::get($post, "title", "");
            $category_id = Arr::get($post, "category_id", 0);
            $brief = Arr::get($post, "brief", "");
            $cover_img = Arr::get($post, "cover_img", "");
            $content = Arr::get($post, "content", "");

            if (empty($title)) {
                return $this->helper->returnJson([1, [], "标题不能为空！"]);
            }
            if (empty($category_id)) {
                return $this->helper->returnJson([1, [], "栏目不能为空！"]);
            }
            if (empty($brief)) {
                return $this->helper->returnJson([1, [], "简介不能为空！"]);
            }
            if (empty($content)) {
                return $this->helper->returnJson([1, [], "详情不能为空！"]);
            }
            $user_id = Arr::get(session()->get('user'), 'id', 0);
            $insert_data = [
                'title' => $title,
                'user_id' => $user_id,
                'category_id' => $category_id,
                'brief' => $brief,
                'cover_img' => $cover_img ? $cover_img : "",
                'content' => htmlspecialchars($content),
                'create_time' => time(),
                'is_show' => 0,
            ];
            $insert = app(Repository::class)->insert("user_publish", $insert_data);
            if ($insert) {
                return $this->helper->returnJson([0, ['redirect' => "/user/{$user_id}.html"], "发布成功，进入审核阶段！"]);
            }
            return $this->helper->returnJson([1, [], "请重试！"]);
        } catch (\Exception $exception) {
            return $this->helper->returnJson([1, [], $exception->getMessage()]);
        }
    }

    public function doModify()
    {
        try {
            $post = $this->request->all();
            $captcha = $this->helper->checkCaptcha($post['ticket'], $post['randstr']);
            if ($captcha) {
                return $this->helper->returnJson($captcha);
            }
            unset($post['_token'], $post['ticket'], $post['randstr']);

            $id = Arr::get($post, "id", 0);
            $title = Arr::get($post, "title", "");
            $category_id = Arr::get($post, "category_id", 0);
            $brief = Arr::get($post, "brief", "");
            $cover_img = Arr::get($post, "cover_img", "");
            $content = Arr::get($post, "content", "");

            if (empty($title)) {
                return $this->helper->returnJson([1, [], "标题不能为空！"]);
            }
            if (empty($category_id)) {
                return $this->helper->returnJson([1, [], "栏目不能为空！"]);
            }
            if (empty($brief)) {
                return $this->helper->returnJson([1, [], "简介不能为空！"]);
            }
            if (empty($content)) {
                return $this->helper->returnJson([1, [], "详情不能为空！"]);
            }
            $user_id = Arr::get(session()->get('user'), 'id', 0);
            $update_data = [
                'title' => $title,
                'user_id' => $user_id,
                'category_id' => $category_id,
                'brief' => $brief,
                'cover_img' => $cover_img ? $cover_img : "",
                'content' => htmlspecialchars($content),
                'is_show' => 0,
                'update_time' => time()
            ];
            $where = [
                'id' => $id,
                'user_id' => $user_id
            ];
            $change = app(Repository::class)->update("user_publish", $where, $update_data);
            if ($change) {
                return $this->helper->returnJson([0, ['redirect' => "/publish/detail/{$id}.html"], "修改成功, 请耐心等待审核"]);
            }
            return $this->helper->returnJson([1, [], "请重试！"]);
        } catch (\Exception $exception) {
            return $this->helper->returnJson([1, [], $exception->getMessage()]);
        }
    }

    public function showModify($id)
    {
        $data = $this->data;
        $where = ['user_publish.id' => $id];
        $data['publish'] = app(UserPublishRepository::class)->getPublishDetail($where);
        return view("publish/modify", $data);
    }
}
