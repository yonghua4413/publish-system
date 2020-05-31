<?php

namespace App\Http\Middleware;

use App\Http\Providers\Helper;
use App\Repository\UserPublishRepository;
use Closure;
use Illuminate\Http\Request;

class CommonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session()->get("user");
        //用户信息
        View()->share('is_login', false);
        View()->share('user', null);
        if ($user) {
            View()->share('is_login', true);
            View()->share('user', $user);
        }

        //分类
        View()->share("category", app(Helper::class)->getCategory());
        //友链
        View()->share("blogroll", app(Helper::class)->getBlogroll());
        //热门用户
        View()->share("hot_user", app(Helper::class)->getHotUser());
        View()->share("spell", null);
        return $next($request);
    }
}
