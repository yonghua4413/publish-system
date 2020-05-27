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
            session()->put("user", (array)$user);
            return $this->helper->returnJson([0, ["redirect" => "/"], "登陆成功！"]);
        } catch (\Exception $exception) {
            return $this->helper->returnJson([1, [], $exception->getMessage()]);
        }
    }

    public function doReg(Repository $repository)
    {
        try {
            $post = $this->request->all();
            $ticket = Arr::get($post, 'ticket', null);
            $randstr = Arr::get($post, 'randstr', null);
            //检验007
            $captcha = $this->helper->checkCaptcha($ticket, $randstr);
            if($captcha) {
                return $this->helper->returnJson($captcha);
            }
            unset($post['_token'], $post['ticket'], $post['randstr']);

            $email = Arr::get($post, 'email', null);
            $user_name = Arr::get($post, 'user_name', null);
            $password = Arr::get($post, 'password', null);
            $repassword = Arr::get($post, 'repassword', null);

            if(!$email || !$this->helper->verifyEmail($email)) {
                return $this->helper->returnJson([1, [], "账户格式不正确！"]);
            }
            if(!$user_name) {
                return $this->helper->returnJson([1, [], "昵称不能为空！"]);
            }
            if(!$password) {
                return $this->helper->returnJson([1, [], "密码不能为空！"]);
            }
            if(!$repassword) {
                return $this->helper->returnJson([1, [], "确认密码不能为空！"]);
            }
            if($password != $repassword ) {
                return $this->helper->returnJson([1, [], "两次密码不一致！"]);
            }

            $user = $repository->getOne("user", ["email" => $post['email']], ["*"]);
            if($user) {
                return $this->helper->returnJson([1, [], "账户已注册！"]);
            }
            unset($post['repassword']);
            $post['password'] = md5($post['password']);
            $insert = $repository->insert('user', $post);
            if(!$insert) {
                return $this->helper->returnJson([1, [], "注册失败，请重试！"]);
            }
            return $this->helper->returnJson([0, ["redirect" => "/user/login.html"], "注册成功,即将转入登录页面！"]);
        } catch (\Exception $exception) {
            return $this->helper->returnJson([1, [], $exception->getMessage()]);
        }
    }

    public function loginOut()
    {
        $this->request->session()->remove("user");
        header("location: /");
    }
}