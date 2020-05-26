<?php

namespace App\Http\Middleware;

use App\Http\Providers\Helper;
use Closure;
use Illuminate\Http\Request;

class CommonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session("user");
        //用户信息
        View()->share('is_login', false);
        if ($user) {
            View()->share('is_login', true);
            View()->share('user', $user);
        }

        //default seo
        View()->share("seo", ["title" => "", "keywords" => "", "description" => ""]);

        //分类
        View()->share("category", app(Helper::class)->getCategory());
        View()->share("blogroll", app(Helper::class)->getBlogroll());
        return $next($request);
    }
}
