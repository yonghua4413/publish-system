<?php

namespace App\Http\Controllers;

use App\Repository\Repository;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function reg()
    {
        $data = $this->data;
        return view("user/reg", $data);
    }

    public function forget()
    {
        $data = $this->data;
        return view("user/forget", $data);
    }

    public function login()
    {
        $data = $this->data;
        return view("user/login", $data);
    }

    public function doLogin(Repository $repository)
    {
        try {
            $post = $this->request->all();
            unset($post['_token']);
            $email = Arr::get($post, 'email', null);
            if(!$email || !$this->helper->verifyEmail($email)) {
                return $this->helper->returnJson([1, [], "账户不存在或格式不正确！"]);
            }
            //检验007
            $captcha = $this->helper->checkCaptcha($post['ticket'], $post['randstr']);
            if($captcha) {
                return $this->helper->returnJson($captcha);
            }
            $user = $repository->getOne("user", ["email" => $post['email']], ["*"]);
            if(!$user) {
                return $this->helper->returnJson([1, [], "账户不存在！"]);
            }
            if($user->password != md5($post['password'])) {
                return $this->helper->returnJson([1, [], "账户或密码不正确！"]);
            }
            unset($user->password);
            session()->push("user", $user);
            return $this->helper->returnJson([0, ["redirect" => "/"], "登陆成功！"]);
        } catch (\Exception $exception) {
            return $this->helper->returnJson([1, [], $exception->getMessage()]);
        }
    }
}