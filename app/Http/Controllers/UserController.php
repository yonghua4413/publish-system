<?php

namespace App\Http\Controllers;

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
}