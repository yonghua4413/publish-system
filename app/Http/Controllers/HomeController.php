<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/26
 * Time: 13:29
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        $data = $this->data;
        return view("home/index", $data);
    }
}